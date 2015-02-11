<?php
//require_once __DIR__ . '/Database.php';

namespace Itp\Music;
use Itp\Base\Database;

class GenreQuery extends Database {
    public function __construct(){
        //session_start();
        parent::__construct();
    }
    
    public function getAll(){
        $sql = "
            SELECT *
            FROM genres
            ORDER BY genre
        ";
        $statement = static::$pdo->prepare($sql);

        $statement->execute();
        $genres = $statement->fetchAll(\PDO::FETCH_OBJ);
        if($genres){
            return $genres;
        }
        
    }
}