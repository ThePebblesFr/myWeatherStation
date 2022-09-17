/*
    __________________________________________________________________________
   |                                                                          |
   |                     MY WHEATHER STATION - SCRIPT                         |
   |                                                                          |
   |    Author            :   M. JALES, P. GARREAU                            |
   |    Status            :   Under Development                               |
   |    Last Modification :   16/09/2022                                      |
   |    Project           :   EMBEDDED LINUX PROJECT                          |
   |                                                                          |
   |__________________________________________________________________________|
   
*/

/* ----------------------------------------------------------------------------
                                     INIT
---------------------------------------------------------------------------- */
var nameIconsMenu = Array('home', 'temperature', 'humidity', 'pressure');
var itemsMenu = document.getElementsByClassName('menuItemContainer');
var fakeItem = document.getElementsByClassName('fakeItemContainer');
var iconsMenu = document.getElementsByClassName('menuIcon');

var logoWeatherStation = document.getElementById('logoWeatherStation');

/* ----------------------------------------------------------------------------
                                    MAIN
---------------------------------------------------------------------------- */
for (var i = 0; i < iconsMenu.length; i++) {
    itemsMenu[i].addEventListener('mouseenter', (function(arg) {
        return function() {
            iconsMenu[arg].src = 'assets/images/' + nameIconsMenu[arg] + '_icon_colored.png';
            if (arg != 0)
            {
                itemsMenu[arg - 1].style.borderBottomRightRadius = '30px';
            }
            else
            {
                fakeItem[0].style.borderBottomRightRadius = '30px';
            }
            if (arg != iconsMenu.length - 1)
            {
                itemsMenu[arg + 1].style.borderTopRightRadius = '30px';
            }
            else
            {
                fakeItem[1].style.borderTopRightRadius = '30px';
            }
        }
    }) (i));

    itemsMenu[i].addEventListener('mouseleave', (function(arg) {
        return function() {
            iconsMenu[arg].src = 'assets/images/' + nameIconsMenu[arg] + '_icon.png';
            if (arg != 0)
            {
                itemsMenu[arg - 1].style.borderBottomRightRadius = '0px';
            }
            else
            {
                fakeItem[0].style.borderBottomRightRadius = '0px';
            }
            if(arg != iconsMenu.length - 1)
            {
                itemsMenu[arg + 1].style.borderTopRightRadius = '0px';
            }
            else
            {
                fakeItem[1].style.borderTopRightRadius = '0px';
            }
        }
    }) (i));
}

logoWeatherStation.addEventListener('mouseenter', function() {
    logoWeatherStation.src = 'assets/images/logo_weather_station_colored.png';
});

logoWeatherStation.addEventListener('mouseleave', function() {
    logoWeatherStation.src = 'assets/images/logo_weather_station.png';
});