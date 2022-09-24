<?php
/*
    __________________________________________________________________________
   |                                                                          |
   |                    MY WHEATHER STATION - TEMPERATURE                     |
   |                                                                          |
   |    Author            :   P. GARREAU, M. JALES                            |
   |    Status            :   Under Development                               |
   |    Last Modification :   16/09/2022                                      |
   |    Project           :   EMBEDDED LINUX PROJECT                          |
   |                                                                          |
   |__________________________________________________________________________|

*/

    $config_file = (object) parse_ini_file("config.ini");
    $bddConn = new PDO('mysql:host='.$config_file->servername.';dbname='.$config_file->database.';charset=utf8', $config_file->username, $config_file->password);

    // Get Last Data
    $getLastData = 'SELECT * FROM data ORDER BY date_ DESC LIMIT 1';
    $requestGetLastData = $bddConn->query($getLastData);
    $outputGetLastData = $requestGetLastData->fetch();

    // Get Min of the day
    $day = date('Y-m-d');
    $day_plus_1 = date('Y-m-d', strtotime('+1 day'));
    $getMinDaily = 'SELECT temperature FROM data WHERE date_ >= "'.$day.'" AND date_ < "'.$day_plus_1.'" ORDER BY temperature ASC LIMIT 1';
    $requestGetMinDaily = $bddConn->query($getMinDaily);
    $outputGetMinDaily = $requestGetMinDaily->fetch();

    // Get Average of the day
    $getAvgDaily = 'SELECT AVG(temperature) AS "avg_temperature" FROM data WHERE date_ >= "'.$day.'" AND date_ < "'.$day_plus_1.'"';
    $requestGetAvgDaily = $bddConn->query($getAvgDaily);
    $outputGetAvgDaily = $requestGetAvgDaily->fetch();

    // Get Max of the day
    $getMaxDaily = 'SELECT temperature FROM data WHERE date_ >= "'.$day.'" AND date_ < "'.$day_plus_1.'" ORDER BY temperature DESC LIMIT 1';
    $requestGetMaxDaily = $bddConn->query($getMaxDaily);
    $outputGetMaxDaily = $requestGetMaxDaily->fetch();

    $outputGetAvgHourly = array(
        "nb_hours" => 0
    );
    for ($i = 0; $i < 24; $i++) {
        $day_and_hour = $day . ' ' . strval($i) . ':00:00';
        $day_and_hour_plus_1 = $day . ' ' . strval($i + 1) . ':00:00';
        $getAvgDaily = 'SELECT AVG(temperature) AS "avg_temperature" FROM data WHERE date_ >= "'.$day_and_hour.'" AND date_ < "'.$day_and_hour_plus_1.'"';
        $requestGetAvgDaily = $bddConn->query($getAvgDaily);
        $temp_result = $requestGetAvgDaily->fetch();
        if ($temp_result['avg_temperature'] != NULL)
        {
            $outputGetAvgHourly['nb_hours']++;
            $outputGetAvgHourly += [ $i => $temp_result['avg_temperature'] ];
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/temperature.css" />
        <title>myWeatherStation - Temperature</title>
        <script type="text/javascript" src="js/jQuery.js"></script>
        <script src="node_modules/chart.js/dist/chart.js"></script>
    </head>
    <body>
        <section class="leftContainer">
            <section class="menuContainer">
                <div class="fakeItemContainer"></div>
                <div class="menuItemContainer">
                    <img src="assets/images/home_icon.png" class="menuIcon" id="homeIcon"/>
                </div>
                <div class="menuItemContainer">
                    <img src="assets/images/temperature_icon.png" class="menuIcon"/>
                </div>
                <div class="menuItemContainer">
                    <img src="assets/images/humidity_icon.png" class="menuIcon"/>
                </div>
                <div class="menuItemContainer">
                    <img src="assets/images/pressure_icon.png" class="menuIcon"/>
                </div>
                <div class="fakeItemContainer"></div>
            </section>
            <section class="logoMinesContainer">
                <img src="assets/images/logo_mines.png" class="logoMines" id="logoMines"/>
            </section>
        </section>
        <section class="topContainer">
            <div class="logoWeatherStationContainer">
                <img src="assets/images/logo_weather_station.png" class="logoWeatherStation" id="logoWeatherStation"/>
            </div>
            <div class="titleTopContainer">TEMPERATURE</div>
            <div class="contributorsContainer" id="contributorsContainer">
                <img src="assets/images/photo_mickael.png" class="pdpImage" id="imageMickael"/>
                <img src="assets/images/photo_pierre.png" class="pdpImage" id="imagePierre"/>
                <div class="contributors">Contributors</div>
            </div>
        </section>
        <section class="bodyContainer">
            <section class="tempBodyContainer">
                <section class="leftBodyContainer">
                    <section class="leftTopBodyContainer">
                        <div class="leftTopLeftContainer">
                            <section class="iconDetailedPageContainer">
                                <img src="assets/images/temperature_icon.png" class="iconDetailedPage"/>
                            </section>
                            <section class="dataItemDetailedPageContainer">
                                <div class="celsiusData" id="temperatureValue"><?php echo number_format($outputGetLastData['temperature'], 2); ?>°C</div>
                                <div class="fahrneheitData" id="fahrenHeitValue">67.23°F</div>
                            </section>
                        </div>
                        <section class="dateTimeDetailedPageContainer">
                            <div class="dateSmallContainer" id="dateContainer">Monday 19 September</div>
                            <div class="timeSmallContainer" id="timeContainer">10:43</div>
                        </section>
                    </section>
                    <section class="leftBottomBodyContainer">
                        <div class="graphDetailedPageSubContainer">
                            <canvas id="chart_detailed_temp"></canvas>
                        </div>
                    </section>
                    <section class="leftStatsBodyContainer">
                        <div>Minimum : <?php echo number_format($outputGetMinDaily['temperature'], 2); ?>°C</div>
                        <div>Averaged : <?php echo number_format($outputGetAvgDaily['avg_temperature'], 2); ?>°C</div>
                        <div>Maximum : <?php echo number_format($outputGetMaxDaily['temperature'], 2); ?>°C</div>
                    </section>
                </section>
                <section class="rightBodyContainer">
                    <section class="titleHistoricContainer">Past days</section>
                    <section class="contentHistoricContainer">
                        <div class="itemHistoricContainer">
                            <div>Sat 24 Sept</div>
                            <div>26.56°C</div>
                            <div><img src="assets/images/hot_icon.png" class="iconHistoric" id="temperatureHistoricIcon"/></div>
                        </div>
                        <div class="itemHistoricContainer">
                            <div>Sat 24 Sept</div>
                            <div>26.56°C</div>
                            <div><img src="assets/images/hot_icon.png" class="iconHistoric" id="temperatureHistoricIcon"/></div>
                        </div>
                    </section>
                </section>

            </section>
        </section>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/temperature.js"></script>
        <script type="text/javascript" src="js/dimensions.js"></script>
        <script type="text/javascript">
            var today = new Date();
            var dayNumber = (today.getDate() < 10) ? '0' + today.getDate() : today.getDate();
            var realMonth = parseInt(today.getMonth()) + 1;
            var monthNumber = (realMonth < 10) ? '0' + realMonth : realMonth;
            var chartNbData = 0;
            var chartHourlyTemp = Array();
            var urlRequest = urlData + '?data=temperature&day=' + today.getFullYear() + '-' + monthNumber + '-' + dayNumber;
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function(data) {
                    data = JSON.parse(data);
                    for (var i = 0; i < 24; i++)
                    {
                        console.log(data[i]);
                        chartNbData++;
                        if (data[i] != 0)
                        {
                            chartHourlyTemp.push(parseFloat(data[i]));
                        }
                        else
                        {
                            chartHourlyTemp.push(null);
                        }
                    }
                    console.log(chartHourlyTemp);
                }
            });
            setTimeout(function() {
                const ctx_detailed_temp = document.getElementById('chart_detailed_temp').getContext('2d');
                const chartDetailedTemperature = new Chart(ctx_detailed_temp, {
                type: 'line',
                data: {
                    labels: timeOfTheDay,
                    datasets: [{
                        label: '',
                        data: chartHourlyTemp,
                        fill: false,
                        borderColor: colors[5],
                        pointBackgroundColor: colors[5],
                        tension: 0.2
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: colors[0],
                                borderColor: colors[0]
                            },
                            ticks: {
                                color: colors[0],
                            }
                        },
                        y: {
                            grid: {
                                color: colors[0],
                                borderColor: colors[0]
                            },
                            ticks: {
                                color: colors[0],
                            }
                        }
                    }
                }
            });
            }, 1000);
        </script>
    </body>
</html>