<?php
/**
 * Autocompletion for search plugin
 * ================================
 * Delivers Excel-like behaviour when filtering tables using the search-fields. 
 * After selecting a column for search using the drop-down, all values in this column are fetched using AJAX and can be selected directly in the search text-field.
 * When one or more columns are already set for search then these values will be respected when autocomplete values are fetched from the database. This way, the search is refined with each selected column. 
 * 
 * Example: 
 *  - column `lastName` is selected with the value `Smith`
 *  - the user selects column `firstName`
 *  => only first names of all Smiths will be given for autocomplete 
 *
 * Written in vanilla JavaScript, no jquery needed.
 * 
 * Tested with Adminer 4.8.1 in PHP8.1 on MySQL in FireFox 104  and >5000 distinct values within one column without any performance degredation.
 * 
 * NOTE: Will fetch values with line feeds as well but those will be converted by the browser to single lines due to the features of the input field. So the search won't find the values in these cases. This is not this plugin's fault.
 *
 * @author Stephan Herrmann, https://github.com/derStephan/AdminerPlugins
 * @license MIT
 *
 */
class searchAutocomplete
{	
	//react to ajax-requests with json
	public function headers() 
	{
		global $driver;
		if(isset($_POST["getAutoCompleteData"]))
		{			
			//this will likely not use any indexes. So give up pretty quickly (5s). 
			set_time_limit (5);
			//if you fail, do it silently
			//error_reporting (0);
			
			//make safe against all kinds of threats
			$column=preg_replace("/[^a-zA-Z0-9_-]/", "", $_POST["getAutoCompleteData"]);
			$table=preg_replace("/[^a-zA-Z0-9_-]/", "", $_GET["select"]);
			
			unset($_POST["getAutoCompleteData"]);
			
			$where= array();
			$fields=array();
			
			//each new search field refines the search for autocomplete
			//reuse relevant parts of Adminer::selectSearchProcess. Just using static method won't work.
			//get SQL from operation-selection.
			$adminer=new Adminer();
			foreach ((array) $_POST["where"] as $key => $val) 
			{
				
				$prefix = "";
				$cond = " $val[op]";
				if (preg_match('~IN$~', $val["op"])) {
					$in = process_length($val["val"]);
					$cond .= " " . ($in != "" ? $in : "(NULL)");
				} elseif ($val["op"] == "SQL") {
					$cond = " $val[val]"; // SQL injection
				} elseif ($val["op"] == "LIKE %%") {
					$cond = " LIKE " . $adminer->processInput($fields[$val["col"]], "%$val[val]%");
				} elseif ($val["op"] == "ILIKE %%") {
					$cond = " ILIKE " . $adminer->processInput($fields[$val["col"]], "%$val[val]%");
				} elseif ($val["op"] == "FIND_IN_SET") {
					$prefix = "$val[op](" . q($val["val"]) . ", ";
					$cond = ")";
				} elseif (!preg_match('~NULL$~', $val["op"])) {
					$cond .= " " . $adminer->processInput($fields[$val["col"]], $val["val"]);
				}
				
				$Min_SQL=new Min_SQL(null );				
				$where[] = $prefix .  $Min_SQL->convertSearch(idf_escape($val["col"]), $val, $fields[$val["col"]]) . $cond;
			}	
				
			//this will likely not use any indexes. 
			$whereSQL="";
			if($where)
				$whereSQL= " WHERE " . implode(" AND ", $where);


			//to order even text-columns naturally, use this ugly hack, this is tested in MySQL only. Sorry.
			$orderSQLforNaturalSort="`$column`+0<>0 DESC, `$column`+0, `$column`";		
			//deliver json
			echo json_encode(get_vals("SELECT DISTINCT `$column` FROM `$table` $whereSQL ORDER BY $orderSQLforNaturalSort"));
			//stop delivering anything...
			die();
		}
			
	}
	
	public function head()
	{
		//all of this is only applicable in the simple table view
		if(!isset($_GET["select"]))
			return;
	?>
		<script <?php echo nonce()?> type='text/javascript'>
		//prepare autocomplete searchFields on page load
		document.addEventListener('DOMContentLoaded', function()
		{
			//get all search dropDowns
			var searchFieldDropDowns=document.querySelectorAll('#fieldset-search select[name$="[col]"]');

			for (let searchFieldDropDown of searchFieldDropDowns )
			{	
				//bind event to each dropDown 
				searchFieldDropDown.addEventListener('ValueChange', populateAutocompleteDataList);
			}
			
			//get all search text fields
			var searchFields=document.querySelectorAll('#fieldset-search input[name$="[val]"]');
			for (let searchField of searchFields )
			{
				//disable browser-integrated autocomplete, only use the existing values from the database
				searchField.setAttribute("autocomplete", "off");
				//bind event to each input 
				searchField.addEventListener('mousedown', populateAutocompleteDataList);				
			}
			
			//whenever a search is started, a new empty search row is added. 
			//this will register changeEvents for any new search row
			document.getElementById("fieldset-search").addEventListener('DOMNodeInserted', function(e)
			{
				//drop down
				if(e.target.childNodes[0])
					e.target.childNodes[0].addEventListener('ValueChange', populateAutocompleteDataList);
				//text fields
				if(e.target.childNodes[4])
					e.target.childNodes[4].addEventListener('mousedown', populateAutocompleteDataList);
			});
		});
		
		function populateAutocompleteDataList(e)
		{
			//column to be searched
			var column="";
			
			//called from text field
			if(e.type=="mousedown")
				column=e.target.parentElement.childNodes[0].value;
			//called from drop down
			if(e.type=="ValueChange")
				column=e.target.value;			

			//no column selected, stop.
			if(column=="")
				return;
			
			//create datalist object if it does not exist
			if(!document.getElementById("autocompleteSource"))
			{
				//add datalist to searchfieldset. 
				var dataList = document.createElement("datalist");
				dataList.setAttribute("id", "autocompleteSource");
				document.getElementById("fieldset-search").appendChild(dataList);
			}
			var dataList=document.getElementById("autocompleteSource");
			
			//if the last searched column was the same as now, do not bother the server again
			if(dataList.getAttribute("column")==column)
				return;
			
			//save to datalist which column is searched now.
			dataList.setAttribute("column",column);
			
			//get all values of all other search fields for refined search
			//this way we only see valid options in auto complete
			var searchData="";
			
			//walk through all search text fields
			var searchFieldInputs=document.querySelectorAll('#fieldset-search input[name$="[val]"]');
			let whereCount=0;
			for (let searchFieldInput of searchFieldInputs )
			{	
				
				//unbind datalist from all search text fields
				searchFieldInput.setAttribute("list", "");
				
				//get all information about the search
				var searchFieldColumn=encodeURIComponent(searchFieldInput.parentElement.childNodes[0].value);
				var searchFieldOperation=encodeURIComponent(searchFieldInput.parentElement.childNodes[2].value);
				var searchFieldValue=encodeURIComponent(searchFieldInput.value);

				//include in refined search only if the column is set
				if(column != searchFieldColumn && searchFieldColumn != "")
				{
					//build string for ajax request. This cannot be sent as an array, so I don't even bother.
					searchData+="where["+whereCount+"][col]="+searchFieldColumn+"&where["+whereCount+"][op]="+searchFieldOperation+"&where["+whereCount+"][val]="+searchFieldValue+"&";
					whereCount++;
				}
				
			}

			
			// clear any previously loaded options in the datalist
			dataList.innerHTML = "";
			
			//get all values in the column using ajax
			var autoCompleteXHR = new XMLHttpRequest();
			autoCompleteXHR.open("POST", "", true);
			autoCompleteXHR.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			//submit
			autoCompleteXHR.send("getAutoCompleteData=" + column+ "&" +searchData );
			autoCompleteXHR.onreadystatechange = function() 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					 // We're expecting a json response so we convert it to an object
					var response = JSON.parse( this.responseText ); 

					// clear any previously loaded options in the datalist
					dataList.innerHTML = "";

					response.forEach(function(item) 
					{
						// Create a new <option> element.
						var option = document.createElement('option');
						option.value = item;

						// attach the option to the datalist element
						dataList.appendChild(option);
					});
				}
			}
			
			//bind the datalist to the text field. 
			
			//if this event is fired from search text field
			if(e.type=="mousedown")
			{
				e.target.setAttribute("list", "autocompleteSource");
				e.target.focus();
			}
			//if this event is fired from drop down
			if(e.type=="ValueChange")
			{
				e.target.parentElement.childNodes[4].blur();
				e.target.parentElement.childNodes[4].setAttribute("list", "autocompleteSource");
				e.target.parentElement.childNodes[4].focus();
			}
		}
		</script>
	<?php
	}
}
