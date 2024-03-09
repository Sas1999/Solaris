php

echo PHP script is running.;

if (isset($_POST['insert'])) {
     Your Firebase Realtime Database URL
    $firebaseUrl = 'httpssolaris-2e0fa-default-rtdb.asia-southeast1.firebasedatabase.app';

     Firebase Web API Key
    $firebaseApiKey = 'AIzaSyC3uV0QQCsSSNzoRo_K15JmkyHJmGJ1o_k';

     Initialize cURL session
    $ch = curl_init();

     Set cURL options
    $postData = [
        'VOLTAGE' = $_POST['v'],
        'CURRENT' = $_POST['c'],
        'FREQUENCY' = $_POST['f'],
        'POWER' = $_POST['p'],
        'SOLAR_INTENSITY' = $_POST['sr'],
        'METER_NAME' = $_POST['m'],
    ];

     Firebase Realtime Database path where data will be stored
    $firebasePath = 'sensordata1.json';

     URL to Firebase Realtime Database
    $url = $firebaseUrl . $firebasePath . 'key=' . $firebaseApiKey;

     Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');  Use PATCH for updating data

     Send data to Firebase
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    $response = curl_exec($ch);

     Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error ' . curl_error($ch);
    } else {
         Check Firebase response
        $responseData = json_decode($response, true);
        if ($responseData && isset($responseData['name'])) {
            echo 'Data Inserted into Firebase';
        } else {
            echo 'Error Inserting Data into Firebase';
        }
    }

     Close cURL session
    curl_close($ch);
}

