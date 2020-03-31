<div class="page-header">
	<h4 class="page-title">PATHOLOGY ENTRY</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Booking Entry</a></li>
	</ol>
    <a href="<?=base_url('pathology/entry/booking/add')?>" class="btn btn-outline-primary">
        <i class="fas fa-folder-plus"></i>&nbsp;&nbsp;&nbsp;Add Booking Entry
    </a>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Booking Entry List</strong></h4>
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
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</div>
