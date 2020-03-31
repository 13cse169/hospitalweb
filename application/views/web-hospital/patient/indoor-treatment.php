<div class="page-header">
    <h4 class="page-title">INDOOR PATIENT</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Treatment</a></li>
    </ol>
</div>

<div class="card">
    <div class="card-header"><h3 class="card-title font-weight-bold">Indoor Patient Treatment</h3></div>
    <div class="card-body">
        <div class="panel panel-primary">
            <div class=" tab-menu-heading">
                <div class="tabs-menu1 ">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li><a href="#tab2" class="active" data-toggle="tab">Bed Allotment</a></li>
                        <li><a href="#tab3" data-toggle="tab">Diagnosis & Treatment</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body">
                <div class="tab-content">

<div class="tab-pane active" id="tab2">
    <form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="modal-body">
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label"> Enter Patient Code</label>
                        <select class="form-control select2-show-search required" name="treatment" data-placeholder="Select Patient Code">
                            <option value="" hidden="true"></option>
                            <?php
                                foreach ($BedAlot as $key => $value) {
                                    $Details = $this->my_library->GetRow('h_patient', array('patient_id' => $value->patient_id)); ?>
                                    <option value="<?=$value->treatment_id?>"><?=$Details->code?> - [<?=$Details->name?>]</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                        
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">Enter Allotment Date <span class="text-danger">*</span></label>
                        <input type="text" name="allotment_date" value="<?=date('d-m-Y')?>" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">Enter Allotment Time <span class="text-danger">*</span></label>
                        <input type="time" name="allotment_time" value="<?=date('H:i')?>" class="form-control required">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Department <span class="text-danger">*</span></label>
                        <select class="form-control required myDepartment" name="dept_id">
                            <option value="" hidden="true">Select Department</option>
                            <?php foreach ($Dept as $key) { ?>
                                <option value="<?=$key->dept_id?>">[<?=$key->code?>] <?=$key->name?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Select Ward <span class="text-danger">*</span></label>
                        <select class="form-control required myWard" name="ward_id">
                            <option value="" hidden="true">Select Ward</option>
                            <option value="" disabled="true">Select Department First.</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Bed Name <span class="text-danger">*</span></label>
                        <!-- <input type="text" class="form-control required" name="name" placeholder="Enter Bed Name"> -->
                        <select class="form-control required myBed" name="bed_id">
                            <option value="" hidden="true">Select Bed</option>
                            <option value="" disabled="true">Select Ward First.</option>
                        </select>
                    </div>
                </div>
                        
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" name="bed-allot" class="btn btn-outline-primary btn-block"><strong>Add Data</strong></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="tab-pane " id="tab3">
    <form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="modal-body">
            <div class="row">
                        
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Enter Diagnosis <span class="text-danger">*</span></label>
                        <textarea class="form-control required" name="diagnosis"></textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Enter Treatment <span class="text-danger">*</span></label>
                        <textarea class="form-control required" name="treatment"></textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label"> Enter Patient Code</label>
                        <select class="form-control select2-show-search required" name="code" data-placeholder="Select Patient Code">
                            <option value="" hidden="true"></option>
                            <?php foreach ($Patient as $key => $value) { ?>
                                <option value="<?=$value->code?>"><?=$value->code?> - [<?=$value->name?>]</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                        
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" name="diagnosis-treatment" class="btn btn-outline-primary btn-block"><strong>Add Diagnosis & Treatment</strong></button>
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
</div>

