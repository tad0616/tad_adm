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

    <form action="zip.php" method="post" class="form-horizontal" role="form">
        <div class="card panel panel-primary">
            <div class="panel-heading card-header text-white bg-primary">
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
                    <td style="text-align: right;"><{if $dir.fileowner.name|default:false}><{$dir.fileowner.name}><{$dir.fileowner.name}>:<{$dir.filegroup.name}><{/if}></td>
                    <td style="text-align: right;"><{$dir.fileperms}></td>
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
                    <td style="text-align: right;"><{if $file.fileowner.name|default:false}><{$file.fileowner.name}>:<{$file.filegroup.name}><{/if}></td>
                    <td style="text-align: right;"><{$file.fileperms}></td>
                </tr>
            <{/foreach}>
            </table>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary"><{$smarty.const._MA_TADADM_DOWNLOAD_ZIP}></button>
        </div>
    </form>
</div>