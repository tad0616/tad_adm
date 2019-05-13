<link href="<{$xoops_url}>/modules/tadtools/css/font-awesome/css/font-awesome.css" rel="stylesheet">
<script language="JavaScript">
  $().ready(function(){
    $("#clickAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
        updateSize();
    });

    $(".dirfile").change(function(){
        if($(this).is(":checked")){
            $(this).parent().addClass("text-danger");
        }else{
            $(this).parent().removeClass("text-danger");
        }
    });

    $('.dirfile').click(updateSize);
    updateSize();
  });



  function updateSize() {
     var totalSize = 0;
     $('.dirfile:checked').each(function() {
       size = $(this).prop('title');
       totalSize += parseInt(size);
     });

     var humanSize = humanFileSize(totalSize,false);
     $('#totalSize').html(humanSize);
  }


  function humanFileSize(bytes, si) {
      var thresh = si ? 1000 : 1024;
      if(Math.abs(bytes) < thresh) {
          return bytes + ' B';
      }
      var units = ['kB','MB','GB','TB','PB','EB','ZB','YB'];
      var u = -1;
      do {
          bytes /= thresh;
          ++u;
      } while(Math.abs(bytes) >= thresh && u < units.length - 1);
      return bytes.toFixed(1)+' '+units[u];
  }

</script>


<div class="container-fluid">

  <h1><{$smarty.const._MA_TADADM_FREE_SPACE}><{$free_space}></h1>
  <form action="zip.php" method="post" class="form-horizontal" role="form">
    <div class="panel panel-primary"  style="width: auto;">
      <div class="panel-heading">
        <label class="checkbox-inline">
          <input id="clickAll" type="checkbox" checked>
          <{$dir}> (<span id="totalSize"><{$total_size}></span>)
        </label>
      </div>
      <!-- Table -->
      <table class="table">
      <{foreach from=$all_dir item=dir}>
        <tr>
          <td>
            <label class="checkbox-inline">
              <input type="checkbox" name="dirs[]" value="<{$dir.dir_path}>" checked title="<{$dir.size}>" class="dirfile">
              <i class="fa fa-folder-open-o" aria-hidden="true"></i> <{$dir.dir_name}>
            </label>
          </td>
          <td style="text-align: right;"><{$dir.dir_size}></td>
          </tr>
      <{/foreach}>
      <{foreach from=$all_files item=file}>
        <tr>
          <td>
            <label class="checkbox-inline text-info">
              <input type="checkbox" name="files[]" value="<{$file.file_path}>" checked title="<{$file.size}>" class="dirfile">
              <i class="fa fa-file-text-o" aria-hidden="true"></i> <{$file.file_name}>
            </label>
          </td>
          <td style="text-align: right;"><{$file.file_size}></td>
          </tr>
      <{/foreach}>
      </table>
    </div>

    <button type="submit" class="btn btn-primary"><{$smarty.const._MA_TADADM_DOWNLOAD_ZIP}></button>
  </form>

</div>