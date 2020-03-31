<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="msapplication-TileColor" content="#0061da">
		<meta name="theme-color" content="#1643a3">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/favicon.ico')?>" />
		<title>Web Hospital</title>
		<link rel="stylesheet" href="<?=base_url('assets/fonts/fonts/font-awesome.min.css')?>">
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
		<link href="<?=base_url('assets/css/dashboard.css')?>" rel="stylesheet" />
                <link href="<?=base_url('assets/plugins/notify/css/jquery.growl.css')?>" rel="stylesheet" />
		<link href="<?=base_url('assets/css/mystyle.css')?>" rel="stylesheet" />
		<link href="<?=base_url('assets/plugins/charts-c3/c3-chart.css')?>" rel="stylesheet" />
		<link href="<?=base_url('assets/plugins/morris/morris.css')?>" rel="stylesheet" />
		<link href="<?=base_url('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css')?>" rel="stylesheet" />
		<link href="<?=base_url('assets/plugins/iconfonts/plugin.css')?>" rel="stylesheet" />
		<link href="<?=base_url('assets/plugins/accordion/accordion.css')?>" rel="stylesheet" />
		<link href="<?=base_url('assets/css/dropify.min.css')?>" rel="stylesheet" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link href="<?=base_url('assets/plugins/datatable/dataTables.bootstrap4.min.css')?>" rel="stylesheet" />
                <link href="<?=base_url('assets/plugins/select2/select2.min.css')?>" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

                <!-------Datatable Export--->
                <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">
	</head>
	<body class="" >
		<div id="global-loader" ></div>
		<div class="page" >
			<div class="page-main">
				
				<?php $this->load->view('web-hospital/layout/nav-bar') ?>
				
				<?php $this->load->view('web-hospital/layout/menu-bar') ?>

				<div class="my-3 my-md-5">
					<div class="container">
						
						<?php $this->load->view($load) ?>						
						
					</div>
				</div>

			</div>
		</div>

		<!--footer-->
		<footer class="footer">
			<div class="container">
				<div class="row align-items-center flex-row-reverse">
					<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
						Copyright © 2018 <a href="#">Viboon</a>. Designed by <a href="#">Spruko</a> All rights reserved.
					</div>
				</div>
			</div>
		</footer>
		<!-- End Footer-->

	</body>
	
	<!-- Dashboard Core -->
	<script src="<?=base_url('assets/js/vendors/jquery-3.2.1.min.js')?>"></script>
	<script src="<?=base_url('assets/js/vendors/bootstrap.bundle.min.js')?>"></script>
	<script src="<?=base_url('assets/js/vendors/jquery.sparkline.min.js')?>"></script>
	<script src="<?=base_url('assets/js/vendors/selectize.min.js')?>"></script>
	<script src="<?=base_url('assets/js/vendors/jquery.tablesorter.min.js')?>"></script>
	<script src="<?=base_url('assets/js/vendors/circle-progress.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/rating/jquery.rating-stars.js')?>"></script>
	<script src="<?=base_url('assets/plugins/accordion/accordion.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/input-mask/jquery.mask.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/morris/morris.js')?>"></script>
	<script src="<?=base_url('assets/plugins/morris/raphael-min.js')?>"></script>
	<script src="<?=base_url('assets/js/index3.js')?>"></script>
	<script src="<?=base_url('assets/plugins/charts-c3/d3.v5.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/charts-c3/c3-chart.js')?>"></script>
        <script src="<?=base_url('assets/plugins/echarts/echarts.js')?>"></script>
	<script src="<?=base_url('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')?>"></script>
	<script src="<?=base_url('assets/js/custom.js')?>"></script>
	<script src="<?=base_url('assets/js/dropify.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/select2/select2.full.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/select2/select2.full.min.js')?>"></script>
        <script src="<?=base_url('assets/js/select2.js')?>"></script>
	<script src="<?=base_url('assets/plugins/datatable/jquery.dataTables.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/datatable/dataTables.bootstrap4.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/notify/js/rainbow.js')?>"></script>
        <script src="<?=base_url('assets/plugins/notify/js/sample.js')?>"></script>
        <script src="<?=base_url('assets/plugins/notify/js/jquery.growl.js')?>"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!-----Datatable Export ----->

       <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
       <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
       <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
       <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            $('.fc-datepicker').mask('00-00-0000');
        });     
    </script>

 <script>
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print',
                title: '<table width="100%"><tr align="center"><td style="width: 20%;"><img src="<?=base_url('assets/img/nbm-logo.png')?>"></td><td style="width: 60%;"><h2 class="font-weight-bold" style="text-align:center;"> DR. B. C. ROY GENERAL HOSPITAL & MATERNITY HOME</h2><h4 class="font-weight-bold" style="text-align:center;">Managed by New Barrackpore Municipality<br>033-25375393<br>Money Receipt</h4></td><td style="width: 20%;"><img src="<?=base_url('assets/img/h-logo.png')?>" width="90px"></td></tr></table>'
              
            },
            {
                extend: 'pdfHtml5',
                title: ''
            },
            {
               extend: 'excelHtml5',
               title: ''
            }
        ]
});
</script>

	<script type="text/javascript">
    	$(function(e) {
    		$('#datatables2').DataTable();
        	$(".demo-accordion").accordionjs();
            $('.js-example-basic-multiple').select2();
        });
    </script>

    <script type="text/javascript">
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong appended.'
            },
            error: {
                'fileSize': 'The file size is too big (2M max).'
            }
        });
    </script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#datatables2').on('click', '.btn-danger', function(event) {
                
                var tr    = $(this).closest('tr');
                var col   = $(this).attr('data');
                var colid = $(this).closest('tr').attr('id');
                var table = $('#datatables2').attr('data-table');
                
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '<?=base_url('delete/records')?>',
                            type: 'POST',
                            dataType: 'json',
                            data: {col: col, colid: colid, table: table},
                        })
                        .done(function() {
                            swal("Done! Your data has been deleted!", { icon: "success", });
                            $(tr).remove();
                        })
                        .fail(function() {
                            swal('Oops..! Something went wrong.');
                        });
                    }
                });
                
            });
        });
    </script>

	<script type="text/javascript">
		jQuery(document).ready(function($) {

            var emailFilter = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            $('input,textarea').on('keyup', function(event) {
                if ($(this).val() != '') {

                    if ($(this).hasClass('email-true')) {
                        if(!emailFilter.test($(this).val())){
                            $(this).removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                        }else{
                            $(this).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
                        }
                    }else if($(this).hasClass('phone-true')){
                        if($(this).val().length == 10){
                            $(this).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
                        }else{
                            $(this).removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                        }
                    }else{
                        $(this).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
                    }
                }else{
                    $(this).removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                }    
            });

            $('select').on('change', function(event) {
                if ($(this).val() != '') {
                    $(this).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
                }    
            });

			$('form').submit(function(event) {
                var error = 0;
                $(this).find('input,textarea,select').each(function(){
                    if($(this).hasClass('required')){
                        if ($(this).val() == '') {
                            $(this).removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                            ++error;
                        }else{
                            if ($(this).hasClass('email-true')) {
                                if(!emailFilter.test($(this).val())){
                                    $(this).removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                                    ++error;
                                }else{
                                    $(this).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
                                }
                            }else if($(this).hasClass('phone-true')){
                                if($(this).val().length == 10){
                                    $(this).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
                                }else{
                                    $(this).removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                                    ++error;
                                }
                            }else if ($(this).hasClass('ent-qty')) {
                                if (parseInt($("#ent-qty").val()) > parseInt($("#CurrentStock2").val())) { 
                                    $('#ent-qty').removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                                    ++error;
                                }
                            }else{
                                $(this).removeClass('is-invalid state-invalid').addClass('is-valid state-valid');
                            }
                        }
                    }
                });
                if (error > 0) { event.preventDefault(); }
                else{
                    var submit = $(this).closest('form').find(':submit');
                    $(submit).html('Please wait a moment <i class="fa fa-spinner fa-spin ml-2"></i>');
                }
            });


		});
	</script>


    <script type="text/javascript">
        jQuery(document).ready(function($) {
            <?php if ($this->session->flashdata('error')) { ?>
                return $.growl.error({ message: "Oops...!! Something went wrong..." });
            <?php } elseif ($this->session->flashdata('added')) { ?>
                return $.growl.notice({ message: "Data successfuly added..." });
            <?php } elseif ($this->session->flashdata('credentials')) { ?>
                return $.growl.error({ message: "Check your credentials..." });
            <?php } ?>
        });
    </script>

    <?php if (isset($script)) { $this->load->view($script); } ?>

    <script type="text/javascript">
        var chartdata = [
            { name: 'Indoor Patient', type: 'bar', data: [<?=$TotalIndoor?>] },
            { name: 'Outdoor Patient', type: 'bar', data: [<?=$TotalOutdoor?>] }
        ];

        var chart    = document.getElementById('chart-combination');
        var barChart = echarts.init(chart);

        var option = {
            grid: { top: '6', right: '0', bottom: '17', left: '25', },
            xAxis: {
                data: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                axisLine: { lineStyle: { color: '#eaeaea' } },
                axisLabel: { fontSize: 10, color: '#000' }
            },
            tooltip: {
                show: true,
                showContent: true,
                alwaysShowContent: true,
                triggerOn: 'mousemove',
                trigger: 'axis',
                axisPointer: { label: { show: false, } }
            },
            yAxis: {
                splitLine: { lineStyle: { color: '#eaeaea' } },
                axisLine: { lineStyle: { color: '#eaeaea' } },
                axisLabel: { fontSize: 10, color: '#000' }
            },
            series: chartdata,
            color:[ '#17B794', '#172f71',]
        };

        barChart.setOption(option);

        var chartdata2 = [
            { name: 'sales', type: 'line', smooth: true, data: [12, 25, 12, 35, 12, 38], color:[ '#17B794'] },
            { name: 'Profit', type: 'line', smooth: true, size:10, data: [8, 12, 28, 10, 10, 12], color:[ '#172f71'] }
        ];
    </script>

</html>