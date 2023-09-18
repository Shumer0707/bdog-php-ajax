<?php
$username = trim(filter_var($_COOKIE['log'],FILTER_SANITIZE_SPECIAL_CHARS));
$mess = trim(filter_var($_POST['mess'],FILTER_SANITIZE_SPECIAL_CHARS));
$error='';

if(strlen($mess)<=1 )
$error='Ошибка mess';  
if($error != ''){
echo $error;
exit();
}

require_once "../lib/mysql.php";

 $sql='INSERT INTO `chat`( `name`, `mess`) VALUES (?,?)';
 $qwery = $pdo->prepare($sql);
 $qwery->execute([$username,$mess]); 

 echo "Done";