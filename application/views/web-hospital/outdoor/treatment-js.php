<script type="text/javascript">
    jQuery(document).ready(function($) {
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

        $(document).on('change', '.ReferredBy', function(event) {
            if($(this).val() == 'Name') $('.ReferredByName').show('fast');
            else $('.ReferredByName').hide('fast');
        });
/*
        $('#OutdoorTreatmentForm').submit(function(event) {
            event.preventDefault();
            var FormData = $(this).serialize();

            $('#OutdoorTreatmentForm').find(':submit').attr('disabled', 'true');

            var error = 0;
            $(this).find('input,textarea,select').each(function(){ if($(this).hasClass('required')){ if ($(this).val() == '') ++error; } });

            if (error == 0) {
                $.ajax({
                    url: '<?=base_url('outdoor/')?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {Data: FormData},
                })
                .done(function(res) {
                    window.open("<?=base_url('outdoor/ticket/')?>"+res, '_blank');
                    location.reload();

                })
                .fail(function() {
                    $('#OutdoorTreatmentForm').find(':submit').html('<span>Save</span>');

                    event.preventDefault();
                    event.stopPropagation();
                    return $.growl.error({
                        message: "Oops looks like an error occurred."
                    });

                });
            }

            $('#OutdoorTreatmentForm').find(':submit').removeAttr('disabled');
            
        });
*/
    	$(document).on('change', '.Category', function(event) {
    		let gID = $(this).val();
            let Row = $(this).closest('.row');

            if(Row.find('.ParticularAmount').val())
                $('.TotalAmount').val(parseInt($('.TotalAmount').val()) - parseInt(Row.find('.ParticularAmount').val()));

            Row.find('.ParticularAmount').val('');

    		$.ajax({
                url: '<?=base_url('outdoor/getOutDoorFacility')?>',
                type: 'POST',
                dataType: 'json',
                data: {CatID: gID},
            })
            .done(function(res) { Row.find('.particular').html(res); })
            .fail(function() { console.log("error"); });
    	});
        $(document).on('change', '.particular', function(event) {
            let pID = $(this).val();
            var pType = $('.PatientType').val();
            let Row = $(this).closest('.row');
            let Total = 0;
            if (pType) {
                $.ajax({
                    url: '<?=base_url('outdoor/getFacilityAmount')?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {pID: pID, pType: pType},
                })
                .done(function(res) { 
                    Row.find('.ParticularAmount').val(res); 

                    $('.ParticularAmount').each(function(index, el) { Total += parseInt($(this).val()); });
                    $('.TotalAmount').val(Total);
                })
                .fail(function() { console.log("error"); });
            } else {
                $(this).val('');

                event.preventDefault();
                event.stopPropagation();
                return $.growl.warning({
                    message: "Please select patient type."
                });
            }
        });
        $(document).on('change', '.PatientType', function(event) {
            let pType = $(this).val();
            var pID   = $('.particular').val();

            if (pID) {
                $.ajax({
                    url: '<?=base_url('outdoor/getFacilityAmount')?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {pID: pID, pType: pType},
                })
                .done(function(res) { $('.ParticularAmount').val(res); })
                .fail(function() { console.log("error"); });
            }
        });
        $(document).on('click', '.ParticularBtn', function(event) {
            if($(this).hasClass('RemoveParticular')){

                let Row = $(this).closest('.row');
                $('.TotalAmount').val(parseInt($('.TotalAmount').val()) - parseInt(Row.find('.ParticularAmount').val()));
                Row.remove();
                //$(this).closest('.row').remove();

            }else{
                var Cat = $(this).closest('.row').find('.Category').val();
                $('.ParticularDiv').append('<div class="row">'+$(this).closest('.row').html()+'</div>');
                $('.Category').last().val(Cat);
                $(this).removeClass('AddParticular btn-outline-primary').addClass('RemoveParticular btn-outline-danger').html('<i class="fas fa-times"></i>');
            }
        });

        $(document).on('change', '.disType', function(event) {
            if ($(this).val() == 'N/A') $('.disVal').val('00').attr('readonly', 'true');
            else {
                $('.disVal').val('00').removeAttr('readonly');
                $('.AfterDiscount').val('');
            }
        });

        $(document).on('keyup', '.disVal', function(event) {
            var disVal = $(this).val(), Total  = $('.TotalAmount').val();
            
            if ($('.disType').val() == 'Percentage') var Amt = ((Total) - ((Total * disVal) / 100));
            else var Amt = (parseInt(Total) - parseInt(disVal)); 

            $('.AfterDiscount').val(Amt);
        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(document).on('click', '#PrintBill', function(event) {
            $('#UpdateParticular').hide('fast');
            $(this).hide('fast', function() {
                window.print();
            });
            $(this, '#UpdateParticular').show('fast');
        });
    });
</script>
