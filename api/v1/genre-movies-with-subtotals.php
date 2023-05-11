<?php
//database connection
require "config.php";

//checking request method
if($_SERVER["REQUEST_METHOD"] == "GET"){

    //fetching all genres from movies database 
    $db_genres = DB::query("SELECT genres FROM movies",array());
    
    //saving each unique genres into "genre_list" array
    $genre_list = [];
    foreach ($db_genres as $key => $value) {
        if(!(in_array($value["genres"],$genre_list))){
            array_push($genre_list,$value["genres"]);
        }
    }
    
    //declaring variable to store all the movies details with their html semantic tags
    $total_movies_list = "";

    //loop through genres("genre_list") to get movies under that genre
    foreach ($genre_list as $key => $genre) {

        //fetching movies under iteration genre from database
        $movies_list = DB::query("SELECT movies.genres,movies.primaryTitle,ratings.numVotes FROM movies,ratings WHERE movies.tconst = ratings.tconst AND movies.genres = :genres ORDER BY movies.genres ASC",array(":genres"=>$genre));
        
        //calculation of numVotes of movies under iteration genre from database 
        $subtotal = DB::query("SELECT sum(numVotes) AS subtotal FROM movies,ratings WHERE movies.genres = :genre AND movies.tconst = ratings.tconst",array(":genre"=>$genre));
        
        //loop through movies("movies_list") to save individual movie data into earlier declared "total_movies_list" variable with html semantic tags
        foreach ($movies_list as $key => $value) {
            $total_movies_list .= '<tr>
                <td>'.$value["genres"].'</td>
                <td>'.$value["primaryTitle"].'</td>
                <td>'.$value["numVotes"].'</td>
            </tr>';
        }

        //saving total of numVotes into the "total_movies_list" variable with html semantic tags directly after the genre movies
        $total_movies_list .= '<tr>
            <td></td>
            <td><b>TOTAL</b></td>
            <td>'.$subtotal[0]["subtotal"].'</td>
        </tr>';
    }

    //creating html table and saving in "response" along with the "total_movies_list" included in the table body
    $response = '
    <html>
        <style>
            table{background-color:black;}
            table th,td{
                width:max-content;
                padding:9px 20px;
                text-align:start;
                background-color:white;
            }
        </style>
        <table>
            <thead>
                <tr>
                    <th>Genre</th>
                    <th>primaryTitle</th>
                    <th>numVotes</th>
                </tr>
            </thead>
            <tbody>'.$total_movies_list.'</tbody>
        </table>
    </html>
    ';
    
}else{
    $response = "invalid request method";
}

//returning response
echo $response;
?>