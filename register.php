<?php

include "../core/helper.php";

if(!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["password"])){
    json_response(400, "Name, Email, and Password must be filled");
}

$name           = $_POST["name"];
$email          = $_POST["email"];
$password       = $_POST["password"];
$date           = date("Y-m-d");
$hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);

$rawQuery = "INSERT INTO users (name, email, password, date) VALUES ('$name', '$email', '$hashedPassword', '$date')";

if(mysqli_query($conn, $rawQuery)){
    json_response(201, "Created");
}else{
    json_response(422, mysqli_error($conn));
}