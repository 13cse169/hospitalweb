<div class="page-header">
	<h4 class="page-title">DR. B.C. ROY HOSPITAL & MATERNITY HOME</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
	</ol>
</div>
<div class="row row-cards">
	
	<div class="col-sm-12 col-md-6 col-lg-3">
		<div class="card widgets-cards">
			<div class="card-body d-flex justify-content-center align-items-center">
				<div class="col-5 p-0">
					<div class="wrp icon-circle bg-success">
						<i class="fas fa-user-md"></i>
					</div>
				</div>
				<div class="col-7 p-0">
					<div class="wrp text-wrapper">
						<p><?=$Doctor?></p>
						<p class="text-dark mt-1 mb-0">Doctor</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6 col-lg-3">
		<div class="card widgets-cards">
			<div class="card-body d-flex justify-content-center align-items-center">
				<div class="col-5 p-0">
					<div class="wrp icon-circle bg-danger">
						<i class="fas fa-procedures"></i>
					</div>
				</div>
				<div class="col-7 p-0">
					<div class="wrp text-wrapper">
						<p><?=$Emergency?></p>
						<p class="text-dark mt-1 mb-0">Emergency Patient</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6 col-lg-3">
		<div class="card widgets-cards">
			<div class="card-body d-flex justify-content-center align-items-center">
				<div class="col-5 p-0">
					<div class="wrp icon-circle bg-warning">
						<i class="fas fa-procedures"></i>
					</div>
				</div>
				<div class="col-7 p-0">
					<div class="wrp text-wrapper">
						<p><?=$Outdoor?></p>
						<p class="text-dark mt-1 mb-0">Outdoor Patient</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6 col-lg-3">
		<div class="card widgets-cards">
			<div class="card-body d-flex justify-content-center align-items-center">
				<div class="col-5 p-0">
					<div class="wrp icon-circle bg-primary">
						<i class="fas fa-procedures"></i>
					</div>
				</div>
				<div class="col-7 p-0">
					<div class="wrp text-wrapper">
						<p><?=$Indoor?></p>
						<p class="text-dark mt-1 mb-0">Indoor Patient</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title font-weight-bold">Monthly Report (<?=date('Y')?>)</h3>
			</div>
			<div class="card-body">
				<div id="chart-combination" class="chartsh"></div>
			</div>
		</div>
	</div>
</div>
