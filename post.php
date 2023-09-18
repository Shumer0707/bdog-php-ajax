<!DOCTYPE html>
<html lang="ru">
<head>
<?php
require_once "lib/mysql.php";
$sql = 'SELECT * FROM articles WHERE `id`=?';
$query = $pdo->prepare($sql);
$query->execute([$_GET['id']]);

$articles = $query->fetch(PDO::FETCH_OBJ);
$website_title = $articles->title;
require "block/head.php";
?>
</head>
<body>
<?php require "block/header.php"?>
   <main>
    <?php 
         echo "<div class= 'post'>
         <h1>".$articles->title."</h1>
         <p>".$articles->anons."</p><br>
         <p>".$articles->full_text."</p>
         <p class='avtor'>Автор: <span>".$articles->avtor."</span></p>
         <p><b>Время публикации: </b>".date("H:i:s",$articles->date)."</p>
         </div>";
    ?>
    <h3>Коментарии</h3>
    <form >
        <label for="username">Ваше Имя</label>
        <?php if(isset($_COOKIE['log'])): ?>
        <input type="text" name="username" id="username" value="<?= $_COOKIE['log']; ?>" >
        <?php else: ?>
            <input type="text" name="username" id="username">
            <?php endif; ?>
        <label for="mess">Сообшение</label>
        <textarea  name="mess" id="mess"></textarea>

        <div class="error_mess" id="error_block"></div>

        <button type="button" id="mess_send">Отправить комментарий</button>
    </form>

    <div class="comments">
    <?php
        $sql = 'SELECT * FROM comments WHERE `article_id`=? ORDER BY id DESC';
        $query = $pdo->prepare($sql);
        $query->execute([$_GET['id']]);

        $comments = $query->fetchAll(PDO::FETCH_OBJ);
        foreach($comments as $el) {
            echo "<div class='comment'> 
                  <h2>".$el->name."</h2>
                  <p>".$el->mess."</p>
            </div>";
        }
    ?>
    </div>
   </main>
<?php require "block/aside.php"?>
<?php require "block/footer.php"?>
<script>
    $('#mess_send').click(function(){
        let name = $('#username').val();
        let mess = $('#mess').val();
        $.ajax({
            url:'ajax/comment_add.php',
            type:'POST',
            cache: false,
            data:{'username': name,'mess': mess,'id':<?=$_GET['id']?>},
            dataType: 'html',
            success: function(data){
                console.log(data);
                if(data === "Done"){
                $(".comments").prepend(
                `<div class='comment'> 
                  <h2>${name}</h2>
                  <p>${mess}</p>
                 </div>`);
                $("#mess_send").text("Все готово");
                $("#error_block").hide();
                $('#mess').val("");
                }else{
                    $("#error_block").show();
                    $("#error_block").text(data);
                }
            }
        })
    })
   </script>
</body>
</html>