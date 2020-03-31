<div class="page-header">
	<h4 class="page-title">PATHOLOGY ENTRY</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Booking Entry</a></li>
	</ol>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Add Booking Entry</strong></h4>
<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="modal-body">
        <div class="row border border-primary rounded mb-2">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label"> Enter Patient Code</label>
                    <select class="form-control select2-show-search required" name="code" data-placeholder="Select Patient Code">
                        <option value="" hidden="true"></option>
                        <?php foreach ($Patient as $key => $value) { ?>
                            <option value="<?=$value->patient_id?>"><?=$value->name?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Patient Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="name" placeholder="Enter Patient Name">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Address <span class="text-danger">*</span></label>
                    <textarea name="address" class="form-control required" rows="1" placeholder="Enter Address required"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Gender <span class="text-danger">*</span></label>
                    <select class="form-control required" name="gender">
                        <option value="" hidden="true">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Category <span class="text-danger">*</span></label>
                    <select class="form-control required" name="category">
                        <option value="" hidden="true">Select Category</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Pregnant">Pregnant</option>
                        <option value="Infant">Infant</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Age <span class="text-danger">*</span></label>
                    <input type="number" class="form-control required" name="age" min="1" placeholder="Enter Age">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Contact No. <span class="text-danger">*</span></label>
                    <input type="number" class="form-control required phone-true" name="phone" placeholder="Enter Contact No. (10 Digits)">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Referred By <span class="text-danger">*</span></label>
                    <select class="form-control required myDept" name="referred">
                        <option value="" hidden="true">Select Referred By</option>
                        <option value="Referred 1">Referred 1</option>
                        <option value="Referred 2">Referred 2</option>
                        <option value="Referred 3">Referred 3</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Doctor Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="name" placeholder="Enter Doctor Name">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Admission ID <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="admission_id" placeholder="Enter Admission ID">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Collected By <span class="text-danger">*</span></label>
                    <select class="form-control required myDept" name="referred">
                        <option value="" hidden="true">Select Collected By</option>
                        <option value="Consultant 1">Consultant 1</option>
                        <option value="Consultant 2">ReConsultant 2</option>
                        <option value="Consultant 3">Consultant 3</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="row border border-primary rounded">
                    <div class="col-md-6">
                        <label class="form-label">Enter Delivery Date <span class="text-danger">*</span></label>
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
                            <label class="form-label">Enter Test <span class="text-danger">*</span></label>
                            <select class="form-control required myDept" name="department">
                                <option value="" hidden="true">Select Test</option>
                                <!-- <?php foreach($Dept as $key => $value) { ?>
                                    <option value="<?=$value->dept_id?>"><?=$value->name?></option>
                                <?php } ?> -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enter Test Head <span class="text-danger">*</span></label>
                            <select class="form-control required myDept" name="department">
                                <option value="" hidden="true">Select Test Head</option>
                                <?php foreach($testHead as $key => $value) { ?>
                                    <option value="<?=$value->dept_id?>"><?=$value->name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="row border border-primary rounded ml-1">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Enter Test Amount <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required" name="test_amount" placeholder="Enter Test Amount">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Enter Tax Amount <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required" name="test_amount" placeholder="Enter Test Amount">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Enter Discount Amount <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required" name="discount_amount" placeholder="Enter Discount Amount">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Enter Net Amount <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required" name="net_amount" placeholder="Enter Net Amount">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Enter Balance Amount <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required" name="balance_amount" placeholder="Enter Balance Amount">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Enter Payable Amount <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required" name="payable_amount" placeholder="Enter Payable Amount">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-outline-primary btn-block" name="add"><strong>Add</strong></button>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-outline-primary btn-block" name="exit"><strong>Exit</strong></button>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-outline-primary btn-block" name="new"><strong>New</strong></button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
                </div>
            </div>
        </div>                
    </div>
</div>
