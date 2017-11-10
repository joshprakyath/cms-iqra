<?php
define("DB_SERVER","localhost"); //replace this with your database server
define("DB_USER","root"); //replace this with your database username
define("DB_PASS","root"); //replace this with your database passoword
define("DB_NAME","iqra"); //replace this with your database name

// Create connection
$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
