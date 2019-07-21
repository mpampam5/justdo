
<link rel="stylesheet" href="<?=config_item('sty_back')?>plugins/datatables/dataTables.bootstrap4.min.css">
<script src="<?=config_item('sty_back')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=config_item('sty_back')?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

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
      <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
              <h5 class="card-title">List <?=ucfirst($temp_title)?></h5>
              <a href="<?=site_url('backend/news/add')?>" style="position:absolute;right:10px;" class="btn btn-sm btn-primary btn-xs btn-icon-right">Tambah <i class="fa fa-plus"></i></a>
            </div>
              <div class="card-block">
                <table class="table table-bordered" width="100%" id="table">
                  <thead>
                    <tr>
                      <th width="50px">No</th>
                      <th>Waktu Upload</th>
											<th>Berita</th>
                      <th>Kategori</th>
											<th>Slug</th>
                      <th></th>
                      <th></th>
                      <th>#</th>
                    </tr>
                  </thead>
                </table>
              </div>
            <div class="card-footer">
              <a href="<?=site_url("backend")?>" class="btn btn-sm btn-info"><i class="fa fa-home"></i></a>
            </div>
          </div>
      </div>
    </div>
  </div>

</section>


<script type="text/javascript">
$(document).ready(function() {
  var t = $("#table").dataTable({
    
            initComplete: function() {
                var api = this.api();
                $('#table_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "Memuat Data..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "<?=base_url()?>backend/news/json", "type": "POST"},
            columns: [
                {
                    "data": "id_news",
                    "orderable": false,
                    "visible":false
                },
                {
                  "data":"created_at",
                  "visible":false
                },
								{"data":"title",
                  render:function(data,type,row,meta){
                    if (row.headline == 1) {
                      var headline = `<a style="font-size:11px;"  class="setheadline btn btn-xs btn-warning text-white" id="headline`+row.id_news_category+`" data-headline="`+row.headline+`" title="headline"><i class="fa fa-star"></i> Headline Di Tetapkan</a>`;
                    }else {
                      var headline = `<a style="font-size:11px;" class="setheadline btn btn-xs btn-default" data-headline="`+row.headline+`"  id="headline`+row.id_news_category+`" title="headline"><i class="fa fa-star"></i> Bukan Headline</a>`;
                    }

                    var str = '<a title="'+data+'" data-toggle="tooltip" data-placement="bottom" style="text-transform:capitalize;">'+data.substr(0, 115)+'...</a>';
                        str+=`<p class="text-info" style="font-size:12px;">
                              <a target="_blank" href="<?=base_url()?>news/`+row.id_news+`/`+row.slug+`.html" title="<?=base_url()?>news/`+row.id_news+`/`+row.slug+`.html"><i class="fa fa-globe"></i> <?=base_url()?>news/`+row.id_news+`/`+row.slug.substr(0, 60)+`...</a>
                              </p>`;
                        str+=`<p>
                                <div class="btn-group btn-group-sm text-white" role="group">
                                  <a style="font-size:11px;" class="btn btn-xs btn-danger"><i class="fa fa-clock-o"></i> `+row.created_at+`</a>
                                  <a style="font-size:11px;" class="btn btn-xs btn-warning"><i class="fa fa-tags"></i> `+row.category+`</a>
                                </div>
                                <div class="btn-group btn-group-sm" role="group" style="font-size:11px;">
                                    <a style="font-size:11px;" href="https://www.facebook.com/sharer/sharer.php?u=<?=base_url()?>news/`+row.id_news+`/`+row.slug+`.html" class="btn btn-xs btn-primary" id="facebook" title="Bagikan di Facebook"><i class="fa fa-facebook"></i></a>
                                    <a style="font-size:11px;" href="https://twitter.com/intent/tweet?url=<?=base_url()?>news/`+row.id_news+`/`+row.slug+`.html" class="btn btn-xs btn-info" id="twitter" title="Bagikan di Twitter"><i class="fa fa-twitter"></i></a>
                                    <a style="font-size:11px;" href="https://wa.me/?text=<?=base_url()?>news/`+row.id_news+`/`+row.slug+`.html" class="btn btn-xs btn-success" id="whatsapp" title="Bagikan di Whatsapp"><i class="fa fa-whatsapp"></i></a>
                                </div>
                                <div class="btn-group btn-group-sm" role="group" style="font-size:11px;">
                                    `+headline+`
                                </div>
                              </p>`;

                    return str;
                  }
                },
                {
                  "data":"category",
                  "visible":false
                },
								{
                  "data":"slug",
                  "visible":false
                },
                {
                  "data":"headline",
                  "visible":false
                },
                {
                  "data":"id_news_category",
                  "visible":false
                },
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'desc']]
        });
});


$(document).on('click','#hapus',function(e){
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
  $.ajax({
          url:$(this).data('url'),
          type:'post',
          cache:false,
          dataType:'json',
          success:function(json){
            $('#modalGue').modal('hide');
            $('#alert').hide().fadeIn(1000).html(`<div class="alert `+json.alert_class+`">
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    `+json.alert+`
                                                    <div>`);
            $('#table').DataTable().ajax.reload();
            $('.alert').delay(5000).show(10, function(){
              $('.alert').fadeOut(1000, function(){
                $('.alert').remove();
              });
            })
          }
        });
});

$(document).on('click','.headline',function(e){
  e.preventDefault();
  var id = $(this).attr('id');
  $("#headline"+id).html("Waiting...");
  var headline = $("#headline"+id).attr("data-headline");
  if (headline=='0') {
    var dataHeadline = '1';
  }else {
    var dataHeadline = '0';
  }
  $.ajax({
					type: "POST",
					url: $(this).attr('href'),
					data: 'headline='+ dataHeadline,
					cache: false,
          dataType:'json',
					success: function(data){
						if (data.success==true) {
              if (data.headline==1) {
  							$("#headline"+id).attr("data-headline","0");
                $("#headline"+id).removeClass('btn-warning text-white')
                                 .addClass('btn-default');
  							$("#headline"+id).html("<i class='fa fa-star'></i> Bukan Headline");
  						} else {
  							$("#headline"+id).attr("data-headline","1");
                $("#headline"+id).removeClass('btn-default')
                                 .addClass('btn-warning text-white');
  							$("#headline"+id).html("<i class='fa fa-star'></i> Headline Di Tetapkan");
  						}
            }else {
              alert('gagal set headline');
            }
					}
				});
})
</script>
