<?php
$login = trim(filter_var($_POST['login'],FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS));

$error='';

if(strlen($login)<=1)
    $error='Ошибка Логин';
else if(strlen($password)<=1)
    $error='Ошибка Пароль';
if($error != ''){
    echo $error;
    
}
require_once "../lib/mysql.php";

$salt = 'asvasopdvb$^&654612dsa,.v';
$password = md5($password.$salt);

$sql = 'SELECT id FROM users WHERE `login` = ? AND `password` = ?';

$qwery = $pdo->prepare($sql);
$qwery->execute([$login,$password]); 

if($qwery->rowCount()==0)
    echo"Такого пользавателя нет";
else   
    setcookie('log', $login, time() + 3600, "/");
    echo "Done";
