<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(document).on('change', '.myDepartment', function(event) {
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
		$(document).on('change', '.myWard', function(event) {
			event.preventDefault();
			let Ward = $(this).val();
			$.ajax({
				url: '<?=base_url('H_Ajax/GetBed')?>',
				type: 'POST',
				dataType: 'json',
				data: {Ward: Ward},
			})
			.done(function(res) {
				$('.myBed').html(res);
			})
			.fail(function() {
				console.log("error");
			});
		});
		$(document).on('change', '.visit-patient', function(event) {
			event.preventDefault();
			let pid = $(this).val();
			$.ajax({
				url: '<?=base_url('H_Ajax/GetPatient')?>',
				type: 'POST',
				dataType: 'json',
				data: {pid: pid},
			})
			.done(function(res) {
				$('#visit-patient-form').find('input').each(function(index, el) {
					let val = $(this).attr('name');
					$(this).val(res[val]);
				});
			})
			.fail(function() {
				console.log("error");
			});
		});
		
		/*
			* Quick Bill JavaScript
		*/

		$(document).on('change', '.particular-patient', function(event) {
			event.preventDefault();
			let tid = $(this).val();
			$.ajax({
				url: '<?=base_url('H_Ajax/GetTreatment')?>',
				type: 'POST',
				dataType: 'json',
				data: {tid: tid},
			})
			.done(function(res) {
				$('#patient-form').find('input').each(function(index, el) {
					let val = $(this).attr('name');
					$(this).val(res[val]);
				});
				$('#particular-data').html(res.facility_data);

				$('.Discount-Type').val(res.disTyp);
				$('.discount-per').val(res.discount);
				$('.finalNetAmt').val(res.dueAmt);
				$('.finalRounded').val(res.rounddueAmt);

				if (res.DueReport == 'Yes') {
					$('.switch-final').show('slow');
				}else{
					$('.switch-final').hide('slow');
				}
			})
			.fail(function() {
				console.log("error");
			});
		});
		$(document).on('change', '.particular', function(event) {
			event.preventDefault();
			let amt = $(this).find('option:selected').attr('amt');

			$('.particular-amt').val(amt).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
			$('.particular-uom').val($(this).find('option:selected').attr('uom')).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
			$('.particular-total').val(parseInt($('.particular-qty').val()) * parseInt(amt)).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');

		});
		$(document).on('keyup', '.particular-qty', function(event) {
			event.preventDefault();
			$('.particular-total').val(parseInt($(this).val()) * parseInt($('.particular-amt').val()));
		});
		$(document).on('click', '.particular-tax', function(event) {
			if ($(this).prop('checked') == true) {
				$('.Final-Bill').show('slow');
			}else{
				$('.Final-Bill').hide('slow');
				//$('.particular-tax-amt, .particular-perc').attr('readonly', 'true').val(null).removeClass('required is-invalid state-invalid is-valid state-valid');
			}
		});
		$(document).on('click', '.print-bill', function(event) {
			let tID = $('.particular-patient').val(), loc = '';

			if (tID) {

				if ($(this).hasClass('final-bill')) {
					loc = '<?=base_url('patient/indoor/final-bill')?>/'+tID;
					location.reload();
				}else{
					loc = '<?=base_url('patient/indoor/provisional-bill')?>/'+tID;
				}
				$('.print-bill').attr('href', loc);

			}else{ 
				event.preventDefault();
				event.stopPropagation();
				return $.growl.warning({
					message: "Please select patient first..."
				});
			}
		});
		$('#particular-form').submit(function(event) {
			event.preventDefault();

			var submit = $(this).closest('form').find(':submit');

			if ($('.particular-patient').val()) {

				let tid = $('.particular-patient').val();
				
				$.ajax({
					url: '<?=base_url('H_Ajax/PostParticular')?>',
					type: 'POST',
					dataType: 'json',
					data: {Data: $('#particular-form').serialize(), tID: tid},
				})
				.done(function(res) {
					$('#particular-data').append(res);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function(){
					$(submit).html('Add');

				});

			}else{ 
				$(submit).html('Add'); 

					event.preventDefault();
					event.stopPropagation();
					return $.growl.warning({
						message: "Please select patient first..."
					});
			}
            
		});

		$(document).on('click', '.remove-particular', function(event) {
			event.preventDefault();
			let tr = $(this).closest('tr');
			
			$.ajax({
				url: '<?=base_url('H_Ajax/RemoveParticular')?>',
				type: 'POST',
				dataType: 'json',
				data: {tID: tr.attr('class')},
			})
			.done(function(res) {
				console.log(res);
				tr.remove();
			})
			.fail(function() {
				console.log("error");
			});
		});

		$('#particular-data').bind('DOMSubtreeModified', function(event) {
			let amt = 0;
			$('.tableTotal').each(function(index, el) {
				amt = parseInt($(this).text()) + parseInt(amt);
			});
			$('.finalAmt').val(amt);
		});

		$(document).on('click', '.save-particular', function(event) {
			event.preventDefault();
			let tid = $('.particular-patient').val();

			let dAmt = $('.discount-per').val();
			let dTyp = $('.Discount-Type').val();

			if (tid) {
				swal({
					title: "Are you sure?",
					text: "Confirm all data is correct.",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						$.ajax({
							url: '<?=base_url('H_Ajax/ConfirmParticular')?>',
							type: 'POST',
							dataType: 'json',
							data: {tID: tid, dTyp: dTyp, dAmt: dAmt},
						})
						.done(function(res) {

							$('#particular-data').find('.remove-particular').each(function(index, el) {
								$(this).closest('td').text('--');
							});

							event.preventDefault();
							event.stopPropagation();
							return $.growl.notice({
								message: "Data successfuly saved..."
							});

						})
						.fail(function() {
							event.preventDefault();
							event.stopPropagation();
							return $.growl.error({
								message: "Oops.!! Something went wrong..."
							});
						});
					}
				});
			}else{
				event.preventDefault();
				event.stopPropagation();
				return $.growl.warning({
					message: "Please select patient first..."
				});
			}
			
		});

		$(document).on('keyup', '.discount-per', function(event) {
			let finalAmt = $('.finalAmt').val();
			if (finalAmt) {

				let lessAmt = 0;
				let amt = $(this).val();
				let tpy = $('.Discount-Type').val();

				if (tpy) {
					if (tpy == 'Amount') lessAmt = amt;
					else if (tpy == 'Percentage') lessAmt = ((finalAmt * amt) / 100);
					
					let aftDis  = finalAmt - lessAmt;

					if (aftDis < 0) {
						$(this).val(null); 
						$('.finalNetAmt, .finalRounded').val(null);
					}
					else{
						$('.finalNetAmt').val(aftDis);
						$('.finalRounded').val(Math.round(aftDis));
					}

				}

			}else{
				$(this).val(null);

				event.preventDefault();
				event.stopPropagation();
				return $.growl.warning({
					message: "Please select patient first..."
				});
			}

		});

		$(document).on('change', '.Discount-Type', function(event) {
			event.preventDefault();
			let tpy = $(this).val();
			let amt = $('.discount-per').val();
			let finalAmt = $('.finalAmt').val();
			let lessAmt  = 0;

			if (amt) {
				if (tpy == 'Amount') lessAmt = amt;
				else if (tpy == 'Percentage') lessAmt = ((finalAmt * amt) / 100);
				
				let aftDis  = finalAmt - lessAmt;

				$('.finalNetAmt').val(aftDis);
				$('.finalRounded').val(Math.round(aftDis));
			}
		});

		/*
			* Payment Receive
		*/

		$(document).on('change', '.payment-receive', function(event) {
			event.preventDefault();
			let tid = $(this).val();

			$.ajax({
				url: '<?=base_url('H_Ajax/GetPatientAmount')?>',
				type: 'POST',
				dataType: 'json',
				data: {tID: tid},
			})
			.done(function(res) {
				$('#payment-receive-form').find('input').each(function(index, el) {
					let val = $(this).attr('name');
					$(this).val(res[val]);
				});
				//console.log(res);
			})
			.fail(function() {
				console.log("error");
			});
		});


		$(document).on('keyup', '.payment-amount', function(event) {
			event.preventDefault();
			if ($('.payment-receive').val()) {
				
				let pay_amt    = parseInt($(this).val());
				let total_amt  = parseInt($('.total_amt').val());
				let total_paid = parseInt($('.total_paid').val());

				if ((total_paid + pay_amt) > total_amt) {

					$(this).val(null);
					
					event.preventDefault();
					event.stopPropagation();
					return $.growl.warning({
						message: "Amount is more then Total Amount..."
					});		
				}

			}else{

				$(this).val(null);
				
				event.preventDefault();
				event.stopPropagation();
				return $.growl.warning({
					message: "Please select patient first..."
				});

			}
		});

		/*
			* Patient Discharge
		*/

		$(document).on('change', '.patient-discharge', function(event) {
			event.preventDefault();
			let tID = $(this).val();

			$('.discharge-treatment').val(tID);

			$.ajax({
				url: '<?=base_url('H_Ajax/DischargePatient')?>',
				type: 'POST',
				dataType: 'json',
				data: {tID: tID},
			})
			.done(function(res) {
				if (res == 'Due') {
					$('.patient-discharge-btn').hide('slow');
					
					$('.PatientBox').find('input').each(function(index, el) {
						let tmp = $(this).attr('name');
						$(this).val(res[tmp]);
					});

					$('.relative-name').val(res.relative);
					$('.relation-name').val(res.relation);

					event.preventDefault();
					event.stopPropagation();
					return $.growl.warning({
						message: "Amount is not clear for this patient..."
					});
				}else{
					$('.patient-discharge-btn').show('slow');
					
					$('.PatientBox').find('input').each(function(index, el) {
						let tmp = $(this).attr('name');
						$(this).val(res[tmp]);
					});

					$('.relative-name').val(res.relative);
					$('.relation-name').val(res.relation);

				}
			})
			.fail(function() {
				console.log("error");
			});
		});

	});
</script>
