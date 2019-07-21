
<section class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb">
        <li><a href="<?=site_url('backend')?>">Home</a></li>
        <li><a href="<?=site_url("backend/".$this->uri->segment(2))?>"><?=ucfirst($temp_title)?></a></li>
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
                    <h5 class="card-title"><?=ucfirst($button)?> <?=ucfirst($temp_title)?></h5>
                </div>

                <form id="form" action="<?=$aksi?>" autocomplete="off">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?=$first_name?>">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?=$last_name?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?=$email?>">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="<?=$phone?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Usename</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Usename" value="<?=$username?>">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <?php if($button=="tambah"):?>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" class="form-control" name="password" id="password" placeholder="Password">
                                </div>
                                    <?php else: ?>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <span  class="form-control text-danger">*******</span>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Group</label>
                                    <?=cmb_dimanis('group','group','groups','id_groups','name',$id_groups)?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                        <label for="">Aktif</label>
                                        <select class="form-control" id="aktif" name="aktif">
                                            <?php if($button=="tambah"): ?>
                                            <option value="">-pilih-</option>
                                            <?php endif;?>
                                            <option <?=($aktif=="y"?"selected":"")?> value="y">Ya</option>
                                            <option <?=($aktif=="n"?"selected":"")?> value="n">Tidak</option>
                                        </select>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="card-footer">
                        <a href="<?=site_url("backend/".$this->uri->segment(2))?>" class="btn btn-sm btn-default">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary" id="submit" name="submit"> <?=ucfirst($button)?></button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
</section>

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
                              $('#alert').hide().fadeIn(1000).html(`<div id="alert" class="alert alert-success">
                                                                      <i class="fa fa-check"></i> `+json.alert+`
                                                                    <div>`);
                              $('.form-group').removeClass('.has-error')
                                              .removeClass('.has-success');
                                $('.alert-success').delay(5000).show(10, function(){
                                  $('.alert-success').fadeOut(1000, function(){
                                    $('.alert-success').remove();
                                    location.href="<?=site_url('backend/'.$this->uri->segment(2))?>";
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
