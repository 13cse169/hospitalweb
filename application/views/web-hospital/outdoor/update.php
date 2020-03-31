<div class="page-header">
    <h4 class="page-title">UPDATE OUTDOOR TREATMENT</h4>
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
                    <h4 class="font-weight-bold">Update Details</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Enter Patient Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required PatientName" name="name" value="<?=$tData->name?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Enter Age</label>
                    <input type="number" class="form-control required" name="age" min="1" value="<?=$tData->age?>">
                </div>
            </div>
            <!-- <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Enter Day/Month/Year</label>
                    <select class="form-control required select" name="age2">
                        <option value="" hidden="true">Day/Month/Year</option>
                        <option value="Day" <?=($tData->age2 == 'Day')?'selected':''?>>Day</option>
                        <option value="Week">Week</option>
                        <option value="Month" <?=($tData->age2 == 'Month')?'selected':''?>>Month</option>
                        <option value="Year" <?=($tData->age2 == 'Year')?'selected':''?>>Year</option>
                    </select>
                </div>
            </div> -->
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Enter Gender</label>
                    <select class="form-control required select" name="gender">
                        <option value="" hidden="true">Select Gender</option>
                        <option value="Male" <?=($tData->gender == 'Male')?'selected':''?>>Male</option>
                        <option value="Female" <?=($tData->gender == 'Female')?'selected':''?>>Female</option>
                        <option value="Other" <?=($tData->gender == 'Other')?'selected':''?>>Other</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Enter Patient Type</label>
                    <select class="form-control required PatientType select" name="patient_type">
                        <option value="" hidden="true">Enter Patient Type</option>
                        <option value="Pension Holder" <?=($tData->patient_type == 'Pension Holder')?'selected':''?>>Pension Holder</option>
                        <option value="General" <?=($tData->patient_type == 'General')?'selected':''?>>General</option>
                        <option value="Beneficiaries" <?=($tData->patient_type == 'Beneficiaries')?'selected':''?>>Beneficiaries</option>
                        <option value="Non-Beneficiaries" <?=($tData->patient_type == 'Non-Beneficiaries')?'selected':''?>>Non-Beneficiaries</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Referred By <span class="text-danger">*</span></label>
                    <select class="form-control required ReferredBy" name="referredby">
                        <option value="" hidden="true">Select referredby</option>
                        <option value="N/A" <?=($tData->referredby == 'N/A')?'selected':''?>>N/A</option>
                        <option value="Name" <?=(!is_numeric($tData->referredby) && $tData->referredby != 'N/A')?'selected':''?>>Enter Name</option>
                        <?php foreach ($Doctor as $key => $value) { ?>
                            <option value="<?=$value->doctor_id?>" <?=($tData->referredby == $value->doctor_id)?'selected':''?>>
                                <?=$value->name?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3 ReferredByName" style="<?=(!is_numeric($tData->referredby) && $tData->referredby != 'N/A')?'':'display: none;'?>">
                <div class="form-group">
                    <label class="form-label">Enter Doctor Name</label>
                    <input type="text" name="ReferredByName" class="form-control" placeholder="Enter Doctor Name" value="<?=$tData->referredby?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Appointment Date</label>
                    <input type="text" name="app_date" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY" value="<?=date('d-m-Y', strtotime($tData->app_date))?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Appointment Time</label>
                    <input type="time" name="app_time" value="<?=date('H:i', strtotime($tData->app_time))?>" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Collected By</label>
                    <input type="text" class="form-control required" value="<?=($tData->collectedby)?$this->my_library->GetParam('users', 'name', array('id' => $tData->collectedby)):'Admin'?>" readonly="true">
                </div>
            </div>
        </div>
        <div class="ParticularDiv">
<?php 
    $category   = explode(',', $tData->category);
    $particular = explode(',', $tData->particular);
    $amount     = explode(',', $tData->amount);
    for ($i = 0; $i < count($category); $i++) { ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Enter Category <span class="text-danger">*</span></label>
                        <select class="form-control Category required select" name="category[]" data-placeholder="Select Category">
                            <option value="" hidden="true">Select Category</option>
                            <?php foreach ($Category as $key => $value) { if($value->g_code != 'G00032') { ?>
                                <option value="<?=$value->g_code?>" <?=($value->g_code == $category[$i])?'selected':''?>>
                                    <?=$value->group_name?>
                                </option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Enter Particular <span class="text-danger">*</span></label>
                        <select class="form-control particular required select" name="particular[]" data-placeholder="Select Particular">
                            <option value="" hidden="true">Select Particular</option>
                            <?php
                                $Data = $this->my_library->GetArray('outdoor_facility', array('g_code' => $category[$i]));
                                foreach ($Data as $key => $value) { ?>
                                    <option value="<?=$value->od_facilit_id?>" <?=($value->od_facilit_id == $particular[$i])?'selected':''?>>
                                        <?=$value->facilit_name?>
                                    </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Amount</label>
                        <input type="number" name="amount[]" class="form-control ParticularAmount" value="<?=$amount[$i]?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col-md-3 text-center">
                        <label class="form-label">&nbsp;</label>
                        <?php if($i == (count($category) - 1)) { ?>
                            <span href="#" class="btn btn-outline-primary ParticularBtn AddParticular"><i class="fas fa-plus"></i></span>
                        <?php } else { ?>
                            <span href="#" class="btn btn-outline-danger ParticularBtn RemoveParticular"><i class="fas fa-times"></i></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
<?php } ?>            
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Select Discount Type</label>
                    <select class="form-control disType" name="distype">
                        <option value="" hidden="true">Select Discount Type</option>
                        <option value="N/A" <?=($tData->distype == 'N/A')?'selected':''?>>N/A</option>
                        <option value="Refund" <?=($tData->distype == 'Refund')?'selected':''?>>Refund Amount</option>
                        <option value="Amount" <?=($tData->distype == 'Amount')?'selected':''?>>Discount in Amount</option>
                        <option value="Percentage" <?=($tData->distype == 'Percentage')?'selected':''?>>Discount in Percentage</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Discount / Refund</label>
                    <input type="number" class="form-control required disVal" name="disval" placeholder="Discount Value" value="<?=$tData->disval?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Total Amount</label>
                    <input type="number" class="form-control TotalAmount" name="total" value="<?=$tData->total?>" readonly="true">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Net Amount</label>
                    <input type="number" class="form-control AfterDiscount" name="after_discount" value="<?=$tData->after_discount?>" readonly="true">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary btn-block">Update Data</button>
            </div>
        </div>

    </div>

</form>

        </div>                
    </div>
</div>
