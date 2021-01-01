<!doctype html>
<html lang="en">
	<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
    <link href="<?=base_url()?>css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=base_url()?>asset/css/bootstrap.min.css">
	<!-- css -->
	<link rel="stylesheet" href="<?=base_url()?>asset/css/style.css">
	<!-- chart js -->
	<script src="<?=base_url()?>asset/js/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/jquery-ui.css"></script>
    <link href="<?=base_url()?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">

	<title>Hello, world!</title>
	</head>
	<body style="background-color:grey;">
        <?php 
			$rh_data = "";
			$rh_time = "";
			foreach($rh_set -> result() as $row): 
			$rh_data = $rh_data . '"'. $row->temperature.'",';
			$rh_time = $rh_time . '"'. date('m-d',strtotime($row->Time_Stamp)) .'",';
		?>
		<?php endforeach; ?>
		<?php 
			$sh_data = "";
			$sh_time = "";
			foreach($sh_set -> result() as $rows): 
			$sh_data = $sh_data . '"'. $rows->humidity.'",';
			$sh_time = $sh_time . '"'. date('m-d',strtotime($rows->Time_Stamp)) .'",';
		?>
		<?php endforeach;  ?>
        <?php 
            //data string dirubah ke aray sesuai parameter delimiter
            $rh_data = explode(",", $rh_data);
            //data array dipotong sesuai jumlah n terakhir
            // $rh_data = array_slice($rh_data, -60, 60, true);
            //data array dirubah kembali ke data string
            $rh_data = implode(",",  $rh_data);
        ?>
        <?php 
            //data string dirubah ke aray sesuai parameter delimiter
            $sh_data = explode(",", $sh_data);
            //data array dipotong sesuai jumlah n terakhir
            // $sh_data = array_slice($sh_data, -60, 60, true);
            //data array dirubah kembali ke data string
            $sh_data = implode(",",  $sh_data);
        ?>
        <?php 
            //data string dirubah ke aray sesuai parameter delimiter
            $sh_time = explode(",", $sh_time);
            //data array dipotong sesuai jumlah n terakhir
            // $sh_time = array_slice($sh_time, -60, 60, true);
            //data array dirubah kembali ke data string
            $sh_time = implode(",",  $sh_time);
		?>
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href="#">
				<img src="<?=base_url()?>asset/img/kalbe.PNG" width="30" height="30" class="d-inline-block align-top" alt="">
				PT. Kalbe Morinaga Indonesia
			</a>
			<ul class="navbar-nav ml-auto"> 
				<li class="nav-item"> 
					<a class="nav-link" href="<?=site_url()?>/Welcome"> 
						<button class="btn btn-block btn-info">Back</button>
					</a> 
				</li> 
			</ul>
		</nav>
		<div class="container mt-5">
			<div class="row">
				<div class="col-lg-12">
					<div class="ibox">
						<div class="ibox-content">
							<div class="row">
								<div class="col-lg-3 ">
									<div class="form-group mt-2" id="data_5">
									<form action="chart_from_search" method="post">
										<div class="input-daterange input-group" id="datepicker">
											<input type="text" class="form-control-sm form-control start" name="start" value="<?=$start?>"/>
											<span class="input-group-addon">to</span>
											<input type="text" class="form-control-sm form-control end" name="end" value="<?=$end?>" />
										</div>
									</div>
								</div>
								<div class="col-lg-1">
									<input type="submit" value="Filter" class="btn btn-block btn-info mt-2"></form>
								</div>
								<div class="col-lg-1 ml-auto">
									<input type="button" value="Save" class="btn btn-success mt-2 save">
								</div>
							</div>
							<canvas id="chart" style=" width: 100%; height: 300px; background: rgba(0,0,0,0.0); margin-top: 10px;margin-bottom: 10px;"></canvas>
						</div>
					</div>
				</div>
			</div> 
		</div>
	<!-- Optional JavaScript -->
	</body>
</html>
<script src="<?=base_url()?>asset/js/jquery-3.1.1.min.js"></script>
<script src="<?=base_url()?>asset/js/jquery-ui.js"></script>
<!-- <script src="<?=base_url()?>asset/js/plugins/datapicker/bootstrap-datepicker.js"></script> -->
<!-- <script src="<?=base_url()?>asset/js/plugins/daterangepicker/daterangepicker.js"></script> -->
<!-- <script src="<?=base_url()?>asset/js/plugins/fullcalendar/moment.min.js"></script> -->
<script src="<?=base_url()?>asset/js/FileSaver.min.js"></script>
<script src="<?=base_url()?>asset/js/canvas-toBlob.js"></script>
<script>
	var ctx = document.getElementById("chart").getContext('2d');
		var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels:  [<?php echo $sh_time?>],
			datasets: 
			[{
				label: 'RH',
				data: [<?php echo $rh_data ?>],
				backgroundColor: 'rgba(220, 220, 220, 0.5)',
                pointBorderColor: "#fff",
				borderWidth: 1,
			},
			{
				label: 'Suhu',
				data: [<?php echo $sh_data?>],
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
				text: 'History Realtime Monitoring'
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
            animation:true
		}
	});
	$(document).ready(function(){
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
		$('.save').click(function(){
			$("#chart").get(0).toBlob(
				function(blob){
					saveAs(blob, 'chart.png')
				}
			);
		});
	});
</script>