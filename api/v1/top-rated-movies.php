<?php
//database connection
require "config.php";

//checking request method
if($_SERVER["REQUEST_METHOD"] == "GET"){

    //fetching rated movies from database and saving to "response"
    $response = DB::query("SELECT movies.tconst,movies.primaryTitle,movies.genres,ratings.averageRating FROM movies,ratings WHERE ratings.tconst = movies.tconst AND averageRating > :rating ORDER BY averageRating DESC",array(":rating"=>"6.0"));

}else{
    $response = "invalid request method";
}

//returning response as JSON
echo json_encode($response);
?>