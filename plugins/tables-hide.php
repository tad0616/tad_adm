<?php

/** 
 * Enable hiding tables in menu list
 *
 * Install to Adminer on http://www.adminer.org/plugins/
 * @author Pavel Kutáč, http://www.kutac.cz/
 * 
 * Filter inspiration by Jakub Vrana: https://raw.githubusercontent.com/vrana/adminer/master/plugins/tables-filter.php
 * 
 */
class AdminerTablesHide {
	
	function tablesPrint($tables) {
		$jsonTables = array();    
		foreach ($tables as $table => $status) {
		  $jsonTables[] = array(
			'table' => $table,
			'isView' => is_view($status),
			'show' => support("table") || support("indexes"),
			'selected' => in_array($table, array($_GET["table"], $_GET["create"], $_GET["indexes"], $_GET["foreign"], $_GET["trigger"], $_GET["select"], $_GET["edit"], $_GET["view"])),
			'fullTableName' => $_GET[DRIVER]."-".$_GET["db"]."-".$table
		  );
		}
		?>
		<style<?php echo nonce(); ?>>
			p.toggleTableVisible{
				cursor: pointer;
			}
			#menu.hiddenVisible .hideT{
				display: inline;
			}
			.hideT, #tables li.hiddenTable, #menu.hiddenVisible .showT{
				display: none;
			}
			#menu.hiddenVisible #tables li.hiddenTable{
				display: inline;
				opacity: 0.5;
			}		  
			#tables li.filtered, #menu.hiddenVisible #tables li.hiddenTable.filtered{
				display: none;
			}
			#tables a.toggleVisible{
				background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAAKCAYAAABv7tTEAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAANJJREFUeNp00cEGAkEcx/HYpEN0jei0RKfouqceoOsSsW8QEd16lD31DBG9QDp1WmIpS8QSER2yfSe/ydj057N27fxnfjPjVf5XF7neW9iijp07qIEpDijkiRESZPDdBvNx1MAUYwwQqOGECXq2oa0YpuGGDuYYaiLTEOGBq11t7cSJNXukFVNNEjtjNlUeNSemhzNWeGGpJD/la9k7QsVJFG9Rip9r5U/1tXnbEOggQkUs9M8v30mmhlBHbfdwwQzNckRzWntdot3boLTfb70FGACGeTlEq+2nVAAAAABJRU5ErkJggg==);
				display: inline-block;
				height: 10px;
				visibility: hidden;
				width: 13px;
			}
			#tables li.hiddenTable a.toggleVisible{
				background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAAKCAYAAABv7tTEAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAALZJREFUeNpiZsAEokCsCcS+UP4fIP7GgAPoAvEKIP4Pxd+Q2Cug8iggBEnROqhtICAB5cMMCYFpsIc6ASRxD4j5gfgwlA+ieYD4BpT/B6qe4TaSM2YCcSAS/z+UPxOJf5sJSCxDcqYcEF8D4l9Q/i8oXxpJDVg9GxBvQbI+BOrpNCjth+T8LVD1YMAMxF1IgQGSnIZk2DeoPEgdAyOWOEoAYhUgVgfim0B8B4gXAPFrBkoAQIABAO6KOXvUtxGwAAAAAElFTkSuQmCC);
			}
			#tables.min a.toggleVisible{
				visibility: visible;
			}
		</style>

		<p class="jsonly">Filter: <input id="filterInput"></p>
		<ul id="tables"></ul>
		<p class="toggleTableVisible"><span class="showT">Show</span><span class="hideT">Hide</span> hidden tables</p>

		<script<?php echo nonce(); ?>>
			var menuTables = <?php echo json_encode($jsonTables); ?>;
			var baseUrl = <?php echo json_encode(ME); ?>;
			var selectLang = <?php echo json_encode(lang('select')); ?>;
			var structureLang = <?php echo json_encode(lang('Show structure')); ?>;
			var hiddenTables = [];
			var currentDatabase = "<?php echo $_GET[DRIVER]."-".$_GET["db"]; ?>";
			var menuBlock = qs("#menu");
			var tablesEl = qs("#tables");
			/**
			 * Click on button for hide/show hidden button
			 */
			function bclick(){
				if(menuBlock.classList.contains("hiddenVisible")){
					menuBlock.classList.remove("hiddenVisible")
				}else{
					menuBlock.classList.add("hiddenVisible")
				}
			}
			/**
			* Toggle visibility of table and save
			* @return bool
			*/
			function toggleVisible(e){
				var parent = this.parentElement, tableName = currentDatabase, hashPosition = this.href.indexOf("#");
				if(hashPosition < 1){
					return true;
				}
				tableName += "-" + this.href.substring(hashPosition + 1);
				var tableIndex = inTables(tableName);
				if(tableIndex > -1){
					hiddenTables.splice(tableIndex, 1);
				}else{
					hiddenTables.push(tableName);
				}
				localStorage.setItem("adminer_tablesHide", hiddenTables.join("|"));
				e.preventDefault();
				filterTables.call(qs("#filterInput"));
				return false;
			}
			/**
			* Initialize tables after menu is loaded
			*/
			function initTables() {
				hiddenTables = (localStorage.getItem("adminer_tablesHide") || "").split("|").filter(function(el) {return el.length != 0});
				tablesEl.classList.add("hidingTablesPlugin");
				filterTables();
			}
			/**
			* Check if table is in array of hidden tables
			* @param string s Name of table
			* @returns integer Index in array of table or -1 if isn't there
			*/
			function inTables(s){
				for(var i = 0; i < hiddenTables.length; i++){
					if(hiddenTables[i] == s){
						return i;
					}
				}
				return -1;
			}
			/**
			 * Filter tables and print new list
			 */
			function filterTables() {
				value = this.value || "";
				tablesEl.innerHTML = "";
				for (var i = 0; i < menuTables.length; i++ ) {          
					if (menuTables[i].table.indexOf(value) >= 0) {
						var spn = document.createElement("li");
						if (menuTables[i].selected) {
							spn.classList.add("bold");
						}
						if (inTables(menuTables[i].fullTableName) >= 0) {
							spn.classList.add("hiddenTable");
						}

						var showHideButton = document.createElement("a");
						showHideButton.href = "#" + encodeURIComponent(menuTables[i].table);
						showHideButton.className = "toggleVisible";

						var selectA = document.createElement("a");
						selectA.appendChild(document.createTextNode(selectLang));
						selectA.href = baseUrl + "select=" + encodeURIComponent(menuTables[i].table);
						selectA.className = "select" + (menuTables[i].isView ? " is-view" : "");

						var structureA = document.createElement("a");
						structureA.appendChild(highlightFoundPart(menuTables[i].table, value));
						structureA.href = baseUrl + "table=" + encodeURIComponent(menuTables[i].table);
						structureA.title = structureLang;

						spn.appendChild(showHideButton);
						spn.appendChild(document.createTextNode(" "));
						spn.appendChild(selectA);
						spn.appendChild(document.createTextNode(" "));
						spn.appendChild(structureA);
						tablesEl.appendChild(spn).appendChild(document.createElement("br"));
					}
				}
			}
			/**
			 * Return new element with highlighted searched part
			 * @return DOMElement
			 */
			function highlightFoundPart(name, search){
				if (search == "") {
					return document.createTextNode(name);
				}

				var wrap = document.createElement("span");
				wrap.className = "noBg";
				var startIndex = name.indexOf(search);
				if (startIndex > 0) {
					wrap.appendChild(document.createTextNode(name.substring(0, startIndex)));
				}
				var strongEl = document.createElement("strong");
				strongEl.appendChild(document.createTextNode(name.substring(startIndex, startIndex + search.length)));
				wrap.appendChild(strongEl);
				if (name.length > startIndex + search.length) {
					wrap.appendChild(document.createTextNode(name.substring(startIndex + search.length)));
				}
				return wrap;
			}
			function menuOverATH(e) {
				menuOver.call(this, e);
				this.classList.add("min");
			}
			function menuOutATH(e) {
				menuOut.call(this, e);
				this.classList.remove("min");
			}
			mixin(qs("#filterInput"), {onkeyup: filterTables});
			mixin(qs(".toggleTableVisible"), {onclick: bclick});
			mixin(qs('#tables'), {onmouseover: menuOverATH, onmouseout: menuOutATH});
			tablesEl.addEventListener("click", function (e) {
				var t = event.target;
				var ret = true;
				while (t && t !== this) {
					if (t.matches("a.toggleVisible")) {
						if(toggleVisible.call(t, event) === false){
							ret = false;
						}
					}
					t = t.parentNode;
				}
				return ret;
			});
			initTables();
		</script>
		<?php 
		return true;
	}	
}
