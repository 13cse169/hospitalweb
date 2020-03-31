<div class="page-header">
	<h4 class="page-title">HOSPITAL MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Attendent Master</a></li>
	</ol>
	<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">
		<i class="fas fa-folder-plus"></i>&nbsp;&nbsp;&nbsp;Add Attendent
	</button>
</div>

<?php if (isset($UpdateData)) { ?>
<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <h4 class="m-t-0 header-title"><strong>Update Attendent Details</strong></h4>
				<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="form-label">Enter Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control required" name="name" placeholder="Enter Name" value="<?=$UpdateData->name?>">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="form-label">Select Shift <span class="text-danger">*</span></label>
								<select class="form-control required" name="shift_id">
									<option value="" hidden="true">Select Shift</option>
									<?php foreach ($AShift as $key) { ?>
										<option value="<?=$key->shift_id?>" <?=($UpdateData->shift_id == $key->shift_id)?'selected':''?>>[<?=$key->code?>] <?=$key->name?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="form-label">Enter Charge Per Day <span class="text-danger">*</span></label>
								<input type="number" class="form-control required" name="charge_pday" placeholder="Enter Charge Per Day" value="<?=$UpdateData->charge_pday?>">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="form-label">Enter Phone Number <span class="text-danger">*</span></label>
								<input type="number" class="form-control required" name="mobile" placeholder="Enter Phone Number" value="<?=$UpdateData->mobile?>">
							</div>
						</div>
						<div class="col-md-3">
			                <label class="form-label">Enter D.O.J <span class="text-danger">*</span></label>
							<div class="input-group">
			                    <div class="input-group-prepend">
			                        <div class="input-group-text">
			                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
			                        </div>
			                    </div><input type="text" name="doj" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY" value="<?=date('d-m-Y', strtotime($UpdateData->doj))?>">
			                </div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="form-label">Enter Address <span class="text-danger">*</span></label>
								<textarea name="address" class="form-control required" rows="1" placeholder="Enter Address"><?=$UpdateData->address?></textarea>
							</div>
						</div>
						<div class="col-md-3">
							<input type="hidden" name="id" value="<?=$this->uri->segment(3)?>">
							<label class="form-label">&nbsp;</label>
							<button type="submit" name="update" class="btn btn-outline-primary btn-block"><strong>Update Attendent</strong></button>
						</div>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Attendent List</strong></h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Charge</th>
                                <th>Mobile</th>
                                <th>DOJ</th>
                                <th>Dept. Name</th>
                                <th>Address</th>
                                <th>Date</th>
                                <!-- <th class="disabled-sorting text-center">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
							<?php $count = 0; foreach ($Attendent as $key) { ?>
								<tr>
									<td><?=++$count?></td>
									<td><?=$key->code?></td>
									<td><?=$key->name?></td>
									<td><?=$key->charge_pday?></td>
									<td><?=$key->mobile?></td>
									<td><?=date('d-M-Y', strtotime($key->doj))?></td>
									<td><?=$this->my_library->GetParam('h_attendent_shift', 'name', array('shift_id' => $key->shift_id))?></td>
									<td><?=$key->address?></td>
									<td><?=date('d-M-Y', strtotime($key->added_on))?></td>
									<!-- <td class="text-center">
										<a href="<?=base_url('master/attendent/'.$key->attendent_id)?>" class="btn btn-icon btn-primary">
											<i class="far fa-edit"></i>
										</a>
									</td> -->
								</tr>
							<?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</div>


<!-- Message Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="example-Modal3">Add Attendent</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Enter Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control required" name="name" placeholder="Enter Name">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Select Shift <span class="text-danger">*</span></label>
					<select class="form-control required" name="shift_id">
						<option value="" hidden="true">Select Shift</option>
						<?php foreach ($AShift as $key) { ?>
							<option value="<?=$key->shift_id?>">[<?=$key->code?>] <?=$key->name?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Enter Charge Per Day <span class="text-danger">*</span></label>
					<input type="number" class="form-control required" name="charge_pday" placeholder="Enter Charge Per Day">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Enter Phone Number <span class="text-danger">*</span></label>
					<input type="number" class="form-control required" name="mobile" placeholder="Enter Phone Number">
				</div>
			</div>
			<div class="col-md-6">
                <label class="form-label">Enter D.O.J <span class="text-danger">*</span></label>
				<div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                        </div>
                    </div><input type="text" name="doj" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY">
                </div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="form-label">Enter Address <span class="text-danger">*</span></label>
					<textarea name="address" class="form-control required" rows="1" placeholder="Enter Address"></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-outline-primary btn-block"><strong>Add Attendent</strong></button>
	</div>
</form>				
		</div>
	</div>
</div>