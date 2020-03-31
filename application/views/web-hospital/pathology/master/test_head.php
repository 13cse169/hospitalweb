<div class="page-header">
	<h4 class="page-title">PATHOLOGY MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Test Head</a></li>
	</ol>
    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">
        <i class="fas fa-folder-plus"></i>&nbsp;&nbsp;&nbsp;Add Test Head
    </button>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Test Head List</strong></h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Test Department</th>
                                <th>Test Head Code</th>
                                <th>Test Head Name</th>
                                <th>Date</th>
                                <th class="disabled-sorting text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; foreach ($Head as $key) { ?>
                                <tr>
                                    <td><?=++$count?>.</td>
                                    <td><?=$this->my_library->GetParam('h_dept', 'name', array('dept_id' => $key->department))?></td>
                                    <td><?=$key->code?></td>
                                    <td><?=$key->name?></td>
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
                <h5 class="modal-title" id="example-Modal3">Add Test Head</h5>
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
                    <label class="form-label">Enter Test Head Code <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="code" placeholder="Enter Test Head Code">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Enter Test Head Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="name" placeholder="Enter Test Head Name">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary btn-block"><strong>Add Test Head</strong></button>
    </div>
</form>             
        </div>
    </div>
</div>