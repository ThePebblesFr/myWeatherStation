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

// Variables ------------------------------------------------------------------
var borderRadius = '30px';

// Items ----------------------------------------------------------------------
var nameIconsMenu = Array('home', 'temperature', 'humidity', 'pressure');
var itemsMenu = document.getElementsByClassName('menuItemContainer');
var fakeItem = document.getElementsByClassName('fakeItemContainer');
var iconsMenu = document.getElementsByClassName('menuIcon');

var homeIcon = document.getElementById('homeIcon');
var logoWeatherStation = document.getElementById('logoWeatherStation');
var logoMines = document.getElementById('logoMines');

var page = document.getElementsByClassName('titleTopContainer')[0].innerText.toLowerCase();

/* ----------------------------------------------------------------------------
                                    MAIN
---------------------------------------------------------------------------- */

// Menu items management ------------------------------------------------------
for (var i = 0; i < iconsMenu.length; i++) {

    // Hovering effects
    if (page !== nameIconsMenu[i])
    {
        itemsMenu[i].addEventListener('mouseenter', (function(arg) {
            return function() {
                iconsMenu[arg].src = 'assets/images/' + nameIconsMenu[arg] + '_icon_colored.png';
                if (arg != 0)
                {
                    itemsMenu[arg - 1].style.borderBottomRightRadius = borderRadius;
                }
                else
                {
                    fakeItem[0].style.borderBottomRightRadius = borderRadius;
                }
                if (arg != iconsMenu.length - 1)
                {
                    itemsMenu[arg + 1].style.borderTopRightRadius = borderRadius;
                }
                else
                {
                    fakeItem[1].style.borderTopRightRadius = borderRadius;
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
    else
    {
        iconsMenu[i].src = 'assets/images/' + nameIconsMenu[i] + '_icon_colored.png';
        if (i != 0)
        {
            itemsMenu[i - 1].style.borderBottomRightRadius = borderRadius;
        }
        else
        {
            fakeItem[0].style.borderBottomRightRadius = borderRadius;
        }
        if (i != iconsMenu.length - 1)
        {
            itemsMenu[i + 1].style.borderTopRightRadius = borderRadius;
        }
        else
        {
            fakeItem[1].style.borderTopRightRadius = borderRadius;
        }
    }

    // Clicking effects
    itemsMenu[i].addEventListener('click', (function(arg) {
        return function() {
            window.location.href = nameIconsMenu[arg] + '_page.php';
        }
    }) (i));
}

homeIcon.addEventListener('click', function() {
    window.open('index.php');
});

logoWeatherStation.addEventListener('mouseenter', function() {
    logoWeatherStation.src = 'assets/images/logo_weather_station_colored.png';
});

logoWeatherStation.addEventListener('mouseleave', function() {
    logoWeatherStation.src = 'assets/images/logo_weather_station.png';
});

logoMines.addEventListener('click', function() {
    window.open('https://emse.fr/', '_blank');
});

contributorsContainer.addEventListener('click', function() {
    window.open('https://github.com/ThePebblesFr/myWeatherStation', '_blank');
});