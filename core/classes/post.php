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
       
          foreach($posts as $post){
              $main_react =$this->main_react($userid,$post->id);
          }
        return $posts;
        
        
    }
    public function main_react($userid,$postid){
        $statement = $this->pdo->prepare("SELECT * FROM react WHERE reactedBy=:userid
         AND reactedOn =:postid AND reactCommentOn='0' AND reactReplyOn='0' " );
         $statement->bindParam(':userid',$userid,PDO::PARAM_INT);
         $statement->bindParam(':postid',$postid,PDO::PARAM_INT);

         $statement->execute();
         return $statement->fetch(PDO::FETCH_OBJ);


    }
    public function react_max_show($postid){
        $statement = $this->pdo->prepare("SELECT reactType,count(*) as maxreact FROM react WHERE reactedOn=:postid AND reactCommentOn='0' AND reactReplyOn='0' GROUP BY reactType LIMIT 3");
         $statement->bindParam(':postid',$postid,PDO::PARAM_INT);
         $statement->execute();
         return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function main_react_count($postid){
        $statement = $this->pdo->prepare("SELECT count(*) as maxreact FROM react WHERE reactedOn=:postid AND reactCommentOn='0' AND reactReplyOn='0'");
         $statement->bindParam(':postid',$postid,PDO::PARAM_INT);
         $statement->execute();
         return $statement->fetch(PDO::FETCH_OBJ);
    }
    public function commentFetch($postid){
        $statement = $this->pdo->prepare("SELECT * FROM comments INNER JOIN profile ON comments.commentedBy = profile.user_id WHERE comments.commentedOn = :postid AND comments.commentReplyID ='0' LIMIT 10");
         $statement->bindParam(':postid',$postid,PDO::PARAM_INT);
         $statement->execute();
         return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function FetchLastComment($commentid){
        $statement = $this->pdo->prepare("SELECT * FROM comments INNER JOIN profile ON comments.commentedBy = profile.user_id WHERE comments.comment_id = :commentid");
         $statement->bindParam(':commentid',$commentid,PDO::PARAM_INT);
         $statement->execute();
         return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function totalCommentCount($postid){
        $statement = $this->pdo->prepare("SELECT count(*) as totalComment FROM comments WHERE comments.commentedOn = :postid");
         $statement->bindParam(':postid',$postid,PDO::PARAM_INT);
         $statement->execute();
         return $statement->fetch(PDO::FETCH_OBJ);
    }
    public function com_react_max_show($postid,$commentid){
        $statement = $this->pdo->prepare("SELECT reactType,count(*) as maxreact FROM react WHERE reactedOn = :postid AND reactCommentOn = :commentid AND reactReplyOn ='0' GROUP BY reactType LIMIT 3");
         $statement->bindParam(':postid',$postid,PDO::PARAM_INT);
         $statement->bindParam(':commentid',$commentid,PDO::PARAM_INT);
         $statement->execute();
         return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function com_main_react_count($postid,$commentid){
        $statement = $this->pdo->prepare("SELECT count(*) as maxreact FROM react WHERE reactedOn = :postid AND reactCommentOn = :commentid AND reactReplyOn ='0'");
         $statement->bindParam(':postid',$postid,PDO::PARAM_INT);
         $statement->bindParam(':commentid',$commentid,PDO::PARAM_INT);
         $statement->execute();
         return $statement->fetch(PDO::FETCH_OBJ);
    }
    public function com_reactCheck($userid,$postid,$commentid){
        $statement = $this->pdo->prepare("SELECT * FROM react WHERE reactedBy = :userid AND reactedOn =:postid AND reactCommentOn=:commentid AND reactReplyOn='0'");
         $statement->bindParam(':postid',$postid,PDO::PARAM_INT);
         $statement->bindParam(':commentid',$commentid,PDO::PARAM_INT);
         $statement->bindParam(':userid',$userid,PDO::PARAM_INT);
         $statement->execute();
         return $statement->fetch(PDO::FETCH_OBJ);
    }
    public function commentUpdate($userid,$postid,$editedTextVal,$commentid){
        $statement = $this->pdo->prepare("UPDATE comments SET comment =:editedTextVal WHERE comment_id =:commentid AND commentedBy=:userid AND commentedOn=:postid");
         $statement->bindParam(':postid',$postid,PDO::PARAM_INT);
         $statement->bindParam(':commentid',$commentid,PDO::PARAM_INT);
         $statement->bindParam(':userid',$userid,PDO::PARAM_INT);
         $statement->bindParam(':editedTextVal',$editedTextVal,PDO::PARAM_INT);
         $statement->execute();
         return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function totalShareCount($postid){
        $statement = $this->pdo->prepare("SELECT count(*) as totalShare FROM post WHERE post.shareId =:postid");
         $statement->bindParam(':postid',$postid,PDO::PARAM_INT);
         $statement->execute();
         return $statement->fetch(PDO::FETCH_OBJ);
    }
    public function shareFetch($postid,$profileid){
        $statement = $this->pdo->prepare("SELECT users.*,post.*,profile.* FROM users,post,profile WHERE users.id=:profileid AND post.id=:postid AND profile.user_id:userid");
         $statement->bindParam(':postid',$postid,PDO::PARAM_INT);
         $statement->bindParam(':profileid',$profileid,PDO::PARAM_INT);
         $statement->execute();
         return $statement->fetchAll(PDO::FETCH_OBJ);
    }

}


?>