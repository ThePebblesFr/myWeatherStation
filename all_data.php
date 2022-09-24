<?php

    $config_file = (object) parse_ini_file("config.ini");
    $bddConn = new PDO('mysql:host='.$config_file->servername.';dbname='.$config_file->database.';charset=utf8', $config_file->username, $config_file->password);

    $output = array(
        'exitcode' => 500,
        'message' => 'Internal Server Error'
    );

    switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':
            $output['nb_hours'] = 0;
            for ($i = 0; $i < 24; $i++) {
                $day_and_hour = $_GET['day'] . ' ' . strval($i) . ':00:00';
                $day_and_hour_plus_1 = $_GET['day'] . ' ' . strval($i + 1) . ':00:00';
                $getAvgDaily = 'SELECT AVG(temperature) AS "avg_temperature" FROM data WHERE date_ >= "'.$day_and_hour.'" AND date_ < "'.$day_and_hour_plus_1.'"';
                $requestGetAvgDaily = $bddConn->query($getAvgDaily);
                $temp_result = $requestGetAvgDaily->fetch();
                if ($temp_result['avg_temperature'] != NULL)
                {
                    $output['nb_hours']++;
                    $output += [ $i => $temp_result['avg_temperature'] ];
                }
                else
                {
                    $output += [ $i => 0.0 ];
                }
                $output['exitcode'] = 200;
                $output['message'] = 'Ok ! Data sent !';
            }
            break;
        default:
            $output['exitcode'] = 501;
            $output['message'] = 'Method not implemented';
            break;
    }

    echo json_encode($output, JSON_PRETTY_PRINT);
?>