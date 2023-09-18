<?php
$username = trim(filter_var($_POST['username'],FILTER_SANITIZE_SPECIAL_CHARS));
$surname = trim(filter_var($_POST['surname'],FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));
$login = trim(filter_var($_POST['login'],FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS));
$age = trim(filter_var($_POST['age'],FILTER_SANITIZE_SPECIAL_CHARS));

$error='';
if(strlen($username)<=1)
    $error='Ошибка Имя';
else if(strlen($surname)<=1)
    $error='Ошибка Фамилия';  
else if(strlen($email)<=1)
    $error='Ошибка Email';
else if(strlen($login)<=1)
    $error='Ошибка Логин';
else if(strlen($password)<=1)
    $error='Ошибка Пароль';
else if(strlen($age)<=1)
    $error='Ошибка Возраст';

if($error != ''){
    echo $error;
    exit();
}
require_once "../lib/mysql.php";

$salt = 'asvasopdvb$^&654612dsa,.v';
$password = md5($password.$salt);

 $sql='INSERT INTO `users`( `name`, `surname`, `email`, `login`, `password`, `age`) VALUES (?,?,?,?,?,?)';
 $qwery = $pdo->prepare($sql);
 $qwery->execute([$username,$surname,$email,$login,$password,$age]); 

 echo "Done";
