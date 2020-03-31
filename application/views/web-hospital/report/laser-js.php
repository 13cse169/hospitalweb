<script type="text/javascript">
	$(document).ready(function(e){

		$('#getLaserReport').submit(function(event){
			event.preventDefault();
			var fData = $(this).serialize();

			var submit = $(this).closest('form').find(':submit');

			if (fData.length > 15) {
				$.ajax({
					url: '<?=base_url('report/getlaserreport')?>',
					type: 'POST',
					dataType: 'json',
					data: {Data: fData},
				})
				.done(function(res) {
					//console.log(res);
					$('#GetReport').html(res);
				})
				.fail(function() {
					console.log("error");
				});
			}

			$(submit).html('<strong>Get Report</strong>');
		});

	});
</script>