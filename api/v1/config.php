<?php
    class DB {
        private static function connect(){
         $pdo = new PDO("mysql:hostname=localhost;dbname=onito;charset=UTF8","root",""); 
         $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
         return $pdo;
        }
        public static function query ($query , $params) {
            $statement=self::connect()->prepare($query);
            $statement->execute($params);
            if (explode(" ",$query)[0]="SELECT") {
                $data = $statement->fetchAll();    
                return $data;
            }
        }
    }


?>