<div class="page-header">
    <h4 class="page-title">EMERGENCY PATIENT ADMISSION</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Emergency Patient Admission</a></li>
    </ol>
    <a href="<?=base_url('patient/emergency-list')?>" class="btn btn-outline-primary">
        <i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;Emergency Patient List
    </a>
</div>

<!-- Example For -->

<div class="card">
    <div class="row">
        <div class="card-body">
                    
            <form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="row">
                <!-- <div class="row border border-primary rounded mb-3 account-details-box"> -->
                   <!--  <div class="col-md-3">
                       <div class="form-group">
                           <label class="form-label"> Enter Patient Code</label>
                           <select class="form-control select2-show-search patient-code" name="patient_id">
                               <option value="New">New Patient</option>
                               <?php foreach ($Patient as $key => $value) { 
                                   if($value->status != 'Discharge') { ?>
                                   <option value="<?=$value->patient_id?>"><?=$value->code?> - [<?=$value->name?>]</option>
                               <?php } } ?>
                           </select>
                       </div>
                   </div> -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Enter Patient Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required PatientName" name="name" placeholder="Enter Patient Name">
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
                                <option value="Month">Month</option>
                                <option value="Year">Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
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
                            <label class="form-label">Enter Relative Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" name="relative" placeholder="Enter Relative Name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Enter Relation <span class="text-danger">*</span></label>
                            <select class="form-control required" name="relation">
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
                            <label class="form-label">Enter Contact No. <span class="text-danger">*</span></label>
                            <input type="number" class="form-control phone-true required" name="phone" placeholder="Enter Contact No. (10 Digits)">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Enter Referred By <span class="text-danger">*</span></label>
                            <select class="form-control required ReferredBy" name="referred_by">
                                <option value="" hidden="true">Select Referred By</option>
                                <option value="N/A">N/A</option>
                                <?php foreach ($Doctor as $key => $value) { ?>
                                    <option value="<?=$value->doctor_id?>"><?=$value->name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Enter Allotment Date</label>
                            <input type="text" name="allotment_date" value="<?=date('d-m-Y')?>" class="form-control fc-datepicker AllotmentDate" placeholder="DD-MM-YYYY">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Enter Allotment Time</label>
                            <input type="time" name="allotment_time" value="<?=date('H:i')?>" class="form-control AllotmentTime">
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Collected By</label>
                            <input type="text" class="form-control required" value="<?=$_SESSION['name']?>" readonly="true">
                            <input type="hidden" name="collectedby" value="<?=$_SESSION['userID']?>">
                        </div>
                    </div>


                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Select Facility <span class="text-danger">*</span></label>
                            <select class="form-control FacilityHead required" name="facilityhead">
                                <option value="" hidden="true">Select Facility</option>
                                <option value="Emergency Facility">EMERGENCY FACILITY</option>
                                <option value="Pathology">PATHOLOGY TEST</option>
                                <option value="ECHO CARDIOGRAPHY" data-amt="400">ECHO CARDIOGRAPHY</option>
                                <option value="E.C.G" data-amt="50">E.C.G</option>
                                <option value="U.S.G">U.S.G</option>
                                <option value="X-Ray">X-RAY</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 EmergencyFacilityDiv" style="display: none;">
                        <div class="form-group">
                            <label class="form-label">Select Emergency Facility</label>
                            <select class="form-control EmergencyFacility" name="emfacility">
                                <option value="" hidden="true">Select Emergency Facility</option>
                                <?php foreach ($Facility as $key => $value) { if(($value->id != 1) && ($value->id != 9)) { ?>
                                    <option value="<?=$value->id?>" data-amt="<?=$value->amount?>"><?=$value->facility?></option>
                                <?php } } ?>
                                <option value="Bed">Bed</option>
                                <option value="Miscellaneous">Miscellaneous</option>
                                <option value="Special Doctor">Special Call Doctor</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 Pathology" style="display: none;">
                        <div class="form-group">
                            <label class="form-label">Select Pathology Test <span class="text-danger">*</span></label>
                            <select class="form-control PathologyTest">
                                <option value="" hidden="true">Select Pathology Test</option>
                                <option value="All">All</option>
                                <option value="G00013">HISTOPATHOLOGY</option>
                                <?php foreach ($Type as $key => $value) { ?>
                                    <option value="<?=$value->type?>"><?=$value->type?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 SpecialDoctor" style="display: none;">
                        <div class="form-group">
                            <label class="form-label">Special Call Doctor</label>
                            <input type="text" name="doctor_name" class="form-control" placeholder="Enter Doctor Name">
                        </div>
                    </div>
                    <div class="col-md-3 AmountDiv">
                        <div class="form-group">
                            <label class="form-label">Amount / Fee</label>
                            <input type="text" name="doctor_fee" class="form-control AmountFee">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Enter Registration Fee</label>
                            <input type="number" class="form-control required RegistrationFee" name="admissionfee" value="150" data-amt="150">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Enter Service Charge</label>
                            <input type="number" class="form-control required ServiceCharge" name="service_charge" value="50" data-amt="50">
                        </div>
                    </div>
                </div>
                <div class="OtherPathologyDiv"></div>
                <div class="USG" style="display: none;">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Select USG</label>
                                <select class="form-control USGSelect" name="usg[]">
                                    <option value="" hidden="true">Select USG</option>
                                    <?php foreach ($USG as $key => $value) { ?>
                                        <option value="<?=$value->od_facilit_id?>" data-amt="<?=$value->rate_nb?>"><?=$value->facilit_name?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Amount</label>
                                <input type="text" name="usg_fee[]" class="form-control xray-usg-fee">
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <label class="form-label">&nbsp;</label>
                            <span href="#" class="btn btn-outline-primary PathologyBtn AddPathology"><i class="fas fa-plus"></i></span>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
                <div class="XRay" style="display: none;">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Select X-Ray</label>
                                <select class="form-control XRaySelect" name="xray[]">
                                    <option value="" hidden="true">Select X-Ray</option>
                                    <?php foreach ($XRay as $key => $value) { ?>
                                        <option value="<?=$value->od_facilit_id?>" data-amt="<?=$value->rate_nb?>"><?=$value->facilit_name?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Amount</label>
                                <input type="text" name="xray_fee[]" class="form-control xray-usg-fee">
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <label class="form-label">&nbsp;</label>
                            <span href="#" class="btn btn-outline-primary PathologyBtn AddPathology"><i class="fas fa-plus"></i></span>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block">Add Patient</button>
                    </div>
                </div>
            </form>

        </div>                
    </div>
</div>