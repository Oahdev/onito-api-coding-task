<?php
require "config.php";
$response = [];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST["input"])){
        $input = json_decode($_POST["input"]);
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
echo json_encode($response);
?>