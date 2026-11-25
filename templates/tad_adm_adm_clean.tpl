<script>
  $(function(){
    $("#clickAll").on('change', function () {
        $("input[type='checkbox'].dirfile").prop('checked', $(this).prop("checked"));
        updateSize();
    });

    $(".dirfile").on('change', function(){
        if($(this).is(":checked")){
            $(this).parent().addClass("text-danger");
        }else{
            $(this).parent().removeClass("text-danger");
        }
        updateSize();
    });

    updateSize();
  });

  function updateSize() {
     var totalSize = 0;
     $('.dirfile:checked').each(function() {
       var size = parseInt($(this).prop('title'), 10);
       if (!isNaN(size)) {
         totalSize += size;
       }
     });

     var humanSize = humanFileSize(totalSize,false);
     $('#totalSize').text(humanSize);
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
  <h2><{$dir|default:''|escape:'html'}></h2>
  <{if $all_dir|default:false or $all_files|default:false}>
  <form action="clean.php" method="post" class="form-horizontal" role="form">
    <div class="card panel panel-primary" style="width: 640px;">
      <div class="card-header text-white bg-primary panel-heading">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="clickAll" value="" checked>
          <label class="form-check-label" for="clickAll"><{$dir|default:''|escape:'html'}> (<span id="totalSize"><{$total_size|default:''|escape:'html'}></span>)</label>
        </div>
      </div>
      <!-- Table -->
      <table class="table">
      <{foreach from=$all_dir|default:[] item=dir_item name=dir_loop}>
        <tr>
          <td>
            <div class="form-check form-check-inline">
              <input class="form-check-input dirfile" name="dirs[]" type="checkbox" id="clean_dir_<{$smarty.foreach.dir_loop.index}>" value="<{$dir_item.dir_path|escape:'html'}>" checked title="<{$dir_item.size|default:0|escape:'html'}>">
              <label class="form-check-label" for="clean_dir_<{$smarty.foreach.dir_loop.index}>">
                <i class="fa fa-folder-open" aria-hidden="true"></i> <{$dir_item.dir_name|escape:'html'}>
              </label>
            </div>
          </td>
          <td style="text-align: right;"><{$dir_item.dir_size|escape:'html'}></td>
          </tr>
      <{/foreach}>
      <{foreach from=$all_files|default:[] item=file_item name=file_loop}>
        <tr>
          <td>
            <div class="form-check form-check-inline text-info">
              <input class="form-check-input dirfile" name="files[]" type="checkbox" id="clean_file_<{$smarty.foreach.file_loop.index}>" value="<{$file_item.file_path|escape:'html'}>" checked title="<{$file_item.file_size|default:0|escape:'html'}>">
              <label class="form-check-label" for="clean_file_<{$smarty.foreach.file_loop.index}>">
                  <i class="fa fa-file-text" aria-hidden="true"></i> <{$file_item.file_name|escape:'html'}>
              </label>
            </div>
          </td>
          <td style="text-align: right;"><{$file_item.file_size|escape:'html'}></td>
          </tr>
      <{/foreach}>
      </table>
    </div>
    <input type="hidden" name="op" value="del_templates">
    <input type="hidden" name="XOOPS_TOKEN_REQUEST" value="<{$token|default:''|escape:'html'}>">
    <button type="submit" class="btn btn-danger"><{$smarty.const._MA_TADADM_CLEAN}></button>
  </form>
  <{else}>
    <div class="alert alert-info"><h2><{$smarty.const._MA_TADADM_CLEANED}></h2></div>
  <{/if}>
</div>
