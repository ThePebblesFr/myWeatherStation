<?php
/*
    __________________________________________________________________________
   |                                                                          |
   |                    MY WHEATHER STATION - PRESSURE                        |
   |                                                                          |
   |    Author            :   P. GARREAU, M. JALES                            |
   |    Status            :   Under Development                               |
   |    Last Modification :   16/09/2022                                      |
   |    Project           :   EMBEDDED LINUX PROJECT                          |
   |                                                                          |
   |__________________________________________________________________________|

*/
    $daysOfTheWeek = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
    $monthOfTheYear = array('Zebre', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    $config_file = (object) parse_ini_file("config.ini");
    $bddConn = new PDO('mysql:host='.$config_file->servername.';dbname='.$config_file->database.';charset=utf8', $config_file->username, $config_file->password);

    // Get Last Data
    $getLastData = 'SELECT * FROM data ORDER BY date_ DESC LIMIT 1';
    $requestGetLastData = $bddConn->query($getLastData);
    $outputGetLastData = $requestGetLastData->fetch();

    // Get Min of the day
    $day = date('Y-m-d');
    $day_plus_1 = date('Y-m-d', strtotime('+1 day'));
    $getMinDaily = 'SELECT pressure FROM data WHERE date_ >= "'.$day.'" AND date_ < "'.$day_plus_1.'" ORDER BY pressure ASC LIMIT 1';
    $requestGetMinDaily = $bddConn->query($getMinDaily);
    $outputGetMinDaily = $requestGetMinDaily->fetch();

    // Get Average of the day
    $getAvgDaily = 'SELECT AVG(pressure) AS "avg_pressure" FROM data WHERE date_ >= "'.$day.'" AND date_ < "'.$day_plus_1.'"';
    $requestGetAvgDaily = $bddConn->query($getAvgDaily);
    $outputGetAvgDaily = $requestGetAvgDaily->fetch();

    // Get Max of the day
    $getMaxDaily = 'SELECT pressure FROM data WHERE date_ >= "'.$day.'" AND date_ < "'.$day_plus_1.'" ORDER BY pressure DESC LIMIT 1';
    $requestGetMaxDaily = $bddConn->query($getMaxDaily);
    $outputGetMaxDaily = $requestGetMaxDaily->fetch();

    // Get first day
    $getFirstDay = 'SELECT * FROM data ORDER BY date_ DESC LIMIT 1';
    $requestGetFirstDay = $bddConn->query($getFirstDay);
    $outputGetFirstDay = $requestGetFirstDay->fetch();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/pressure.css" />
        <link rel="icon" type="image/png" href="assets/images/logo_weather_station_colored.png" />
        <title>myWeatherStation - Pressure</title>
        <script type="text/javascript" src="js/jQuery.js"></script>
        <script src="node_modules/chart.js/dist/chart.js"></script>
        <script type="text/javascript">
            var datesHistoric = Array();
            var chartHourlyPress = Array(Array());
        </script>
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
            <div class="titleTopContainer">PRESSURE</div>
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
                                <img src="assets/images/pressure_icon.png" class="iconDetailedPage"/>
                            </section>
                            <section class="dataItemDetailedPageContainer">
                                <div class="celsiusData" id="pressureValue"><?php echo number_format($outputGetLastData['pressure'], 0, '', ''); ?>Pa</div>
                            </section>
                        </div>
                        <section class="dateTimeDetailedPageContainer">
                            <div class="dateSmallContainer" id="dateContainer">Monday 19 September</div>
                            <div class="timeSmallContainer" id="timeContainer">10:43</div>
                        </section>
                    </section>
                    <section class="leftBottomBodyContainer">
                        <div class="graphDetailedPageSubContainer">
                            <div class="loaderContainer" id="loaderTemperature">
                                <div class="loader-wrapper">
                                    <div class="loader">
                                        <div class="loader loader-inner"></div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $day_x = new DateTime($outputGetFirstDay['date_']);
                                $day_x_1 = clone $day_x;
                                $day_x_1->modify('+1 day');
                                $getAvgDay = 'SELECT AVG(pressure) AS "avg_pressure" FROM data WHERE date_ >= "'.$day_x->format('Y-m-d').'" AND date_ < "'.$day_x_1->format('Y-m-d').'"';
                                $requestGetAvgDay = $bddConn->query($getAvgDay);
                                $outputGetAvgDay = $requestGetAvgDay->fetch();
                                $nb_days = 0;
                                while ($outputGetAvgDay['avg_pressure'] != NULL)
                                {
                                    echo '<canvas id="chart_detailed_press'.$nb_days.'"></canvas>';
                                    $day_x->modify('-1 day');
                                    $day_x_1->modify('-1 day');
                                    $getAvgDay = 'SELECT AVG(pressure) AS "avg_pressure" FROM data WHERE date_ >= "'.$day_x->format('Y-m-d').'" AND date_ < "'.$day_x_1->format('Y-m-d').'"';
                                    $requestGetAvgDay = $bddConn->query($getAvgDay);
                                    $outputGetAvgDay = $requestGetAvgDay->fetch();
                                    
                                    ?>
                                    <script type="text/javascript">
                                        var nb_days_1 = <?php echo json_encode($nb_days); ?>;
                                        document.getElementById('chart_detailed_press' + nb_days_1).style.display = (nb_days_1 > 0) ? 'none' : 'block';
                                        chartHourlyPress.push(Array());
                                    </script>
                                    <?php
                                    $nb_days++;
                                }
                            ?>
                        </div>
                    </section>
                    <section class="leftStatsBodyContainer">
                        <div>Minimum : <?php echo number_format($outputGetMinDaily['pressure'], 0, '', ''); ?>Pa</div>
                        <div>Averaged : <?php echo number_format($outputGetAvgDaily['avg_pressure'], 0, '', ''); ?>Pa</div>
                        <div>Maximum : <?php echo number_format($outputGetMaxDaily['pressure'], 0, '', ''); ?>Pa</div>
                    </section>
                </section>
                <section class="rightBodyContainer">
                    <section class="titleHistoricContainer">Past days</section>
                    <section class="contentHistoricContainer">
                    <?php
                        $day_x = new DateTime($outputGetFirstDay['date_']);
                        $day_x_1 = clone $day_x;
                        $day_x_1->modify('+1 day');
                        $getAvgDay = 'SELECT AVG(pressure) AS "avg_pressure" FROM data WHERE date_ >= "'.$day_x->format('Y-m-d').'" AND date_ < "'.$day_x_1->format('Y-m-d').'"';
                        $requestGetAvgDay = $bddConn->query($getAvgDay);
                        $outputGetAvgDay = $requestGetAvgDay->fetch();
                        $nb_days = 0;
                        while ($outputGetAvgDay['avg_pressure'] != NULL)
                        {
                    ?>
                        <div class="itemHistoricContainer">
                            <div class="dayHistoricContainer"><?php echo $daysOfTheWeek[date("w", strtotime($day_x->format('Y-m-d')))] . ' ' . $day_x->format('d') . ' ' . $monthOfTheYear[intval($day_x->format('m'))]; ?></div>
                            <div><?php echo number_format($outputGetAvgDay['avg_pressure'], 0, '', ''); ?>Pa</div>
                            <div><img src="assets/images/high_pressure.png" class="iconHistoric" id="pressureHistoricIcon<?php echo $nb_days; ?>"/></div>
                        </div>
                        <script type="text/javascript">
                            datesHistoric.push(<?php echo json_encode($day_x->format('Y-m-d')); ?>)
                            var nb_days = <?php echo json_encode($nb_days); ?>;
                            var valuePress = <?php echo json_encode($outputGetAvgDay['avg_pressure']); ?>;
                            document.getElementById("pressureHistoricIcon" + nb_days).src = (valuePress > 50) ? "assets/images/high_pressure.png" : "assets/images/high_pressure.png";
                        </script>
                    <?php
                            $day_x->modify('-1 day');
                            $day_x_1->modify('-1 day');
                            $getAvgDay = 'SELECT AVG(pressure) AS "avg_pressure" FROM data WHERE date_ >= "'.$day_x->format('Y-m-d').'" AND date_ < "'.$day_x_1->format('Y-m-d').'"';
                            $requestGetAvgDay = $bddConn->query($getAvgDay);
                            $outputGetAvgDay = $requestGetAvgDay->fetch();
                            $nb_days++;
                        }
                    ?>
                    </section>
                </section>
            </section>
        </section>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/pressure.js"></script>
        <script type="text/javascript" src="js/dimensions.js"></script>
        <script type="text/javascript">
            var loaderTemperature = document.getElementById('loaderTemperature');

            var today = new Date();
            var dayNumber = (today.getDate() < 10) ? '0' + today.getDate() : today.getDate();
            var realMonth = parseInt(today.getMonth()) + 1;
            var monthNumber = (realMonth < 10) ? '0' + realMonth : realMonth;
            var chartNbData = 0;
            var urlRequest = urlData + '?data=pressure&day=' + today.getFullYear() + '-' + monthNumber + '-' + dayNumber;
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function(data) {
                    data = JSON.parse(data);
                    for (var i = 0; i < 24; i++)
                    {
                        chartNbData++;
                        if (data[i] != 0)
                        {
                            chartHourlyPress[0].push(parseFloat(data[i]));
                        }
                        else
                        {
                            chartHourlyPress[0].push(null);
                        }
                    }
                }
            });
            setTimeout(function() {
                loaderTemperature.style.display = "none";
                const ctx_detailed_press = document.getElementById('chart_detailed_press0').getContext('2d');
                const chartDetailedPressure = new Chart(ctx_detailed_press, {
                type: 'line',
                data: {
                    labels: timeOfTheDay,
                    datasets: [{
                        label: '',
                        data: chartHourlyPress[0],
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

            var itemHistoricContainer = document.getElementsByClassName("itemHistoricContainer");
            itemHistoricContainer[0].style.backgroundColor = colors[3];

            for (var i = 0; i < itemHistoricContainer.length; i++)
            {
                itemHistoricContainer[i].addEventListener("click", (function(arg) {
                    return function() {
                        loaderTemperature.style.display = "flex";
                        for (var j = 0; j < itemHistoricContainer.length; j++)
                        {
                            itemHistoricContainer[j].style.backgroundColor = (arg != j) ? 'transparent' : colors[3];
                        }
                        urlRequest = urlData + '?data=pressure&day=' + datesHistoric[arg];
                        $.ajax({
                            type: 'GET',
                            url: urlRequest,
                            success: function(data) {
                                loaderTemperature.style.display = "none";
                                data = JSON.parse(data);
                                for (var i = 0; i < 24; i++)
                                {
                                    chartNbData++;
                                    if (data[i] != 0)
                                    {
                                        chartHourlyPress[arg].push(parseFloat(data[i]));
                                    }
                                    else
                                    {
                                        chartHourlyPress[arg].push(null);
                                    }
                                }
                                document.getElementById('chart_detailed_press' + arg).style.display = 'block';
                                for (var j = 0; j < itemHistoricContainer.length; j++)
                                {
                                    document.getElementById('chart_detailed_press' + j).style.display = (arg != j) ? 'none' : 'block';
                                }
                                const ctx_detailed_press = document.getElementById('chart_detailed_press' + arg).getContext('2d');
                                const chartDetailedPressure = new Chart(ctx_detailed_press, {
                                type: 'line',
                                data: {
                                    labels: timeOfTheDay,
                                    datasets: [{
                                        label: '',
                                        data: chartHourlyPress[arg],
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
                            }
                        });
                    };
                }) (i));
            }
        </script>
    </body>
</html>