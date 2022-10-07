<?php

include "../core/helper.php";

if(!isset($queryParam["user_id"])){
    json_response(400, "user_id must be filled");
}

$userID = $queryParam["user_id"];
$appendWhere = "";
if(isset($queryParam["type"])){
    $type          = strtoupper($queryParam["type"]);
    $appendWhere  .= " AND transactions.type = '$type'";
}else{
    $appendWhere .= " AND transactions.type IN ('IN', 'OUT')";
}

if( isset($queryParam["start_date"]) && isset($queryParam["end_date"])){
    $startDate     = $queryParam["start_date"];
    $endDate       = $queryParam["end_date"];
    $appendWhere  .= " AND transactions.date >= '$startDate' AND transactions.date <= '$endDate'";
}

$rawQuery = "SELECT transactions.id, categories.name as category, transactions.description, transactions.amount, transactions.type, transactions.date
FROM `transactions`
JOIN categories ON categories.id = transactions.category_id
WHERE transactions.user_id = '$userID' $appendWhere
ORDER BY transactions.date DESC";

$result = mysqli_query($conn, $rawQuery);

$totalIn  = 0;
$totalOut = 0;
$balance  = 0;
$data = [];
if ($result){
    while($row = mysqli_fetch_assoc($result)){
        $data[] = [
            "id"          => $row["id"],
            "category"    => $row["category"],
            "description" => $row["description"],
            "amount"      => (double) $row["amount"],
            "type"        => $row["type"],
            "date"        => $row["date"],
        ];

        if($row["type"] == "IN"){
            $totalIn += (double) $row["amount"];
        }else if($row["type"] == "OUT"){
            $totalOut += (double) $row["amount"];
        }

        $balance = $totalIn - $totalOut;
        $options = [
            "total_in"  => (double) $totalIn,
            "total_out" => (double) $totalOut,
            "balance"  => (double) $balance,
        ];

    }

    json_response(200, "OK", $data, $options);

}else{
    json_response(422, mysqli_error($conn));

}

