<div class="page-header">
	<h4 class="page-title">REPORT</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Indoor Patient Report</a></li>
	</ol>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <h4 class="m-t-0 header-title"><strong>Indoor Patient Report</strong></h4>
            <div class="col-12">

<form action="" method="post" accept-charset="utf-8">
    <div class="row border border-primary rounded mb-4">
        <div class="col-md-3">
            <label class="form-label">Select Facility <span class="text-danger">*</span></label>
            <div class="input-group">
                <select class="form-control required" name="cat_id">
                    <option value="" hidden="true">Select Facility</option>
                    <option value="All">All</option>
                    <option value="Advance">ADVANCE INDOOR PAYMENT</option>
                    <option value="FinalIPD">FINAL INDOOR PAYMENT IPD</option>
                    <option value="AMBULANCE">AMBULANCE</option>
                    <option value="Emergency Facility">EMERGENCY FACILITY</option>
                    <option value="E.C.G">E.C.G</option>
                    <option value="ECHO">ECHO</option>
                    <option value="PATHOLOGY TEST">PATHOLOGY TEST</option>
                    <option value="U.S.G">U.S.G</option>
                    <option value="X-RAY">X-RAY</option>
                    <?php foreach ($Fclty as $key => $value) { ?>
                        <option value="<?=$value->cat_id?>"><?=$value->category?></option>
                    <?php } ?>
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
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Facility / Patient</th>
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
