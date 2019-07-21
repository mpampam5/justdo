
<section class="breadcrumbs">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="<?=site_url('backend')?>">Home</a></li>
      <li><a href="<?=site_url("backend/".$this->uri->segment(2))?>"><?=ucfirst($temp_title)?></a></li>
      <li class="active"><?=ucfirst($sub_title)?></li>
    </ol>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header">
              <h5 class="card-title">Detail <?=ucfirst($temp_title)?></h5>
            </div>
              <div class="card-block">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th>Nama</th>
                                <td>: <?=$first_name." ".$last_name?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>: <?=$email?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>: <?=$phone?></td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>: <?=$username?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th>Status Aktif</th>
                                <td>:
                                    <?php if($active=="y"):?>
                                    <span class="badge badge-success"> Ya</span>
                                        <?php else:?>
                                        <span class="badge badge-danger"> Tidak</span>
                                    <?php endif;?>
                                </td>
                            </tr>
                            <tr>
                                <th>Group</th>
                                <td>:
                                    <a href="<?=site_url("backend/groups/detail/$id_groups")?>" class="text-info" target="_blank"><i class="fa fa-link">
                                        </i> <?=ucfirst($name)?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td>
                                <?php if (session('id_users')==$id_users): ?>
                                  <a href="<?=base_url("backend/resetpwd")?>" id="resetpwd" class="badge badge-warning" data-toggle="tooltip" data-placement="bottom" title="Reset Password"><i class="fa fa-key"></i> Reset Password</a>
                                  <?php else: ?>
                                    <a href="<?=base_url("backend/users/resetpwd/$id_users")?>" id="reset_pwd" class="badge badge-warning" data-toggle="tooltip" data-placement="bottom" title="Reset Password"><i class="fa fa-key"></i> Reset Password</a>
                                <?php endif; ?>

                              </td>
                            </tr>
                        </table>
                    </div>

                </div>


              </div>
            <div class="card-footer">
              <a href="<?=site_url("backend/".$this->uri->segment(2))?>" class="btn btn-sm btn-default">Kembali</a>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
$(document).on('click','#reset_pwd',function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-md')
                    .addClass('modal-sm');
  $('#modalContent').hide().fadeIn(2000).load($(this).attr('href'));
  $("#modalTitle").text('Form Ubah Password');
  $("#modalGue").modal('show');
});

</script>
