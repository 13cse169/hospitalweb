<div class="page-header">
	<h4 class="page-title">HOSPITAL MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Patient List</a></li>
	</ol>
    <a href="<?=base_url('outdoor')?>" class="btn btn-pill btn-secondary">
        <i class="fas fa-arrow-left"></i> Go Back
    </a>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Outdoor Patient List</strong></h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="outdoor_treat">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bill No.</th>
                                <th>Patient</th>
                                <th>Category</th>
                                <th>Appointment</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Collected By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    $count = 0;
    foreach ($patient as $key => $value) { ?>
        <tr id="<?=$value->treat_id?>">
            <td><?=++$count?>.</td>
            <td><?='OP'.sprintf('%04d', $value->treat_id)?></td>
            <td><?=$value->name?></td>
            <td>
                <?php
                    $category = explode(',', $value->category);
                    foreach ($category as $key => $value1)
                        $categoryArray[] = $this->my_library->GetParam('outdoor_facility_group', 'group_name', array('g_code' => $value1));
                    echo implode(', ', $categoryArray);
                ?>
            </td>
            <td>
                <?php
                    $particular = explode(',', $value->particular);
                    foreach ($particular as $key => $value1)
                        $particularArray[] = $this->my_library->GetParam('outdoor_facility', 'facilit_name', array('od_facilit_id' => $value1));
                    echo implode(', ', $particularArray);
                ?>
            </td>
            <td><?=$value->amount?></td>
            <td><?=date('d-M-y', strtotime($value->app_date))?></td>
            <td>
                <?php
                    $User = $this->my_library->GetParam('outdoor_treat', 'collectedby', array('treat_id' => $value->treat_id));
                    if ($User) {
                        echo $this->my_library->GetParam('users', 'name', array('id' => $User));
                    }
                ?>
            </td>
            <td>
                <a href="<?=base_url('outdoor/ticket/'.$value->treat_id)?>" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-print"></i>
                </a>
                <a href="<?=base_url('outdoor/update/'.$value->treat_id)?>" class="btn btn-sm btn-outline-info">
                    <i class="far fa-edit"></i>
                </a>
                <a href="#" class="btn btn-icon btn-sm btn-danger" data="treat_id"><i class="far fa-times-circle"></i></a>
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
