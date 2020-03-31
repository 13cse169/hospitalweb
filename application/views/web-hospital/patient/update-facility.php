<div class="page-header">
    <h4 class="page-title">PATIENT FACILITY</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Update Facility</a></li>
    </ol>
</div>

<div class="card">
	<div class="card-header">
		<h3 class="card-title">Update Patient Facility</h3>
	</div>
	<div class="card-body">
		<ul class="demo-accordion accordionjs m-0" data-active-index="false">
<?php
	foreach ($Amount as $key1 => $value1) {
		$InFacility = $this->my_library->GetArray('patient_facility', array('aid' => $value1->id));
		$OtFacility = $this->my_library->GetArray('other_facility', array('aid' => $value1->id)); ?>
		<li>
			<div><h3 class="font-weight-bold">
				<?=$this->my_library->GetParam('facility_catg', 'category', array('cat_id' => $InFacility[0]->category))?>
			</h3></div>
			<div class="ml-1 mr-1">
				<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<input type="hidden" name="aID" value="<?=$value1->id?>">
					<div class="row border border-secondary rounded mb-3">
						<div class="col-md-3">
				            <label class="form-label">Category : <span class="font-weight-bold">
				            	<?=$this->my_library->GetParam('facility_catg', 'category', array('cat_id' => $InFacility[0]->category))?>
				            </span></label>
				            <input type="hidden" name="category" value="<?=$InFacility[0]->category?>">
				        </div>
				        <div class="col-md-3">
				            <label class="form-label">Sub Category : <span class="font-weight-bold">
				            	<?=$this->my_library->GetParam('facility_subcatg', 'subcategory', array('subcat_id' => $InFacility[0]->subcategory))?>
				            </span></label>
				            <input type="hidden" name="subcategory" value="<?=$InFacility[0]->subcategory?>">
				        </div>
				        <div class="col-md-3">
				            <label class="form-label">Surgeon Doctor : <span class="font-weight-bold">
				            	<?=(is_numeric($InFacility[0]->operative_surgeon)) ? $this->my_library->GetParam('h_doctor', 'name', array('doctor_id' => $InFacility[0]->operative_surgeon)) : $InFacility[0]->operative_surgeon ?>
				            </span></label>
				        </div>
				        <div class="col-md-3">
							<button type="submit" class="btn btn-primary btn-block">Update Data</button>
						</div>
				        <div class="col-md-12 border border-primary border-left-0 border-right-0 border-top-0 mb-4"></div>
			        	<?php foreach ($InFacility as $key2 => $value2) { ?>
					        <div class="col-md-3">
				                <div class="form-group">
				                    <label class="form-label">Particular Name</label>
				                    <input type="text" class="form-control" readonly="true" value="<?=$value2->particular?>">
				                    <input type="hidden" name="inID[]" value="<?=$value2->id?>">
				                </div>
				            </div>
				            <div class="col-md-3">
				                <div class="form-group">
				                    <label class="form-label">Particular Amount</label>
				                    <input type="number" name="amount[]" class="form-control required" value="<?=$value2->amount?>">
				                </div>
				            </div>
				        <?php } ?>
				        <div class="col-md-12 border border-primary border-left-0 border-right-0 border-top-0 mb-4"></div>
						<div class="col-md-4 offset-md-4">
							<div class="form-group">
								<label class="form-label">Select Other Facility <span class="text-danger">*</span></label>
								<select class="form-control OtherFacility">
									<option value="" hidden="true">Select Other Facility</option>
									<option value="Doctor">SPECIAL DOCTOR</option>
									<option value="Ass. Doctor">ASS. DOCTOR</option>
									<option value="O.T SALINE">O.T SALINE</option>
									<option value="WARD SALINE">WARD SALINE</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<?php foreach ($OtFacility as $key3 => $value3) { 
								if ($value3->type == 'Doctor') { ?>
									<div class="SpecialDoctor">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-label">Special Doctor Name <span class="text-danger">*</span></label>
													<input type="text" name="SpecialDoctorName[]" class="form-control required" value="<?=$value3->name?>">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-label">Fees <span class="text-danger">*</span></label>
													<input type="number" name="SpecialDoctorFees[]" class="form-control required" value="<?=$value3->amount?>">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-label">Visit <span class="text-danger">*</span></label>
													<input type="number" name="SpecialDoctorVisit[]" class="form-control required" value="<?=$value3->qty?>">
												</div>
											</div>
											<div class="col-md-2 text-center">
												<label class="form-label">&nbsp;</label>
												<span href="#" class="btn btn-outline-primary AddRow"><i class="fas fa-plus"></i></span>
												<span href="#" class="btn btn-outline-danger RemoveRow"><i class="fas fa-times"></i></span>
											</div>
										</div>
									</div>
								<?php } elseif ($value3->type == 'Asst. Doctor') { ?>
									<div class="AssDoctor">	
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-label">Asst. Doctor Name <span class="text-danger">*</span></label>
													<input type="text" name="AssDoctorName[]" class="form-control required" value="<?=$value3->name?>">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-label">Fees <span class="text-danger">*</span></label>
													<input type="number" name="AssDoctorFees[]" class="form-control required" value="<?=$value3->amount?>">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-label">Visit <span class="text-danger">*</span></label>
													<input type="number" name="AssDoctorVisit[]" class="form-control required" value="<?=$value3->qty?>">
												</div>
											</div>
											<div class="col-md-2 text-center">
												<label class="form-label">&nbsp;</label>
												<span href="#" class="btn btn-outline-primary AddRow"><i class="fas fa-plus"></i></span>
												<span href="#" class="btn btn-outline-danger RemoveRow"><i class="fas fa-times"></i></span>
											</div>
										</div>
									</div>
								<?php } elseif ($value3->type == 'O.T SALINE') { ?>
									<div class="OTSalineDiv">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-label">Select OT Saline <span class="text-danger">*</span></label>
													<select class="form-control OTSalineName required" name="OTSalineName[]">
														<option value="" hidden="true">Select Saline</option>
														<?php 
															$Saline = $this->M_Hospital->GetArray('saline_master', array('category' => 'O.T SALINE'));
															foreach ($Saline as $key4 => $value4) {
																if ($value4->name == $value3->name)
																	echo'<option value="'.$value4->id.'" selected>'.$value4->name.'</option>';
																else
																	echo'<option value="'.$value4->id.'">'.$value4->name.'</option>';
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<label class="form-label">OT Saline Amount</label>
												<input type="number" name="OTSalineAmount[]" class="form-control OTSalineAmount required" value="<?=$value3->amount?>">
											</div>
											<div class="col-md-3">
												<label class="form-label">OT Saline Quantity</label>
												<input type="number" name="OTSalineQty[]" value="1" min="1" class="form-control required" value="<?=$value3->qty?>">
											</div>
											<div class="col-md-2 text-center">
												<label class="form-label">&nbsp;</label>
												<span href="#" class="btn btn-outline-primary AddRow"><i class="fas fa-plus"></i></span>
												<span href="#" class="btn btn-outline-danger RemoveRow"><i class="fas fa-times"></i></span>
											</div>
										</div>
									</div>
								<?php } elseif ($value3->type == 'WARD SALINE') { ?>
									<div class="WardSalineDiv">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-label">Select Ward Saline <span class="text-danger">*</span></label>
													<select class="form-control WardSalineName" name="WardSalineName[]">
														<option value="" hidden="true">Select Saline</option>
														<?php 
															$Saline = $this->M_Hospital->GetArray('saline_master', array('category' => 'WARD SALINE'));
															foreach ($Saline as $key5 => $value5) {
																if ($value5->name == $value3->name)
																	echo'<option value="'.$value5->id.'" selected>'.$value5->name.'</option>';
																else
																	echo'<option value="'.$value5->id.'">'.$value5->name.'</option>';
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<label class="form-label">Ward Saline Amount</label>
												<input type="number" name="WardSalineAmount[]" class="form-control WardSalineAmount required" value="<?=$value3->amount?>">
											</div>
											<div class="col-md-3">
												<label class="form-label">Ward Saline Quantity</label>
												<input type="number" name="WardSalineQty[]" value="1" min="1" class="form-control required" value="<?=$value3->qty?>">
											</div>
											<div class="col-md-2 text-center">
												<label class="form-label">&nbsp;</label>
												<span href="#" class="btn btn-outline-primary AddRow"><i class="fas fa-plus"></i></span>
												<span href="#" class="btn btn-outline-danger RemoveRow"><i class="fas fa-times"></i></span>
											</div>
										</div>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
				    </div>
	    		</form>
	    	</div>
	    </li>
<?php } ?>			
		</ul>
	</div>
</div>