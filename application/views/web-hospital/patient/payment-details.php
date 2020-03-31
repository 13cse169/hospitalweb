<div class="page-header">
	<h4 class="page-title">HOSPITAL MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Patient Payment</a></li>
	</ol>
    <a href="<?=base_url('patient/list')?>" class="btn btn-pill btn-secondary">
        <i class="fas fa-arrow-left"></i> Go Back
    </a>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title">
                        <strong>Payment Details</strong>
                        <a href="<?=base_url('patient/payment/report/'.$this->uri->segment(3))?>" target="_blank" class="btn btn-sm btn-outline-primary">
                            <strong>Print All Bill</strong> <i class="fas fa-print"></i>
                        </a>
                    </h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient ID</th>
                                <th>Patient Name</th>
                                <th>Purpose</th>
                                <th class="text-right">Amount</th>
                                <th>Mode</th>
                                <th>Date</th>
                                <th class="disabled-sorting text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php $count = $total = 0; foreach ($Payment as $key => $value) { $total += $value->pay_amt; ?>
    <tr>
        <td><?=++$count?>.</td>
        <td><?=$value->patient_code?></td>
        <td><?=$value->patient_name?></td>
        <td><?=$value->purpose?></td>
        <td align="right"><?=number_format((float)$value->pay_amt, 2, '.', '')?></td>
        <td><?=$value->pay_mode?></td>
        <td><?=date('d-M-Y', strtotime($value->pay_date))?></td>
        <td class="text-center">
            <a href="<?=base_url('patient/payment/invoice/'.$value->pay_id)?>" target="_blank" class="btn btn-outline-primary">
                <i class="fas fa-print"></i>
            </a>
        </td>
    </tr>
<?php } ?>  
<tr class="text-white bg-info">
    <td><?=++$count?>.</td>
    <td></td>
    <td>Total Paid Amount</td>
    <td align="right"><?=number_format((float)$total, 2, '.', '')?></td>
    <td></td>
    <td></td>
    <td>Total Amount</td>
    <td align="center"><?=$grandTotal?></td>
</tr>                         
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</div>
