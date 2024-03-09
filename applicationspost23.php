<?php
echo "PHP script is running.";

if (isset($_POST['insert'])) {
    $hostname = "localhost";
    $username = "root";
    $password = "";

    $connect = mysqli_connect($hostname, $username, $password);

    // Check connection
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create database if it does not exist
    $databaseName = "solart";
    $createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $databaseName";

    if (mysqli_query($connect, $createDatabaseQuery)) {
        echo "Database created or already exists";
    } else {
        echo "Error creating database: " . mysqli_error($connect);
    }

    // Select the database
    mysqli_select_db($connect, $databaseName);

    // Create table if it does not exist
    $createTableQuery = "CREATE TABLE IF NOT EXISTS sensordata1 (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        VOLTAGE FLOAT,
        CURRENT FLOAT,
        POWER FLOAT,
        FREQUENCY FLOAT,
        SOLAR_INTENSITY FLOAT,
        METER_NAME VARCHAR(50)
    )";

    if (mysqli_query($connect, $createTableQuery)) {
        echo "Table created or already exists";
    } else {
        echo "Error creating table: " . mysqli_error($connect);
    }

    // Insert data into the table
    $volt = $_POST['v'];
    $curr = $_POST['c'];
    $freq = $_POST['f'];
    $pow = $_POST['p'];
    $solar_intensity = $_POST['sr'];
    $meter_name = $_POST['m'];

    $query = "INSERT INTO `sensordata1` (`VOLTAGE`, `CURRENT`, `POWER`, `FREQUENCY`, `SOLAR_INTENSITY`, `METER_NAME`) 
              VALUES ('$volt', '$curr', '$freq', '$pow', '$solar_intensity', '$meter_name')";

    $result = mysqli_query($connect, $query);

    if ($result) {
        echo 'Data Inserted';
    } else {
        echo 'Data Not Inserted';
    }

    mysqli_free_result($result);
    mysqli_close($connect);
}
?>
