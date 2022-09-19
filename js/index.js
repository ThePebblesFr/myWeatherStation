/*
    __________________________________________________________________________
   |                                                                          |
   |                 MY WHEATHER STATION - CHARTS INDEX                       |
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
var iconsMenu = document.getElementsByClassName('menuIcon');
var nameIconsMenu = Array('home', 'temperature', 'humidity', 'pressure');

var detailsItemContainer = document.getElementsByClassName('detailsItemContainer');
var temperatureIcon = document.getElementById('temperatureIcon');
var humidityIcon = document.getElementById('humidityIcon');
var temperatureValue = document.getElementById('temperatureValue');
var humidityValue = document.getElementById('humidityValue');

var fahrenHeitValue = document.getElementById('fahrenHeitValue');
var dayNightIcon = document.getElementById('dayNightIcon');
var dateContainer = document.getElementById('dateContainer');
var timeContainer = document.getElementById('timeContainer');

const ctx_temp = document.getElementById('chartTemperature').getContext('2d');
const ctx_hum = document.getElementById('chartHumidity').getContext('2d');
const ctx_press = document.getElementById('chartPressure').getContext('2d');

/* ----------------------------------------------------------------------------
                                    MAIN
---------------------------------------------------------------------------- */

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

for (var i = 0; i < iconsMenu.length; i++) {
    if (i != 3)
    {
        var j = i + 1;
        detailsItemContainer[i].addEventListener('click', (function(arg) {
            return function() {
                window.location.href = nameIconsMenu[arg] + '_page.php';
            }
        }) (j));
    }
}

// Data conversion and icons --------------------------------------------------
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

var today = new Date();
    dateContainer.innerText = daysOfTheWeek[today.getDay()] + ' ' + today.getDate() + ' ' + monthsOfTheYear[today.getMonth()];
    timeContainer.innerText = timelayout(today.getHours().toString()) + ':' + timelayout(today.getMinutes().toString());

setInterval(function() {
    var today = new Date();
    dateContainer.innerText = daysOfTheWeek[today.getDay()] + ' ' + today.getDate() + ' ' + monthsOfTheYear[today.getMonth()];
    timeContainer.innerText = timelayout(today.getHours().toString()) + ':' + timelayout(today.getMinutes().toString());
    dayNightIcon.src = (dayTime(today.getHours())) ? 'assets/images/day_icon.png' : 'assets/images/night_icon.png';
}, 1000);

/* ----------------------------------------------------------------------------
                                FUCNTIONS
---------------------------------------------------------------------------- */

function timelayout(num) {
    return (num.length == 1) ? '0' + num : num ;
}

function dayTime(time) {
    return (time > 8 && time < 20);
}