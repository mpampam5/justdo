<!DOCTYPE html>
<html lang="en">
<head>
  <!-- meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Login</title>
  <!-- vendor css -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <link rel="stylesheet" href="<?=config_item('sty_back')?>plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=config_item('sty_back')?>plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=config_item('sty_back')?>plugins/animate/animate.min.css">
  <!-- theme css -->
  <link rel="stylesheet" href="<?=config_item('sty_back')?>css/theme.min.css">
  <link rel="stylesheet" href="<?=config_item('sty_back')?>css/custom.css">
</head>
<body id="login-template">
  <!-- header -->
  


<section class="m-t-50">
	<div class="overlay"></div>
		<div class="container">
			<div class="row">

				<div class="col-12 col-sm-8 col-md-4 mx-auto">
					<div class="card m-b-0">
						<div class="card-header">
							<h4 class="card-title"><i class="fa fa-sign-in"></i> Masuk ke akun anda</h4>
						</div>
						<div class="card-block">
						<form action="<?=site_url('login/action')?>" autocomplete="off" id="form">
							<div class="form-group input-icon-left m-b-10">
								<i class="fa fa-user"></i>
								<input type="text" id="username" name="username" class="form-control form-control-secondary" placeholder="Username">
							</div>
							<div class="form-group input-icon-left m-b-15">
								<i class="fa fa-lock"></i>
								<input type="password" name="password" id="password" class="form-control form-control-secondary" placeholder="Password">
							</div>
							<button type="submit" id="submit" class="btn btn-primary btn-block m-t-10">Login <i class="fa fa-sign-in"></i></button>
							<div class="divider">
								<span><a href="">Lupa password?</a></span>
							</div>
						</form>
						</div>
					</div>
					<div id="notif" class="text-center"></div>
				</div>

			</div>
		</div>
	</section>

  <!-- /main -->


  <!-- /footer -->

  <!-- vendor js -->
  <script src="<?=config_item('sty_back')?>plugins/jquery/jquery-3.2.1.min.js"></script>
  <script src="<?=config_item('sty_back')?>plugins/popper/popper.min.js"></script>
  <script src="<?=config_item('sty_back')?>plugins/bootstrap/js/bootstrap.min.js"></script>
  
  <!-- theme js -->
  <script src="<?=config_item('sty_back')?>js/themes.min.js"></script>
  <script src="<?=config_item('sty_back')?>js/theme.min.js"></script>
</body>
</html>