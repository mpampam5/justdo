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
              <h5 class="card-title"><?=ucfirst($temp_title)?></h5>
              <a href="<?=site_url("backend/home")?>" class="btn btn-sm btn-info" style="position:absolute;right:20px"><i class="fa fa-home"></i></a>
            </div>
              <div class="card-block">
                <div class="row" id="pengaturan">
                    <div class="col-md-3">
                       <div class="pengaturan">
                            <a href="<?=site_url('backend/pengaturan/umum')?>">
                                <i class="fa fa-cogs"></i>
                                <p>Pengaturan umum</p>
                            </a>
                       </div>
                    </div>

                    <!-- <div class="col-md-3">
                        <div class="pengaturan">
                            <a href="<?=site_url('backend/pengaturan/logo')?>">
                                <i class="fa fa-image"></i>
                                <p>Pengaturan Logo</p>
                            </a>
                        </div>
                    </div> -->

                    <div class="col-md-3">
                        <div class="pengaturan">
                            <a href="<?=site_url('backend/pengaturan/meta_seo')?>">
                                <i class="fa fa-bar-chart"></i>
                                <p>Meta Seo</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="pengaturan">
                            <a href="<?=site_url('backend/pengaturan/widget')?>">
                                <i class="fa fa-code"></i>
                                <p>Widget</p>
                            </a>
                        </div>
                    </div>

                </div>

              </div>
          </div>
      </div>
    </div>
  </div>
</section>
