<?php

/*
    __________________________________________________________________________
   |                                                                          |
   |                     MY WHEATHER STATION - DATA/API                       |
   |                                                                          |
   |    Author            :   M. JALES, P. GARREAU                            |
   |    Status            :   Under Development                               |
   |    Last Modification :   19/09/2022                                      |
   |    Project           :   EMBEDDED LINUX PROJECT                          |
   |                                                                          |
   |__________________________________________________________________________|
   
*/

/* ----------------------------------------------------------------------------
                                     INIT
---------------------------------------------------------------------------- */
	$config_file = (object) parse_ini_file("config.ini");
	$output = array(
        'exitcode' => 500,
        'message' => 'Internal Server Error'
    );

    // BDD
    $servname = $config_file->servername;
    $user = $config_file->username;
    $pwd = $config_file->password;
    $bddname = $config_file->database;
    $table = $config_file->table;

    // Server connection

    switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':
            if (!empty($_GET['token']))
            {
                if ($_GET['token'] == $config_file->api_token)
                {
                    $temperature = file_get_contents("/sys/bus/iio/devices/iio:device0/in_temp_input");
					$relativeHumidity = round(floatval(file_get_contents("/sys/bus/iio/devices/iio:device0/in_humidityrelative_input")), 2);
					$pressure = round(floatval(file_get_contents("/sys/bus/iio/devices/iio:device0/in_pressure_input")), 2);

					$temperature /= 1000;

                    echo $servname . '<br />';
                    echo $user . '<br />';
                    echo $pwd . '<br />';
                    echo $bddname . '<br />';

                    // Update database 
                    $bddConn = new PDO('mysql:host=localhost;dbname='.$config_file->database.';charset=utf8', $config_file->username, $config_file->password);
                    //$conn = new PDO("mysql:host=$servname;dbname=$bddname", $user, $pwd);

                    echo "connected<br />";
                    $date = date('Y-m-d H:i:s');
                    $sql = "INSERT INTO $table (date_, temperature, humidity, pressure) VALUES (:date_, :temperature, :relativeHumidity, :pressure";
                    $request = $conn->prepare($sql);

                    $request->bindParam(':date_', $date);
                    $request->bindParam(':temperature', $temperature);
                    $request->bindParam(':humidity', $relativeHumidity);
                    $request->bindParam(':pressure_', $pressure);

                    if ($request->execute())
                    {
                        $output['exitcode'] = 200;
                        $output['message'] = 'OK ! Database updated';
                        
                        $output += [ 'temperature' => strval($temperature) ];
                        $output += [ 'relativeHumidity' => strval($relativeHumidity) ];
                        $output += [ 'pressure' => strval($pressure) ];
                    }                                  
                }
                else
                {
                    $output['exitcode'] = 403;
                    $output['message'] = 'Access denied ! Wrong token';
                }
            }
            else
            {
                $output['exitcode'] = 403;
                $output['message'] = 'Access denied ! Token required';
            }
            break;
        default:
            $output['exitcode'] = 501;
            $output['message'] = 'Method not implemented';
            break;
    }
    echo json_encode($output, JSON_PRETTY_PRINT);
?>