<script language="JavaScript">
  $().ready(function(){
    $("#clickAll").on('change', function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
        updateSize();
    });

    $(".dirfile").on('change', function(){
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
  <h2><{$dir|default:''}></h2>
  <{if $all_dir|default:false}>
  <form action="clean.php" method="post" class="form-horizontal" role="form">
    <div class="card panel panel-primary" style="width: 640px;">
      <div class="card-header text-white bg-primary panel-heading">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="clickAll" value="" checked>
          <label class="form-check-label" for="clickAll"><{$dir|default:''}> (<span id="totalSize"><{$total_size|default:''}></span>)</label>
        </div>
      </div>
      <!-- Table -->
      <table class="table">
      <{foreach from=$all_dir item=dir}>
        <tr>
          <td>
            <div class="form-check form-check-inline">
              <input class="form-check-input dirfile" name="dirs[]" type="checkbox" id="clickAll" value="<{$dir.dir_path}>" checked title="<{$dir.size}>" >
              <label class="form-check-label" for="clickAll">
                <i class="fa fa-folder-open" aria-hidden="true"></i> <{$dir.dir_name}>
              </label>
            </div>
          </td>
          <td style="text-align: right;"><{$dir.dir_size}></td>
          </tr>
      <{/foreach}>
      <{foreach from=$all_files item=file}>
        <tr>
          <td>
            <div class="form-check form-check-inline text-info">
              <input class="form-check-input dirfile" name="files[]" type="checkbox" id="clickAll" value="<{$file.file_path}>" checked title="<{$file.size}>" >
              <label class="form-check-label" for="clickAll">
                  <i class="fa fa-file-text" aria-hidden="true"></i> <{$file.file_name}>
              </label>
            </div>
          </td>
          <td style="text-align: right;"><{$file.file_size}></td>
          </tr>
      <{/foreach}>
      </table>
    </div>
    <input type="hidden" name="op" value="del_templates">
    <button type="submit" class="btn btn-danger"><{$smarty.const._MA_TADADM_CLEAN}></button>
  </form>
  <{else}>
    <div class="alert alert-info"><h2><{$smarty.const._MA_TADADM_CLEANED}></h2></div>
  <{/if}>
</div>
