<?php
    if(!isset($_COOKIE['log'])){
        header('Location: index_a.php');
        exit();
    }
?>
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





<div class="chat">
<?php
require_once "lib/mysql.php";  
$query = $pdo->query('SELECT * FROM `chat` ORDER BY id');
while ($row = $query->fetch(PDO::FETCH_ASSOC)){
    $id = $row['id'];
    echo 
    '<div class="spisoc"><b>'.$row["mess"].'</b></div>';
}
    ?>
    <form >
        <label for="mess_form">Сообшение</label>
        <input type="text"  name="mess_form" id="mess_form"></textarea>

        <div class="error_mess" id="error_block"></div>

        <button type="button" id="chat_send">Отправить</button>
    </form>
</div> 
<?php require "block/footer.php"?>
<script>
     $('#chat_send').click(function(){
         let mess = $('#mess_form').val();
         $.ajax({
             url:'ajax/chat_add.php',
             type:'POST',
             cache: false,
             data:{'mess': mess},
             dataType: 'html',
             success: function(data){
                 console.log(data);
                 if(data === "Done"){
                $("#error_block").hide();
                $('#mess_form').val("");
                }else{
                    $("#error_block").show();
                    $("#error_block").text(data);
                }
            }
        })
    })
      function interval() {
        let id=<?=$id?>;
        $.ajax({
             url:'ajax/chat_check.php',
             type:'POST',
             cache: false,
             data:{},
             dataType: 'html',
             success: function(data){
                console.log(data);
                if(data !== ""){
                $(".chat").prepend(`<div class="spisoc"><b>${data}</b></div>`);
                 }      
            }
        })
      }
      setInterval(interval, 3000);
   </script>  
</body>
</html>