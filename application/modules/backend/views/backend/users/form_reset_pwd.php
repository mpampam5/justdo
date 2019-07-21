<div class="row">
            <div class="col-lg-12">
                <form id="form" action="<?=$action?>">
                    <div class="form-group">
                        <label for="">Username</label>
                        <p class="form-control" style="background:#bfbfbf"><?=$username?></p>
                    </div>

                    <div class="form-group">
                        <label for="">Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password baru">
                    </div>

                    <div class="form-group">
                        <label for="">Konfirmasi Password Baru</label>
                        <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control" placeholder="Konfirmasi Password Baru">
                    </div>

                    <div class="form-group">
                        <label class="custom-control custom-checkbox custom-checkbox-primary">
                            <input type="checkbox" id="showpwd" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Tampilkan Password</span>
                        </label>
                    </div>

                    <input type="hidden" name="token" id="token" value="<?=$token?>">

                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-label="Close"> Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary" id="submit"> Reset Password</button>
                </form>
            </div>
</div>

<script>
$(document).ready(function(){
    $('#showpwd').click(function(){
    $(this).is(':checked') ? $('#password').attr('type', 'text') : $('#password').attr('type', 'password');
    $(this).is(':checked') ? $('#konfirmasi_password').attr('type', 'text') : $('#konfirmasi_password').attr('type', 'password');
    });
});
  $("#form").submit(function(e){
      e.preventDefault();
      var me = $(this);
      $("#submit").prop('disabled',true)
                  .text('Memproses...');
                  $.ajax({
                        url             : me.attr('action'),
                        type            : 'post',
                        data            :  new FormData(this),
                        contentType     : false,
                        cache           : false,
                        dataType        : 'JSON',
                        processData     :false,
                        success:function(json){
                          if (json.success==true) {
                            $('#modalGue').modal('hide');
                              $('#alert').hide().fadeIn(1000).html(`<div id="alert" class="alert alert-success">
                                                                      <i class="fa fa-check"></i> `+json.alert+`
                                                                    <div>`);
                              $('.form-group').removeClass('.has-error')
                                              .removeClass('.has-success');
                                $('.alert-success').delay(5000).show(10, function(){
                                  $('.alert-success').fadeOut(1000, function(){
                                    $('.alert-success').remove();
                                  });
                                })
                          }else {
                            $.each(json.alert, function(key, value) {
                              var element = $('#' + key);
                              $("#submit").prop('disabled',false)
                                          .text('Ganti Password');
                              $(element)
                              .closest('.form-group')
                              .find('.text-danger').remove();
                              $(element).after(value);
                            });
                          }
                        }
                  });
    });

</script>
