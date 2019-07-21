<section class="breadcrumbs">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="<?=site_url('backend')?>">Home</a></li>
      <li><a href="<?=site_url("backend/".$this->uri->segment(2))?>"><?=$temp_title?></a></li>
      <li class="active"><?=ucfirst($button)?></li>
    </ol>
  </div>
</section>


<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-6 mx-auto">
        <div class="card">
            <div class="card-header">
              <h5 class="card-title"><?=ucfirst($button)." ".$temp_title?></h5>
            </div>

            <form id="form" action="<?=$action?>" autocomplete="off">
                <div class="card-block">
                    <div class="form-group">
                      <label for="">Nama Menu</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Nama Menu" value="<?=$name?>">
                    </div>

                    <div class="form-group">
                      <label for="">Url</label>
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon3"><?=base_url("backend")?>/</span>
                        <input type="text" class="form-control" name="url" placeholder="url" aria-describedby="basic-addon3" value="<?=$url?>">
                      </div>
                      <div id="url" ></div>
                    </div>

                    <div class="form-group">
                      <label for="">Is Parent</label>
                      <?=cmb_menu($is_parent)?>
                    </div>

                    <div class="form-group">
                      <label for="">Icon</label>
                      <div class="input-group">
                          <input type="text" class="form-control" name="icon" id="iconn"  placeholder="fa fa-icon" value="<?=$icon?>">
                          <span class="input-group-btn">
                            <a class="btn btn-secondary btn-icon" href="<?=base_url('backend/menus/icon')?>" id="icons"><i class="fa fa-smile-o"></i></a>
                          </span>
                      </div>
                      <div id="icon"></div>
                    </div>


                    <div class="form-group">
                      <label for="">Aktif</label>
                      <select  class="form-control" id="is_active" name="is_active">
                        <option value="1" <?=($is_active=="1"?"selected":"")?>> Ya</option>
                        <option value="0" <?=($is_active=="0"?"selected":"")?>> Tidak</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="">Keterangan</label>
                      <textarea name="description" id="description" class="form-control" rows="2" cols="80" placeholder="Keterangan"><?=$description?></textarea>
                    </div>

                </div>

                <div class="card-footer">
                  <a href="javascript:history.back()" class="btn btn-default btn-sm"> Batal</a>
                  <button type="submit" id="submit" name="submit" data-loading-text="<i class='fa fa-spinner fa-pulse'></i> Sedang Memproses ..."  class="btn btn-primary btn-sm"> <?=ucfirst($button)?></button>
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

$('#is_parent').click(function() {
var value = $("#is_parent option:selected").val();
if (value!="0") {
  $('#iconn').val('fa fa-circle');
}else{
  $('#iconn').val('<?=$icon?>');
}

});

  $(document).on('click',"#icons", function(e){
      e.preventDefault();
      $('.modal-dialog').removeClass('modal-md')
                        .removeClass('modal-sm');
      $('.modal-dialog').addClass('modal-lg');
      $('#modalContent').load($(this).attr('href'));
      $("#modalTitle").text('Add Icons')
      $("#modalGue").modal('show');
  });


</script>
