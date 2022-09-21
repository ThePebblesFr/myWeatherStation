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
        <title>myWeatherStation - Welcome</title>
        <script type="text/javascript" src="jQuery.js"></script>
    </head>
    <body>
        <div id="nbSendings"></div>
        <script type="text/javascript">
            var nbSendings = 0;
            setInterval(function() {
                $.ajax({
                    type: 'GET',
                    url: 'https://comif-ismin.fr/others/myWeatherStation/insertData.php',
                    success: function() {
                        nbSendings++;
                        document.getElementById("nbSendings").innerHTML = nbSendings;
                    }
                });
            }, 1000);
        </script>
    </body>
</html>