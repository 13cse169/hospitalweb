<div class="page-header">
	<h4 class="page-title">REPORT</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Outdoor Patient Report</a></li>
	</ol>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <h4 class="m-t-0 header-title"><strong>Outdoor Patient Report</strong></h4>
            <div class="col-12">

<form action="" method="post" accept-charset="utf-8">
    <div class="row border border-primary rounded mb-4">
        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Enter Category <span class="text-danger">*</span></label>
                                <select class="form-control Category required select" name="code" data-placeholder="Select Category">
                                    <option value="" hidden="true">Select Category</option>
                                    <option value="All">ALL</option>
                                    <?php foreach ($Category as $key => $value) { if($value->g_code != 'G00032') { ?>
                                        <option value="<?=$value->g_code?>"><?=$value->group_name?></option>    
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                              <div class="form-group">
                                <label class="form-label">Enter Sub Category <span class="text-danger">*</span></label>
                                  <select class="form-control particular select" name="particular[]" data-placeholder="Select Particular">
                                    <option value="" hidden="true">Select Sub Category</option>
                                     <?php foreach ($Particular as $key => $value) { ?>
                                        <option value="<?=$value->od_facilit_id?>"><?=$value->facilit_name?></option>    
                                    <?php } ?>
                                    <option value="" disabled="true">Select Category First</option>
                                </select>
                            </div>
                        </div>
        <div class="col-md-3">
            <label class="form-label">From Date <span class="text-danger">*</span></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-calendar tx-16 lh-0 op-6"></i></div>
                </div>
                <input type="text" name="f_date" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY" value="<?=date('d-m-Y')?>">
            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label">To Date <span class="text-danger">*</span></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                    </div>
                </div><input type="text" name="t_date" class="form-control fc-datepicker required" placeholder="DD-MM-YYYY" value="<?=date('d-m-Y')?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-outline-primary btn-block"><strong>Get Report</strong></button>
            </div>
        </div>
    </div>
</form>

            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                           <th>#</th>
                                <th>Payment Date</th>
                                <!-- <th>Facility</th> -->
                                <th>Patient</th>
                                <th>Collected By</th>
                                <th>Category</th>
                                <th>Amount</th>
                        </thead>
                        <tbody id="GetReport"><?=$Row?></tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</div>
