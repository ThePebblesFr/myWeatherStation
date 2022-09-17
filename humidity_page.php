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
        </section>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/dimensions.js"></script>
    </body>
</html>