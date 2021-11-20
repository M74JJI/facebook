<?php

class Post extends User{
 
    function __construct($pdo){

        $this->pdo = $pdo;

    }

    public function posts($userid,$profileId,$num){
        $userdata = $this->getUserInfo($userid);

        $statement= $this->pdo->prepare('SELECT * FROM users LEFT JOIN profile ON users.id=profile.user_id LEFT JOIN post ON post.user_id=users.id WHERE post.user_id =:user_id
        ORDER BY post.postedAt DESC LIMIT :num');

        $statement->bindParam(':user_id',$profileId,PDO::PARAM_INT);
        $statement->bindParam('num',$num,PDO::PARAM_INT);
        $statement->execute();
        $posts=$statement->fetchAll(PDO::FETCH_OBJ);
       

        return $posts;
        
        
    }
}


?>