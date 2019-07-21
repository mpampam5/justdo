

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
                <div class="form-group">
                  <label for="">Group</label>
                  <input type="text" class="form-control" id="group" name="group" placeholder="Group" value="<?=$groups?>">
                </div>


                <div class="form-group">
                  <label for="">Deskripsi</label>
                  <textarea class="form-control" rows="3" cols="80" name="description" id="description" placeholder="Deskripsi"><?=$description?></textarea>
                </div>


                <!-- menu list -->
                <hr>
                <div style="padding-bottom:10px;">
                  <strong>Menu Akses</strong>
                  <span style="right:35px;position:absolute">
                    <label class="custom-control custom-checkbox custom-checkbox-primary">
                      Check All
                        <input type="checkbox" class="custom-control-input" id="check-all">
                        <span class="custom-control-indicator"></span>
                      </label>
                  </span>
                </div>


                <?php
                  if ($button=="tambah") {
                    echo listMenu();
                  }else {
                    echo listMenuedit($id_groups);
                  }
                ?>
                <!-- end menu list -->
                <div id="field"></div>
              </div>

              <input type="hidden" name="field" class="field"/>

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

$(document).ready(function() {
  var chkArray = [];
  $(".custom-control-input:checked").each(function() {
  		chkArray.push($(this).val());
  	});
    var selected;
      	selected = chkArray.join(',') ;

      if (selected=="") {
        $('.field').val("");
      }else {
        $('.field').val("1");
      }
});


$('.custom-control-input').on('change',function(){
  var chkArray = [];
  $(".custom-control-input:checked").each(function() {
  		chkArray.push($(this).val());
  	});
    var selected;
      	selected = chkArray.join(',') ;

      if (selected=="") {
        $('.field').val("");
      }else {
        $('.field').val("1");
      }
});

  $("#check-all").click(function(){
    $('.custom-checkbox input:checkbox').not(this).prop('checked', this.checked);
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
