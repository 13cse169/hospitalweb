<div class="page-header">
	<h4 class="page-title">HOSPITAL MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Ward Master</a></li>
	</ol>
	<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">
		<i class="fas fa-folder-plus"></i>&nbsp;&nbsp;&nbsp;Add Ward
	</button>
</div>

<?php if (isset($UpdateData)) { ?>
<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <h4 class="m-t-0 header-title"><strong>Update Ward Details</strong></h4>
				<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-label">Select Department <span class="text-danger">*</span></label>
								<select class="form-control required" name="dept_id">
									<option value="" hidden="true">Select Department</option>
									<?php foreach ($Dept as $key) { ?>
										<option value="<?=$key->dept_id?>" <?=($UpdateData->dept_id == $key->dept_id)?'selected':''?>>[<?=$key->code?>] <?=$key->name?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-label">Enter Ward Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control required" name="name" placeholder="Enter Ward Name" value="<?=$UpdateData->name?>">
							</div>
						</div>
						<div class="col-md-4">
							<input type="hidden" name="id" value="<?=$this->uri->segment(3)?>">
							<label class="form-label">&nbsp;</label>
							<button type="submit" name="update" class="btn btn-outline-primary btn-block"><strong>Update Ward</strong></button>
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
                    <h4 class="m-t-0 header-title"><strong>Ward List</strong></h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ward Code</th>
                                <th>Ward Name</th>
                                <th>Dept. Code</th>
                                <th>Dept. Name</th>
                                <th>Date</th>
                                <!-- <th class="disabled-sorting text-center">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
							<?php $count = 0; foreach ($Ward as $key) { ?>
								<tr>
									<td><?=++$count?></td>
									<td><?=$key->code?></td>
									<td><?=$key->name?></td>
									<td><?=$this->my_library->GetParam('h_dept', 'code', array('dept_id' => $key->dept_id))?></td>
									<td><?=$this->my_library->GetParam('h_dept', 'name', array('dept_id' => $key->dept_id))?></td>
									<td><?=date('d-M-Y', strtotime($key->added_on))?></td>
									<!-- <td class="text-center">
										<a href="<?=base_url('master/ward/'.$key->ward_id)?>" class="btn btn-icon btn-primary">
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
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="example-Modal3">Add New Ward</h5>
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
					<select class="form-control required" name="dept_id">
						<option value="" hidden="true">Select Department</option>
						<?php foreach ($Dept as $key) { ?>
							<option value="<?=$key->dept_id?>">[<?=$key->code?>] <?=$key->name?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="form-label">Enter Ward Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control required" name="name" placeholder="Enter Ward Name">
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-outline-primary btn-block"><strong>Add Ward</strong></button>
	</div>
</form>				
		</div>
	</div>
</div>