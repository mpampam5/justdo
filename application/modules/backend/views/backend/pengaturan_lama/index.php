<style media="screen">

element.style {
}
.toolbar.toolbar-profile ul.toolbar-nav {
  padding-left: 0!important;
}
</style>

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
      <div class="col-lg-9 mx-auto">
        <div class="card">
            <div class="card-header">
              <h5 class="card-title"><?=ucfirst($temp_title)?></h5>
              <a href="<?=site_url("backend/home")?>" class="btn btn-sm btn-info" style="position:absolute;right:20px"><i class="fa fa-home"></i></a>
            </div>
              <div class="card-block">

                <div class="tabs-color">

                      <ul class="nav nav-tabs nav-icon-left" role="tablist">
                        <li class="nav-item"><a class="nav-link active" href="<?=site_url("backend/pengaturan/umum")?>" aria-controls="pengaturan-umum" role="tab" data-toggle="tab" data-target="#pengaturan-umum" id="pengaturan-umum"><i class="fa fa-cog"></i> Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?=site_url("backend/pengaturan/logo")?>" aria-controls="pengaturan" role="tab" data-toggle="tab" data-target="#pengaturan-logo" id="pengaturan-logo"><i class="fa fa-picture-o"></i> Logo</a></li>
                        <li class="nav-item"><a class="nav-link" href="" aria-controls="meta-seo" role="tab" data-toggle="tab" data-target="#pengaturan-meta" id="pengaturan-meta"><i class="fa fa-code"></i> Meta Seo</a></li>

                      </ul>

                      <div class="tab-content" id="load-content"></div>


                </div>

              </div>
          </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">

$(document).ready(function(e){
  var loaduri = $("#pengaturan-umum").attr('href');
  $.get(loaduri, function(data) {
      $("#load-content").hide().fadeIn(500).html(data);
  });
});


  $('[data-toggle="tab"]').click(function(e) {
    var $this = $(this),
        loadurl = $this.attr('href'),
        targ = $this.attr('data-target');

    $("#load-content").html("");

    $.get(loadurl, function(data) {
        $("#load-content").hide().fadeIn(500).html(data);
    });

  });
</script>
