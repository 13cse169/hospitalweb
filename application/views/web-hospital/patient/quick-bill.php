<div class="page-header">
    <h4 class="page-title">INDOOR PATIENT</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Quick Bill</a></li>
    </ol>
</div>


<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Patient Details</strong></h4>
                    
<div class="modal-body">
    <form action="#" enctype="multipart/form-data" method="post" accept-charset="utf-8" id="patient-form">
        <div class="row border border-primary rounded mb-3">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label"> Enter Patient ID / Name</label>
                    <select class="form-control select2-show-search particular-patient" name="code" data-placeholder="Select Patient ID">
                        <option value="" hidden="true"></option>
                        <?php foreach ($Patient as $key => $value) { 
                            if ($value->bed_id) {
                                $Details = $this->my_library->GetRow('h_patient', array('patient_id' => $value->patient_id)); ?>
                                <option value="<?=$value->treatment_id?>"><?=$Details->code?> - [<?=$Details->name?>]</option>
                        <?php } } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Admission ID <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="admission_id" placeholder="Admission ID" readonly="true">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Admission Date <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="admission_date" placeholder="Admission Date" readonly="true">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Department <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="department" placeholder="Department" readonly="true">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Ward <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="ward" placeholder="Ward" readonly="true">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Bed <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="bed" placeholder="Bed" readonly="true">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Assign Dr. <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="doctor" placeholder="Assign Dr." readonly="true">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Length of Stay <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="length" placeholder="Length of Stay" readonly="true">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Bill Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="bill_no" placeholder="Bed" readonly="true">
                </div>
            </div>
        </div>
    </form>

    <div class="row border border-primary rounded mb-3">
        <div class="col-12">
            <form action="#" enctype="multipart/form-data" method="post" accept-charset="utf-8" id="particular-form">
                <div class="row border border-dark rounded mb-1">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Enter Particular <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search required particular" name="particular" data-placeholder="Select Particular">
                                <option value="" hidden="true">Select Particular</option>
                                <?php foreach ($facility as $key => $value) { ?>
                                    <option value="<?=$value->facility_id?>" amt="<?=$value->rate?>" uom="<?=$value->unit?>">
                                        <?=$value->name?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Amount <span class="text-danger">*</span></label>
                            <input type="number" class="form-control particular-amt required" name="amount" placeholder="Amount" readonly="true">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control particular-qty required" name="quantity" value="1" min="1" placeholder="quantity">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">UOM <span class="text-danger">*</span></label>
                            <input type="text" class="form-control particular-uom required" name="uom" placeholder="uom" readonly="true">
                        </div>
                    </div>
                    <!-- <div class="col-md-3">
                        <div class="form-group">
                            <div class="form-label">Tax <span class="text-danger">*</span></div>
                            <label class="custom-switch">
                                <input type="checkbox" name="tax" class="custom-switch-input particular-tax">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Switch if Tax</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Tax Percentage <span class="text-danger">*</span></label>
                            <input type="number" class="form-control particular-perc" name="tax_percentage" placeholder="Tax Percentage" readonly="true">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Tax <span class="text-danger">*</span></label>
                            <input type="number" class="form-control particular-tax-amt" name="tax_amount" placeholder="Tax" readonly="true">
                        </div>
                    </div> -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Total <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required particular-total" name="particular_total" placeholder="Total" readonly="true">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">&nbsp;</label>
                        <button class="btn btn-block btn-pill btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Particular</th>
                            <th>Amount</th>
                            <th>Qty.</th>
                            <th>UOM</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="particular-data"></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="row border border-dark mb-1">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Total <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required finalAmt" placeholder="Total" readonly="true">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Select Discount Type</label>
                            <select class="form-control Discount-Type">
                                <option value="" hidden="true">Select Discount Type</option>
                                <option value="">N/A</option>
                                <option value="Amount">Discount in Amount</option>
                                <option value="Percentage">Discount in Percentage</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Discount</label>
                            <input type="number" class="form-control required discount-per" placeholder="Discount in">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Net <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required finalNetAmt" placeholder="Net" readonly="true">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Rounded Net <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required finalRounded" placeholder="Rounded Net" readonly="true">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <button class="btn btn-pill btn-primary btn-block save-particular">Save</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <a href="#" target="_blank" class="btn btn-pill btn-info btn-block print-bill">Print</a>
                        </div>
                    </div>
                    <div class="col-md-3 switch-final" style="display: none;">
                        <div class="form-group">
                            <div class="form-label">Print Final Bill <span class="text-danger">*</span></div>
                            <label class="custom-switch">
                                <input type="checkbox" name="tax" class="custom-switch-input particular-tax">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Switch For Final Bill</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 Final-Bill" style="display: none;">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <a href="#" target="_blank" class="btn btn-pill btn-success btn-block print-bill final-bill">
                                Print Final Bill
                            </a>
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
    </div>
</div>