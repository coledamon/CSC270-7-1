<?php

// Create constants
//COMPUTER
//DEFINE ('DB_USER', 'root');
//DEFINE ('DB_PSWD', 'root');
//PI
DEFINE ('DB_USER', 'MyUser');
DEFINE ('DB_PSWD', 'MyPass');
DEFINE ('DB_SERVER', 'localhost');
DEFINE ('DB_NAME', 'MediaLibrary');

// ///////////////////////////////////////////////////
// Get db connection
function ConnGet() {
    // $dbConn will contain a resource link to the database
    // @ Don't display error
    $dbConn = @mysqli_connect(DB_SERVER, DB_USER, DB_PSWD, DB_NAME, 3306)
    OR die('Failed to connect to MySQL ' . DB_SERVER . '::' . DB_NAME . ' : ' . mysqli_connect_error()); // Display messge and end PHP script

    return $dbConn;
}

function sanitizeInput($input) {
    $sanInput = preg_replace("(;|DELIMITER)", "", $input);
    return $sanInput;
}

function formatRecords($result) {
    $myjson = null;
    $row = null;

    if ($result){
        while($row = mysqli_fetch_array($result)) {
            $rowarray[] = json_decode($row[0]);
        }
        $myjson = json_encode($rowarray);
    }

    return $myjson;
}

function connClose($dbConn) {
    mysqli_close($dbConn);
}



?>


