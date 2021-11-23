<?php

include 'database/connect.php';
include 'classes/users.php';
include 'classes/post.php';
include 'classes/about.php';

global $pdo;

$loadUser = new User($pdo);
$loadPost = new Post($pdo);
$loadAbout = new About($pdo);

define('BASE_URL','http://localhost/facebook/');

?>