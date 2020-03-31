<div class="page-header">
	<h4 class="page-title">HOSPITAL MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Facility Master</a></li>
	</ol>
	<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">
		<i class="fas fa-folder-plus"></i>&nbsp;&nbsp;&nbsp;Add Facility
	</button>
</div>

<?php if (isset($UpdateData)) { ?>
<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <h4 class="m-t-0 header-title"><strong>Update Facility Details</strong></h4>
				<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<div class="row">
						
						<div class="col-md-3">
							<div class="form-group">
								<label class="form-label">Select Category <span class="text-danger">*</span></label>
								<select class="form-control required FacilityCat-2" name="category">
									<option value="" hidden="true">Select Category</option>
									<?php foreach ($Category as $key => $value) { ?>
										<option value="<?=$value->cat_id?>" <?=($value->cat_id == $UpdateData->category)?'selected':''?>>
											<?=$value->category?>
										</option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="form-label">Select Sub-Category <span class="text-danger">*</span></label>
								<select class="form-control required" id="FacilitySubCat-2" name="subcategory">
									<option value="" hidden="true">Select Sub-Category</option>
									<?php 
										$SubCat = $this->my_library->GetArray('facility_subcatg', array('cat_id' => $UpdateData->category));	
										foreach ($SubCat as $key => $value) { ?>
											<option value="<?=$value->subcat_id?>" <?=($value->subcat_id == $UpdateData->subcategory)?'selected':''?>>
												<?=$value->subcategory?>
											</option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="form-label">Enter Facility Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control required" name="name" placeholder="Enter Facility Name" value="<?=$UpdateData->name?>">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="form-label">Enter Unit <span class="text-danger">*</span></label>
								<input type="text" class="form-control required" name="unit" placeholder="Enter Unit" value="<?=$UpdateData->unit?>">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="form-label">Non-Beneficiaries <span class="text-danger">*</span></label>
								<input type="number" class="form-control required" name="nonbeneficiaries" placeholder="Enter Non-Beneficiaries Rate" value="<?=$UpdateData->nonbeneficiaries?>">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="form-label">Beneficiaries <span class="text-danger">*</span></label>
								<input type="number" class="form-control required" name="beneficiaries" placeholder="Enter Beneficiaries Rate" value="<?=$UpdateData->beneficiaries?>">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<div class="form-label">Facility Type</div>
								<div class="custom-controls-stacked">
									<label class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" name="facilitytype" value="Indoor" <?=($UpdateData->facilitytype == 'Indoor')?'checked':''?>>
										<span class="custom-control-label">Indoor</span>
									</label>
									<label class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" name="facilitytype" value="Out Door" <?=($UpdateData->facilitytype == 'Out Door')?'checked':''?>>
										<span class="custom-control-label">Out Door</span>
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<input type="hidden" name="id" value="<?=$this->uri->segment(3)?>">
							<label class="form-label">&nbsp;</label>
							<button type="submit" name="update" class="btn btn-outline-primary btn-block"><strong>Update Facility</strong></button>
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
                    <h4 class="m-t-0 header-title"><strong>Facility List</strong></h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="h_facility">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Sub Category</th>
                                <th>Name</th>
                                <th>Unit</th>
                                <th>Non-Benef.</th>
                                <th>Benef.</th>
                                <!-- <th>Category</th>
                                <th>Date</th> -->
                                <th class="disabled-sorting text-center">Action</th>
                            </tr>
                        </thead>                        
                        <tbody>
							<?php $count = 0; foreach ($Facility as $key) { ?>
								<tr id="<?=$key->facility_id?>">
									<td><?=++$count?></td>
									<td><?=$key->code?></td>
									<td><?=$this->my_library->GetParam('facility_subcatg', 'subcategory', array('subcat_id' => $key->subcategory))?></td>
									<td><?=$key->name?></td>
									<td><?=$key->unit?></td>
									<td><?=$key->nonbeneficiaries?></td>
									<td><?=$key->beneficiaries?></td>
									<!-- <td><?=$key->category?></td>
									<td><?=date('d-M-Y', strtotime($key->added_on))?></td> -->
									<td class="text-center">
										<a href="<?=base_url('master/facility/'.$key->facility_id)?>" class="btn btn-icon btn-sm btn-primary">
											<i class="far fa-edit"></i>
										</a>

										<a href="#" class="btn btn-icon btn-sm btn-danger" data="facility_id">
											<i class="far fa-times-circle"></i>
										</a>
									</td>
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
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="example-Modal3">Add Facility</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Select Category <span class="text-danger">*</span></label>
					<select class="form-control required FacilityCat" name="category">
						<option value="" hidden="true">Select Category</option>
						<?php foreach ($Category as $key => $value) { ?>
							<option value="<?=$value->cat_id?>"><?=$value->category?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Select Sub-Category <span class="text-danger">*</span></label>
					<select class="form-control required" id="FacilitySubCat" name="subcategory">
						<option value="" hidden="true">Select Sub-Category</option>
						<option value="" disabled="true">Select Category First</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Enter Facility Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control required" name="name" placeholder="Enter Facility Name">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Enter Unit <span class="text-danger">*</span></label>
					<input type="text" class="form-control required" name="unit" placeholder="Enter Unit">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Non-Beneficiaries Rate <span class="text-danger">*</span></label>
					<input type="number" class="form-control required" name="nonbeneficiaries" placeholder="Enter Non-Beneficiaries Rate">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Beneficiaries Rate <span class="text-danger">*</span></label>
					<input type="number" class="form-control required" name="beneficiaries" placeholder="Enter Beneficiaries Rate">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class="form-label">Facility Type</div>
					<div class="custom-controls-stacked">
						<label class="custom-control custom-radio">
							<input type="radio" class="custom-control-input" name="facilitytype" value="Indoor" checked>
							<span class="custom-control-label">Indoor</span>
						</label>
						<label class="custom-control custom-radio">
							<input type="radio" class="custom-control-input" name="facilitytype" value="Out Door">
							<span class="custom-control-label">Out Door</span>
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-outline-primary btn-block"><strong>Add Facility</strong></button>
	</div>
</form>				
		</div>
	</div>
</div>