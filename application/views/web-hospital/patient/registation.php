<div class="page-header">
    <h4 class="page-title">PATIENT ADMISSION</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Patient Admission</a></li>
    </ol>
    <a href="<?=base_url('patient/list')?>" class="btn btn-outline-primary">
        <i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;Patient List
    </a>
</div>


<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Patient Details</strong></h4>
                    
<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="modal-body">
        <div class="row border border-primary rounded mb-2">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enter Patient Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" name="name" placeholder="Enter Patient Name">
                        </div>
                    </div>
                    <div class="col-md-6">
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Enter Age <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required" name="age" min="1" placeholder="Enter Age">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Enter Day/Month/Year <span class="text-danger">*</span></label>
                            <select class="form-control required" name="age2">
                                <option value="" hidden="true">Day/Month/Year</option>
                                <option value="Day">Day</option>
                                <option value="Week">Week</option>
                                <option value="Month">Month</option>
                                <option value="Year">Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enter Nationality <span class="text-danger">*</span></label>
                            <select class="form-control" name="nationality">
                                <option value="" hidden="true">Select Nationality</option>
                                <option value="Indian">Indian</option>
                                <option value="Bangladeshi">Bangladeshi</option>
                                <option value="Nepali">Nepali</option>
                                <option value="Bhutani">Bhutani</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enter Religion <span class="text-danger">*</span></label>
                            <select class="form-control" name="religion">
                                <option value="" hidden="true">Select Religion</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Muslim">Muslim</option>
                                <option value="Sikh">Sikh</option>
                                <option value="Jain">Jain</option>
                                <option value="Christian">Christian</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enter Category <span class="text-danger">*</span></label>
                            <select class="form-control" name="category">
                                <option value="" hidden="true">Select Category</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Pregnant">Pregnant</option>
                                <option value="Infant">Infant</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Upload Patient Photo </label>
                <input type="file" class="dropify" data-height="185" name="photo" />
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Blood Group <span class="text-danger">*</span></label>
                    <select class="form-control" name="blood_group">
                        <option value="" hidden="true">Select Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="B+">B+</option>
                        <option value="AB+">AB+</option>
                        <option value="A-">A-</option>
                        <option value="B-">B-</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Marital Status <span class="text-danger">*</span></label>
                    <select class="form-control" name="material_status">
                        <option value="" hidden="true">Select Marital Status</option>
                        <option value="Married">Married</option>
                        <option value="Single">Single</option>
                        <option value="Separated">Separated</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Divorced">Divorced</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Contact No. <span class="text-danger">*</span></label>
                    <input type="number" class="form-control phone-true" name="phone" placeholder="Enter Contact No. (10 Digits)">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Email ID <span class="text-danger">*</span></label>
                    <input type="text" class="form-control email-true" name="email" placeholder="Enter Email ID">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Relative Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="relative" placeholder="Enter Relative Name">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Relation <span class="text-danger">*</span></label>
                    <select class="form-control" name="relation">
                        <option value="" hidden="true">Select Relation</option>
                        <option value="Gurdian">Gurdian</option>
                        <option value="Son">Son</option>
                        <option value="Son in law">Son in law</option>
                        <option value="Daughter">Daughter</option>
                        <option value="Daughter in law">Daughter in law</option>
                        <option value="Father">Father</option>
                        <option value="Father in law">Father in law</option>
                        <option value="Mother">Mother</option>
                        <option value="Mother in law">Mother in law</option>
                        <option value="Sister">Sister</option>
                        <option value="Sister in law">Sister in law</option>
                        <option value="Brother">Brother</option>
                        <option value="Brother in law">Brother in law</option>
                        <option value="Aunty">Aunty</option>
                        <option value="Uncle">Uncle</option>
                        <option value="Grand Father">Grand Father</option>
                        <option value="Grand Mother">Grand Mother</option>
                        <option value="Grand Son">Grand Son</option>
                        <option value="Grand Daughter">Grand Daughter</option>
                        <option value="Wife">Wife</option>
                        <option value="Husband">Husband</option>
                        <option value="Nephew">Nephew</option>
                        <option value="Others">Others</option>
                    </select>
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
                    <label class="form-label">Enter Referred By <span class="text-danger">*</span></label>
                    <select class="form-control required" name="referred_by">
                        <option value="" hidden="true">Select Referred By</option>
                        <?php foreach ($Doctor as $key => $value) { ?>
                            <option value="<?=$value->doctor_id?>"><?=$value->name?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-outline-primary btn-block"><strong>Add Patient</strong></button>
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
