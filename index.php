<?php
/*
    __________________________________________________________________________
   |                                                                          |
   |                      MY WHEATHER STATION - INDEX                         |
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

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css" />
        <title>myWeatherStation - Welcome</title>
        <script type="text/javascript" src="js/jQuery.js"></script>
        <script src="node_modules/chart.js/dist/chart.js"></script>
        <link rel="icon" type="image/x-icon" href="assets/images/logo_weather_station.ico" />
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
            <div class="titleTopContainer">DASHBOARD</div>
            <div class="contributorsContainer" id="contributorsContainer">
                <img src="assets/images/photo_mickael.png" class="pdpImage" id="imageMickael"/>
                <img src="assets/images/photo_pierre.png" class="pdpImage" id="imagePierre"/>
                <div class="contributors">Contributors</div>
            </div>
        </section>
        <section class="bodyContainer">
            <section class="topBodyContainer">
                <section class="topLeftBodyContainer">
                    <section class="dateTimeContainer">
                        <div class="dateContainer" id="dateContainer">Monday 19 September</div>
                        <div class="timeContainer" id="timeContainer">10:43</div>
                    </section>
                    <section class="dataHomeContainer">
                            <div class="dayNightContainer"><img src="assets/images/day_icon.png" class="realTimeDayNightIcon" id="dayNightIcon"/></div>
                    </section>
                </section>
                <section class="topRightBodyContainer">
                    <section class="graphContainer">
                        <div class="titleDataHome">Temperature</div>
                        <div class="graphSubContainer">
                            <div class="loaderHomeContainer" id="loaderTemperature">
                                <div class="loader-wrapper">
                                    <div class="loader">
                                        <div class="loader loader-inner"></div>
                                    </div>
                                </div>
                            </div>
                            <canvas id="chart_detailed_temp"></canvas>
                        </div>
                    </section>
                    <section class="dataHomeContainer">
                        <div class="dataItemContainer">
                            <div><img src="assets/images/hot_icon.png" class="realTimeTemperatureIcon" id="temperatureIcon"/></div>
                            <div class="celsiusData" id="temperatureValue"><?php echo number_format($outputGetLastData['temperature'], 2); ?>°C</div>
                            <div class="fahrneheitData" id="fahrenHeitValue">67.23°F</div>
                        </div>
                        <div class="detailsItemContainer">See details</div>
                    </section>
                </section>
            </section>
            <section class="bottomBodyContainer">
                <section class="bottomLeftBodyContainer">
                    <section class="graphContainer">
                        <div class="titleDataHome">Relative Humidity</div>
                        <div class="graphSubContainer">
                            <div class="loaderHomeContainer" id="loaderHumidity">
                                <div class="loader-wrapper">
                                    <div class="loader">
                                        <div class="loader loader-inner"></div>
                                    </div>
                                </div>
                            </div>
                            <canvas id="chart_detailed_hum"></canvas>
                        </div>
                    </section>
                    <section class="dataHomeContainer">
                        <div class="dataItemContainer">
                            <div ><img src="assets/images/humid_icon.png" class="realTimeTemperatureIcon" id="humidityIcon"/></div>
                            <div class="celsiusData" id="humidityValue"><?php echo number_format($outputGetLastData['humidity'], 2); ?>%</div>
                        </div>
                        <div class="detailsItemContainer">See details</div>
                    </section>
                </section>
                <section class="bottomRightBodyContainer">
                    <section class="graphContainer">
                        <div class="titleDataHome">Pressure</div>
                        <div class="graphSubContainer">
                            <div class="loaderHomeContainer" id="loaderPressure">
                                <div class="loader-wrapper">
                                    <div class="loader">
                                        <div class="loader loader-inner"></div>
                                    </div>
                                </div>
                            </div>
                            <canvas id="chart_detailed_press"></canvas>
                        </div>
                    </section>
                    <section class="dataHomeContainer">
                        <div class="dataItemContainer">
                            <div ><img src="assets/images/high_pressure.png" class="realTimeTemperatureIcon" /></div>
                            <div class="celsiusData"><?php echo number_format($outputGetLastData['pressure'], 0, '', ''); ?></div>
                            <div class="fahrneheitData">Pa</div>
                        </div>
                        <div class="detailsItemContainer">See details</div>
                    </section>
                </section>
            </section>
        </section>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <script type="text/javascript" src="js/dimensions.js"></script>
        <script type="text/javascript">
            var loaderTemperature = document.getElementById('loaderTemperature');
            var loaderHumidity = document.getElementById('loaderHumidity');
            var loaderPressure = document.getElementById('loaderPressure');

            var today = new Date();
            var dayNumber = (today.getDate() < 10) ? '0' + today.getDate() : today.getDate();
            var timeOfSixLastHours = Array(today.getHours()-5 +'h', today.getHours()-4 +'h', today.getHours()-3 +'h', today.getHours()-2 +'h', today.getHours()-1 +'h', today.getHours() +'h');            
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
                    for (var i = 6; i > 0; i--)
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
                loaderTemperature.style.display = "none";
                const ctx_detailed_temp = document.getElementById('chart_detailed_temp').getContext('2d');
                const chartDetailedTemperature = new Chart(ctx_detailed_temp, {
                type: 'line',
                data: {
                    labels: timeOfSixLastHours,
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
        <script type="text/javascript">
            var today = new Date();
            var dayNumber = (today.getDate() < 10) ? '0' + today.getDate() : today.getDate();
            var timeOfSixLastHours = Array(today.getHours()-5 +'h', today.getHours()-4 +'h', today.getHours()-3 +'h', today.getHours()-2 +'h', today.getHours()-1 +'h', today.getHours() +'h');            
            var realMonth = parseInt(today.getMonth()) + 1;
            var monthNumber = (realMonth < 10) ? '0' + realMonth : realMonth;
            var chartNbData = 0;
            var chartHourlyHum = Array();
            var urlRequest = urlData + '?data=humidity&day=' + today.getFullYear() + '-' + monthNumber + '-' + dayNumber;
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function(data) {
                    data = JSON.parse(data);
                    for (var i = 6; i > 0; i--)
                    {
                        console.log(data[i]);
                        chartNbData++;
                        if (data[i] != 0)
                        {
                            chartHourlyHum.push(parseFloat(data[i]));
                        }
                        else
                        {
                            chartHourlyHum.push(null);
                        }
                    }
                    console.log(chartHourlyHum);
                }
            });
            setTimeout(function() {
                loaderHumidity.style.display = "none";
                const ctx_detailed_hum = document.getElementById('chart_detailed_hum').getContext('2d');
                const chartDetailedHumidity = new Chart(ctx_detailed_hum, {
                type: 'line',
                data: {
                    labels: timeOfSixLastHours,
                    datasets: [{
                        label: '',
                        data: chartHourlyHum,
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
        <script type="text/javascript">
            var today = new Date();
            var dayNumber = (today.getDate() < 10) ? '0' + today.getDate() : today.getDate();
            var timeOfSixLastHours = Array(today.getHours()-5 +'h', today.getHours()-4 +'h', today.getHours()-3 +'h', today.getHours()-2 +'h', today.getHours()-1 +'h', today.getHours() +'h');            
            var realMonth = parseInt(today.getMonth()) + 1;
            var monthNumber = (realMonth < 10) ? '0' + realMonth : realMonth;
            var chartNbData = 0;
            var chartHourlyPress = Array();
            var urlRequest = urlData + '?data=pressure&day=' + today.getFullYear() + '-' + monthNumber + '-' + dayNumber;
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function(data) {
                    data = JSON.parse(data);
                    for (var i = 6; i > 0; i--)
                    {
                        console.log(data[i]);
                        chartNbData++;
                        if (data[i] != 0)
                        {
                            chartHourlyPress.push(parseFloat(data[i]));
                        }
                        else
                        {
                            chartHourlyPress.push(null);
                        }
                    }
                    console.log(chartHourlyPress);
                }
            });
            setTimeout(function() {
                loaderPressure.style.display = "none";
                const ctx_detailed_press = document.getElementById('chart_detailed_press').getContext('2d');
                const chartDetailedPressure = new Chart(ctx_detailed_press, {
                type: 'line',
                data: {
                    labels: timeOfSixLastHours,
                    datasets: [{
                        label: '',
                        data: chartHourlyPress,
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