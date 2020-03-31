<div class="page-header">
	<h4 class="page-title">HOSPITAL MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Patient List</a></li>
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
                    <h4 class="m-t-0 header-title"><strong>Patient List</strong></h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient ID</th>
                                <th>Patient Name</th>
                                <th>Total Amt.</th>
                                <th>Paid Amt.</th>
                                <th>Reg. Date</th>
                                <th>Collected By</th>
                                <th>Payment Details</th>
                                <!-- <th class="disabled-sorting text-center">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; foreach ($Patient as $key => $value) { 
                                $tID = $this->my_library->GetParam('h_treatment', 'treatment_id', array('patient_id' => $value->patient_id)); ?>
                                <tr>
                                    <td><?=++$count?></td>
                                    <td><?=$value->code?></td>
                                    <td><?=$value->name?></td>
                                    <td>
                                        <?=number_format((float)$this->my_library->GetAmount($value->patient_id), 2, '.', ''); ?>
                                    </td>
                                    <td>
                                        <?=number_format((float)$this->M_Hospital->GetSum('h_payment', 'pay_amt', array('treatment_id' => $tID)), 2, '.', ''); ?>                                        
                                    </td>
                                    <td><?=date('d-M-Y', strtotime($value->added_on))?></td>
                                    <td>
                                        <?php
                                            $User = $this->my_library->GetParam('h_payment', 'pay_rcv', array('pay_type' => 'Advance','treatment_id' => $tID));
                                            if ($User) {
                                                echo $this->my_library->GetParam('users', 'name', array('id' => $User));
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?=base_url('patient/payment-details/'.$value->code)?>" class="badge badge-pill badge-primary">
                                            View Datils
                                        </a>
                                    </td>
                                    <!-- <td></td> -->
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</div>
