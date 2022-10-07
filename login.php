<?php

include "../core/helper.php";

if(!isset($_POST["email"]) || !isset($_POST["password"])){
    json_response(400, "Email, and Password must be filled");
}

$email          = $_POST["email"];
$password       = $_POST["password"];

$rawQuery = "SELECT * FROM users WHERE email = '$email'";
$query = mysqli_query($conn, $rawQuery);
$rowUser = mysqli_num_rows($query);
$user = mysqli_fetch_assoc($query);

if ( $rowUser  >= 1 ){
    if( password_verify($password, $user["password"]) ){

        $data = [
            "id"    => $user["id"],
            "name"  => $user["name"],
            "email" => $user["email"],
            "date"  => $user["date"],

        ];

        json_response(200, "OK", $data);

    }else{
        json_response(400, "Password wrong!");
    }

}else{
    json_response(400, "Email do not match!");
}