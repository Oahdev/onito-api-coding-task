<?php
//database connection
require "config.php";

//checking request method
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //updating runtime for "Documentary"
    DB::query("UPDATE movies SET runtimeMinutes = (runtimeMinutes + 15) WHERE genres = :genre",array(":genre"=>"Documentary"));

    //updating runtime for "Animation"
    DB::query("UPDATE movies SET runtimeMinutes = (runtimeMinutes + 30) WHERE genres = :genre",array(":genre"=>"Animation"));

    //updating runtime for the rest
    DB::query("UPDATE movies SET runtimeMinutes = (runtimeMinutes + 45) WHERE genres != :genre1 AND genres != :genre2",array(":genre1"=>"Animation",":genre2"=>"Documentary"));
    
    $response = "runtime updated";
}else{
    $response = "invalid request method";
}

//returning response
echo $response;
?>