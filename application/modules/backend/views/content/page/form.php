<link rel="stylesheet" href="<?=config_item('sty_back')?>plugins/summernote/summernote-bs4.css">
<section class="breadcrumbs">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="<?=site_url('backend')?>">Home</a></li>
      <li><a href="<?=site_url('backend/page')?>"><?=ucfirst($temp_title)?></a></li>
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
            <form action="<?=$action?>" id="form" autocomplete="off">
              <div class="card-block">
                  <div class="row">

												<div class="col-md-8">
                          <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?=$title?>">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Gambar</label>
                            <div class="input-group">
                              <input type="text" class="image" style="display:none" name="image" id="image" value="<?=$image?>">
                              <a href="<?=base_url()?>temp/img_manager/page/<?=$image?>" data-fancybox="gallery" id="text-img" class="form-control text-info"><?=$image?></a>
                              <span class="input-group-btn">
                              <button class="btn btn-info btn-icon" type="button" id="button-browse" data-url="<?=base_url().'backend/file_manager/'.$this->uri->segment(2)?>" data-toggle="tooltip" data-placement="bottom" title="Browse"><i class="fa fa-image"></i></button>
                              <button class="btn btn-danger btn-icon" type="button" id="remove-img"  data-toggle="tooltip" data-placement="bottom" title="Remove"><i class="fa fa-close"></i></button>
                            </span>
                            </div>
                          </div>
                        </div>


												<div class="col-md-12">
                          <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control deskripsi" name="deskripsi"><?=$deskripsi?></textarea>
                            <div id="deskripsi"></div>
                          </div>
                        </div>



                  </div>
              </div>
            <div class="card-footer">
              <a href="<?=site_url("backend")?>" class="btn btn-sm btn-info"><i class="fa fa-home"></i></a>
              <a href="<?=site_url('backend/'.$this->uri->segment(2))?>"  class="btn btn-sm btn-default"> kembali</a>
              <button type="submit" id="submit" name="submit" class="btn btn-primary btn-sm pull-right"> <?=ucfirst($button)?></button>
            </div>
          </form>

          </div>
      </div>
    </div>
  </div>
</section>


<script src="<?=config_item('sty_back')?>plugins/summernote/summernote-bs4.js"></script>
<script src="<?=config_item('sty_back')?>plugins/summernote/lang/summernote-id-ID.min.js"></script>
<script type="text/javascript">
$('.deskripsi').summernote({
      height: "400px",
      lang: 'id-ID',
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['link', ['linkDialogShow', 'unlink']],
        ['color', ['color']],
        ['table', ['table']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['codeview',['codeview']],
        ['fullscreen',['fullscreen']]
      ]
    });

$(document).on("click","#remove-img",function(){
  $("#image").val("");
  $("#text-img").text("");
  $("#text-img").attr("href","no");
})

$(document).on('click','#button-browse',function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-sm')
                    .removeClass('modal-md')
                    .addClass('modal-md');
  $('#modalContent').load($(this).attr('data-url'));
  $("#modalTitle").text('File manager');
  $("#modalGue").modal('show');
});

  $("#form").submit(function(e){
      e.preventDefault();
      var me = $(this);
      $("#submit").prop('disabled',true)
                  .text('Memproses...');
      $('.text-danger').remove();
      $('.form-control').prop('readonly', true);
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
                              $('#alert').hide().fadeIn(1000).html(json.alert);
                              $('.form-group').removeClass('.has-error')
                                              .removeClass('.has');
                                $('.alert').delay(9000).show(10, function(){
                                  $('.alert').fadeOut(1000, function(){
                                    $('.alert').remove();
                                    location.href="<?=site_url('backend/'.$this->uri->segment(2))?>";
                                  });
                                })
                          }else {
                            $.each(json.alert, function(key, value) {
                              var element = $('#' + key);
                              $("#submit").prop('disabled',false)
                                          .text('<?=ucfirst($button)?>');
                              $('.form-control').prop('readonly', false);
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
