<div class="page-header">
    <h4 class="page-title">HOSPITAL MASTER</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Outdoor Treatment Entry</a></li>
    </ol>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Outdoor Treatment Entry</strong></h4>
                    
<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="modal-body">
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Patient Code <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="code" placeholder="Enter Patient Code">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Patient Name <span class="text-danger">*</span></label>
                    <select class="form-control required" name="patient">
                        <option value="" hidden="true">Select Patient Name</option>
                        <?php foreach ($Patient as $key => $value) { ?>
                            <option value="<?=$value->patient_id?>"><?=$value->name?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Age <span class="text-danger">*</span></label>
                    <input type="number" class="form-control required" name="age" placeholder="Enter Age">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Blood Group <span class="text-danger">*</span></label>
                    <select class="form-control required" name="blood_group">
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
                    <label class="form-label">Material Status <span class="text-danger">*</span></label>
                    <select class="form-control required" name="material_status">
                        <option value="" hidden="true">Select Material Status</option>
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
                <label class="form-label">Enter Appointment Date <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                        </div>
                    </div><input type="text" name="appointment_date" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY">
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
                    <label class="form-label">Enter Complain <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="complain" placeholder="Enter Complain">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Sl. No. (Bill No.) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="bill_no" placeholder="Enter Sl. No. (Bill No.)">
                </div>
            </div>
                    
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Agent <span class="text-danger">*</span></label>
                    <select class="form-control required" name="agent">
                        <option value="" hidden="true">Select Agent</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Muslim">Muslim</option>
                        <option value="Sikh">Sikh</option>
                        <option value="Jain">Jain</option>
                        <option value="Christian">Christian</option>
                    </select>
                </div>
            </div>
                    
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Department <span class="text-danger">*</span></label>
                    <select class="form-control required" name="department">
                        <option value="" hidden="true">Select Department</option>
                        <?php foreach ($Dept as $key => $value) { ?>
                            <option value="<?=$value->dept_id?>"><?=$value->name?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
                  
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Consulting Dr. <span class="text-danger">*</span></label>
                    <select class="form-control required" name="age2">
                        <option value="" hidden="true">Select Consulting</option>
                        <?php foreach ($Doctor as $key => $value) { ?>
                            <option value="<?=$value->doctor_id?>"><?=$value->name?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
              
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Enter Fees <span class="text-danger">*</span></label>
                    <input type="number" class="form-control required" name="Fees" placeholder="Enter Fees">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-outline-primary btn-block"><strong>Add Data</strong></button>
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
