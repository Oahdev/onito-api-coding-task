<?php
require "config.php";
$response = [];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    DB::query("UPDATE movies SET runtimeMinutes = (runtimeMinutes + 15) WHERE genres = :genre",array(":genre"=>"Documentary"));
    DB::query("UPDATE movies SET runtimeMinutes = (runtimeMinutes + 30) WHERE genres = :genre",array(":genre"=>"Animation"));
    DB::query("UPDATE movies SET runtimeMinutes = (runtimeMinutes + 45) WHERE genres != :genre1 AND genres != :genre2",array(":genre1"=>"Animation",":genre2"=>"Documentary"));
    $response = "runtime updated";
}else{
    $response = "invalid request method";
}
echo json_encode($response);
?>