<?php

include "../core/helper.php";

if(!isset($_POST["id"]) || !isset($_POST["category_id"]) || !isset($_POST["user_id"]) || !isset($_POST["description"]) || !isset($_POST["amount"]) || !isset($_POST["type"]) || !isset($_POST["date"]) ){
   json_response(400, "id, category_id, user_id, description, amount, and type must be filled");

}

$ID          = $_POST["id"];
$description = $_POST["description"];
$amount      = $_POST["amount"];
$type        = $_POST["type"];
$date        = $_POST["date"];

$rawQuery = "UPDATE transactions SET  description = '$description', amount = $amount, type = '$type', date = '$date'
WHERE id = '$ID'";

$result = mysqli_query($conn, $rawQuery);
if($result){
    json_response(200, "Data Transaction Update");
}else{
    json_response(422, mysqli_error($conn));
}
