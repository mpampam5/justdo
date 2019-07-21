<!DOCTYPE html>
<html lang="en">
<head>
  <!-- meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?=$title?></title>
  <link rel="icon" href="<?=base_url()?>temp/favicon.png" sizes="192x192" />
  <?=$this->meta_tags->generate_meta_tags(); ?>
  <?php include_once APPPATH.'modules/backend/views/backend/pengaturan/meta.txt' ?>
  <!-- vendor css -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <link rel="stylesheet" href="<?=base_url()?>temp/front/plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=base_url()?>temp/front/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>temp/front/plugins/animate/animate.min.css">
  <!-- plugins css -->
  <link href="<?=base_url()?>temp/front/plugins/owl-carousel/css/owl.carousel.min.css" rel="stylesheet">
  <!-- theme css -->
  <link rel="stylesheet" href="<?=base_url()?>temp/front/css/theme.css">
  <link rel="stylesheet" href="<?=base_url()?>temp/front/css/custom.css">
  <link rel="stylesheet" href="<?=base_url()?>temp/front/plugins/fancybox/dist/jquery.fancybox.min.css" />

  <!-- jquery -->
  <!-- vendor js -->
  <script src="<?=base_url()?>temp/front/plugins/jquery/jquery-3.2.1.min.js"></script>
  <script src="<?=base_url()?>temp/front/plugins/popper/popper.min.js"></script>
  <script src="<?=base_url()?>temp/front/plugins/bootstrap/js/bootstrap.min.js"></script>

</head>
<body class="fixed-header">
  <!-- header -->
  <header id="header">
    <div class="container">
      <div class="navbar-backdrop">
        <div class="navbar">
          <div class="navbar-left">
            <a class="navbar-toggle"><i class="fa fa-bars"></i></a>
            <a href="index.html" class="logo"><img src="<?=base_url()?>temp/logo.png" style="width:140px;height:50px;" alt="logo"></a>
            <nav class="nav">
              <?=get_menu();?>
            </nav>
          </div>
          <div class="nav navbar-right">
            <ul>
              <li class="hidden-xs-down"><a href="login.html"><i class="text-primary fa fa-facebook"></i></a></li>
              <li class="hidden-xs-down"><a href="register.html"><i class="text-info fa fa-twitter"></i></a></li>
              <!-- <li><a data-toggle="search"><i class="fa fa-search"></i></a></li> -->
            </ul>
          </div>
        </div>
      </div>
      <div class="navbar-search">
        <div class="container">
          <form method="post">
            <input type="text" class="form-control" placeholder="Search...">
            <i class="fa fa-times close"></i>
          </form>
        </div>
      </div>
    </div>
  </header>
  <!-- /header -->
