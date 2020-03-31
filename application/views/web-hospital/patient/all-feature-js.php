<script type="text/javascript">
    jQuery(document).ready(function($) {

var WardSalineDiv = '\
    <div class="row">\
        <div class="col-md-4">\
            <div class="form-group">\
                <label class="form-label">Select Ward Saline <span class="text-danger">*</span></label>\
                <select class="form-control WardSalineName" name="WardSalineName[]">\
                    <option value="" hidden="true">Select Saline</option>\
                </select>\
            </div>\
        </div>\
        <div class="col-md-3">\
            <label class="form-label">Ward Saline Amount</label>\
            <input type="number" name="WardSalineAmount[]" class="form-control WardSalineAmount">\
        </div>\
        <div class="col-md-3">\
            <label class="form-label">Ward Saline Quantity</label>\
            <input type="number" name="WardSalineQty[]" value="1" min="1" class="form-control WardSalineQty">\
        </div>\
        <div class="col-md-2 text-center">\
            <label class="form-label">&nbsp;</label>\
            <span href="#" class="btn btn-outline-primary AddRow"><i class="fas fa-plus"></i></span>\
            <span href="#" class="btn btn-outline-danger RemoveRow"><i class="fas fa-times"></i></span>\
        </div>\
    </div>\
';
var OTSalineDiv = '\
    <div class="row">\
        <div class="col-md-4">\
            <div class="form-group">\
                <label class="form-label">Select OT Saline <span class="text-danger">*</span></label>\
                <select class="form-control OTSalineName" name="OTSalineName[]">\
                    <option value="" hidden="true">Select Saline</option>\
                </select>\
            </div>\
        </div>\
        <div class="col-md-3">\
            <label class="form-label">OT Saline Amount</label>\
            <input type="number" name="OTSalineAmount[]" class="form-control OTSalineAmount">\
        </div>\
        <div class="col-md-3">\
            <label class="form-label">OT Saline Quantity</label>\
            <input type="number" name="OTSalineQty[]" value="1" min="1" class="form-control OTSalineQty">\
        </div>\
        <div class="col-md-2 text-center">\
            <label class="form-label">&nbsp;</label>\
            <span href="#" class="btn btn-outline-primary AddRow"><i class="fas fa-plus"></i></span>\
            <span href="#" class="btn btn-outline-danger RemoveRow"><i class="fas fa-times"></i></span>\
        </div>\
    </div>\
';
var AssDoctor = '\
    <div class="row">  \
        <div class="col-md-4">\
            <div class="form-group">\
                <label class="form-label">Asst. Doctor Name <span class="text-danger">*</span></label>\
                <input type="text" name="AssDoctorName" class="form-control AssDoctorName">\
            </div>\
        </div>\
        <div class="col-md-3">\
            <div class="form-group">\
                <label class="form-label">Fees <span class="text-danger">*</span></label>\
                <input type="number" name="AssDoctorFees" class="form-control AssDoctorFees" value="100" min="100">\
            </div>\
        </div>\
        <div class="col-md-3">\
            <div class="form-group">\
                <label class="form-label">Visit <span class="text-danger">*</span></label>\
                <input type="number" name="AssDoctorVisit" class="form-control AssDoctorVisit" value="1">\
            </div>\
        </div>\
        <div class="col-md-2 text-center">\
            <label class="form-label">&nbsp;</label>\
            <span href="#" class="btn btn-outline-primary AddRow"><i class="fas fa-plus"></i></span>\
            <span href="#" class="btn btn-outline-danger RemoveRow"><i class="fas fa-times"></i></span>\
        </div>\
    </div>\
';
var SpecialDoctor = '\
    <div class="row">\
        <div class="col-md-4">\
            <div class="form-group">\
                <label class="form-label">Special Doctor Name <span class="text-danger">*</span></label>\
                <input type="text" name="SpecialDoctorName" class="form-control SpecialDoctorName">\
            </div>\
        </div>\
        <div class="col-md-3">\
            <div class="form-group">\
                <label class="form-label">Fees <span class="text-danger">*</span></label>\
                <input type="number" name="SpecialDoctorFees" class="form-control SpecialDoctorFees" value="100" min="100">\
            </div>\
        </div>\
        <div class="col-md-3">\
            <div class="form-group">\
                <label class="form-label">Visit <span class="text-danger">*</span></label>\
                <input type="number" name="SpecialDoctorVisit" class="form-control SpecialDoctorVisit" value="1">\
            </div>\
        </div>\
        <div class="col-md-2 text-center">\
            <label class="form-label">&nbsp;</label>\
            <span href="#" class="btn btn-outline-primary AddRow"><i class="fas fa-plus"></i></span>\
            <span href="#" class="btn btn-outline-danger RemoveRow"><i class="fas fa-times"></i></span>\
        </div>\
    </div>\
';

    	$(document).on('click', '.RefundAmt', function(event) {
            $('.TotalAmt').val($(this).closest('tr').find('td:eq(3)').text());
            $('.PaidAmt').val($(this).closest('tr').find('td:eq(4)').text());
            $('.DiscountAmt').val($(this).closest('tr').find('td:eq(5)').text());
            $('.TotalPaidAmt').val($(this).closest('tr').find('td:eq(6)').text());
            $('.PatientID').val($(this).closest('tr').prop('id'));
            var DueAmt = parseInt($(this).closest('tr').find('td:eq(3)').text())-parseInt($(this).closest('tr').find('td:eq(6)').text());
            if (DueAmt > 0) $('.DueAmt').val(DueAmt);
            else $('.DueAmt').val('');
        });
        $(document).on('change', '.OTSalineName', function(event) {
    		var id  = $(this).val();
    		var amt = $(this).closest('.row').find('.OTSalineAmount');

    		$.ajax({
    			url: '<?=base_url('h_ajax/GetSalineData')?>',
    			type: 'POST',
    			dataType: 'json',
    			data: {sID: id},
    		})
    		.done(function(res) {
    			amt.val(res.nonbeneficiaries);
    		})
    		.fail(function() { console.log("error"); });
    		
    	});

        $(document).on('change', '.WardSalineName', function(event) {
            var id  = $(this).val();
            var amt = $(this).closest('.row').find('.WardSalineAmount');
            $.ajax({
                url: '<?=base_url('h_ajax/GetSalineData')?>',
                type: 'POST',
                dataType: 'json',
                data: {sID: id},
            })
            .done(function(res) {
                amt.val(res.nonbeneficiaries);
            })
            .fail(function() { console.log("error"); });
        });

    	$(document).on('click', '.AddRow, .RemoveRow', function(event) {
    		if($(this).hasClass('RemoveRow')){
    			$(this).closest('.row').remove();
    		}else{
    			var Row = $(this).closest('.row').html();
    			var Data = '<div class="row">'+Row+'</div>';
                $(this).closest('.row').parent('div').append(Data);
                $(this).remove();
    		}
    	});

    	$(document).on('change', '.PathologyTest', function(event) {
    		var type  = $(this).val();
    		var Ptype = $('.PatientType').val();
    		$.ajax({
    			url: '<?=base_url('h_ajax/GetPathologyTest')?>',
    			type: 'POST',
    			dataType: 'json',
    			data: {Type: type, pType: Ptype},
    		})
    		.done(function(res) {
    			$('.OtherPathologyDiv').html(res);
    		})
    		.fail(function() { console.log("error"); });
    	});

    	$(document).on('change', '.PathologyTestName', function(event) {
    		$(this).closest('.row').find('.TestAmount').val($(this).children("option:selected").attr('amt'));
    	});

    	$(document).on('click', '.PathologyBtn', function(event) {
    		if($(this).hasClass('RemovePathology')){
    			$(this).closest('.row').remove();
    		}else{
    			var Row = $(this).closest('.row').html();
    			var Data = '<div class="row">'+Row+'</div>';
    			$(this).removeClass('AddPathology btn-outline-primary').addClass('RemovePathology btn-outline-danger').html('<i class="fas fa-times"></i>');
    			$('.OtherPathologyDiv').append(Data);
    		}
    	});

    	$(document).on('change', '.OtherFacility', function(event) {
    		var Cat = $(this).val();

            var pType = $('.PatientType').val();
            //var Code  = new Array('G00031', 'G00029', 'G00003', 'G00015', 'G00025', 'G00033', 'G00022', 'G00024', 'G00005', 'G00004');
            var Code  = new Array('G00031', 'G00003', 'G00015', 'G00033', 'G00005', 'G00004');

    		if (Cat == 'Doctor') {
                $('.SpecialDoctor').html(SpecialDoctor);
                $('.SpecialDoctor').show('slow');
            }
            else if(Cat == 'Ass. Doctor') {
                $('.AssDoctor').html(AssDoctor);
                $('.AssDoctor').show('slow');
            }
            else if(Cat == 'O.T SALINE') {
                $('.OTSalineDiv').html(OTSalineDiv);
                $('.OTSalineDiv').show('slow');

                $.ajax({
                    url: '<?=base_url('h_ajax/GetSaline')?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {Cat: Cat},
                })
                .done(function(res) {
                    $('.OTSalineName').html(res);
                })
                .fail(function() { console.log("error"); });
            }
            else if(Cat == 'WARD SALINE') {
                $('.WardSalineDiv').html(WardSalineDiv);
                $('.WardSalineDiv').show('slow');

                $.ajax({
                    url: '<?=base_url('h_ajax/GetSaline')?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {Cat: Cat},
                })
                .done(function(res) {
                    $('.WardSalineName').html(res);
                })
                .fail(function() { console.log("error"); });
            }
            else if(Cat == 'Pathology') {
                $.ajax({
                    url: '<?=base_url('h_ajax/GetPathologyType')?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {param: 'value'},
                })
                .done(function(res) {
                    $('.OtherFacilityCol4').html(res);
                })
                .fail(function() { console.log("error"); });
            }
            else if(jQuery.inArray(Cat, Code) !== -1) {
                $('.OtherFacilityCol4').html('');
                
                $.ajax({
                    url: '<?=base_url('h_ajax/GetOutdoorFclty')?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {Cat: Cat, pType: pType},
                })
                .done(function(res) {
                    $('.OtherFacilityCol4').html(res);
                    //console.log(res)
                })
                .fail(function() { console.log("error"); });
            }
            else $('.SpecialDoctor, .AssDoctor, .OTSalineDiv, .WardSalineDiv').hide('fast');
           
    	});

        $(document).on('change', '.OtherFacilityItem', function(event) {
            event.preventDefault();
            let amt = $('.OtherFacilityItem').find('option:selected').attr('amt');
            var HTML = '\
                <div class="form-group">\
                    <label class="form-label">Amount <span class="text-danger">*</span></label>\
                    <input type="text" class="form-control OtherFacilityItemAmt fac-amt" min="'+amt+'" value="'+amt+'" style="width: 25%">\
                </div>\
            ';
            $('.OtherPathologyDiv').html(HTML);
        });

    	$(document).on('click', '.AddOtherFacility', function(event) {
    		$(this).html('Please wait a moment <i class="fa fa-spinner fa-spin ml-2"></i>').attr('disabled', 'true');
    		var Category = $('.OtherFacility').val(), error = 0;
    		if (Category) {
                if (Category == 'Pathology') {
        			$('.OtherPathologyDiv').find('input,select').each(function(index, el) {
                        if (!$(this).val()) {
                            $(this).removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                            ++error;
                        }
                    });
                    if (error == 0) {
                        var PathologyTestName   = new Array(); $('.PathologyTestName').each(function(index, el) { PathologyTestName.push($(this).val()); });
                        var TestAmount = new Array(); $('.TestAmount').each(function(index, el) { TestAmount.push($(this).val()); });

                        var Data = [PathologyTestName, TestAmount, $('.PathologyTest').val()];
                    }
                } else {
                    var Data = [$('.OtherFacility').val(), $('.OtherFacilityItem').val(), $('.OtherFacilityItemAmt').val()];
                }
    			if (error == 0) {
    				$.ajax({
    					url: '<?=base_url('h_ajax/OtherFacility')?>',
    					type: 'POST',
    					dataType: 'json',
    					data: {Category: Category, Data: Data, pID: $('.patient-code').val()},
    				})
    				.done(function(res) {
    					$('#particular-data').append(res.Data);
    					//console.log(res);
    					$('.AddOtherFacility').html('Add Other Facility').removeAttr('disabled');
    					$('.OtherFacilityCol4, .OtherPathologyDiv').html('');
    					$('.OtherFacility').val(''); 

    					event.preventDefault();
						event.stopPropagation();
						return $.growl.notice({ message: "Other Facility added." });
    				})
    				.fail(function() {
    					$('.AddOtherFacility').html('Add Other Facility').removeAttr('disabled');
		    			event.preventDefault();
						event.stopPropagation();
						return $.growl.error({ message: "Oops...!! looks like an error occurred." });
    				});
    				
    			}else $('.AddOtherFacility').html('Add Other Facility').removeAttr('disabled');
    			$('.AddOtherFacility').html('Add Other Facility').removeAttr('disabled');
    		}else{
    			$('.AddOtherFacility').html('Add Other Facility').removeAttr('disabled');
    			event.preventDefault(); event.stopPropagation();
				return $.growl.warning({ message: "Please select Other Facility." });
    		}
    	});

    	$(document).on('blur', '.fac-amt', function(event) {
    		var fAmt = $(this).val(); var mAmt = $(this).attr('min'); if (fAmt < mAmt) $(this).val(mAmt);
    	});	
    	$(document).on('change', '.SelectCabin', function(event) {
    		var cabin = $(this).val(); var pType = $('.PatientType').val();
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
    			event.preventDefault(); event.stopPropagation();
				return $.growl.warning({ message: "Please select patient type." });
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
				event.preventDefault(); event.stopPropagation();
				return $.growl.warning({ message: "Please select registered patient first..." });
			}
    	});
		
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

                var Link = '<a href="<?=base_url('patient/update-facility/')?>'+pid+'" class="btn btn-sm btn-primary float-left">Update Facility</a> Facility Details';
                $('.UpdateFacility').html(Link);

        		/*$('.BasicCharges').slideDown('slow');
        		$('.FacilityChargesRow').slideDown('slow');
        		$('.PaymentDetailsRow').slideDown('slow');*/
        		$('.RegisteredPatient').slideDown('slow');
        		$('.AdvancePaymentRow').slideUp('slow');

                $('.tret-faci-cat, .tret-faci-subcat').val('');

                $('.myFacility, .SpecialDoctor, .AssDoctor, .OTSalineDiv, .WardSalineDiv').html('');

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
	        	/*$('.BasicCharges').slideUp('slow');
	        	$('.FacilityChargesRow').slideUp('slow');
	        	$('.PaymentDetailsRow').slideUp('slow');*/
	        	
	        	$('.RegisteredPatient').slideUp('slow');
	        	$('.AdvancePaymentRow').slideDown('slow');

	        	$('.AdvanceTitle').html('Advance Payment');

	        	$('.patient-details-box').find('input,select,textarea').each(function(index, el) {
        			$(this).val('');
        		});
        		$('#particular-data').html('');

        		$(".account-details-box").hide('slow');

        		$('.myWard').html('<option value="" hidden="true">Select Ward</option><option value="" disabled="true">Select Department First.</option>');
        		$('.myBed').html('<option value="" hidden="true">Select Bed</option><option value="" disabled="true">Select Ward First.</option>');
        	}
        	
        });

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
                $(this).html('Please wait a moment <i class="fa fa-spinner fa-spin ml-2"></i>').attr('disabled', 'true');

				let error = 0, pid = $('.patient-code').val(); OpSurgeon = $('.OperativeSurgeon').val();

                $('.SpecialDoctor, .AssDoctor, .OTSalineDiv, .WardSalineDiv').find('input,select').each(function(index, el) {
                    if (!$(this).val()) {
                        $(this).removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                        ++error;
                    } else $(this).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
                });
				
				let ParticularName = new Array(); let ParticularAmt  = new Array(); let ParticularID   = new Array();
				$('.myFacility').find('.fac-nme').each(function(index, el) { ParticularName.push($(this).val()); });
				$('.myFacility').find('.fac-amt').each(function(index, el) { ParticularAmt.push($(this).val()); });
				$('.myFacility').find('.fac-id').each(function(index, el) { ParticularID.push($(this).val()); });

                var SpecialDoctorName  = new Array(); var SpecialDoctorFees  = new Array(); var SpecialDoctorVisit = new Array();
                $('.SpecialDoctor').find('.SpecialDoctorName').each(function(index, el) { SpecialDoctorName.push($(this).val()); });
                $('.SpecialDoctor').find('.SpecialDoctorFees').each(function(index, el) { SpecialDoctorFees.push($(this).val()); });
                $('.SpecialDoctor').find('.SpecialDoctorVisit').each(function(index, el) { SpecialDoctorVisit.push($(this).val()); });
                var SpecialDoctor = [SpecialDoctorName, SpecialDoctorFees, SpecialDoctorVisit, 'Doctor'];

                var AssDoctorName  = new Array(); var AssDoctorFees  = new Array(); var AssDoctorVisit = new Array();
                $('.AssDoctor').find('.AssDoctorName').each(function(index, el) { AssDoctorName.push($(this).val()); })
                $('.AssDoctor').find('.AssDoctorFees').each(function(index, el) { AssDoctorFees.push($(this).val()); })
                $('.AssDoctor').find('.AssDoctorVisit').each(function(index, el) { AssDoctorVisit.push($(this).val()); });
                var AssDoctor = [AssDoctorName, AssDoctorFees, AssDoctorVisit, 'Asst. Doctor'];

                var OTSalineName  = new Array(); var OTSalineAmount  = new Array(); var OTSalineQty = new Array();
                $('.OTSalineDiv').find('.OTSalineName').each(function(index, el) { OTSalineName.push($(this).val()); })
                $('.OTSalineDiv').find('.OTSalineAmount').each(function(index, el) { OTSalineAmount.push($(this).val()); })
                $('.OTSalineDiv').find('.OTSalineQty').each(function(index, el) { OTSalineQty.push($(this).val()); });
                var OTSalineDiv = [OTSalineName, OTSalineAmount, OTSalineQty, 'O.T SALINE'];

                var WardSalineName  = new Array(); var WardSalineAmount  = new Array(); var WardSalineQty = new Array();
                $('.WardSalineDiv').find('.WardSalineName').each(function(index, el) { WardSalineName.push($(this).val()); })
                $('.WardSalineDiv').find('.WardSalineAmount').each(function(index, el) { WardSalineAmount.push($(this).val()); })
                $('.WardSalineDiv').find('.WardSalineQty').each(function(index, el) { WardSalineQty.push($(this).val()); });
                var WardSalineDiv = [WardSalineName, WardSalineAmount, WardSalineQty, 'WARD SALINE'];

                var OtherFacility = [SpecialDoctor, AssDoctor, OTSalineDiv, WardSalineDiv];

				if((ParticularName.length) && error == 0){	
					$.ajax({
						url: '<?=base_url('H_Ajax/PostParticularNew')?>',
						type: 'POST',
						dataType: 'json',
						data: {Name: ParticularName, ID: ParticularID, Amt: ParticularAmt, pID: pid, OpSurgeon: OpSurgeon, OtherFacility: OtherFacility, FacilityDate: $('.FacilityDate').val()},
					})
					.done(function(res) {
						//console.log(res);
                        $('.particular-add').html('Add Other Facility').removeAttr('disabled');
                        $('.tret-faci-cat, .tret-faci-subcat').val('');
						$('.myFacility, .SpecialDoctor, .AssDoctor, .OTSalineDiv, .WardSalineDiv').html('');
						$('#particular-data').append(res);

						event.preventDefault(); event.stopPropagation();
						return $.growl.notice({ message: "Particular added." });
					})
					.fail(function() {
                        $('.particular-add').html('Add Other Facility').removeAttr('disabled');
						console.log("error");
					});
				}else{
                    $('.particular-add').html('Add Other Facility').removeAttr('disabled');

					event.preventDefault(); event.stopPropagation();
					return $.growl.warning({ message: "Please select particular & all mandatory fields..." });	
				}
			}else{ 
				event.preventDefault(); event.stopPropagation();
				return $.growl.warning({ message: "Please select registered patient first..." });
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
			.done(function(res) { console.log(res); tr.remove(); })
			.fail(function() { console.log("error"); });
		});

		/*$(document).on('keyup', '.payment-amount', function(event) {
			event.preventDefault();
			if ($('.accTotal').val()) {
				
				let pay_amt = parseInt($(this).val());
				let due_amt = parseInt($('.accDue').val());

				if (pay_amt > due_amt) {

					$(this).val(null);
					event.preventDefault(); event.stopPropagation();
					return $.growl.warning({ message: "Amount is more then Total Amount..." });		
				}

			}else{

				$(this).val(null);
				event.preventDefault(); event.stopPropagation();
				return $.growl.warning({ message: "Please select patient first..." });

			}
		});*/

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
				event.preventDefault(); event.stopPropagation();
				return $.growl.warning({ message: "Please select patient first..." });
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
				event.preventDefault(); event.stopPropagation();
				return $.growl.warning({ message: "Please select patient first..." });
			}
		});

		$(document).on('change', '.disType', function(event){
			let disType = $(this).val();

			if (disType == 'N/A') {
				$('.afterDis').slideUp();
				$('.disVal').attr('readonly', 'True').val('00');
			
			} else {
				$('.afterDis').slideDown();
				$('.disVal').removeAttr('readonly').val('');
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

			if (disType == 'Amount' && disVal) {

				// $('.accDisTotal').val(accTotal - disVal);
                var accDisDue = (accTotal - disVal) - accPaid;
				$('.accDisDue').val((accDisDue >= 0) ? accDisDue : 0);

			} else if (disType == 'Percentage' && disVal) {

				disVal = (accTotal * disVal) / 100;

				// $('.accDisTotal').val(accTotal - disVal);
                var accDisDue = (accTotal - disVal) - accPaid;
				$('.accDisDue').val((accDisDue >= 0) ? accDisDue : 0);
			
            } else {
                if(disVal){
                    // $('.accDisTotal').val(accTotal - disVal);
                    var accDisDue = (accTotal - disVal) - accPaid;
                    $('.accDisDue').val((accDisDue >= 0) ? accDisDue : 0);
                }
            }

		}

		$('#DischargeForm').submit(function(event){
			event.preventDefault();

            var stat = true;

            if($('.due-amt-check').is(':checked')){
                if ($('.accDisDue').val() > 0) stat = false;
            }

            if(stat){
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
    			.fail(function() { console.log("error"); });
            } else {
                alert('Due amount must be 0.00');
            }
		})

    });

</script>