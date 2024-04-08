<?php
$host = "localhost";
$database = "CLE3";
$email = "1070054@hr.nl";
$password = "12345";

// maak connection
$db = mysqli_connect($host, $email, $password, $database);

// check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


