<div class="page-header">
	<h4 class="page-title">HOSPITAL MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Attendent Shift Master</a></li>
	</ol>
	<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">
		<i class="fas fa-folder-plus"></i>&nbsp;&nbsp;&nbsp;Add Attendent Shift
	</button>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Attendent Shift List</strong></h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Shift Code</th>
                                <th>Shift Name</th>
                                <th>Shift From</th>
                                <th>Shift To</th>
                                <th>Date</th>
                                <!-- <th class="disabled-sorting text-center">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
							<?php $count = 0; foreach ($AShift as $key) { ?>
								<tr>
									<td><?=++$count?></td>
									<td><?=$key->code?></td>
									<td><?=$key->name?></td>
									<td><?=$key->shift_from?></td>
									<td><?=$key->shift_to?></td>
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
				<h5 class="modal-title" id="example-Modal3">Add Attendent Shift</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="form-label">Enter Shift Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control required" name="name" placeholder="Enter Shift Name">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="form-label">Enter Shift Time <span class="text-danger">*</span></label>
					<div class="row">
						<div class="col-md-5">
							<input type="time" class="form-control required" name="shift_from" placeholder="Enter Shift From">
						</div>
						<div class="col-md-2 text-center"><strong>To</strong></div>
						<div class="col-md-5">
							<input type="time" class="form-control required" name="shift_to" placeholder="Enter Shift To">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-outline-primary btn-block"><strong>Add Attendent Shift</strong></button>
	</div>
</form>				
		</div>
	</div>
</div>