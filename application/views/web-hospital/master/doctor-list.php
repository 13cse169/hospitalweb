<div class="page-header">
	<h4 class="page-title">HOSPITAL MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Doctor Master</a></li>
	</ol>
	<a href="<?=base_url('master/doctor/add')?>" class="btn btn-outline-primary">
		<i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;Add Doctor
	</a>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Doctor List</strong></h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Doctor</th>
                                <th>Code</th>
                                <th>email</th>
                                <th>Mobile</th>
                                <th>Dept.</th>
                                <th>Indoor Fee</th>
                                <th>Outdoor Fee</th>
                                <th>Date</th>
                                <!-- <th class="disabled-sorting text-center">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
							<?php $count = 0; foreach ($Doctor as $key) { ?>
								<tr>
									<td><?=++$count?></td>
									<td>
										<!-- <span class="avatar avatar-md bradius" style="background-image: url(<?=base_url('assets/img/doctors/'.$key->photo)?>)"></span> -->
										<?=$key->name?>
									</td>
									<td><?=$key->code?></td>
									<td><?=$key->email?></td>
									<td><?=$key->phone?></td>
                                    <td><?=$key->dept_id?></td>
									<!-- <td><?=$this->my_library->GetParam('h_dept', 'name', array('dept_id' => $key->dept_id))?></td> -->
									<td><?=$key->indoor_fee?></td>
									<td><?=$key->outdoor_fee?></td>
									<td><?=date('d-M-Y', strtotime($key->added_on))?></td>
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
