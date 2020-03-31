<script type="text/javascript">
    jQuery(document).ready(function($) {

    	$(document).on('blur', '.fac-amt', function(event) {
    		var fAmt = $(this).val();
    		var mAmt = $(this).attr('min');
    		if (fAmt < mAmt) $(this).val(mAmt);
    	});	
    	$(document).on('change', '.SelectCabin', function(event) {
    		var cabin = $(this).val();
    		var pType = $('.PatientType').val();
    		if (pType) {

    			var bType  = {'BedRent': 30, 'CabinG': 200, 'CabinAC': 400};
    			var nbType = {'BedRent': 60, 'CabinG': 350, 'CabinAC': 700};

	    		if (pType == 'B'){

	    			if (cabin == 'General Bed') $('.BedRent').val(bType.BedRent).attr('min', bType.BedRent);
	    			else if(cabin == 'General Cabin') $('.BedRent').val(bType.CabinG).attr('min', bType.CabinG);
	    			else $('.BedRent').val(bType.CabinAC).attr('min', bType.CabinAC);

	    		} else {

	    			if (cabin == 'General Bed') $('.BedRent').val(nbType.BedRent).attr('min', nbType.BedRent);
	    			else if(cabin == 'General Cabin') $('.BedRent').val(nbType.CabinG).attr('min', nbType.CabinG);
	    			else $('.BedRent').val(nbType.CabinAC).attr('min', nbType.CabinAC);

	    		} 

    		}else{
    			$(this).val('');

    			event.preventDefault();
				event.stopPropagation();
				return $.growl.warning({
					message: "Please select patient type."
				});
    		}
    	});
    	$(document).on('change', '.PatientType', function(event) {
    		var pType  = $(this).val();
    		
    		if (pType == 'B') $('.AdmissionFee').val(30).attr('min', 30);
    		else $('.AdmissionFee').val(100).attr('min', 100);

    	});
    	$(document).on('change', '.tret-faci-cat', function(event) {
    		let CatID = $(this).val();
    		$('.myFacility').html('');
    		$.ajax({
				url: '<?=base_url('master/getSubCategory')?>',
				type: 'POST',
				dataType: 'json',
				data: {catID: CatID},
			})
			.done(function(res) { $('.tret-faci-subcat').html(res); })
			.fail(function() { console.log("error"); });
    	});
    	$(document).on('click', '.facility-remove', function(event) {
    		$(this).closest('.row').remove();
    	});
    	$(document).on('change', '.tret-faci-subcat', function(event) {
    		let SubCatID = $(this).val();
    		var type = $('.PatientType').val();

    		if ($('.patient-code').val() != 'New') {
	    		$.ajax({
					url: '<?=base_url('master/getFacility')?>',
					type: 'POST',
					dataType: 'json',
					data: {subCatID: SubCatID, pType: type},
				})
				.done(function(res) { $('.myFacility').html(res); })
				.fail(function() { console.log("error"); });
			}else{ 
				$(this).val('');

				event.preventDefault();
				event.stopPropagation();
				return $.growl.warning({
					message: "Please select registered patient first..."
				});
			}
    	});
    	
    	/*$(document).on('change', '.myDepartment', function(event) {
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
		});*/
		
        $(document).on('change', '.adv-pay-mode', function(event) {
            event.preventDefault();
            let mode = $(this).val();
            if (mode == 'Cash') {
            	$('.adv-details-dd, .adv-details-cheque').hide('slow');
            } else if (mode == 'Cheque') {
            	$('.adv-details-dd').hide('slow');
            	$('.adv-details-cheque').show('slow');
            } else {
            	$('.adv-details-cheque').hide('slow');
            	$('.adv-details-dd').show('slow');
            }
        });

        $(document).on('change', '.pmt-pay-mode', function(event) {
            event.preventDefault();
            let mode = $(this).val();
            if (mode == 'Cash') {
            	$('.pay-details-dd, .pay-details-cheque').hide('slow');
            } else if (mode == 'Cheque') {
            	$('.pay-details-dd').hide('slow');
            	$('.pay-details-cheque').show('slow');
            } else {
            	$('.pay-details-cheque').hide('slow');
            	$('.pay-details-dd').show('slow');
            }
        });

        $(document).on('change', '.patient-code', function(event) {
        	event.preventDefault();
        	let pid = $(this).val();

        	if(pid != 'New'){

	        	$.ajax({
	        		url: '<?=base_url('h_ajax/all_patient_details')?>',
	        		type: 'POST',
	        		dataType: 'json',
	        		data: {pid: pid},
	        	})
	        	.done(function(res) {
	        		$('.patient-details-box').find('input,select,textarea').each(function(index, el) {
	        			let name = $(this).attr('name');
	        			$(this).val(res[name]);
	        		});
	        		$('#particular-data').html(res.facility_data);

	        		$('.accTotal').val(res.accTotal);
	        		$('.accPaid').val(res.accPaid);
	        		$('.accDue').val(res.accDue);

	        		$('.myWard').html(res.ward);
	        		$('.myBed').html(res.bed);
	        		
	        		$('.AdvanceTitle').html(res.advPrint);

	        		$(".account-details-box").show('slow');

	        		$('.AdmissionFee').val(res.admissionfee);
	        		$('.SelectCabin').val(res.bed_type);
	        		$('.BedRent').val(res.bedrent);
	        		$('.StayDays').val(res.staydays);
	        	})
	        	.fail(function() {
	        		console.log("error");
	        	});

	        }else{
	        	$('.patient-details-box').find('input,select,textarea').each(function(index, el) {
        			$(this).val('');
        		});
        		$('#particular-data').html('');

        		$(".account-details-box").hide('slow');

        		$('.myWard').html('<option value="" hidden="true">Select Ward</option><option value="" disabled="true">Select Department First.</option>');
        		$('.myBed').html('<option value="" hidden="true">Select Bed</option><option value="" disabled="true">Select Ward First.</option>');
        	}
        	
        });

        /*$(document).on('change', '.particular', function(event) {
			event.preventDefault();
			let amt = $(this).find('option:selected').attr('amt');

			alert($('.BeneType').find('option:selected').val());

			$('.particular-amt').val(amt).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
			$('.particular-uom').val($(this).find('option:selected').attr('uom')).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
			$('.particular-total').val(parseInt($('.particular-qty').val()) * parseInt(amt)).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
		});*/

		$(document).on('change', '.BeneType', function(event) {
			
			//let uom = $('.particular').find('option:selected').attr('uom');

			if ($('.BeneType').find('option:selected').val() == 'Beneficiaries') {

				let amt = $('.particular').find('option:selected').attr('beni');

				$('.particular-amt').val(amt).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
				//$('.particular-uom').val(uom).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
				$('.particular-total').val(parseInt($('.particular-qty').val()) * parseInt(amt)).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');

			} else {

				let amt = $('.particular').find('option:selected').attr('non-beni');

				$('.particular-amt').val(amt).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
				//$('.particular-uom').val(uom).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
				$('.particular-total').val(parseInt($('.particular-qty').val()) * parseInt(amt)).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');

			}
		});

		$(document).on('keyup', '.particular-qty', function(event) {
			event.preventDefault();
			$('.particular-total').val(parseInt($(this).val()) * parseInt($('.particular-amt').val()));
		});

		$('.particular-add').on('click', function(event) {
			event.preventDefault();

			if ($('.patient-code').val() != 'New') {

				let pid = $('.patient-code').val();
				
				let ParticularName = new Array();
				let ParticularAmt  = new Array();
				let ParticularID   = new Array();

				$('.myFacility').find('.fac-nme').each(function(index, el) { ParticularName.push($(this).val()); });
				$('.myFacility').find('.fac-amt').each(function(index, el) { ParticularAmt.push($(this).val()); });
				$('.myFacility').find('.fac-id').each(function(index, el) { ParticularID.push($(this).val()); });

				if(ParticularName.length){	
					$.ajax({
						url: '<?=base_url('H_Ajax/PostParticularNew')?>',
						type: 'POST',
						dataType: 'json',
						data: {Name: ParticularName, ID: ParticularID, Amt: ParticularAmt, pID: pid},
					})
					.done(function(res) {
						//console.log(res);
						$('.myFacility').html('');
						$('#particular-data').append(res);

						event.preventDefault();
						event.stopPropagation();
						return $.growl.notice({
							message: "Particular added."
						});
					})
					.fail(function() {
						console.log("error");
					});
				}else{
					event.preventDefault();
					event.stopPropagation();
					return $.growl.warning({
						message: "Please select particular..."
					});	
				}
			}else{ 
				event.preventDefault();
				event.stopPropagation();
				return $.growl.warning({
					message: "Please select registered patient first..."
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

		$(document).on('keyup', '.payment-amount', function(event) {
			event.preventDefault();
			if ($('.accTotal').val()) {
				
				let pay_amt = parseInt($(this).val());
				let due_amt = parseInt($('.accDue').val());

				if (pay_amt > due_amt) {

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

		$(document).on('click', '.print-bill', function(event) {
			let PID = $('.patient-code').val(), loc = '';

			if (PID != '' && PID != 'New') {

				if ($(this).hasClass('final-bill')) {
					loc = '<?=base_url('patient/indoor/final-bill')?>/'+PID;
					location.reload();
				}else{
					loc = '<?=base_url('patient/indoor/provisional-bill')?>/'+PID;
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

		$(document).on('click', '.FinalSubmit', function(event) {
			let PID = $('.patient-code').val(), loc = '';
			
			if (PID != '' && PID != 'New') {
				
				let text = $('.patient-code').find(':selected').text();
				$('#disPatient').val(PID);
				$('.modal-footer').html('<button type="submit" class="btn btn-primary btn-block">Discharge Patient : '+text+'</button>');

				$('#FinalSubmit').modal('show');

			}else{ 
				event.preventDefault();
				event.stopPropagation();
				return $.growl.warning({
					message: "Please select patient first..."
				});
			}
		});

		$(document).on('change', '.disType', function(event){
			let disType = $(this).val();

			if (disType == 'N/A') {
				$('.afterDis').slideUp();
				$('.disVal').attr('readonly', 'True').val('00');
			
			} else {
				$('.afterDis').slideDown();
				$('.disVal').removeAttr('readonly');
				discountAmount();
			}
		});

		$(document).on('keyup', '.disVal', function(event) {
			event.preventDefault();
			discountAmount();
		});

		function discountAmount(){

			var disType   = $('.disType').val();
			var disVal    = parseInt($('.disVal').val());

			var accTotal  = Math.floor(parseInt($('.accTotal').val()));
			var accPaid   = Math.floor(parseInt($('.accPaid').val()));

			if (disType == 'Amount') {

				$('.accDisTotal').val(accTotal - disVal);
				$('.accDisDue').val((accTotal - disVal) - accPaid);

			}else{

				disVal = (accTotal * disVal) / 100;

				$('.accDisTotal').val(accTotal - disVal);
				$('.accDisDue').val((accTotal - disVal) - accPaid);
			}

		}

		$('#DischargeForm').submit(function(event){
			event.preventDefault();

			var Data = $('#DischargeForm').serialize();
			let PID = $('.patient-code').val();

			$.ajax({
				url: "<?=base_url('patient/discharge')?>",
				type: 'POST',
				dataType: 'json',
				data: {formData: Data},
			})
			.done(function(res) {
				console.log(res);

				window.open("<?=base_url('patient/indoor/final-bill/')?>"+PID, '_blank');
				location.reload();
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		});

		$(document).ready(function(event){
			let TrData = $(this).closest('tr').find('td:eq(3)');

			$.ajax({
				url: '<?=base_url('h_ajax/GetMyData')?>',
				type: 'POST',
				dataType: 'json',
				data: {Data: TrData},
			})
			.done(function(response) {
				console.log(response);

				$('.Patient').hide('slow', function() {
					$(document).removeClass('row');
					$('.MyRow').prepend('Some text')
					$('.MyRow').after('Some text')
				});

				$('form').find('input,select,textarea').each(function(index, el) {
					let Name = $(this).prop('name');
					$(this).val(response[name]);
				});
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});

		});

    });

</script>