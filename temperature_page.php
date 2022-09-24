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
    // $day = date('Y-m-d');
    // $getMinDaily = 'SELECT MIN(SELECT temperature FROM data WHERE date_ >= "'.$day.'" AND date_ < "'.$day.'") AS "minDaily" FROM data';
    // $requestGetMinDaily = $bddConn->query($getMinDaily);
    // $outputGetMinDaily = $requestGetMinDaily->fetch();

    // Get Average of the day

    // Get Max of the day
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
                                <div class="celsiusData" id="temperatureValue"><?php echo $outputGetLastData['temperature'] ?>°C</div>
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
                        <div>Minimum : <?php // echo $outputGetMinDaily['minDaily']; ?>°C</div>
                        <div>Averaged : 24.32°C</div>
                        <div>Maximum : 26.56°C</div>
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
    </body>
</html>