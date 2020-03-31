<script type="text/javascript">
	$(document).ready(function(){
		
		$(document).on('click', '.btn-addCat', function(){
			
			var row = $(this).closest('.row').html();
			$(this).removeClass('btn-success btn-addCat').addClass('btn-danger btn-removeCat').html('<i class="fas fa-times fa-2x"></i>');
			$('.modal-body-cat').append('<div class="row">'+row+'</div>');

		}).on('click', '.btn-removeCat', function(){
			$(this).closest('.row').remove();

		}).on('click', '.updateCat', function(){

			$('#cat_id').val($(this).attr('data-id'));
			$('#category').val($(this).attr('data-name'));
			
		});

		$(document).on('click', '.btn-addSubCat', function(){
			
			var row = $(this).closest('.row').html();
			$(this).removeClass('btn-success btn-addSubCat').addClass('btn-danger btn-removeSubCat').html('<i class="fas fa-times fa-2x"></i>');
			$('.modal-body-subcat').append('<div class="row">'+row+'</div>');

		}).on('click', '.btn-removeSubCat', function(){
			$(this).closest('.row').remove();

		});

		$(document).on('change', '.FacilityCat', function(){
			//$('#FacilitySubCat').html(getSubCategory($(this).val()));
			var id = $(this).val();
			$.ajax({
				url: '<?=base_url('master/getSubCategory')?>',
				type: 'POST',
				dataType: 'json',
				data: {catID: id},
			})
			.done(function(res) { 
				$('#FacilitySubCat').html(res);
			})
			.fail(function() { console.log("error"); });
		});

		$(document).on('change', '.FacilityCat-2', function(){
			//$('#FacilitySubCat-2').html(getSubCategory($(this).val()));
			var id = $(this).val();
			$.ajax({
				url: '<?=base_url('master/getSubCategory')?>',
				type: 'POST',
				dataType: 'json',
				data: {catID: id},
			})
			.done(function(res) { 
				$('#FacilitySubCat-2').html(res);
			})
			.fail(function() { console.log("error"); });
		});

		function getSubCategory(id){
			$.ajax({
				url: '<?=base_url('master/getSubCategory')?>',
				type: 'POST',
				dataType: 'json',
				data: {catID: id},
			})
			.done(function(res) { return res; })
			.fail(function() { console.log("error"); });
		}
	});
</script>