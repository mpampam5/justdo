<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.css" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/mode/htmlmixed/htmlmixed.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/mode/xml/xml.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/mode/javascript/javascript.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/mode/css/css.js"></script>

<style media="screen">
  .CodeMirror-hscrollbar{
    height: 5px!important;
  }
</style>

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
      <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
              <h5 class="card-title"><?=ucfirst($button)?></h5>
            </div>
              <div class="card-block">


            <div class="row">
                <div class="col-sm-12">
                  <form id="form" action="<?=$action?>">
                    <div class="form-group">
                      <textarea id="code" name="code" rows="9" cols="80"><?=$meta_txt?></textarea>
                      <p class="text-danger p-t-20 text-center"></p>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-sm btn-primary" id="submit" name="submit"> Simpan Perubahan</button>
                  </form>
                </div>
            </div>

                <hr>
                <a href="<?=site_url("backend/home")?>" class="btn btn-sm btn-info" title="Home"><i class="fa fa-home"></i></a>
                <a href="<?=site_url("backend/pengaturan")?>" class="btn btn-default btn-sm" title="Kembali">Kembali</a>

              </div>
          </div>
      </div>
    </div>
  </div>
</section>


<script>
  var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
    lineNumbers: true,
    mode:  "htmlmixed",
    htmlMode: true,
  })

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
                              $('#alert').hide().fadeIn(1000).html(`<div id="alert" class="alert `+json.status+`">
                                                                      <i class="fa fa-check"></i> `+json.alert+`
                                                                    <div>`);
                              $('.form-group').removeClass('.has-error')
                                              .removeClass('.has-success');
                                $('.alert').delay(5000).show(10, function(){
                                  $('.alert').fadeOut(1000, function(){
                                    $('.alert').remove();
                                    location.href="<?=site_url('backend/'.$this->uri->segment(2))?>";
                                  });
                                })
                          }else {
                              $("#submit").prop('disabled',false)
                                          .text('Simpan Perubahan');
                              $(".text-danger").text(json.alert);

                          }
                        }
                  });
    });
  </script>
