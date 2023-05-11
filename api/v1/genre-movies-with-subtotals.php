<?php
require "config.php";
$response = [];
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $db_genres = DB::query("SELECT genres FROM movies",array());
    $genre_list = [];
    foreach ($db_genres as $key => $value) {
        if(!(in_array($value["genres"],$genre_list))){
            array_push($genre_list,$value["genres"]);
        }
    }
    $total_movies_list = "";
    foreach ($genre_list as $key => $genre) {
        $movies_list = DB::query("SELECT movies.genres,movies.primaryTitle,ratings.numVotes FROM movies,ratings WHERE movies.tconst = ratings.tconst AND movies.genres = :genres ORDER BY movies.genres ASC",array(":genres"=>$genre));
        $subtotal = DB::query("SELECT sum(numVotes) AS subtotal FROM movies,ratings WHERE movies.genres = :genre AND movies.tconst = ratings.tconst",array(":genre"=>$genre));
        foreach ($movies_list as $key => $value) {
            $total_movies_list .= '<tr>
                <td>'.$value["genres"].'</td>
                <td>'.$value["primaryTitle"].'</td>
                <td>'.$value["numVotes"].'</td>
            </tr>';
        }
        $total_movies_list .= '<tr>
            <td></td>
            <td><b>TOTAL</b></td>
            <td>'.$subtotal[0]["subtotal"].'</td>
        </tr>';
    }
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
echo $response;
?>
