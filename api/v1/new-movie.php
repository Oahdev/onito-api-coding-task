<?php
//database connection
require "config.php";

//checking request method
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //checking if input is not empty
    if(!empty($_POST["input"])){

        //saving input parameters as "input"
        $input = json_decode($_POST["input"]);

        //saving input array into database
        DB::query("INSERT INTO movies VALUES(
            :tconst,
            :titleType,
            :primaryTitle,
            :runtimeMinutes,
            :genres
        )",array(
            ":tconst"=>$input[0]->tconst,
            ":titleType"=>$input[0]->titleType,
            ":primaryTitle"=>$input[0]->primaryTitle,
            ":runtimeMinutes"=>$input[0]->runtimeMinutes,
            ":genres"=>$input[0]->genres
        ));


        $response = "success";
    }else{
        $response = "required field missing";
    }
}else{
    $response = "invalid request method";
}

//returning response as JSON
echo json_encode($response);
?>