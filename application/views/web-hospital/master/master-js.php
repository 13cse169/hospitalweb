<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(document).on('change', '.myDept', function(event) {
			event.preventDefault();
			let Dept = $(this).val();
			$.ajax({
				url: '<?=base_url('H_Ajax/GetDept')?>',
				type: 'POST',
				dataType: 'json',
				data: {Dept: Dept},
			})
			.done(function(res) {
				$('.myWard').html(res);
			})
			.fail(function() {
				console.log("error");
			});
			
		});
		/*$(document).on('click', '.add-price', function(event) {
			let row = $(this).closest('.row').html();
			$(this).html('<i class="fas fa-times"></i>').removeClass('btn-success btn-outline-success add-price').addClass('btn-danger btn-outline-danger remove-price');
			$('<div class="form-group row">'+row+'</div>').insertAfter($(this).closest('.row'));
		});

		$(document).on('click', '.remove-price', function(event) {
			$(this).closest('.row').remove();
		});

		$(document).on('click', '.delete-data', function(event) {
			let tr = $(this).closest('tr');
			let Data = new Array($(this).closest('table').attr('data-table'), $(this).attr('data'), tr.prop('id'));
			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover.!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url: '<?=base_url('master/delete')?>',
						type: 'POST',
						dataType: 'json',
						data: {DeleteData: Data},
					})
					.done(function(res) {
						console.log(res);
						tr.remove();
						swal("Deleted...!!", "Data has been deleted.", "success");
					})
					.fail(function() {
						console.log("error");
					});
				}
			});
		});*/
	});
</script>