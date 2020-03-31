<div class="page-header">
	<h4 class="page-title">REPORT</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Emergency Patient Report</a></li>
	</ol>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <h4 class="m-t-0 header-title"><strong>Emergency Patient Report</strong></h4>
            <div class="col-12">

<form action="" method="post" accept-charset="utf-8">
    <div class="row border border-primary rounded mb-4">
        <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Select Category <span class="text-danger">*</span></label>
                            <select class="form-control FacilityHead required" name="code">
                                <option value="" hidden="true">Select Category</option>
                                <option value="All">ALL</option>
                                <option value="Emergency Facility">EMERGENCY FACILITY</option>
                                <option value="Pathology">PATHOLOGY TEST</option>
                                <option value="E.C.G" data-amt="50">E.C.G</option>
                                <option value="U.S.G">U.S.G</option>
                                <option value="X-Ray">X-RAY</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 EmergencyFacilityDiv" style="display: none;">
                        <div class="form-group">
                            <label class="form-label">Select Sub Category</label>
                               <select class="form-control EmergencyFacility" name="emfacility">
                                <option value="" hidden="true">Select Emergency Facility</option>
                                <?php foreach ($Facility as $key => $value) { if(($value->id != 1) && ($value->id != 9)) { ?>
                                    <option value="<?=$value->id?>" data-amt="<?=$value->amount?>"><?=$value->facility?></option>
                                <?php } } ?>
                                <option value="Bed">Bed</option>
                                <!-- <option value="Miscellaneous">Miscellaneous</option>
                                <option value="Special Doctor">Special Call Doctor</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 Pathology" style="display: none;">
                        <div class="form-group">
                            <label class="form-label">Select Sub Category <span class="text-danger">*</span></label>
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
                        <!-- <div class="col-md-3 SpecialDoctor" style="display: none;">
                            <div class="form-group">
                                <label class="form-label">Special Call Doctor</label>
                                <input type="text" name="doctor_name" class="form-control" placeholder="Enter Doctor Name">
                            </div>
                        </div> -->

                    <div class="col-md-3 ECG" style="display: none;">
                        <div class="form-group">
                            <label class="form-label">Select Sub Category</label>
                            <select class="form-control ECGSelect" name="usg">
                                <option value="" hidden="true">Select ECG</option>
                                <?php foreach ($ECG as $key => $value) { ?>
                                    <option value="<?=$value->od_facilit_id?>" data-amt="<?=$value->rate_nb?>"><?=$value->facilit_name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 All" style="display: none;">
                        <div class="form-group">
                            <label class="form-label">Select Sub Category</label>
                            <select class="form-control AllSelect" name="usg">
                                <option value="" hidden="true">Select Sub Category</option>
                                <?php foreach ($ALL as $key => $value) { ?>
                                    <option value="<?=$value->od_facilit_id?>"><?=$value->facilit_name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 USG" style="display: none;">
                        <div class="form-group">
                            <label class="form-label">Select Sub Category</label>
                            <select class="form-control USGSelect" name="usg">
                                <option value="" hidden="true">Select USG</option>
                                <?php foreach ($USG as $key => $value) { ?>
                                    <option value="<?=$value->od_facilit_id?>" data-amt="<?=$value->rate_nb?>"><?=$value->facilit_name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 XRay" style="display: none;">
                        <div class="form-group">
                            <label class="form-label">Select Sub Category</label>
                            <select class="form-control XRaySelect" name="xray">
                                <option value="" hidden="true">Select X-Ray</option>
                                <?php foreach ($XRay as $key => $value) { ?>
                                    <option value="<?=$value->od_facilit_id?>" data-amt="<?=$value->rate_nb?>"><?=$value->facilit_name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

        <div class="col-md-3">
            <label class="form-label">From Date <span class="text-danger">*</span></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-calendar tx-16 lh-0 op-6"></i></div>
                </div>
                <input type="text" name="f_date" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY" value="<?=date('d-m-Y')?>">
            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label">To Date <span class="text-danger">*</span></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                    </div>
                </div><input type="text" name="t_date" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY" value="<?=date('d-m-Y')?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-outline-primary btn-block"><strong>Get Report</strong></button>
            </div>
        </div>
    </div>
</form>

            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Payment Date</th>
                                <!--<th>Category</th>-->
                                <th>Facility</th>
                                <th>Patient</th>
                                <th>Collected By</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="GetReport"><?=$Row?></tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</div>
