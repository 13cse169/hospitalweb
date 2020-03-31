<script type="text/javascript">
	jQuery(document).ready(function($) {
        $(document).on('change', '.EmergencyFacility', function(event) {
            var type = $(this).val();
            if (type == 'Special Doctor') {
                $('.SpecialDoctor').show('fast', function() {
                    $('.AmountFee').val(100);
                    $('.OtherPathologyDiv').html('');
                }); show('slow');
            }else if (type == 'Miscellaneous') {
                $('.SpecialDoctor').hide('fast');
                $('.AmountFee').val('');
            }else{
                $('.SpecialDoctor').hide('fast');
                $('.AmountFee').val($(this).children("option:selected").attr('data-amt'));
                event.preventDefault();event.stopPropagation();
            }
        });
        $('.PatientName').focus();
        $('input, select').keydown( function(event) {
            var key = event.charCode ? event.charCode : event.keyCode ? event.keyCode : 0;
            if(key == 13) {
                if($(this).val() == ''){
                    event.preventDefault();
                    $(this).removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                }else{
                    event.preventDefault();
                    var inputs = $(this).closest('form').find(':input:visible');
                    inputs.eq( inputs.index(this)+ 1 ).focus();
                }
            }
        });
		$(document).on('change', '.USGSelect, .XRaySelect', function(event) {
            $(this).closest('.row').find('.xray-usg-fee').val($(this).children("option:selected").attr('data-amt'));
            //$('.AmountFee').val($(this).children("option:selected").attr('data-amt'));
        });
        $(document).on('change', '.FacilityHead', function(event) {
			var type = $(this).val();
			if (type == 'Emergency Facility') {
				$('.Pathology, .SpecialDoctor, .USG, .XRay').hide('fast', function() {
                    $('.OtherPathologyDiv').html('');
				    $('.EmergencyFacilityDiv').show('slow');
                    $('.AmountFee').val('');
                });
                $('.AmountDiv').show('fast');
			} else if (type == 'Pathology') {
				$('.SpecialDoctor, .EmergencyFacilityDiv, .USG, .XRay, .AmountDiv').hide('fast', function() {
                    $('.OtherPathologyDiv').html('');
				    $('.Pathology').show('slow');
                    $('.AmountFee').val('');
                });
			} else if (type == 'U.S.G') {
                $('.AmountDiv').show('fast');
				$('.Pathology, .SpecialDoctor, .EmergencyFacilityDiv, .XRay, .AmountDiv').hide('fast', function() {
                    $('.OtherPathologyDiv').html('');
				    $('.USG').show('slow');
                    $('.AmountFee').val('');
                });
			} else if (type == 'X-Ray') {
                $('.AmountDiv').show('fast');
				$('.Pathology, .SpecialDoctor, .EmergencyFacilityDiv, .USG, .AmountDiv').hide('fast', function() {
                    $('.OtherPathologyDiv').html('');
				    $('.XRay').show('slow');
                    $('.AmountFee').val('');
                });
			} else {
                $('.AmountFee').val($(this).children("option:selected").attr('data-amt'));
                $('.AmountDiv').show('fast');
                $('.Pathology, .SpecialDoctor, .EmergencyFacilityDiv, .USG, .XRay').hide('fast', function() {
                    $('.OtherPathologyDiv').html('');
                });
			}
		});

		$(document).on('blur', '.RegistrationFee, .ServiceCharge', function(event) {
			if ($(this).val() < $(this).attr('data-amt')) $(this).val($(this).attr('data-amt'));
		});

		$(document).on('change', '.PathologyTestName', function(event) {
    		$(this).closest('.row').find('.TestAmount').val($(this).children("option:selected").attr('amt'));
    	});

		$(document).on('change', '.PathologyTest', function(event) {
    		var type  = $(this).val();
    		var Ptype = 'NB';
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

    	$(document).on('click', '.PathologyBtn', function(event) {
    		if($(this).hasClass('RemovePathology')){
    			$(this).closest('.row').remove();
    		}else{
    			var Row = $(this).closest('.row').html();
    			var Data = '<div class="row">'+Row+'</div>';
    			$(this).removeClass('AddPathology btn-outline-primary').addClass('RemovePathology btn-outline-danger').html('<i class="fas fa-times"></i>');
    			//$('.OtherPathologyDiv').append(Data);
                $(this).closest('.row').parent('div').append(Data);
    		}
    	});

    	$(document).on('change', '.patient-code', function(event) {
    		var PID = $(this).val();
    		if (PID == 'New') {
    			alert('New');
    		} else {
    			$.ajax({
    				url: '<?=base_url('h_ajax/getemergencypatient')?>',
    				type: 'POST',
    				dataType: 'json',
    				data: {PID: PID},
    			})
    			.done(function(res) {
                    $('form').find('input,select,textarea').each(function(index, el) {let name = $(this).attr('name');$(this).val(res[0][name]);});
                    $('.ReferredBy').val(res[1].doctor_id);$('.AllotmentDate').val(res[1].allotment_date);$('.AllotmentTime').val(res[1].allotment_time);$('#tBody').html(res[2]);
    			})
    			.fail(function() {
    				event.preventDefault();
                    event.stopPropagation();
                    return $.growl.error({ message: "Oops...!! looks like an error occurred." });
    			});
    			
    		}
    	});
	});
</script>