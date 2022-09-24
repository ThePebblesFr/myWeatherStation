/*
    __________________________________________________________________________
   |                                                                          |
   |              MY WHEATHER STATION - TEMEPERATURE SCRIPT                   |
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

var temperatureValue = document.getElementById('temperatureValue');
var fahrenHeitValue = document.getElementById('fahrenHeitValue');
var dayNightIcon = document.getElementById('dayNightIcon');
var dateContainer = document.getElementById('dateContainer');
var timeContainer = document.getElementById('timeContainer');

const ctx_detailed_temp = document.getElementById('chart_detailed_temp').getContext('2d');
var timeOfTheDay = Array('00h', '1h', '2h', '3h', '4h', '5h', '6h', '7h', '8h', '9h', '10h', '11h', '12h', '13h', '14h', '15h', '16h', '17h', '18h', '19h', '20h', '21h', '22h', '23h');

/* ----------------------------------------------------------------------------
                                    MAIN
---------------------------------------------------------------------------- */

// Data conversion and icons --------------------------------------------------

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
}, 1000);

// Chart temperature.php -----------------------------------------------------------
const chartDetailedTemperature = new Chart(ctx_detailed_temp, {
    type: 'line',
    data: {
        labels: timeOfTheDay,
        datasets: [{
            label: '',
            data: [22.43, 24.12, 24.43, 25.10, 26.56, 25.49],
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

/* ----------------------------------------------------------------------------
                                FUCNTIONS
---------------------------------------------------------------------------- */

function timelayout(num) {
    return (num.length == 1) ? '0' + num : num ;
}

function dayTime(time) {
    return (time > 8 && time < 20);
}