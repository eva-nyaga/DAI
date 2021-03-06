<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();
/*$_POST['first']="Eva";
$_POST['last']="Mukii";
$_POST['mail']="eva@gmail";
$_POST['number']="56798";
$_POST['amdroid_version']="1"*/

// check for required fields
if (isset($_POST['first']) && isset($_POST['last']) && isset($_POST['mail']) && isset($_POST['number']) && isset($_POST['android_version'])) {
    
    $first = $_POST['first'];
    $last = $_POST['last'];
    $mail = $_POST['mail'];
    $number = $_POST['number'];
    $version = $_POST['android_version'];
   
    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    $query = "INSERT IGNORE INTO registration(firstname, lastname, email, contacts,registered_on,software_version,android_version) VALUES('$first', '$last', '$mail', '$number',NOW(), 'registration version 1.0.0','$version')";
    // mysql inserting a new row
    $result = mysql_query($query);
    

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "User successfully created.";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
        
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
