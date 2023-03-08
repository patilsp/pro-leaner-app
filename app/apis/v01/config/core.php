<?php
// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('Europe/Zagreb');
 
// variables used for jwt
$key = "example_key";
$iss = "http://localhost/";
$aud = "http://localhost/";
$iat = 1356999524;
$nbf = 1357000000;
?>