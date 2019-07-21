
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
      <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header">
              <h5 class="card-title">List <?=ucfirst($temp_title)?></h5>
              <a href="<?=site_url('backend/groups/tambah')?>" style="position:absolute;right:10px;" class="btn btn-sm btn-primary btn-xs btn-icon-right">Tambah <i class="fa fa-plus"></i></a>
            </div>
              <div class="card-block">
                <table class="table table-bordered" width="100%" id="table">
                  <thead>
                    <tr>
                      <th width="50px">No</th>
                      <th>Groups</th>
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
      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
      {
          return {
              "iStart": oSettings._iDisplayStart,
              "iEnd": oSettings.fnDisplayEnd(),
              "iLength": oSettings._iDisplayLength,
              "iTotal": oSettings.fnRecordsTotal(),
              "iFilteredTotal": oSettings.fnRecordsDisplay(),
              "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
              "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
          };
      };

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
            ajax: {"url": "<?=base_url()?>backend/groups/json", "type": "POST"},
            columns: [
                {
                    "data": "id_groups",
                    "orderable": false
                },
                {"data": "name"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
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
  var id = $(this).attr('data-id');
  $.ajax({
          url:$(this).data('url'),
          type:'post',
          cache:false,
          dataType:'json',
          success:function(json){
            $('#modalGue').modal('hide');
            $("li[data-id='"+id+"']").remove();
            $('#alert').hide().fadeIn(1000).html(`<div class="alert `+json.alert_class+`">
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
</script>
