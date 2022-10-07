<?php

include "../core/helper.php";

if(!isset($queryParam["id"])){
    json_response(400, "id must be filled");
}

$ID = $queryParam["id"];

$rawQuery = "DELETE FROM transactions WHERE id = '$ID'";
$result = mysqli_query($conn, $rawQuery);
if($result){
    json_response(200, "Data has been delete");
}else{
    json_response(422, mysqli_error($conn));
}