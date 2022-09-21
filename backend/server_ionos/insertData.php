<?php
    $config_file = (object) parse_ini_file("config.ini");
    $data_file = json_decode(file_get_contents("data.json"));

    $servname = $config_file->servername;
    $user = $config_file->username;
    $pwd = $config_file->password;
    $bddname = $config_file->database;
    $table = $config_file->table;

    $bddConn = new PDO('mysql:host='.$servname.';dbname='.$config_file->database.';charset=utf8', $config_file->username, $config_file->password);

    $temperature = $data_file->temperature;
    $humidity = $data_file->humidity;
    $pressure = $data_file->pressure;
    var_dump($temperature);
    var_dump($humidity);
    var_dump($pressure);

    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO ".$table." (date_, temperature, humidity, pressure) VALUES (:date_, :temperature, :humidity, :pressure)";
    $request = $bddConn->prepare($sql);

    $request->bindParam(':date_', $date);
    $request->bindParam(':temperature', $temperature);
    $request->bindParam(':humidity', $humidity);
    $request->bindParam(':pressure', $pressure);
    echo "hello";
;
    if ($request->execute())
    {
        echo "Request sent successfully";
    }                          
?>