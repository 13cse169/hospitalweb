<div class="page-header">
	<h4 class="page-title">PATHOLOGY MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Doctor Comission</a></li>
	</ol>
    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">
        <i class="fas fa-folder-plus"></i>&nbsp;&nbsp;&nbsp;Add Doctor Comission
    </button>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Doctor Comission List</strong></h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Department</th>
                                <th>Doctor Code</th>
                                <th>Doctor Name</th>
                                <th>Percentage</th>
                                <th>Date</th>
                                <th class="disabled-sorting text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; foreach ($Comm as $key) { ?>
                                <tr>
                                    <td><?=++$count?>.</td>
                                    <td><?=$this->my_library->GetParam('h_dept', 'name', array('dept_id' => $key->department))?></td>
                                    <td><?=$this->my_library->GetParam('h_doctor', 'code', array('doctor_id' => $key->doctor))?></td>
                                    <td><?=$this->my_library->GetParam('h_doctor', 'name', array('doctor_id' => $key->doctor))?></td>
                                    <td><?=$key->percentage?></td>
                                    <td><?=date('d-M-Y', strtotime($key->added_on))?></td>
                                    <td></td>
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
                <h5 class="modal-title" id="example-Modal3">Add Doctor Comission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Enter Department <span class="text-danger">*</span></label>
                    <select class="form-control required myDept" name="department">
                        <option value="" hidden="true">Select Department</option>
                        <?php foreach($Dept as $key => $value) { ?>
                            <option value="<?=$value->dept_id?>"><?=$value->name?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Enter Doctor <span class="text-danger">*</span></label>
                    <select class="form-control required myDept" name="doctor">
                        <option value="" hidden="true">Select Doctor</option>
                        <?php foreach($Doctor as $key => $value) { ?>
                            <option value="<?=$value->doctor_id?>"><?=$value->name?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Enter Percentage <span class="text-danger">*</span></label>
                    <input type="number" class="form-control required" name="percentage" placeholder="Enter Percentage">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary btn-block"><strong>Add Doctor Comission</strong></button>
    </div>
</form>             
        </div>
    </div>
</div>