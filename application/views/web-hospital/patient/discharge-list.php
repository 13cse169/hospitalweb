<div class="page-header">
	<h4 class="page-title">HOSPITAL MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Patient Discharge List</a></li>
	</ol>
    <a href="<?=base_url('patient/all')?>" class="btn btn-pill btn-secondary">
        <i class="fas fa-arrow-left"></i> Go Back
    </a>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Patient Discharge List</strong></h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient ID</th>
                                <th>Patient Name</th>
                                <th>Reg. Date</th>
                                <th>Dis. Date</th>
                                <th>Payment Details</th>
                                <th class="disabled-sorting text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; foreach ($Patient as $key => $value) { if($value->status == 'Discharge') { ?>
                                <tr>
                                    <td><?=++$count?></td>
                                    <td><?=$value->code?></td>
                                    <td><?=$value->name?></td>
                                    <td><?=date('d-M-Y', strtotime($value->added_on))?></td>
                                    <td>
<?php
    $dt = $this->my_library->GetParam('h_treatment', 'discharge_on', array('patient_id' => $value->patient_id));
    echo date('d-M-Y', strtotime($dt));
?>                                        
                                    </td>
                                    <td>
                                        <a href="<?=base_url('patient/payment-details/'.$value->code)?>" class="badge badge-pill badge-primary">
                                            View Datils
                                        </a>
                                    </td>
                                    <td align="center">
                                        <!-- <a href="<?=base_url('patient/indoor/provisional-bill/'.$value->patient_id)?>" class="badge badge-pill badge-warning" target="_blank">
                                            Provisional Bill
                                        </a> -->
                                        <a href="<?=base_url('patient/indoor/final-bill/'.$value->patient_id)?>" class="badge badge-pill badge-info" target="_blank">
                                            Final Bill
                                        </a>
                                    </td>
                                </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</div>
