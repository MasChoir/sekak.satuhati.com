<?php

$results = [
    "status"  => 200,
    "message" => "ok",
    "data"    => [
        "author" => "sekak",
        "bio"    => "@sekak"
    ]
];

header("HTPP/1.1 200 OK");
header("Content-Type: application/json; charset=utf8");

$json_response = json_encode($results);

echo $json_response;