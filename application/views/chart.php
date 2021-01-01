<!doctype html>
<html lang="en">
	<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- chart js -->
	<script src="<?=base_url()?>asset/js/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
	
	<title>Hello, world!</title>
	</head>
	<body>
	<!-- Just an image -->
        <?php 
			$rh_data = "";
			$rh_time = "";
			foreach($rh_set -> result() as $row): 
			$rh_data = $rh_data . '"'. $row->temperature.'",';
			$rh_time = $rh_time . '"'. date('H:i',strtotime($row->Time_Stamp)) .'",';
		?>
		<?php endforeach; ?>
		<?php 
			$sh_data = "";
			$sh_time = "";
			foreach($sh_set -> result() as $rows): 
			$sh_data = $sh_data . '"'. $rows->humidity.'",';
			$sh_time = $sh_time . '"'. date('H:i',strtotime($rows->Time_Stamp)) .'",';
		?>
		<?php endforeach;  ?>
        <?php 
            //data string dirubah ke aray sesuai parameter delimiter
            $rh_data = explode(",", $rh_data);
            //data array dipotong sesuai jumlah n terakhir
            $rh_data = array_slice($rh_data, -60, 60, true);
            //data array dirubah kembali ke data string
            $rh_data = implode(",",  $rh_data);
        ?>
        <?php 
            //data string dirubah ke aray sesuai parameter delimiter
            $sh_data = explode(",", $sh_data);
            //data array dipotong sesuai jumlah n terakhir
            $sh_data = array_slice($sh_data, -60, 60, true);
            //data array dirubah kembali ke data string
            $sh_data = implode(",",  $sh_data);
        ?>
        <?php 
            //data string dirubah ke aray sesuai parameter delimiter
            $sh_time = explode(",", $sh_time);
            //data array dipotong sesuai jumlah n terakhir
            $sh_time = array_slice($sh_time, -60, 60, true);
            //data array dirubah kembali ke data string
            $sh_time = implode(",",  $sh_time);
        ?>
		<canvas id="chart" style=" width: 100%; height: 300px; background: rgba(0,0,0,0.0); margin-top: 10px;margin-bottom: 10px;"></canvas>
	<!-- Optional JavaScript -->
	</body>
</html>
<script>
	var ctx = document.getElementById("chart").getContext('2d');
		var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels:  [<?php echo $sh_time?>],
			datasets: 
			[{
				label: 'Suhu',
				data: [<?php echo $rh_data ?>],
				backgroundColor: 'rgba(220, 220, 220, 0.5)',
                pointBorderColor: "#fff",
				borderWidth: 1,
			},
			{
				label: 'RH',
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
</script>