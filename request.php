<?php

// BDD

    $servname = $config_file->servername;
    $user = $config_file->username;
    $pwd = $config_file->password;
    $bddname = $config_file->database;
    $table = $config_file->table;

    $conn = new PDO("mysql:host=$servname;dbname=$bddname", $user, $pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_LOCAL_INFILE => true));
    
    $recent_temperature = "SELECT temperature FROM data WHERE id=(SELECT MAX(id) FROM data)";
    $conn->exec($recent_temperature);

    $recent_humidity = "SELECT humidity FROM data WHERE id=(SELECT MAX(id) FROM data)";
    $conn->exec($recent_humidity);

    $recent_pressure = "SELECT pressure FROM data WHERE id=(SELECT MAX(id) FROM data)";
    $conn->exec($recent_pressure);

    $daily_avg_temperature = 'SELECT AVG(SELECT temperature FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 23:59:5999") FROM data';
    $conn->exec($daily_avg_temperature);

    $daily_avg_humidity = 'SELECT AVG(SELECT humidity FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 23:59:5999") FROM data';
    $conn->exec($daily_avg_humidity);

    $daily_avg_pressure = 'SELECT AVG(SELECT pressure FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 23:59:5999") FROM data';
    $conn->exec($daily_avg_pressure);

    $hourly_avg_temperature = 'SELECT AVG(SELECT temperature FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 00:59:5999") FROM data';
    $conn->exec($hourly_avg_temperature);

    $hourly_avg_humidity = 'SELECT AVG(SELECT humidity FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 00:59:5999") FROM data';
    $conn->exec($hourly_avg_humidity);

    $hourly_avg_pressure = 'SELECT AVG(SELECT pressure FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 00:59:5999") FROM data';
    $conn->exec($hourly_avg_pressure);

    $six_hours_avg_temperature = 'SELECT AVG(SELECT temperature FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 05:59:5999") FROM data';
    $conn->exec($hourly_avg_temperature);

    $six_hours_avg_pressure = 'SELECT AVG(SELECT pressure FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 05:59:5999") FROM data';
    $conn->exec($hourly_avg_pressure);

    $six_hours_avg_humidity = 'SELECT AVG(SELECT humidity FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 05:59:5999") FROM data';
    $conn->exec($hourly_avg_humidity);
    
    $daily_min_temperature = 'SELECT MIN(SELECT temperature FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 23:59:5999") AS "minDaily" FROM data';
    $conn->exec($daily_avg_temperature);

    $daily_max_temperature = 'SELECT MIN(SELECT temperature FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 23:59:5999") FROM data';
    $conn->exec($daily_avg_temperature);

    $daily_min_humidity = 'SELECT MIN(SELECT humidity FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 23:59:5999") FROM data';
    $conn->exec($daily_avg_humidity);

    $daily_max_humidity = 'SELECT MIN(SELECT humidity FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 23:59:5999") FROM data';
    $conn->exec($daily_avg_humidity);

    $daily_min_pressure = 'SELECT MIN(SELECT pressure FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 23:59:5999") FROM data';
    $conn->exec($daily_avg_pressure);

    $daily_max_pressure = 'SELECT MIN(SELECT pressure FROM data WHERE date_ >= "2022-09-24 00:00:0000" and date_ <= "2022-09-24 23:59:5999") FROM data';
    $conn->exec($daily_avg_pressure);


?>