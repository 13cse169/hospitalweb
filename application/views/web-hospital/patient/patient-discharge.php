<div class="page-header">
    <h4 class="page-title">INDOOR PATIENT</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Discharge</a></li>
    </ol>
</div>


<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Patient Discharge</strong></h4>
                    

<div class="modal-body">
    <div class="row border border-primary rounded mb-3 PatientBox">
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"> Enter Patient ID / Name</label>
                <select class="form-control select2-show-search required patient-discharge" name="code" data-placeholder="Select Patient ID">
                    <option value="" hidden="true"></option>
                    <?php foreach ($Patient as $key => $value) { 
                        if (($value->bed_id != '') && ($value->discharge_on == '')) {
                            $Details = $this->my_library->GetRow('h_patient', array('patient_id' => $value->patient_id)); ?>
                            <option value="<?=$value->treatment_id?>"><?=$Details->code?> - [<?=$Details->name?>]</option>
                    <?php } } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">Admission ID <span class="text-danger">*</span></label>
                <input type="text" class="form-control required" name="admission_id" placeholder="Admission ID" readonly="true">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">Patient Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control required" name="name" placeholder="Patient Name" readonly="true">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">Mobile No. <span class="text-danger">*</span></label>
                <input type="text" class="form-control required" name="phone" placeholder="Mobile No." readonly="true">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">Admission Date/Time <span class="text-danger">*</span></label>
                <input type="text" class="form-control required" name="added_on" placeholder="Admission Date/Time" readonly="true">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">Enter Age <span class="text-danger">*</span></label>
                <input type="text" class="form-control required" name="age" placeholder="Enter Age" readonly="true">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">Enter Gender <span class="text-danger">*</span></label>
                <input type="text" class="form-control required" name="gender" placeholder="Enter Gender" readonly="true">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">Department <span class="text-danger">*</span></label>
                <input type="text" class="form-control required" name="dept" placeholder="Department" readonly="true">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">Ward <span class="text-danger">*</span></label>
                <input type="text" class="form-control required" name="ward" placeholder="Ward" readonly="true">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">Bed <span class="text-danger">*</span></label>
                <input type="text" class="form-control required" name="bed" placeholder="Bed" readonly="true">
            </div>
        </div>
    </div>
    <form action="" method="post">
        <div class="row border border-primary rounded mb-3">
            <input type="hidden" name="treatment_id" class="form-control discharge-treatment">
            <!-- <div class="col-md-3">
                <label class="form-label">Discharge Date <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                        </div>
                    </div><input type="text" name="dod" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY">
                </div>
            </div> -->
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Discharge By <span class="text-danger">*</span></label>
                    <select class="form-control required relation-name" name="relation">
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
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Discharge Person <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required relative-name" name="relative" placeholder="Discharge Person" readonly="true">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div class="form-label">Discharge on medical advice only <span class="text-danger">*</span></div>
                    <label class="custom-switch">
                        <input type="checkbox" name="tax" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Switch if medical advice only</span>
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Advice on discharge <span class="text-danger">*</span></label>
                    <textarea name="advice" class="form-control required" rows="5" placeholder="Enter Advice"></textarea>
                </div>
            </div>
            <div class="col-md-4 offset-8 patient-discharge-btn" style="display: none;">
                <div class="form-group">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-pill btn-primary btn-block">Discharge</button>
                </div>
            </div>
        </div>
    </form>
</div>

                </div>
            </div>
        </div>                
    </div>
</div>
