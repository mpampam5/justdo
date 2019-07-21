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
      <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header">
              <h5 class="card-title"><?=ucfirst($button)?></h5>
            </div>
              <div class="card-block">
              <table class="table table-striped table-bordered">
                <tr>
                    <th width="200">Title</th>
                    <td class="v_title"><?=$title?></td>
                </tr>

                <tr>
                    <th>Domain</th>
                    <td class="text-info v_domain"><?=$domain?></td>
                </tr>

                <tr>
                    <th>Telepon</th>
                    <td class="v_telepon"><?=$telepon?></td>
                </tr>

                <tr>
                    <th>Alamat</th>
                    <td class="v_alamat"><?=$alamat?></td>
                </tr>
                </table>

                <hr>
                <a href="<?=site_url("backend/pengaturan")?>" class="btn btn-default btn-sm" title="Kembali">Kembali</a>
                <a href="<?=site_url("backend/home")?>" class="btn btn-sm btn-info" title="Home"><i class="fa fa-home"></i></a>
                <a href="<?=site_url("backend/pengaturan/umum_form")?>" id="editumum" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil-square-o"></i> Edit</a>

              </div>
          </div>
      </div>
    </div>
  </div>
</section>


<script type="text/javascript">
$(document).on("click","#editumum",function(e) {
    e.preventDefault();
    $('.modal-dialog').removeClass('modal-lg')
                      .removeClass('modal-sm')
                      .addClass('modal-md');
    $('#modalContent').load($(this).attr('href'));
    $("#modalTitle").text('Form Pengaturan Umum');
    $("#modalGue").modal('show');
})
</script>
