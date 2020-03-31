<div class="page-header">
	<h4 class="page-title">HOSPITAL MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Emergency Patient List</a></li>
	</ol>
    <a href="<?=base_url('patient/emergency')?>" class="btn btn-pill btn-secondary">
        <i class="fas fa-arrow-left"></i> Go Back
    </a>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Emergency Patient List</strong></h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bill. No</th>
                                <th>Patient ID</th>
                                <th>Patient Name</th>   
                                <th>Appointment</th>
                                <th>Amount</th>
                                <th>Patient Type</th>
                                <th>Collected By</th>
                                <th>Reg. Date</th>
                                <th class="disabled-sorting text-center">Action</th>
                              </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; foreach ($Patient as $key => $value) { ?>
                                <tr>
                                    <td><?=++$count?></td>
                                    <td><?='EM'.sprintf('%04d', $value->patient_id)?></td>
                                    <td><?=$value->code?></td>
                                    <td><?=$value->name?></td>
                                    <td>
                                        <?php
                                            if($value->doctor_id == "N/A") {
                                                echo "N/A";
                                               }else {
                                                $particular = explode(',', $value->doctor_id);
                                                foreach ($particular as $key => $value1)
                                                    $particularArray = $this->my_library->GetParam('h_doctor', 'name', array('doctor_id' => $value1));
                                                echo $particularArray;
                                               }
                                          ?>
                                    </td>
                                    <td><?=$value->admissionfee?></td>
                                    <td><?=$value->patient_type?></td>
                                    <td>
                                        <?php
                                            $particular1 = explode(',', $value->collectedby);
                                            foreach ($particular1 as $key => $value1)
                                                $particularArray1 = $this->my_library->GetParam('users', 'name', array('id' => $value1));

                                            if($value->collectedby == '') {
                                                echo "NA";
                                            }else {
                                               echo $particularArray1;
                                            }
                                        ?>
                                            
                                    </td>
                                    <td><?=$this->my_library->GetParam('h_treatment', 'allotment_date', array('patient_id' => $value->patient_id))?></td>
                                    <td>
                                     <a href="<?=base_url('outdoor/ticket1/'.$value->patient_id)?>" class="btn btn-sm btn-outline-primary">
                                       <i class="fas fa-print"></i></a>
                                     <a href="<?=base_url('outdoor/update1/'.$value->patient_id)?>" class="btn btn-sm btn-outline-info">
                                       <i class="far fa-edit"></i></a>
                                     
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</div>
