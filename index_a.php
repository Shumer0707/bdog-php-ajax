<!DOCTYPE html>
<html lang="ru">
<head>
<?php
$website_title = "Blog Master";
require "block/head.php";
?>
</head>
<body>
<?php require "block/header.php"?>
   <main>
    <?php 
       require_once "lib/mysql.php";

       $sql = 'SELECT * FROM articles ORDER BY `date` DESC';
       $query = $pdo->query($sql);
       while ($row = $query->fetch(PDO::FETCH_OBJ)){
         echo "<div class= 'post'>
         <h1>".$row->title."</h1>
         <p>.$row->anons.</p>
         <p class='avtor'>Автор: <span>".$row->avtor."</span></p>
         <a href='post.php?id=".$row->id."'title='".$row->title."'>Прочитать</a>
         </div>";
       }
    ?>
   </main>
<?php require "block/aside.php"?>         
<?php require "block/footer.php"?>
</body>
</html>