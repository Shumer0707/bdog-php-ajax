<?php
$username = trim(filter_var($_POST['username'],FILTER_SANITIZE_SPECIAL_CHARS));
$mess = trim(filter_var($_POST['mess'],FILTER_SANITIZE_SPECIAL_CHARS));
$id = trim(filter_var($_POST['id'],FILTER_SANITIZE_SPECIAL_CHARS));

$error='';
if(strlen($username)<=1)
    $error='Ошибка Имя';
else if(strlen($mess)<=1)
    $error='Ошибка mess';  

if($error != ''){
    echo $error;
    exit();
}
require_once "../lib/mysql.php";

 $sql='INSERT INTO `comments`( `name`, `mess`, `article_id`) VALUES (?,?,?)';
 $qwery = $pdo->prepare($sql);
 $qwery->execute([$username,$mess,$id]); 

 echo "Done";
