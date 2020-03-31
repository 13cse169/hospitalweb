<div class="page-header">
	<h4 class="page-title">REPORT</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Operative Surgeon Report</a></li>
	</ol>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <h4 class="m-t-0 header-title"><strong>Operative Surgeon Report</strong></h4>
            <div class="col-12">

<form action="" method="post" accept-charset="utf-8" id="OperativeSurgeonReport">
    <div class="row border border-secondary rounded mb-4">
          <div class="col-md-3">
            <label class="form-label">Select Category <span class="text-danger">*</span></label>
            <div class="input-group">
                <!-- <select class="form-control select2-show-search required" name="cat_id" data-placeholder="Select Particular"> -->
                <select class="form-control Category required" name="cat_id">
                    <option value="" hidden="true">Select Category</option>
                    <option value="ALL">ALL</option>
                    <?php foreach ($Fclty as $key => $value) { ?>
                        <option value="<?=$value->cat_id?>"><?=$value->category?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label">Select Doctor Type <span class="text-danger">*</span></label>
            <div class="input-group">
                <select class="form-control DoctorType required" name="doc_type">
                    <option value="" hidden="true">Select Doctor</option>
                    <option value="Doctor">SPECIAL CALL DOCTOR</option>
                    <option value="Asst. Doctor">ASSISTANCE DOCTOR</option>
                    <option value="OPERATIVESURGEON">OPERATIVE SURGEON DOCTOR</option>
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
       
        <div class="col-md-3 DoctorTypeDiv" style="display: none;">
            <label class="form-label">Select Doctor <span class="text-danger">*</span></label>
            <div class="input-group">
                <select class="form-control Doctor" name="doc_id">
                    <option value="" hidden="true">Select Doctor</option>
                    <option value="All">All</option>
                    <?php foreach ($Doctor as $key => $value) { ?>
                        <option value="<?=$value->doctor_id?>"><?=$value->name?></option>
                    <?php } ?>
                </select>
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
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Doctor</th>
                                <th>Category</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="GetReport">
                            <?=$Row?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</div>
