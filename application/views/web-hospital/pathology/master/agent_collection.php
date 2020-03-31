<div class="page-header">
	<h4 class="page-title">PATHOLOGY MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Agent Collection</a></li>
	</ol>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Add Agent Collection</strong></h4>
<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enter Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" name="name" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enter Gender <span class="text-danger">*</span></label>
                            <select class="form-control required myDept" name="gender">
                                <option value="" hidden="true">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Enter D.O.B <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                            </div><input type="text" name="dob" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enter Department <span class="text-danger">*</span></label>
                            <select class="form-control required myDept" name="department">
                                <option value="" hidden="true">Select Department</option>
                                <?php foreach($Dept as $key => $value) { ?>
                                    <option value="<?=$value->dept_id?>"><?=$value->name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enter Age <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required" name="age" placeholder="Enter Age">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enter Contact No. <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required phone-true" name="phone" placeholder="Enter Contact No. (10 Digits)">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Upload Photo </label>
                <input type="file" class="dropify" data-height="185" name="photo" />
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Email ID <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required email-true" name="email" placeholder="Enter Email ID">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-outline-primary btn-block"><strong>Add Agent Collection</strong></button>
            </div>
        </div>
    </div>
</form>
                </div>
            </div>
        </div>                
    </div>
</div>
