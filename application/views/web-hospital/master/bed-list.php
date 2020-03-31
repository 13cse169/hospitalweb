<div class="page-header">
	<h4 class="page-title">HOSPITAL MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Bed Master</a></li>
	</ol>
	<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">
		<i class="fas fa-folder-plus"></i>&nbsp;&nbsp;&nbsp;Add Bed
	</button>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Bed List</strong></h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bed Code</th>
                                <th>Bed Name</th>
                                <th>Bed Cost</th>
                                <th>Dept. Name</th>
                                <th>Ward Name</th>
                                <th>Date</th>
                                <!-- <th class="disabled-sorting text-center">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
							<?php $count = 0; foreach ($Bed as $key) { ?>
								<tr>
									<td><?=++$count?></td>
									<td><?=$key->code?></td>
									<td><?=$key->name?></td>
									<td><?=$key->cost?></td>
									<td><?=$this->my_library->GetParam('h_dept', 'name', array('dept_id' => $key->dept_id))?></td>
									<td><?=$this->my_library->GetParam('h_ward', 'name', array('ward_id' => $key->ward_id))?></td>
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


<!-- Message Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="example-Modal3">Add New Bed</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="form-label">Select Department <span class="text-danger">*</span></label>
					<select class="form-control required myDept" name="dept_id">
						<option value="" hidden="true">Select Department</option>
						<?php foreach ($Dept as $key) { ?>
							<option value="<?=$key->dept_id?>">[<?=$key->code?>] <?=$key->name?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="form-label">Select Ward <span class="text-danger">*</span></label>
					<select class="form-control required myWard" name="ward_id">
						<option value="" hidden="true">Select Ward</option>
						<option value="" disabled="true">Select Department First.</option>
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="form-label">Enter Bed Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control required" name="name" placeholder="Enter Bed Name">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="form-label">Enter Bed Cost <span class="text-danger">*</span></label>
					<input type="text" class="form-control required" name="cost" placeholder="Enter Bed Cost">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="form-label">Enter Additional Notes <span class="text-danger">*</span></label>
					<textarea name="notes" class="form-control required" rows="1" placeholder="Enter Additional Notes"></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-outline-primary btn-block"><strong>Add Bed</strong></button>
	</div>
</form>				
		</div>
	</div>
</div>