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
              $main_react =$this->main_react($userid,$post->post_id);
          }
        return $posts;
        
        
    }
    public function deletePost($postid,$userid){
        $statement=$this->pdo->prepare("DELETE FROM post WHERE post_id=:postid AND user_id=:userid");
        $statement->bindValue(':postid',$postid);
        $statement->bindValue(':userid',$userid);
        $statement->execute();
        
    }
    public function getPost($postid){
        $statement=$this->pdo->prepare("SELECT * FROM post LEFT JOIN profile ON profile.user_id =post.user_id  WHERE post_id=:postid");
        $statement->bindParam(':postid',$postid);
        $statement->execute();
      return  $statement->fetch(PDO::FETCH_OBJ); 
    }
    public function Homeposts($userid,$num){
        $userdata = $this->getUserInfo($userid);

        $statement= $this->pdo->prepare('SELECT * from post p LEFT JOIN users u ON p.user_id = u.id LEFT JOIN profile pr ON pr.user_id = p.user_id WHere p.sharedBy IS NULL and p.user_id =:userid 
        UNION
        SELECT * from post p LEFT JOIN users u ON p.user_id = u.id
         LEFT JOIN profile pr ON pr.user_id = p.user_id WHERE p.user_id 
         IN (SELECT follow.receiver FROM follow WHERE follow.sender =:userid)
         ORDER BY postedAt DESC LIMIT :num
        ');

        $statement->bindParam(':userid',$userid,PDO::PARAM_INT);
        $statement->bindParam('num',$num,PDO::PARAM_INT);
        $statement->execute();
        $posts=$statement->fetchAll(PDO::FETCH_OBJ);
       
          foreach($posts as $post){
              $main_react =$this->main_react($userid,$post->post_id);
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
        $statement = $this->pdo->prepare("SELECT users.*, post.*, profile.* FROM users, post, profile WHERE users.id=:user_id AND post.post_id=:postid AND profile.user_id=:user_id");
         $statement->bindParam(':postid',$postid,PDO::PARAM_INT);
         $statement->bindParam(':user_id',$profileid,PDO::PARAM_INT);
         $statement->execute();
         return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function search($searchTerm){
        $statement = $this->pdo->prepare("SELECT * FROM users LEFT JOIN profile ON users.id=profile.user_id WHERE users.link LIKE ?");
         $statement->bindValue(1,$searchTerm.'%',PDO::PARAM_STR);
         $statement->execute();
         return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function requestCheck($userid,$profileId){
        $statement = $this->pdo->prepare("SELECT * FROM friendrequest WHERE requestReceiver=:profileid AND requestSender=:userid");
         $statement->bindValue(':userid',$userid,PDO::PARAM_STR);
         $statement->bindValue(':profileid',$profileId,PDO::PARAM_STR);
         $statement->execute();
         return $statement->fetch(PDO::FETCH_OBJ);
    }
    public function requestConfirm($profileId,$userid){
        $statement = $this->pdo->prepare("SELECT * FROM friendrequest WHERE requestReceiver =:userid AND requestSender=:profileid");
         $statement->bindValue(':userid',$userid,PDO::PARAM_STR);
         $statement->bindValue(':profileid',$profileId,PDO::PARAM_STR);
         $statement->execute();
         return $statement->fetch(PDO::FETCH_OBJ);
    }
    public function ConfirmRequest($profileId,$userid){
        $statement = $this->pdo->prepare("UPDATE friendrequest SET requestStatus ='1' WHERE requestReceiver=:userid AND requestSender=:profileid");
         $statement->bindValue(':userid',$userid,PDO::PARAM_STR);
         $statement->bindValue(':profileid',$profileId,PDO::PARAM_STR);
         $statement->execute();
         return $statement->fetch(PDO::FETCH_OBJ);
    }
    public function followCheck($profileId,$userid){
        $statement = $this->pdo->prepare("SELECT * FROM follow WHERE sender=:userid AND receiver=:profileid");
         $statement->bindValue(':userid',$userid,PDO::PARAM_STR);
         $statement->bindValue(':profileid',$profileId,PDO::PARAM_STR);
         $statement->execute();
         return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function lastmessages($userid){
        $statement = $this->pdo->prepare("SELECT um.* 
        from (select um.*,
                     row_number() over (partition by least(um.sender, um.receiver), greatest(um.sender, um.receiver) order by um.messageAt desc) as seqnum
              from messages um 
             ) um
             
        where seqnum = 1 AND receiver=:userid or sender=:userid
                     
        order by messageAt desc
        
        ");
         $statement->bindValue(':userid',$userid,PDO::PARAM_STR);
         $statement->execute();
         return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function lastPersonMsg($userid){
        $statement = $this->pdo->prepare("SELECT * FROM profile LEFT JOIN messages ON (SELECT IF( messages.receiver =:userid,messages.sender,messages.receiver )) = profile.user_id WHERE (messages.sender=:userid OR messages.receiver =:userid) ORDER BY messages.messageAt DESC LIMIT 0,1;
           ");
         $statement->bindValue(':userid',$userid,PDO::PARAM_STR);
         $statement->execute();
         return $statement->fetch(PDO::FETCH_OBJ);
    }
    public function messageData($userid,$lastPersonId){
      
        $statement = $this->pdo->prepare("SELECT * FROM messages LEFT JOIN profile ON profile.user_id = messages.sender LEFT JOIN users ON users.id = messages.sender WHERE 
        (receiver =:userid and sender=:lastPersonId) OR (receiver =:lastPersonId and sender=:userid)
         ORDER BY messages.messageAT ASC");
         $statement->bindValue(':userid',$userid,PDO::PARAM_STR);
         $statement->bindValue(':lastPersonId',$lastPersonId,PDO::PARAM_STR);
         $statement->execute();
         return $statement->fetchAll(PDO::FETCH_OBJ);
    }


    public function updateTextPost($postid,$text){
        $statement=$this->pdo->prepare("UPDATE post SET post =:post_text WHERE post_id=:post_id");
        $statement->bindValue(':post_text',$text,PDO::PARAM_STR);
        $statement->bindParam(':post_id',$postid,PDO::PARAM_INT);
        $statement->execute();
    }
    public function updatePostImages($postid,$images,$text){
        $statement=$this->pdo->prepare("UPDATE post SET post =:post_text, postImages=:imagess WHERE post_id=:post_id");
        $statement->bindValue(':post_text',$text,PDO::PARAM_STR);
        $statement->bindValue(':imagess',$images,PDO::PARAM_STR);
        $statement->bindParam(':post_id',$postid,PDO::PARAM_INT);
        $statement->execute();
    }

    

}


?>