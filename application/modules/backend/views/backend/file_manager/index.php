<link rel="stylesheet" href="<?=config_item('sty_back')?>plugins/datatables/dataTables.bootstrap4.min.css">
<script src="<?=config_item('sty_back')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=config_item('sty_back')?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<div class="row">
  <div class="col-md-12 m-b-40">
    <div class="row">
      <div class="col-sm-4">
        <a href="#" class="btn btn-success btn-sm" id="button-upload"> Upload Gambar</a>
        <input type="file" style="display:none" name="file" id="file-image" accept="image/jpeg,image/x-png">
      </div>
      <div id="data-info" style="font-size:12px" class="col-sm-8"></div>
    </div>
  </div>

  <div class="col-md-12">
    <table id="table-img" class="table table-bordered">
      <thead>
        <tr>
          <th>File Name</th>
          <th>Size</th>
          <th class="text-center">#</th>
        </tr>
      </thead>
    </table>

  </div>
</div>


<script type="text/javascript">
$(document).ready(function (){
  var table = $('#table-img').DataTable({
      oLanguage: {
          sProcessing: "Memuat Data..."
      },
      processing: true,
      ajax: {
            "url":"<?=base_url()?>backend/file_manager/json/<?=$str?>"
      },
      order: [[0, 'ASC']]
  });
});

$(document).on('click','#remove_image',function(e){
  e.preventDefault();
  $.ajax({
          url:$(this).attr('href'),
          type:'post',
          cache:false,
          dataType:'json',
          success:function(json){
            $('#table-img').DataTable().ajax.reload();
            $('#data-info').hide().fadeIn(1000).html(json.alert_info);
            $('.text-alert').delay(5000).show(10, function(){
              $('.text-alert').fadeOut(1000, function(){
                $('.text-alert').remove();
              });
            })
          }
        });
});

$(document).on('click',"#pilih-img", function(e) {
  var img = $(this).attr('title');
      $('#modalGue').modal('hide');
      $(".image").val(img);
      $("#text-img").text(img);
      $("#text-img").attr("href",'<?=base_url()?>temp/img_manager/<?=$str?>/'+img);

});




$(function () {
        var fileupload = $("#file-image");
        var button = $("#button-upload");
        button.click(function () {
            fileupload.click();
        });
        fileupload.change(function () {
            var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
            // $("#data-info").text(fileName);

            var file_data = $('#file-image').prop('files')[0];
            var form_data = new FormData();
            $("#button-upload").text('Memproses...');

            form_data.append('file', file_data);
            $.ajax({
                url: '<?=base_url()?>backend/file_manager/do_upload/<?=$str?>',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(data){
                      $("#button-upload").text('Upload Gambar');
                        $('#data-info').hide().fadeIn(1000).html(data.msg);
                        $('.form-group').removeClass('.has-error')
                                        .removeClass('.has-success');
                          $('#table-img').DataTable().ajax.reload();
                          $('.text-alert').delay(5000).show(10, function(){
                            $('.text-alert').fadeOut(1000, function(){
                              $('.text-alert').remove();
                            });
                          })
                }
            });

        });
    });
</script>
