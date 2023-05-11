<?php
require "config.php";
$response = [];
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $response = DB::query("SELECT tconst,primaryTitle,runtimeMinutes,genres FROM movies ORDER BY runtimeMinutes DESC LIMIT 10",array());
}else{
    $response = "invalid request method";
}
echo json_encode($response);
?>