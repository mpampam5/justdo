<div class="row">
    <div class="col-sm-12">
            <form action="<?=$action?>" id="form" autocomplete="off">
                <div class="form-group">
                    <label  for="">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?=$title?>">
                </div>

                <div class="form-group">
                    <label  for="">Domain</label>
                    <input type="text" class="form-control" name="domain" id="domain" placeholder="Domain" value="<?=$domain?>">
                </div>

                <div class="form-group">
                    <label  for="">Telepon</label>
                    <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Telepon" value="<?=$telepon?>">
                </div>

                <div class="form-group">
                    <label  for="">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3" placeholder="Alamat"><?=$alamat?></textarea>
                </div>

                <div>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-label="Close"> Batal</button>
                    <button type="submit" id="submit" class="btn btn-sm btn-primary"><?=ucfirst($button)?></button>
                </div>

            </form>
    </div>
</div>

<script type="text/javascript">
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
                              $("#tab-umum").html('<img class="pre-loader" src="<?=base_url();?>temp/backend/loader/loader.svg">');
                                $("#modalGue").modal("hide");
                                $(".text-logo").text($("#title").val());
                                var loaduri = $("#pengaturan-umum").attr('href');
                                $.get(loaduri, function(data) {
                                    $("#load-content").hide().fadeIn(500).html(data);
                                });
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
                                          .text('<?=ucfirst($button)?>');
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
