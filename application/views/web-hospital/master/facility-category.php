<div class="page-header">
	<h4 class="page-title">HOSPITAL MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Facility Category</a></li>
	</ol>
	<span>
		<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">
			<i class="fas fa-folder-plus"></i>&nbsp;&nbsp;&nbsp;Add Category
		</button>
		<button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#subCategory">
			<i class="fas fa-folder-plus"></i>&nbsp;&nbsp;&nbsp;Add Sub-Category
		</button>
	</span>
</div>

<div class="card">
	<div class="card-header">
		<h3 class="card-title">Facility Category List</h3>
	</div>
	<div class="card-body">
		<ul class="demo-accordion accordionjs m-0" data-active-index="false">
			<?php foreach ($Category as $key => $value) { ?>
					
				<li>
					<div><h3><?=$value->category?></h3></div>
					<div>
						<div class="row">
							<div class="col-md-3">
								<button class="btn btn-sm btn-gray updateCat" data-id="<?=$value->cat_id?>" data-name="<?=$value->category?>" data-toggle="modal" data-target="#categoryUpdate">
									Update Category Name
								</button>
								<!-- <button class="btn btn-sm btn-gray-dark">Add Sub-Category</button> -->
							</div>
							<?php
								$subCat = $this->my_library->GetArray('facility_subcatg', array('cat_id' => $value->cat_id));
								foreach ($subCat as $key => $subcat) {
									echo'
										<div class="col-md-3">'.$subcat->subcategory.'</div>
									';
								}
							?>
						</div>
					</div>
				</li>

			<?php } ?>

		</ul>
	</div>
</div>

<!-- Message Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="example-Modal3">Add Facility Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<div class="modal-body modal-body-cat">
					<div class="row">
						<div class="col-md-10">
							<div class="form-group">
								<label class="form-label">Enter Facility Category <span class="text-danger">*</span></label>
								<input type="text" class="form-control required" name="category[]" placeholder="Enter Facility Category">
							</div>
						</div>
						<div class="col-md-2">
							<label class="form-label">&nbsp;</label>
							<button type="button" class="btn btn-success btn-pill btn-addCat">
								<i class="fas fa-plus fa-2x"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-outline-primary btn-block"><strong>Add Category</strong></button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Message Modal -->
<div class="modal fade" id="categoryUpdate" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="example-Modal3">Change Category Name</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<div class="modal-body">
					<div class="row">
						<input type="hidden" name="id" id="cat_id">
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-label">Enter New Category Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control required" name="category" id="category">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="updateCat" class="btn btn-outline-primary btn-block"><strong>Update Category</strong></button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Message Modal -->
<div class="modal fade" id="subCategory" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="example-Modal3">Add Sub-Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<div class="modal-body modal-body-subcat">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-label">Select Category <span class="text-danger">*</span></label>
								<select class="form-control required" name="cat_id">
                        			<option value="" hidden="true">Select Category</option>
									<?php foreach ($Category as $key => $value) { ?>
										<option value="<?=$value->cat_id?>"><?=$value->category?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10">
							<div class="form-group">
								<label class="form-label">Enter Sub-Category <span class="text-danger">*</span></label>
								<input type="text" class="form-control required" name="subcategory[]" placeholder="Enter Sub-Category">
							</div>
						</div>
						<div class="col-md-2">
							<label class="form-label">&nbsp;</label>
							<button type="button" class="btn btn-success btn-pill btn-addSubCat">
								<i class="fas fa-plus fa-2x"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="subCategory" class="btn btn-outline-primary btn-block"><strong>Add Sub-Category</strong></button>
				</div>
			</form>
		</div>
	</div>
</div>