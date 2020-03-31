<div class="page-header">
    <h4 class="page-title">INDOOR PATIENT</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Payment Receive</a></li>
    </ol>
</div>


<div class="card">
    <div class="card-header">
        <h3 class="card-title">Patient Payment</h3>
    </div>
    <div class="card-body">
        <!-- Accordion begin -->
        <ul class="demo-accordion accordionjs m-0" data-active-index="false">
            <li>
                <div><h3>Payment Receive</h3></div>
                <div>
<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" id="payment-receive-form">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label"> Enter Patient ID / Name</label>
                <select class="form-control select2-show-search required payment-receive" name="treatment_id" data-placeholder="Select Patient ID">
                    <option value="" hidden="true"></option>
                    <?php foreach ($Patient as $key => $value) { 
                        if ($value->discharge_on == '') {
                            $Details = $this->my_library->GetRow('h_patient', array('patient_id' => $value->patient_id)); ?>
                            <option value="<?=$value->treatment_id?>"><?=$Details->code?> - [<?=$Details->name?>]</option>
                    <?php } } ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label">Code <span class="text-danger">*</span></label>
                <input type="text" class="form-control required" name="patient_code" placeholder="Code" readonly="true">
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
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control required" name="patient_name" placeholder="Name" readonly="true">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label">Bill No. <span class="text-danger">*</span></label>
                <input type="text" class="form-control required" name="bill_no" placeholder="Bill No." readonly="true">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label">Total Amount <span class="text-danger">*</span></label>
                <input type="text" class="form-control required total_amt" name="total_amt" placeholder="Total Paid" readonly="true">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label">Total Paid <span class="text-danger">*</span></label>
                <input type="text" class="form-control required total_paid" name="total_paid" placeholder="Total Paid" readonly="true">
            </div>
        </div>
        <!-- <div class="col-md-4">
            <label class="form-label">Payment Date <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="pay_date" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY" value="<?=date('d-m-Y')?>">
            </div>
        </div> -->
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label">Payment Amount <span class="text-danger">*</span></label>
                <input type="number" class="form-control required payment-amount" placeholder="Payment Amount" name="pay_amt" min="0">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label">Voucher Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control required" name="voucher" placeholder="Voucher Number">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label">Remarks <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="remarks" placeholder="Remarks">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label">&nbsp;</label>
                <button class="btn btn-pill btn-info btn-block">Add</button>
            </div>
        </div>
    </div>
</form>                    
                </div>
            </li>
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Payment Received List</h3>
    </div>
    <div class=" card-body">
        <div class="table-responsive">
            <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                data-table="sales_user">
                <thead>
                    <tr>
                        <!-- <th>Reciept ID</th> -->
                        <th>Patient</th>
                        <th>P-Code</th>
                        <th>Admission ID</th>
                        <th>Amount</th>
                        <th>Pay Date</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach ($Payment as $key => $value) { ?>
    <tr>
        <td><?=$value->patient_name?></td>
        <td><?=$value->patient_code?></td>
        <td><?=$value->admission_id?></td>
        <td><?=$value->pay_amt?></td>
        <td><?=date('d-M-Y H:i:s', strtotime($value->added_on))?></td>
        <td><?=$value->remarks?></td>
    </tr>
<?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
