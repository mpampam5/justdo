
<link rel="stylesheet" href="<?=config_item('sty_back')?>plugins/datatables/dataTables.bootstrap4.min.css">
<script src="<?=config_item('sty_back')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=config_item('sty_back')?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

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
                <table class="table table-borderless">
                    <tr>
                        <th width="100">Group</th>
                        <td>: <?=$name?></td>
                    </tr>

                    <tr>
                        <th>Deskripsi</th>
                        <td>: <?=$description?></td>
                    </tr>

                </table>
                
                <div class="p-t-30">
                  <strong >Menu Akses</strong>
                  <div class="p-t-10">
                    <?=listMenudetail($id_groups)?>
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


