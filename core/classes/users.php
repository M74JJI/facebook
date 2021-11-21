<?php
class User{
    protected $pdo;
    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function checkInput($var){
        $var=htmlspecialchars($var);
        $var=trim($var);
        $var=stripslashes($var);
        return $var;
    }
    public function checkEmail($email_phone){
        $statement = $this->pdo->prepare("SELECT email FROM users WHERE email = :email");
        $statement->bindParam(':email',$email_phone,PDO::PARAM_STR);
        $statement->execute();
        $count = $statement->rowCount();
        if($count>0){
            return true;
        }else{
            return false;
        }
        
    }
    public function create($table,$fields=array()){
        $columns=implode(',',array_keys($fields));
        $values=':'.implode(', :',array_keys($fields));

        $sql="INSERT INTO {$table} ({$columns}) VALUES({$values})";
        
        if($statement = $this->pdo->prepare($sql)){
            foreach($fields as $key => $data){
                $statement->bindValue(':'.$key,$data);
            }
            $statement->execute();
            return $this->pdo->lastInsertId();
        }
    }
    public function getUserId($username){
        $statement = $this->pdo->prepare('SELECT id FROM users WHERE link = :username');
        $statement->bindParam(':username',$username,PDO::PARAM_STR);
        $statement->execute();
        $user =$statement->fetch(PDO::FETCH_OBJ);
       if($user){
        return $user->id;
       }else{
           header('Location:profile.php');
       }
    }
    public function getUserInfo($id){

      $statement = $this->pdo->prepare('SELECT * from users LEFT JOIN profile ON users.id = profile.user_id WHERE users.id=:user_id');
      $statement->bindParam(':user_id',$id,PDO::PARAM_INT);
      $statement->execute();
      return $statement->fetch(PDO::FETCH_OBJ);
    }
    public function update($table,$userid,$fields = array()){

      $columns="";
      $i=1;
      foreach($fields as $name => $value){
          $columns.="{$name}=:{$name}";
          if($i < count($fields)){
              $columns.=', ';
          }
          $i++;
        }
          $sql ="UPDATE {$table} SET {$columns} WHERE user_id = {$userid}";
       
          if($statement = $this->pdo->prepare($sql)){
              foreach($fields as $key => $value){
                $statement->bindValue(':'.$key, $value);
              }
          }
          
          $statement->execute();
    }

    public function timeAgo($date){
        $time = strtotime($date);
        $current = time();
        $seconds = $current - $time;
        $minutes = round($seconds/60);
        $hours = round($seconds/3600); 
        $month = round($seconds/2600640);

        if($seconds <=60){
            if($seconds == 0){
                return 'just now';
            }else{
                return ''.$seconds.'s ago';
            }
        }else if($minutes <= 60){
            return ''.$minutes.'min ago';
        }else if ($hours <=24){
            return ''.$hours.'hours ago';
        }else if($month <=30){
            return ''.date('M j',$time);
        }else{
            return ''.date('J M Y',$time);
        }
    }


    public function delete($table,$array){
        
        $sql ="DELETE FROM `{$table}`";
        $where = " WHERE ";
        foreach($array as $name => $value){
            $sql.= "{$where} `{$name}` = :{$name}";
            $where = " AND ";
        }
            if($stmt = $this->pdo->prepare($sql)){
                foreach($array as $name=>$value){
                    $stmt->bindValue(':'.$name,$value);
                }
            }
         
            $stmt->execute();

       
    }
}



?>