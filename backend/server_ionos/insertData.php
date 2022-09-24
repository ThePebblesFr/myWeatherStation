<?php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // should do a check here to match $_SERVER['HTTP_ORIGIN'] to a
        // whitelist of safe domains
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         
    
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    
    }
/*
    __________________________________________________________________________
   |                                                                          |
   |               MY WHEATHER STATION - INSERT DATA/SERVER                   |
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
            phpinfo();
            break;
        case 'POST':
            if (!empty($_POST['token']))
            {
                if ($_POST['token'] == $config_file->api_token)
                {
                    $temperature = floatval($_POST['temperature']);
                    $humidity = floatval($_POST['humidity']);
                    $pressure = floatval($_POST['pressure']);
                    $dateTime = date('Y-m-d H:i:s');

                    $bddConn = new PDO('mysql:host='.$servname.';dbname='.$config_file->database.';charset=utf8', $config_file->username, $config_file->password);

                    $sql = "INSERT INTO ".$table." (date_, temperature, humidity, pressure) VALUES (:date_, :temperature, :humidity, :pressure)";
                    $request = $bddConn->prepare($sql);

                    $request->bindParam(':date_', $dateTime);
                    $request->bindParam(':temperature', $temperature);
                    $request->bindParam(':humidity', $humidity);
                    $request->bindParam(':pressure', $pressure);

                    if ($request->execute())
                    {
                        $output['exitcode'] = 200;
                        $output['message'] = 'Ok ! Data inserted in database !';
                    }
                }
                else
                {
                    $output['exitcode'] = 403;
                    $output['message'] = 'Access denied ! Wrong token ';
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

<?php
//     $config_file = (object) parse_ini_file("config.ini");
//     $data_file = json_decode(file_get_contents("data.json"));

//     $servname = $config_file->servername;
//     $user = $config_file->username;
//     $pwd = $config_file->password;
//     $bddname = $config_file->database;
//     $table = $config_file->table;

//     $bddConn = new PDO('mysql:host='.$servname.';dbname='.$config_file->database.';charset=utf8', $config_file->username, $config_file->password);

//     $temperature = $data_file->temperature;
//     $humidity = $data_file->humidity;
//     $pressure = $data_file->pressure;
//     var_dump($temperature);
//     var_dump($humidity);
//     var_dump($pressure);

//     $date = date('Y-m-d H:i:s');
//     $sql = "INSERT INTO ".$table." (date_, temperature, humidity, pressure) VALUES (:date_, :temperature, :humidity, :pressure)";
//     $request = $bddConn->prepare($sql);

//     $request->bindParam(':date_', $date);
//     $request->bindParam(':temperature', $temperature);
//     $request->bindParam(':humidity', $humidity);
//     $request->bindParam(':pressure', $pressure);
//     echo "hello";
// ;
//     if ($request->execute())
//     {
//         echo "Request sent successfully";
//     }                          
?>