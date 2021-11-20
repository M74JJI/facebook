<?php

include 'database/connect.php';
include 'classes/users.php';
include 'classes/post.php';

global $pdo;

$loadUser = new User($pdo);
$loadPost = new Post($pdo);

define('BASE_URL','http://localhost/facebook/');

?>