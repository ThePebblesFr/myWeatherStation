<?php
/*
    __________________________________________________________________________
   |                                                                          |
   |                    MY WHEATHER STATION - HUMIDITY                        |
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
    $getMinDaily = 'SELECT humidity FROM data WHERE date_ >= "'.$day.'" AND date_ < "'.$day_plus_1.'" ORDER BY humidity ASC LIMIT 1';
    $requestGetMinDaily = $bddConn->query($getMinDaily);
    $outputGetMinDaily = $requestGetMinDaily->fetch();

    // Get Average of the day
    $getAvgDaily = 'SELECT AVG(humidity) AS "avg_humidity" FROM data WHERE date_ >= "'.$day.'" AND date_ < "'.$day_plus_1.'"';
    $requestGetAvgDaily = $bddConn->query($getAvgDaily);
    $outputGetAvgDaily = $requestGetAvgDaily->fetch();

    // Get Max of the day
    $getMaxDaily = 'SELECT humidity FROM data WHERE date_ >= "'.$day.'" AND date_ < "'.$day_plus_1.'" ORDER BY humidity DESC LIMIT 1';
    $requestGetMaxDaily = $bddConn->query($getMaxDaily);
    $outputGetMaxDaily = $requestGetMaxDaily->fetch();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/humidity.css" />
        <title>myWeatherStation - Humidity</title>
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
            <div class="titleTopContainer">HUMIDITY</div>
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
                                <img src="assets/images/humidity_icon.png" class="iconDetailedPage"/>
                            </section>
                            <section class="dataItemDetailedPageContainer">
                                <div class="celsiusData" id="humidityValue"><?php echo $outputGetLastData['humidity'] ?>%</div>
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
                        <div>Minimum : <?php echo number_format($outputGetMinDaily['humidity'], 2); ?>%</div>
                        <div>Averaged : <?php echo number_format($outputGetAvgDaily['avg_humidity'], 2); ?>%</div>
                        <div>Maximum : <?php echo number_format($outputGetMaxDaily['humidity'], 2); ?>%</div>
                    </section>
                </section>
                <section class="rightBodyContainer">
                    <section class="titleHistoricContainer">Past days</section>
                    <section class="contentHistoricContainer">
                        <div class="itemHistoricContainer">
                            <div>Sat 24 Sept</div>
                            <div>56%</div>
                            <div><img src="assets/images/humid_icon.png" class="iconHistoric" id="humidityHistoricIcon"/></div>
                        </div>
                        <div class="itemHistoricContainer">
                            <div>Sat 24 Sept</div>
                            <div>26%</div>
                            <div><img src="assets/images/dry_icon.png" class="iconHistoric" id="humidityHistoricIcon"/></div>
                        </div>
                    </section>
                </section>

            </section>
        </section>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/humidity.js"></script>
        <script type="text/javascript" src="js/dimensions.js"></script>
    </body>
</html>