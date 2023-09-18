<?php
$username = trim(filter_var($_POST['name'],FILTER_SANITIZE_SPECIAL_CHARS));
$surname = trim(filter_var($_POST['email'],FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['mess'],FILTER_SANITIZE_EMAIL));

$error='';
if(strlen($username)<=1)
    $error='Ошибка Имя';
else if(strlen($email)<=1)
    $error='Ошибка email';  
else if(strlen($mess)<=1)
    $error='Ошибка Сообщение';

    $error='Ошибка Возраст';

if($error != ''){
    echo $error;
    exit();
}

$to = "shumer0707@mail.ru";
$subject = "=?utf-8?B".base64_decode("Новое Сообщение")."?=";
$message = "Пользователь: $username.<br>$mess";
$headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8\r\n";
mail($to, $subject, $message, $headers);

 echo "Done";
