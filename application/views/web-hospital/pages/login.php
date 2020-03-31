<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<meta name="msapplication-TileColor" content="#0061da">
		<meta name="theme-color" content="#1643a3">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
		<title>Web Hospital</title>
		<link href="<?=base_url('assets/fonts/fonts/font-awesome.min.css')?>" rel="stylesheet" >
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
		<link href="<?=base_url('assets/css/dashboard.css')?>" rel="stylesheet" />
		<link href="<?=base_url('assets/css/mystyle.css')?>" rel="stylesheet" />
		<link href="<?=base_url('assets/plugins/charts-c3/c3-chart.css')?>" rel="stylesheet" />
		<link href="<?=base_url('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css')?>" rel="stylesheet" />
		<link href="<?=base_url('assets/plugins/iconfonts/plugin.css')?>" rel="stylesheet" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	</head>
	<body class="login-img">
		<div id="global-loader" ></div>
		<div id="toast"><div id="img"><i class="fas fa-bell"></i></div><div id="desc">Login Failed.! Check your credentials.</div></div>
		<div class="page">
			<div class="page-single">
				<div class="container">
					<div class="row">
						<div class="col col-login mx-auto">
							<div class="text-center mb-6">
								<h4 class="text-white"><i class="fas fa-clinic-medical"></i> Web Hospital</h4>
							</div>
							<form class="card" method="post" action="">
								<div class="card-body p-6">
									<div class="card-title text-center">Login to your Account</div>
									<div class="form-group">
										<label class="form-label">User Name</label>
										<input type="text" name="user_name" class="form-control required"  placeholder="Enter User Name" value="<?=$this->session->flashdata('user_name')?>">
									</div>
									<div class="form-group">
										<label class="form-label">Password</label>
										<input type="password" name="password" class="form-control required" placeholder="Enter Password" value="<?=$this->session->flashdata('password')?>">
									</div>
									<div class="form-footer">
										<button type="submit" class="btn btn-primary btn-block">Sign in</button>
									</div>
								</div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	
	<script src="<?=base_url('assets/js/vendors/jquery-3.2.1.min.js')?>"></script>
	<script src="<?=base_url('assets/js/vendors/bootstrap.bundle.min.js')?>"></script>
	<script src="<?=base_url('assets/js/vendors/jquery.sparkline.min.js')?>"></script>
	<script src="<?=base_url('assets/js/vendors/selectize.min.js')?>"></script>
	<script src="<?=base_url('assets/js/vendors/jquery.tablesorter.min.js')?>"></script>
	<script src="<?=base_url('assets/js/vendors/circle-progress.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/rating/jquery.rating-stars.js')?>"></script>
	<script src="<?=base_url('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')?>"></script>
	<script src="<?=base_url('assets/js/custom.js')?>"></script>

	<script type="text/javascript">
		jQuery(document).ready(function($) {

			$('form').submit(function(event) {
                var error = 0;
                $(this).find('input,textarea,select').each(function(){
                    if($(this).hasClass('required')){
                        if ($(this).val() == '') {
                            $(this).removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                            ++error;
                        }else{
                            if ($(this).hasClass('email-true')) {
                                if(!emailFilter.test($(this).val())){
                                    $(this).removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                                    ++error;
                                }else{
                                    $(this).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
                                }
                            }else if($(this).hasClass('phone-true')){
                                if($(this).val().length == 10){
                                    $(this).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
                                }else{
                                    $(this).removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                                    ++error;
                                }
                            }else if ($(this).hasClass('ent-qty')) {
                                if (parseInt($("#ent-qty").val()) > parseInt($("#CurrentStock2").val())) { 
                                    $('#ent-qty').removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                                    ++error;
                                }
                            }else{
                                $(this).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
                            }
                        }
                    }
                });
                if (error > 0) { event.preventDefault(); }
                else{
                    var submit = $(this).closest('form').find(':submit');
                    $(submit).html('Please wait a moment <i class="fa fa-spinner fa-spin ml-2"></i>');
                }
            });


		});
	</script>

<?php if($this->session->flashdata('error')) { ?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
    		var x = document.getElementById("toast")
    		x.className = "show";
    		setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
		});
	</script>
<?php } ?>

</html>