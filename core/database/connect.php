<?php

$host='mysql:host=127.0.0.1;dbname=facebook;charset=utf8mb4';
$user='root';$pass='root';
$password='';

try {
    $pdo = new PDO($host,$user,$password);
} catch(PDOException $e){
   echo 'Connection error! '.$e->getMessage();
}

?>