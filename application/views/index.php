<!doctype html>
<html lang="en">
	<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- daterangepicker -->
	<link href="<?=base_url()?>css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="<?=base_url()?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/jquery-ui.css"></script>
	
	<!-- css -->
	<link rel="stylesheet" href="<?=base_url()?>asset/css/style.css">
	<!-- Bootstrap CSS -->
    <link href="<?=base_url()?>css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
	<!-- chart js -->
	<script src="<?=base_url()?>asset/js/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
	<!-- jquery -->
	<!-- <script src="<?=base_url()?>asset/js/jquery-2.1.1.js"></script> -->
	<title>Hello, world!</title>
	</head>
	<body style="background-color:grey;">
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href="#">
				<img src="<?=base_url()?>asset/img/kalbe.PNG" width="30" height="30" class="d-inline-block align-top" alt="">
				PT. Kalbe Morinaga Indonesia
			</a>
			<ul class="navbar-nav ml-auto"> 
				<li class="nav-item"> 
					<a class="nav-link" href="<?=site_url()?>/welcome/chart_from_search"> 
						<button class="btn btn-block btn-info">History</button>
					</a> 
				</li> 
			</ul>
		</nav>
		<div class="container mt-5">
			<div class="row">
				<div class="col-lg">
					<div class="ibox">
						<div class="ibox-content">
							<div id="show_chart"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-lg-5">
					<div class="ibox">
						<div class="ibox-content">
							<div class="form-group" id="data_5">
								<label class="font-normal">Search From date</label>
								<div class="input-daterange input-group" id="datepicker">
									<input type="text" class="form-control-sm form-control start" name="start" value="<?=date("Y-m-d")?>"/>
									<span class="input-group-addon">to</span>
									<input type="text" class="form-control-sm form-control end" name="end" value="<?=date("Y-m-d")?>" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg">
					<div class="ibox">
						<div class="ibox-content">
							<div id="show_chart_2">
							</div>
						</div>
					</div>
				</div>
			</div> -->
		</div>
	</body>
</html>
<script src="<?=base_url()?>asset/js/jquery-3.1.1.min.js"></script>
<script src="<?=base_url()?>asset/js/jquery-ui.js"></script>
<script src="<?=base_url()?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?=base_url()?>js/plugins/fullcalendar/moment.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
		setInterval(function(){
		$('#show_chart').load('<?php echo base_url()?>/index.php/welcome/chart');
		// alert("ss");
		},500);
	});
	// $('.end').change(function(){
	// 	var start = $('.start').val();
	// 	var end = $('.end').val();
	// 	$.ajax({  
	// 		method:"post",  
	// 		data:{
	// 				start:start,
	// 				end:end
	// 			}, 
	// 		success:function(data){  
	// 		}  
	// 	});  
	// });
</script>
<script>
	
	var ctx = document.getElementById("chart_2").getContext('2d');
		var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels:  [<?php echo $sh_time_search?>],
			datasets: 
			[{
				label: 'RH',
				data: [<?php echo $rh_data_search ?>],
				backgroundColor: 'rgba(220, 220, 220, 0.5)',
                pointBorderColor: "#fff",
				borderWidth: 1,
			},
			{
				label: 'Suhu',
				data: [<?php echo $sh_data_search?>],
				backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
				borderWidth: 1 
			}]
		},
		options: {
			responsive: true,
			hoverMode: 'index',
			stacked: false,
			title: {
				display: true,
				text: 'Realtime Monitoring'
			},
			scales: {
				yAxes: [{
					type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
					display: true,
					position: 'left',
					id: 'y-axis-1',
				}, {
					type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
					display: false,
					position: 'right',
					id: 'y-axis-2',
					// grid line settings
					gridLines: {
						drawOnChartArea: false, // only want the grid lines for one axis to show up
					},
				}],
			},
            animation:false
		}
	});
	$('.start').datepicker({
		keyboardNavigation: false,
		forceParse: false,
		autoclose: true
	});
	$('.end').datepicker({
		keyboardNavigation: false,
		forceParse: false,
		autoclose: true
	});
</script>