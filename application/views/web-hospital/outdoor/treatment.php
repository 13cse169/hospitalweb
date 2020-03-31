<div class="page-header">
    <h4 class="page-title">OUTDOOR PATIENT TREATMENT</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Outdoor Patient</a></li>
    </ol>
    <a href="<?=base_url('outdoor/patientlist')?>" class="btn btn-outline-primary">
        <i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;Patient List
    </a>
</div>

<!-- Example For -->

<div class="card">
    <div class="row">
        <div class="card-body">

<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" id="OutdoorTreatmentForm">
    <div class="modal-body border border-primary rounded mb-3 patient-outdoor-box">

        <div class="row">

            <div class="col-md-12">
                <div class="border border-secondary border-left-0 border-right-0 border-top-0 text-center mb-4">
                    <h4 class="font-weight-bold">Patient Details</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Enter Patient Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required PatientName" name="name" placeholder="Enter Patient Name">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Enter Age</label>
                    <input type="number" class="form-control required" name="age" min="1" placeholder="Enter Age">
                </div>
            </div>
            <!-- <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Enter Day/Month/Year</label>
                    <select class="form-control required select" name="age2" open>
                        <option value="" hidden="true">Day/Month/Year</option>
                        <option value="Day">Day</option>
                        <option value="Month">Month</option>
                        <option value="Year">Year</option>
                    </select>
                </div>
            </div> -->
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Enter Gender</label>
                    <select class="form-control required select" name="gender">
                        <option value="" hidden="true">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Enter Patient Type</label>
                    <select class="form-control required PatientType select" name="patient_type">
                        <option value="" hidden="true">Enter Patient Type</option>
                        <option value="Pension Holder">Pension Holder</option>
                        <option value="General">General</option>
                        <option value="Beneficiaries">Beneficiaries</option>
                        <option value="Non-Beneficiaries">Non-Beneficiaries</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Referred By <span class="text-danger">*</span></label>
                    <select class="form-control required ReferredBy" name="referredby">
                        <option value="" hidden="true">Select referredby</option>
                        <option value="N/A">N/A</option>
                        <option value="Name">Enter Name</option>
                        <?php foreach ($Doctor as $key => $value) { ?>
                            <option value="<?=$value->doctor_id?>"><?=$value->name?></option>    
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3 ReferredByName" style="display: none;">
                <div class="form-group">
                    <label class="form-label">Enter Doctor Name</label>
                    <input type="text" name="ReferredByName" class="form-control" placeholder="Enter Doctor Name">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Appointment Date</label>
                    <input type="text" name="app_date" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY" value="<?=date('d-m-Y')?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Appointment Time</label>
                    <input type="time" name="app_time" value="<?=date('H:i')?>" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Collected By</label>
                    <input type="text" class="form-control required" value="<?=$_SESSION['name']?>" readonly="true">
                    <input type="hidden" name="collectedby" value="<?=$_SESSION['userID']?>">
                </div>
            </div>
        </div>
        <div class="ParticularDiv">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Enter Category <span class="text-danger">*</span></label>
                        <select class="form-control Category required select" name="category[]" data-placeholder="Select Category">
                            <option value="" hidden="true">Select Category</option>
                            <?php foreach ($Category as $key => $value) { if($value->g_code != 'G00032') { ?>
                                <option value="<?=$value->g_code?>"><?=$value->group_name?></option>    
                            <?php } } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Enter Particular <span class="text-danger">*</span></label>
                        <select class="form-control particular required select" name="particular[]" data-placeholder="Select Particular">
                            <option value="" hidden="true">Select Particular</option>
                            <option value="" disabled="true">Select  Category First</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Amount</label>
                        <input type="text" name="amount[]" class="form-control ParticularAmount required" readonly="true">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col-md-3 text-center">
                        <label class="form-label">&nbsp;</label>
                        <span href="#" class="btn btn-outline-primary ParticularBtn AddParticular"><i class="fas fa-plus"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Select Discount Type</label>
                    <select class="form-control disType" name="distype">
                        <option value="" hidden="true">Select Discount Type</option>
                        <option value="N/A">N/A</option>
                        <option value="Refund">Refund Amount</option>
                        <option value="Amount">Discount in Amount</option>
                        <option value="Percentage">Discount in Percentage</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Discount / Refund</label>
                    <input type="number" class="form-control required disVal" name="disval" placeholder="Discount Value" value="00" readonly="true">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Total Amount</label>
                    <input type="number" class="form-control TotalAmount" name="total" value="00" readonly="true">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Net Amount</label>
                    <input type="number" class="form-control AfterDiscount" name="after_discount" readonly="true">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </div>
        </div>

    </div>

</form>

        </div>                
    </div>
</div>
