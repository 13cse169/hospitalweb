<div class="page-header">
	<h4 class="page-title">PROFILE SETTING</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">User Setting</a></li>
	</ol>
</div>

<div class="row">
    <div class="col-4">
		<div class="card">
	        <div class="card-body">
            	<h4 class="m-t-0 header-title"><strong>Change Password</strong></h4>
				<form action="" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-label">Enter Old Password <span class="text-danger">*</span></label>
								<input type="password" class="form-control required" name="old" value="<?=$this->session->flashdata('old')?>" placeholder="Enter Old Password">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-label">Enter New Password <span class="text-danger">*</span></label>
								<input type="password" class="form-control required" name="new" value="<?=$this->session->flashdata('new')?>" placeholder="Enter New Password">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-label">Confirm Password <span class="text-danger">*</span></label>
								<input type="password" class="form-control required" name="renew" value="<?=$this->session->flashdata('renew')?>" placeholder="Confirm Password">
							</div>
						</div>
						<div class="col-md-12">
							<button type="submit" class="btn btn-outline-primary btn-block"><strong>Update Password</strong></button>
						</div>
					</div>
				</form>
            </div>
        </div>                
    </div>
</div>