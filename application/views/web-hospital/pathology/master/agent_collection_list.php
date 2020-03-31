<div class="page-header">
	<h4 class="page-title">PATHOLOGY MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Agent Collection</a></li>
	</ol>
    <a href="<?=base_url('pathology/master/agent-collection')?>" class="btn btn-outline-primary">
        <i class="fas fa-folder-plus"></i>&nbsp;&nbsp;&nbsp;Add Agent Collection
    </a>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Agent Collection List</strong></h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Department</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>Dob</th>
                                <th class="disabled-sorting text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; foreach ($Coll as $key) { ?>
                                <tr>
                                    <td><?=++$count?>.</td>
                                    <td><?=$this->my_library->GetParam('h_ptl_dept', 'name', array('dept_id' => $key->department))?></td>
                                    <td><?=$key->name?></td>
                                    <td><?=$key->gender?></td>
                                    <td><?=$key->phone?></td>
                                    <td><?=$key->email?></td>
                                    <td><?=$key->age?></td>
                                    <td><?=date('d-M-Y', strtotime($key->dob))?></td>
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
