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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css" />
        <title>myWeatherStation - Welcome</title>
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
                            <canvas id="chartTemperature"></canvas>
                        </div>
                    </section>
                    <section class="dataHomeContainer">
                        <div class="dataItemContainer">
                            <div><img src="assets/images/hot_icon.png" class="realTimeTemperatureIcon" id="temperatureIcon"/></div>
                            <div class="celsiusData" id="temperatureValue">15.49°C</div>
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
                            <canvas id="chartHumidity"></canvas>
                        </div>
                    </section>
                    <section class="dataHomeContainer">
                        <div class="dataItemContainer">
                            <div ><img src="assets/images/humid_icon.png" class="realTimeTemperatureIcon" id="humidityIcon"/></div>
                            <div class="celsiusData" id="humidityValue">46.27%</div>
                        </div>
                        <div class="detailsItemContainer">See details</div>
                    </section>
                </section>
                <section class="bottomRightBodyContainer">
                    <section class="graphContainer">
                        <div class="titleDataHome">Pressure</div>
                        <div class="graphSubContainer">
                            <canvas id="chartPressure"></canvas>
                        </div>
                    </section>
                    <section class="dataHomeContainer">
                        <div class="dataItemContainer">
                            <div ><img src="assets/images/high_pressure.png" class="realTimeTemperatureIcon" /></div>
                            <div class="celsiusData">0.987</div>
                            <div class="fahrneheitData">bar</div>
                        </div>
                        <div class="detailsItemContainer">See details</div>
                    </section>
                </section>
            </section>
        </section>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <script type="text/javascript" src="js/dimensions.js"></script>
    </body>
</html>