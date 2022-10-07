<?php

include "../core/helper.php";

if(!isset($_POST["category_id"]) || !isset($_POST["user_id"]) || !isset($_POST["description"]) || !isset($_POST["amount"]) ){
    json_response(400, "category_id, user_id, description, amount and type must be filled");
}

$userID      = $_POST["user_id"];
$categoryID  = $_POST["category_id"];
$description = $_POST["description"];
$amount      = $_POST["amount"];
$type        = strtoupper($_POST["type"]);
$date        = date("Y-m-d");

$rawQuery = "INSERT INTO transactions (category_id, user_id, description, amount, type, date)
VALUES ('$categoryID', '$userID', '$description', '$amount', '$type', '$date')";

$results = mysqli_query($conn, $rawQuery);
if($results){
    json_response(201, "Data Transaction Created");
}else{
    json_response(422, mysqli_error($conn));
}