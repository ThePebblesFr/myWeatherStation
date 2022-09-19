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
var daysOfTheWeek = Array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
var colors = Array('#FFFFFF', '#EAEAEA', '#fdb813', '#0487E2', '#bc1142', '#000000');

// Items ----------------------------------------------------------------------
var nameIconsMenu = Array('home', 'temperature', 'humidity', 'pressure');
var itemsMenu = document.getElementsByClassName('menuItemContainer');
var fakeItem = document.getElementsByClassName('fakeItemContainer');
var iconsMenu = document.getElementsByClassName('menuIcon');

var homeIcon = document.getElementById('homeIcon');
var logoWeatherStation = document.getElementById('logoWeatherStation');
var logoMines = document.getElementById('logoMines');

var temperatureIcon = document.getElementById('temperatureIcon');
var humidityIcon = document.getElementById('humidityIcon');
var temperatureValue = document.getElementById('temperatureValue');
var humidityValue = document.getElementById('humidityValue');

var fahrenHeitValue = document.getElementById('fahrenHeitValue');

var page = document.getElementsByClassName('titleTopContainer')[0].innerText.toLowerCase();
const ctx_temp = document.getElementById('chartTemperature').getContext('2d');
const ctx_hum = document.getElementById('chartHumidity').getContext('2d');
const ctx_press = document.getElementById('chartPressure').getContext('2d');

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
        itemsMenu[i].style.backgroundColor = '#FFFFFF';
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
            window.location.href = (arg == 0) ? 'index.php' : nameIconsMenu[arg] + '_page.php';
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

// Charts index.php -----------------------------------------------------------
const chartTemperature = new Chart(ctx_temp, {
    type: 'line',
    data: {
        labels: ['10h', '11h', '12h', '13h', '14h', '15h'],
        datasets: [{
            label: '',
            data: [22.43, 24.12, 24.43, 25.10, 26.56, 25.49],
            fill: false,
            borderColor: colors[4],
            pointBackgroundColor: colors[4],
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

const chartHumidity = new Chart(ctx_hum, {
    type: 'line',
    data: {
        labels: ['10h', '11h', '12h', '13h', '14h', '15h'],
        datasets: [{
            label: '',
            data: [22.43, 24.12, 24.43, 25.10, 26.56, 25.49],
            fill: false,
            borderColor: colors[4],
            pointBackgroundColor: colors[4],
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

const chartPressure = new Chart(ctx_press, {
    type: 'line',
    data: {
        labels: ['10h', '11h', '12h', '13h', '14h', '15h'],
        datasets: [{
            label: '',
            data: [22.43, 24.12, 24.43, 25.10, 26.56, 25.49],
            fill: false,
            borderColor: colors[4],
            pointBackgroundColor: colors[4],
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

// Data conversion ------------------------------------------------------------
if (parseFloat(temperatureValue.innerText.substring(0,5)) > 20.0)
{
    temperatureIcon.src = 'assets/images/hot_icon.png';
}
else
{
    temperatureIcon.src = 'assets/images/cold_icon.png';
}

if (parseFloat(humidityValue.innerText.substring(0,5)) > 50.0)
{
    humidityIcon.src = 'assets/images/humid_icon.png';
}
else
{
    humidityIcon.src = 'assets/images/dry_icon.png';
}

var fahrenHeitTemp = Math.round((parseFloat(temperatureValue.innerText.substring(0,5)) * (9 / 5) + 32) * 100) / 100;
fahrenHeitValue.innerHTML = fahrenHeitTemp.toString() + "°F";

// Date and time --------------------------------------------------------------
