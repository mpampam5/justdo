<link rel="stylesheet" type="text/css" href="<?=config_item('sty_back')?>plugins/nestable/nestable.css">



<section class="breadcrumbs">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="<?=site_url('backend')?>">Home</a></li>
      <li class="active"><?=ucfirst($temp_title)?></li>
    </ol>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-10 mx-auto">
        <div class="card">
            <div class="card-header">
              <h5 class="card-title">List Menu</h5>
              <div style="position:absolute;right:10px;" >
                <a href="javascript:location.reload();" class="btn btn-sm btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="Reload halaman"><i class="fa fa-refresh"></i></a>
                <a href="<?=site_url('backend/menu_public/tambah')?>" class="btn btn-sm btn-primary btn-xs btn-icon-right">Tambah <i class="fa fa-plus"></i></a>
              </div>
            </div>

            <div class="card-block">


              <div class="dd" id="nestable">
            <?php
                $ref   = [];
                $items = [];
                foreach ($query->result() as $data) {
                  # code...
                    $thisRef = &$ref[$data->id];
                    $thisRef['parent'] = $data->is_parent;
                    $thisRef['label'] = $data->name;
                    $thisRef['link'] = $data->url;
                    $thisRef['target'] = $data->type;
                    $thisRef['id'] = $data->id;
                    $thisRef['active'] = $data->is_active;

                   if($data->is_parent == 0) {
                        $items[$data->id] = &$thisRef;
                   } else {
                        $ref[$data->is_parent]['child'][$data->id] = &$thisRef;
                   }
                }




                function get_menu($items,$class = 'dd-list') {

                    $html = "<ol class=\"".$class."\" id=\"menu-id\">";
                    foreach($items as $key=>$value) {
                      if ($value['active']==1) {
                        $active = "<a class='buttons aktif'>Aktif</a>";
                      }else {
                        $active = "<a class='buttons tidak-aktif'>Tidak Aktif</a>";
                        }

                        if ($value['target']=="_blank") {
                          $target ="_blank";
                        }else {
                          $target ="none";
                        }


                        $html.= '<li class="dd-item dd3-item" data-id="'.$value['id'].'" >
                                    <div class="dd-handle dd3-handle"></div>

                                    <div class="dd3-content"><span id="label_show'.$value['id'].'">'.strtoupper($value['label']).'</span>
                                      <span class="span-right">
                                        <a class="buttons links"><i id="link_show'.$value['id'].'">'.strtolower($value['link']).'</i></a>
                                        '.$active.'
                                        <a class="buttons links" data-toggle="tooltip" data-placement="bottom" title="Data Target">'.strtolower($target).'</a>
                                        <a href="'.site_url('backend/menu_public/edit/'.$value['id']).'" class="buttons edit-button" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a href="'.site_url('backend/menu_public/hapus/'.$value['id']).'" id="delete" alt="'.$value['id'].'" class="buttons del-button" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>&nbsp;
                                      </span>
                                    </div>';
                        if(array_key_exists('child',$value)) {
                            $html .= get_menu($value['child'],'child');
                        }
                            $html .= "</li>";
                    }
                    $html .= "</ol>";
                    return $html;
                }
                print get_menu($items);
            ?>
          </div>

          <input type="hidden" id="id">
          <input type="hidden" id="nestable-output">

            </div>

            <div class="card-footer">
              <a href="<?=site_url('backend')?>" class="btn btn-sm btn-info"><i class="fa fa-home"></i></a>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>

<script src="<?=config_item('sty_back')?>plugins/nestable/jquery.nestable.js"></script>

<script>

$(document).ready(function()
{

    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1,
        maxDepth:2
    })
    .on('change', updateOutput);



    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));

    // $('#nestable-menu').on('click', function(e)
    // {
    //     var target = $(e.target),
    //         action = target.data('action');
    //     if (action === 'expand-all') {
    //         $('.dd').nestable('expandAll');
    //     }
    //     if (action === 'collapse-all') {
    //         $('.dd').nestable('collapseAll');
    //     }
    // });

    $('.dd').on('change', function() {
         var dataString = {
             data : $("#nestable-output").val(),
           };

       $.ajax({
           type: "POST",
           url: "<?=base_url()?>backend/menu_public/save",
           data: dataString,
           cache : false,
           success: function(data){
             $('.alert-success').remove();
             $('#alert').hide().fadeIn(1000).html(`<div id="alert" class="alert alert-success">
                                                    <i class="fa fa-check"></i> Berhasil mengubah posisi!
                                                   <div>`);
             $('.alert-success').delay(5000).show(10, function(){
               $('.alert-success').fadeOut(1000, function(){
                 $('.alert-success').remove();
               });
             })
           } ,error: function(xhr, status, error) {
             alert(error);
           },
       });
   });
});


$(document).on('click','#delete',function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-md')
                    .addClass('modal-sm');
  $('#modalContent').html(`
                          <p>Apakah Anda Yakin Ingin Menghapus?</p>
                          <button type='button' class='btn btn-default btn-sm' data-dismiss='modal'>Batal</button>
                          <button type='button' class='btn btn-primary btn-sm' id='ya-hapus' data-id=`+$(this).attr('alt')+`  data-url=`+$(this).attr('href')+`>Ya, saya yakin</button>
                        `);
  $("#modalTitle").text('Konfirmasi Hapus');
  $("#modalGue").modal('show');
});

$(document).on('click','#ya-hapus',function(e){
  $(this).prop('disabled',true)
          .text('Memproses...');
  var id = $(this).attr('data-id');
  $.ajax({
          url:$(this).data('url'),
          type:'post',
          cache:false,
          dataType:'json',
          success:function(json){
            $('#modalGue').modal('hide');
            $("li[data-id='"+id+"']").remove();
            // updateOutput($('#nestable').data('output', $('#nestable-output')));
            $('#alert').hide().fadeIn(1000).html(`<div id="alert" class="alert `+json.alert_class+`">
                                                   `+json.alert+`
                                                  <div>`);
            $('.alert-success').delay(5000).show(10, function(){
              $('.alert-success').fadeOut(1000, function(){
                $('.alert-success').remove();
              });
            })
          }
        });
});
</script>
