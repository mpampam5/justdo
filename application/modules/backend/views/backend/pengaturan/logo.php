<section class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb">
        <li><a href="<?=site_url('backend')?>">Home</a></li>
        <li><?=ucfirst($temp_title)?></li>
        <li class="active"><?=ucfirst($button)?></li>
        </ol>
    </div>
</section>


<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header">
              <h5 class="card-title"><?=ucfirst($button)?></h5>
            </div>
              <div class="card-block">

            <div class="row">
                <div class="col-md-4">
                    <div class="container-logo">
                        <a class="link-img" href="<?=base_url("temp/backend/logo/$logo")?>" data-fancybox="gallery" title="<?=$logo?>">
                        <div id="logo-pengaturan" class="logo-pengaturan" style='background-image:url(<?=base_url("temp/backend/logo/$logo")?>)'></div>
                        </a>
                    </div>
                </div>

                <div class="col-md-8">
                    <table class="table  table-borderless m-t-50">
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

                <hr>
                <a href="<?=site_url("backend/pengaturan")?>" class="btn btn-default btn-sm" title="Kembali">Kembali</a>
                <a href="<?=site_url("backend/home")?>" class="btn btn-sm btn-info" title="Home"><i class="fa fa-home"></i></a>

              </div>
          </div>
      </div>
    </div>
  </div>
</section>




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
            $('#logo-pengaturan').css('backgroundImage','');
            $('#logo-pengaturan').html('<div class="loader" style="position:absolute;top:60px;left:100px"></div>');
            form_data.append('file', file_data);
            $.ajax({
                url: '<?=base_url()?>backend/pengaturan/logo_action/'+$(".link-img").attr("title"),
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
                        $("#img_logo").attr("src",'<?=base_url()?>temp/backend/logo/'+data.img);
                        $(".link-img").attr("href",'<?=base_url()?>temp/backend/logo/'+data.img);
                        $(".link-img").attr("title",data.img);
                        $('#logo-pengaturan').html('');
                        $('#logo-pengaturan').css('backgroundImage','url(<?=base_url()?>temp/backend/logo/'+data.img+')');
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
