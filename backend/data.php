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
                    $pressure *= 100;
                    $dateTime = date('Y-m-d H:i:s');

                    // $data = array(
                    //     "token" => $config_file->api_token,
                    //     "temperature" => $temperature,
                    //     "humidity" => $humidity,
                    //     "pressure" => $pressure,
                    //     "date" => $dateTime
                    // );

                    // $ch = curl_init();
                    // curl_setopt($ch, CURLOPT_URL, "https://comif-ismin.fr/others/myWeatherStation/insertData.php");
                    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                    // $curl_output = curl_exec($ch);
                    
                    $output['temperature'] = $temperature;
                    $output['humidity'] = $relativeHumidity;
                    $output['pressure'] = $pressure;
                    $output['date'] = $dateTime;
                    $output['exitcode'] = 200;
                    $output['message'] = 'Ok ! Data sent !';
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