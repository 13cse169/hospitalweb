<div class="header py-1">
	<div class="container">
		<div class="d-flex">
			<a class="header-brand" href="<?=base_url('dashboard/')?>">
				<img src="<?=base_url('assets/img/logo.png')?>" class="header-brand-img" alt="Viboon logo"> <span class="text-white">Hospital</span>
			</a>
			<div class="d-flex order-lg-2 ml-auto">
				<div class="dropdown mt-1">
					<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
						<span class="avatar avatar-md brround" style="background-image: url(<?=base_url('assets/img/user-male.png')?>)"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
						<div class="text-center">
							<a href="#" class="dropdown-item text-center font-weight-sembold user"><?=$_SESSION['name']?></a>
							<div class="dropdown-divider"></div>
						</div>
						<!-- <a class="dropdown-item" href="#">
							<i class="dropdown-icon mdi mdi-account-outline "></i> Profile
						</a> -->
						<a class="dropdown-item" href="<?=base_url('user/setting')?>">
							<i class="dropdown-icon  mdi mdi-settings"></i> Settings
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?=base_url('login/logout')?>">
							<i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
						</a>
					</div>
				</div>
			</div>
			<a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
				<span class="header-toggler-icon"></span>
			</a>
		</div>
	</div>
</div>