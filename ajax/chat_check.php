<?php
session_start();

 require_once "../lib/mysql.php";  
 $query = $pdo->query('SELECT * FROM `chat`ORDER BY id');
 while ($row = $query->fetch(PDO::FETCH_ASSOC)){
     $id_check = $row['id'];
     $mess_check = $row['mess']; 
 }
if($id_check != $_SESSION['id_sesion'])
echo $mess_check;
else
echo"";

$_SESSION['id_sesion'] = $id_check;
?>