<div class="page-header">
    <h4 class="page-title">PATIENT ADMISSION</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Patient Admission</a></li>
    </ol>
    <a href="<?=base_url('patient/list')?>" class="btn btn-outline-primary">
        <i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;Patient List
    </a>
</div>

<!-- Example For -->

<div class="card">
    <div class="row">
        <div class="card-body">
                    
<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="modal-body">

        <div class="row border border-primary rounded mb-3 account-details-box" style="display: none;">

            <div class="col-md-12">
                <div class="border border-secondary border-left-0 border-right-0 border-top-0 text-center mb-4">
                    <h4 class="font-weight-bold">Patient Account Details</h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Total Amount</label>
                    <input type="text" class="form-control accTotal" readonly="true">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Paid Amount</label>
                    <input type="text" class="form-control accPaid" readonly="true">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Due Amount</label>
                    <input type="text" class="form-control accDue" readonly="true">
                </div>
            </div>

        </div>

        <div class="border border-primary rounded mb-3 patient-details-box">
            <div class="row">

                <div class="col-md-12">
                    <div class="border border-secondary border-left-0 border-right-0 border-top-0 text-center mb-4">
                        <h4 class="font-weight-bold">Patient Details</h4>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label"> Enter Patient Code</label>
                        <select class="form-control select2-show-search required patient-code" name="patient_id" data-placeholder="Select Patient Code">
                            <option value="New">New Patient</option>
                            <?php foreach ($Patient as $key => $value) { 
                                if(($value->status != 'Discharge') && ($value->patient_type != 'Emergency')) { ?>
                                <option value="<?=$value->patient_id?>"><?=$value->code?> - [<?=$value->name?>]</option>
                            <?php } } ?>
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
                        <label class="form-label">Enter Age <span class="text-danger">*</span></label>
                        <input type="number" class="form-control required" name="age" min="1" placeholder="Enter Age">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Day/Month/Year <span class="text-danger">*</span></label>
                        <select class="form-control required" name="age2">
                            <option value="" hidden="true">Day/Month/Year</option>
                            <option value="Day">Day</option>
                            <!-- <option value="Week">Week</option> -->
                            <option value="Month">Month</option>
                            <option value="Year">Year</option>
                        </select>
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
                        <label class="form-label">Enter Patient Type <span class="text-danger">*</span></label>
                        <select class="form-control required PatientType" name="patient_cat">
                            <option value="" hidden="true">Select Patient Type</option>
                            <option value="B">Beneficiaries</option>
                            <option value="NB">Non-Beneficiaries</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Bed Type</label>
                        <select class="form-control required SelectCabin" name="bed_type">
                            <option value="" hidden="true">Select Bed Type</option>
                            <option value="General Bed">General Bed</option>
                            <option value="General Cabin">General Cabin</option>
                            <option value="Cabin with A/c">Cabin with A/C</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Gender</label>
                        <select class="form-control" name="gender">
                            <option value="" hidden="true">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Nationality</label>
                        <select class="form-control" name="nationality">
                            <option value="" hidden="true">Select Nationality</option>
                            <option value="Indian" selected="true">Indian</option>
                            <!-- <option value="Bangladeshi">Bangladeshi</option>
                            <option value="Nepali">Nepali</option>
                            <option value="Bhutani">Bhutani</option> -->
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Religion</label>
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Blood Group</label>
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
                            <option value="N/A">N/A</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Marital Status</label>
                        <select class="form-control" name="material_status">
                            <option value="" hidden="true">Select Marital Status</option>
                            <option value="Married">Married</option>
                            <option value="Single">Single</option>
                            <option value="Separated">Separated</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Divorced">Divorced</option>
                            <option value="N/A">N/A</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Contact No.</label>
                        <input type="number" class="form-control phone-true" name="phone" placeholder="Enter Contact No. (10 Digits)">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Relative Name</label>
                        <input type="text" class="form-control" name="relative" placeholder="Enter Relative Name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Relation</label>
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
                        <label class="form-label">Enter Address</label>
                        <textarea name="address" class="form-control" rows="1" placeholder="Enter Address"></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Allotment Date</label>
                        <input type="text" name="allotment_date" value="<?=date('d-m-Y')?>" class="form-control fc-datepicker" placeholder="DD-MM-YYYY">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Allotment Time</label>
                        <input type="time" name="allotment_time" value="<?=date('H:i')?>" class="form-control">
                    </div>
                </div>

            </div>
            <div class="row AdvancePaymentRow">

                <div class="col-md-12">
                    <div class="border border-secondary border-left-0 border-right-0 text-center mb-4">
                        <h4 class="font-weight-bold AdvanceTitle">Advance Payment</h4>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Payment Received by</label>
                    <div class="input-group">
                        <input type="text" class="form-control" value="<?=$_SESSION['name']?>" readonly="true">
                        <input type="hidden" name="adv_pay_rcv" value="<?=$_SESSION['userID']?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Purpose</label>
                        <select class="form-control" name="adv_purpose">
                            <option value="" hidden="true">Select Purpose</option>
                            <option value="Advance Payment IPD" selected="true">Advance Payment IPD</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Payment Mode</label>
                        <select class="form-control adv-pay-mode" name="adv_pay_mode">
                            <option value="" hidden="true">Select Payment Mode</option>
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Demand Draft">Demand Draft</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Payment Date</label>
                    <div class="input-group">
                        <input type="text" name="adv_pay_date" class="form-control fc-datepicker" placeholder="DD-MM-YYYY" value="<?=date('d-m-Y')?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Payment Amount</label>
                        <input type="number" class="form-control" placeholder="Payment Amount" name="adv_pay_amt" min="0">
                    </div>
                </div>

                <div class="col-md-12 adv-details-cheque" style="display: none;">
                    <div class="border border-secondary border-left-0 border-right-0 text-center">
                        <h4 class="font-weight-bold">Cheque Details</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Cheque Number</label>
                                <input type="text" class="form-control" name="adv_cheque_num" placeholder="Enter Cheque Number">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Bank Name</label>
                                <input type="text" class="form-control" name="adv_ch_bank_name" placeholder="Enter Bank Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Issued Date</label>
                            <div class="input-group">
                                <input type="text" name="adv_ch_issued_date" class="form-control fc-datepicker" placeholder="DD-MM-YYYY">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 adv-details-dd" style="display: none;">
                    <div class="border border-secondary border-left-0 border-right-0 text-center">
                        <h4 class="font-weight-bold">Demand Draft Details</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">DD Number</label>
                                <input type="text" class="form-control" name="adv_dd_num" placeholder="Enter DD Number">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Bank Name</label>
                                <input type="text" class="form-control" name="adv_dd_bank_name" placeholder="Enter Bank Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Issued Date</label>
                            <div class="input-group">
                                <input type="text" name="adv_dd_issued_date" class="form-control fc-datepicker" placeholder="DD-MM-YYYY">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Payable At</label>
                                <input type="text" class="form-control" name="adv_dd_payable_at" placeholder="Enter Payable At">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- <div class="border border-primary rounded mb-3 facility-charges-box RegisteredPatient"> -->
        <div class="border border-primary rounded mb-3 facility-charges-box RegisteredPatient" style="display: none;">
            <div class="row BasicCharges">

                <div class="col-md-12">
                    <div class="border border-secondary border-left-0 border-right-0 border-top-0 text-center mb-4">
                        <h4 class="font-weight-bold">Basic Charges</h4>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Admission Fee <span class="text-danger">*</span></label>
                        <input type="number" name="admissionfee" class="form-control required AdmissionFee">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Enter Bed Rent (General) <span class="text-danger">*</span></label>
                        <input type="number" name="bedrent" class="form-control required BedRent">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Number of Days <span class="text-danger">*</span></label>
                        <input type="number" name="staydays" value="1" class="form-control required StayDays">
                    </div>
                </div>

            </div>
            <div class="row FacilityChargesRow">
            
                <div class="col-md-12">
                    <div class="border border-secondary border-left-0 border-right-0 text-center mb-4 mt-4">
                        <h4 class="font-weight-bold">Facility Charges</h4>
                    </div>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Facility Charges Date</label>
                    <div class="input-group">
                        <input type="text" name="FacilityDate" class="form-control fc-datepicker FacilityDate" placeholder="DD-MM-YYYY" value="<?=date('d-m-Y')?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">Enter Category <span class="text-danger">*</span></label>
                        <select class="form-control tret-faci-cat" data-placeholder="Select Category">
                            <option value="" hidden="true">Select Category</option>
                            <?php
                                $CatList = $this->my_library->GetTable('facility_catg', 'category', 'ASC');
                                foreach ($CatList as $key => $value) {
                                    echo '<option value="'.$value->cat_id.'">'.$value->category.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Enter Sub Category <span class="text-danger">*</span></label>
                        <select class="form-control tret-faci-subcat" data-placeholder="Select Sub Category">
                            <option value="" hidden="true">Select Sub-Category</option>
                            <option value="" disabled="true">Select Category First</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Operative Surgeon Doctor <span class="text-danger">*</span></label>
                        <select class="form-control OperativeSurgeon" name="OperativeSurgeon">
                            <option value="" hidden="true">Select Operative Surgeon Doctor</option>
                            <option value="">N/A</option>
                            <?php foreach ($Doctor as $key => $value) { ?>
                                <option value="<?=$value->doctor_id?>"><?=$value->name?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <button type="button" class="btn btn-block btn-primary particular-add">Add Facility</button>
                </div>

                <div class="col-md-12 myFacility"></div>

                <div class="col-md-12">
                    <div class="border border-secondary border-left-0 border-right-0 text-center mb-4 mt-4">
                        <h4 class="font-weight-bold">Other Facility</h4>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Select Other Facility <span class="text-danger">*</span></label>
                        <select class="form-control OtherFacility">
                            <option value="" hidden="true">Select Other Facility</option>
                            <option value="G00031">AMBULANCE</option>   
                            <option value="G00033">EMERGENCY FACILITY</option> 
                            <!-- <option value="G00029">BIOMETRY</option> -->
                            <option value="G00003">E.C.G</option> 
                            <option value="G00015">ECHO</option>
                            <!-- <option value="G00025">INJECTION CHARGE(ORTHOPAEDIC)</option>   -->
                            <option value="Pathology">PATHOLOGY TEST</option>
                            <!-- <option value="G00022">PLASTER CHARGE</option>  -->
                            <!-- <option value="G00024">TOOTH EXTRACTION</option> -->
                            <option value="G00005">U.S.G</option>    
                            <option value="G00004">X-RAY</option> 
                        </select>
                    </div>
                </div>

                <div class="col-md-4 OtherFacilityCol4"></div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-block btn-pill btn-primary AddOtherFacility">Add Other Facility</button>
                    </div>
                </div>
            </div>

            <div class="OtherPathologyDiv"></div>
            
            <div class="row FacilityChargesRow">

                <div class="col-md-12">
                    <div class="border border-secondary border-left-0 border-right-0 text-center mb-4 mt-2">
                        <h4 class="font-weight-bold UpdateFacility">Facility Details</h4>
                    </div>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Particular</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="particular-data"></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="row border border-primary rounded mb-3 PaymentDetailsRow RegisteredPatient" style="display: none;">

            <div class="col-md-12">
                <div class="border border-secondary border-left-0 border-right-0 border-top-0 text-center mb-4">
                    <h4 class="font-weight-bold">Payment Details</h4>
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label">Payment Received by</label>
                <div class="input-group">
                    <!-- <input type="text" name="pay_rcv" class="form-control" placeholder="Payment Received by"> -->
                    <select class="form-control pmt-pay-mode" name="pay_rcv">
                        <option value="" hidden="true">Select User</option>
                        <?php foreach ($Users as $key => $value) { ?>
                            <option value="<?=$value->id?>" <?=$value->name?> <?=($value->id == $_SESSION['userID']) ? 'selected' : 'disabled'?>>
                                <?=$value->name?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Purpose</label>
                    <select class="form-control" name="purpose">
                        <option value="" hidden="true">Select Purpose</option>
                        <option value="Payment IPD">Payment IPD</option>
                        <option value="Final IPD">Final Payment IPD</option>
                        <!-- <option value="Miscellaneous IPD">Miscellaneous IPD</option> -->
                        <!-- <option value="Pathology IPD">Pathology IPD</option> -->
                    </select>
                </div>
            </div>

            <!-- <div class="col-md-4">
                <label class="form-label">Voucher Number</label>
                <div class="input-group">
                    <input type="text" name="voucher_no" class="form-control" placeholder="Voucher Number">
                </div>
            </div> -->
                    
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Payment Mode</label>
                    <select class="form-control pmt-pay-mode" name="pay_mode">
                        <option value="" hidden="true">Select Payment Mode</option>
                        <option value="Cash">Cash</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Demand Draft">Demand Draft</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label">Payment Date</label>
                <div class="input-group">
                    <input type="text" name="pay_date" class="form-control fc-datepicker" placeholder="DD-MM-YYYY" value="<?=date('d-m-Y')?>">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Payment Amount</label>
                    <input type="number" class="form-control payment-amount" placeholder="Payment Amount" name="pay_amt" min="0">
                </div>
            </div>

            <div class="col-md-12 pay-details-cheque" style="display: none;">
                <div class="border border-secondary border-left-0 border-right-0 text-center">
                    <h4 class="font-weight-bold">Cheque Details</h4>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Cheque Number</label>
                            <input type="text" class="form-control" name="cheque_num" placeholder="Enter Cheque Number">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Bank Name</label>
                            <input type="text" class="form-control" name="ch_bank_name" placeholder="Enter Bank Name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Issued Date</label>
                        <div class="input-group">
                            <input type="text" name="ch_issued_date" class="form-control fc-datepicker" placeholder="DD-MM-YYYY">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 pay-details-dd" style="display: none;">
                <div class="border border-secondary border-left-0 border-right-0 text-center">
                    <h4 class="font-weight-bold">Demand Draft Details</h4>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">DD Number</label>
                            <input type="text" class="form-control" name="dd_num" placeholder="Enter DD Number">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Bank Name</label>
                            <input type="text" class="form-control" name="dd_bank_name" placeholder="Enter Bank Name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Issued Date</label>
                        <div class="input-group">
                            <input type="text" name="dd_issued_date" class="form-control fc-datepicker" placeholder="DD-MM-YYYY">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Payable At</label>
                            <input type="text" class="form-control" name="dd_payable_at" placeholder="Enter Payable At">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary btn-block">Save & Continue</button>        
        </div>
        <div class="col-md-4">
            <a href="#" target="_blank" class="btn btn-success btn-block print-bill">Print</a>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-info btn-block FinalSubmit">Final Submit</button>
        </div>
    </div>
    
    


</form>

        </div>                
    </div>
</div>


<div class="modal fade" id="FinalSubmit" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary">Discharge Patient ( <u>Final Submit</u> )</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="DischargeForm">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="disPatient" name="pid">
                    <div class="row border border-primary rounded mb-3 account-details-box">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Total Amount</label>
                                <input type="text" class="form-control accTotal" readonly="true">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Paid Amount</label>
                                <input type="text" class="form-control accPaid" readonly="true">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Due Amount</label>
                                <input type="text" class="form-control accDue" readonly="true">
                            </div>
                        </div>

                    </div>
                    <div class="row border border-primary rounded mb-3 account-details-box">

                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Discount / Refund</label>
                                <input type="number" class="form-control required disVal" name="disval" placeholder="Discount Value" value="00" readonly="true">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Select Remarks</label>
                                <select class="form-control" name="remarks">
                                    <option value="" hidden="true">Select Remarks</option>
                                    <option value="N/A">N/A</option>
                                    <option value="Order by Chairman">Order by Chairman</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row border border-warning rounded mb-3 afterDis" style="display: none;">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Total Amount</label>
                                <input type="number" class="form-control accTotal accDisTotal">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Paid Amount</label>
                                <input type="number" class="form-control accPaid">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Due Amount</label>
                                <input type="number" class="form-control accDue accDisDue">
                            </div>
                        </div>

                    </div>
                        
                </div>
                <div class="modal-footer"></div>
            </form>
        </div>
    </div>
</div>