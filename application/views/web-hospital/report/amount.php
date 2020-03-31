<div class="page-header">
	<h4 class="page-title">HOSPITAL MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Payment History</a></li>
	</ol>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <h4 class="m-t-0 header-title"><strong>Payment History</strong></h4>
            <div class="col-12">

<form action="" method="post" accept-charset="utf-8" id="getAmountReport">
    <div class="row border border-primary rounded mb-4">
        <div class="col-md-4">
            <label class="form-label">From Date <span class="text-danger">*</span></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                    </div>
                </div><input type="text" name="f_date" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY">
            </div>
        </div>
        <div class="col-md-4">
            <label class="form-label">To Date <span class="text-danger">*</span></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                    </div>
                </div><input type="text" name="t_date" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY">
            </div>
        </div>
        <div class="col-md-4">
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
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Patient Code</th>
                                <th>Patient Name</th>
                                <th>Mode</th>
                                <th>Received By</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="GetReport">
                            
<?php $total = $count = 0; foreach ($amount as $key => $value) { $total += $value->pay_amt; ?>
    <tr>
        <td><?=++$count?>.</td>
        <td><?=date('d-M-Y', strtotime($value->pay_date))?></td>
        <td><?=$value->patient_code?></td>
        <td><?=$value->patient_name?></td>
        <td><?=$value->pay_mode?></td>
        <td>--</td>
        <td align="right"><?=number_format((float)$value->pay_amt, 2, '.', '')?></td>
    </tr>
<?php } ?>

<tr class="bg-info text-white">
    <td><?=++$count?>.</td>
    <td></td><td></td>
    <td><strong>Total Paid Amount</strong></td>
    <td></td><td></td>
    <td align="right"><?=number_format((float)$total, 2, '.', '')?></td>
</tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</div>
