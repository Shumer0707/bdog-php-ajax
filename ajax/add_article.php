<?php
$title = trim(filter_var($_POST['title'],FILTER_SANITIZE_SPECIAL_CHARS));
$anons = trim(filter_var($_POST['anons'],FILTER_SANITIZE_SPECIAL_CHARS));
$full_text = trim(filter_var($_POST['full_text'],FILTER_SANITIZE_SPECIAL_CHARS));

$error='';
if(strlen($title)<=1)
    $error='Ошибка Название';
else if(strlen($anons)<=1)
    $error='Ошибка Анонс';  
else if(strlen($full_text)<=1)
    $error='Ошибка Текст';
if($error != ''){
    echo $error;
    exit();
}
require_once "../lib/mysql.php";

 $sql='INSERT INTO `articles`( `title`, `anons`, `full_text`,date,avtor) VALUES (?,?,?,?,?)';
 $qwery = $pdo->prepare($sql);
 $qwery->execute([$title,$anons,$full_text,time(),$_COOKIE['log']]); 

 echo "Done";
