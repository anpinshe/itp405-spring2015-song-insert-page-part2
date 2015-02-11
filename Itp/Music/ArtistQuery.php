<?php

namespace Itp\Music;
use Itp\Base\Database;

class ArtistQuery extends Database {
    public function __construct(){
        //session_start();
        parent::__construct();
    }
    
    public function getAll(){
        $sql = "
            SELECT *
            FROM artists
            ORDER BY artist_name
        ";
        $statement = static::$pdo->prepare($sql);
        $statement->execute();
        $artists = $statement->fetchAll(\PDO::FETCH_OBJ);
        if($artists){
            return $artists;
        }
        
    }
}
