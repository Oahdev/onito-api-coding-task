<?php
//database connection
require "config.php";

//checking request method
if($_SERVER["REQUEST_METHOD"] == "GET"){

    //fetching longest duration movies from database and saving to response
    $response = DB::query("SELECT tconst,primaryTitle,runtimeMinutes,genres FROM movies ORDER BY runtimeMinutes DESC LIMIT 10",array());

}else{
    $response = "invalid request method";
}

//returning response as JSON
echo json_encode($response);
?>