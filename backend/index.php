<?php
	$config_file = (object) parse_ini_file("config.ini");
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css" />
		<title>myRealTimeWeather : Home</title>
		<script type="text/javascript" src="jQuery.js"></script>
	</head>
	<body>
		<h1>myRealTimeWeather : Welcome</h1>
		<section class="row">
			<div class="cell">Temperature</div>
			<div class="cell" id="temperature">No data</div>
		</section>
		<section class="row">
			<div class="cell">Relative Humidity</div>
			<div class="cell" id="relativeHumidity">No data</div>
		</section>
		<section class="row">
			<div class="cell">Pressure</div>
			<div class="cell" id="pressure">No data</div>
		</section>
		<script type="text/javascript">
			var api_token = <?php echo json_encode($config_file->api_token); ?>;
			var ip_raspberryPi = <?php echo json_encode($config_file->ip_raspberryPi); ?>;

			var temperature = document.getElementById('temperature');
			var relativeHumidity = document.getElementById('relativeHumidity');
			var pressure = document.getElementById('pressure');

			var urlData = "data.php?token=" + api_token;
			var urlComif = "http://software-developments-pg.com/others/myWeatherStation/insertData.php";

			setInterval(function() {
				$.ajax({
					type:"GET",
					url: urlData,
					success: function(dataRPi) {
						
						dataRPi = JSON.parse(dataRPi);
						if (dataRPi['exitcode'] == 200)
						{
							temperature.innerHTML = dataRPi['temperature'] + " °C";
							relativeHumidity.innerHTML = dataRPi['humidity'] + " %";
							pressure.innerHTML = dataRPi['pressure'] + " bar";
							$.ajax({
								type: "POST",
								url: urlComif,
								beforeSend: function(xhr) {
									xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
								},
								data: {
									"token": api_token,
									"temperature": dataRPi['temperature'],
									"humidity": dataRPi['humidity'],
									"pressure": dataRPi['pressure'],
									"dateTime": dataRPi['date']
                                },
								headers: {
									'Access-Control-Allow-Origin': '*'
								}
							});
						}
						else
						{
							temperature.innerHTML = "No data";
							relativeHumidity.innerHTML = "No data";
							pressure.innerHTML = "No data";
						}
					}
				});
			}, 1000);
		</script>
	</body>
</html>