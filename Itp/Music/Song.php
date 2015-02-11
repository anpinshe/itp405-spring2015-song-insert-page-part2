<?php

namespace Itp\Music;

use Itp\Base\Database;

class Song extends Database {
    protected $t;
    protected $aid;
    protected $gid;
    protected $p;
    
    public function __construct(){
        session_start();
        parent::__construct(); 
    }
    
    public function setTitle($title){
        $this->t = $title;
        //echo $this->t;
    }
    public function setArtistId($id){
        $this->aid = $id;
    }
    public function setGenreId($genre_id){
        $this->gid = $genre_id;
    }
    public function setPrice($price){
        $this->p = $price;
    }
    public function save(){
    try{
        $sql = "
            INSERT INTO songs (title, artist_id, genre_id, price)
            VALUES(:title, :aid, :gid, :p)
        ";
        $statement = static::$pdo->prepare($sql);
        $statement->bindParam(':title', $this->t);
        $statement->bindParam(':aid', $this->aid);
        $statement->bindParam(':gid', $this->gid);
        $statement->bindParam(':p', $this->p);
        
		$statement->execute();
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
    }
    public function getTitle(){
        return $this->t;
    }
    public function getId(){
        /*$sql = "
            SELECT id
            FROM songs
            WHERE title = ? AND genre_id =?
            LIMIT 1
            ";
        
        $statement = static::$pdo->prepare($sql);
        $statement->bindParam(1, $this->t);
        $statement->bindParam(2, $this->gid);
        $statement->execute();
        $id = $statement->fetch(PDO::FETCH_OBJ);
        //echo $id->id;*/
        $id = static::$pdo->lastInsertId();
        
        if($id){
            return $id;
        }
    }
}