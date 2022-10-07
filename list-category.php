<?php

include "../core/helper.php";

$rawQuery = "SELECT * FROM `categories`";

$result = mysqli_query($conn, $rawQuery);

$data = [];
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $data[] = [
            "id"   => $row["id"],
            "name" => $row["name"],
        ];
    }

    json_response(200, "OK", $data);

}else{
    
    json_response(422, mysqli_error($conn));

}