<style media="screen">
  .logo-pengaturan{
    max-width: 200px;
    max-height: 200px;
    width: 200px;
    height: 200px;
    background-repeat: no-repeat;
    background-size: contain;
  }

</style>

<div class="row">
  <div class="col-md-4">
    <div id="logo-pengaturan" class="logo-pengaturan" style='background-image:url(<?=base_url("temp/backend/logo/$logo")?>)'></div>
  </div>

  <div class="col-md-8">
    <table class="table  table-borderless">
      <tr>
        <td id="content-logo">
          <a id="g-logo" class="badge badge-warning text-white"> Ganti Logo</a>
          <input class="input-file" name='input-logo' type='file' id='input-logo' accept="image/png" style="display:none">
          <span id="text-output" style="font-size:11px"></span>
          <span id="alert-danger" style="font-size:11px!important"></span>
        </td>
      </tr>
      <tr>
        <td>Maksimal ukuran logo 400x400px (pixel) dalam bentuk PNG & Max 1mb.</td>
      </tr>
    </table>
  </div>
</div>


<script type="text/javascript">
$(function () {
        var fileupload = $("#input-logo");
        var filePath = $("#spnFilePath");
        var button = $("#g-logo");
        button.click(function () {
            fileupload.click();
        });
        fileupload.change(function () {
            var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
            if (fileName!="") {
              $("#text-output").html('<a href="#" class="badge badge-success text-white" id="simpan-logo">Simpan</a>'+
                                      "&nbsp;&nbsp;File Name : "+fileName);
            }else {
              $("#text-output").html("");
              $("#alert-danger").html("");
            }
        });
    });


    $(document).on('click','#simpan-logo',function(e){
            e.preventDefault();
            var file_data = $('#input-logo').prop('files')[0];
            var form_data = new FormData();
            $("#simpan-logo").text('Memproses...');

            form_data.append('file', file_data);
            $.ajax({
                url: '<?=site_url("backend/pengaturan/logo_action/$logo") ?>',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(data){
                    if (data.status!='error') {
                        $('#input-logo').val('');
                        $("#text-output").html("");
                        $("#alert-danger").html("");
                        var loaduri = $("#pengaturan-logo").attr('href');
                        $.get(loaduri, function(data) {
                            $("#load-content").html(data);
                        });
                        $('#alert').hide().fadeIn(1000).html(`<div id="alert" class="alert alert-success">
                                                             <i class="fa fa-check"></i> `+data.msg+`
                                                            <div>`);
                        $('.form-group').removeClass('.has-error')
                                        .removeClass('.has-success');
                          $('.alert-success').delay(5000).show(10, function(){
                            $('.alert-success').fadeOut(1000, function(){
                              $('.alert-success').remove();
                            });
                          })
                    }else{
                        $("#simpan-logo").text('Simpan');
                        $("#alert-danger").html('<i class="text-danger">'+data.msg+'</i>')
                    }
                }
            });
        })



</script>
