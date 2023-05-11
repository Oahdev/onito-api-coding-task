<?php
require "config.php";
$response = [];
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $response = DB::query("SELECT movies.tconst,movies.primaryTitle,movies.genres,ratings.averageRating FROM movies,ratings WHERE ratings.tconst = movies.tconst AND averageRating > :rating ORDER BY averageRating DESC",array(":rating"=>"6.0"));
}else{
    $response = "invalid request method";
}
echo json_encode($response);
?>