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
              <a href="<?=site_url('backend/users/tambah')?>" style="position:absolute;right:10px;" class="btn btn-sm btn-primary btn-xs btn-icon-right">Tambah <i class="fa fa-plus"></i></a>
            </div>
              <div class="card-block">
                <table class="table table-bordered" width="100%" id="table">
                  <thead>
                    <tr>
                      <th width="50px">No</th>
                      <th></th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Username</th>
                      <th>Group</th>
                      <th>Aktif</th>
                      <th>Terakhir login</th>
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
            ajax: {"url": "<?=base_url()?>backend/users/json", "type": "POST"},
            columns: [
                {
                    "data": "id_users",
                    "orderable": false,
                    "visible":false
                },
                {
                    "data": "first_name",
                    "visible":false
                },
                {
                    "data": "last_name",
                    render:function(data,type,row,meta) {
                      if (row.id_users==<?=session('id_users')?>) {
                            var str = row.first_name+' '+data+'</br><b class="text-success" style="font-size:11px"><i class="fa fa-circle"></i> Aktif saat ini</b>';
                      } else {
                          var str = row.first_name+' '+data;
                      }
                            return str;
                    }
                },
                {"data": "email"},
                {"data": "username"},
                {"data": "name"},
                {
                    "data": "active",
                    render:function(data) {
                            if (data=='y') {
                                return '<span class="badge badge-success">Ya</span>';
                            }else{
                                return '<span class="badge badge-danger">Tidak</span>';
                            }
                    }
                },
                {"data": "last_login"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center",
                    render:function(data,type,row,meta) {
                      if (row.id_users==<?=session('id_users')?>) {
                        var str = '<a href="<?=base_url("backend/resetpwd")?>" id="resetpwd" class="btn btn-link p-a-5 text-success" data-toggle="tooltip" data-placement="bottom" title="Reset Password"><i class="fa fa-key"></i></a>';
                      }else{
                        var str = '<a href="<?=base_url("backend/users/resetpwd")?>/'+row.id_users+'" id="reset_pwd" class="btn btn-link p-a-5 text-success" data-toggle="tooltip" data-placement="bottom" title="Reset Password"><i class="fa fa-key"></i></a>'
                      }
                      return str+''+data;
                    }
                }
            ],
            order: [[0, 'desc']]
        });
});



$(document).on('click','#reset_pwd',function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-md')
                    .addClass('modal-sm');
  $('#modalContent').hide().fadeIn(2000).load($(this).attr('href'));
  $("#modalTitle").text('Form Ubah Password');
  $("#modalGue").modal('show');
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
            $('#alert').hide().fadeIn(1000).html(`<div id="alert" class="alert `+json.alert_class+`">
                                                    `+json.alert+`
                                                    <div>`);
            $('#table').DataTable().ajax.reload();
            $('.alert-success').delay(5000).show(10, function(){
              $('.alert-success').fadeOut(1000, function(){
                $('.alert-success').remove();
              });
            })
          }
        });
});
</script>
