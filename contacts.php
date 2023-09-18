<!DOCTYPE html>
<html lang="ru">
<head>
<?php
$website_title = "Контакты";
require "block/head.php"
?>
</head>
<body>
    <?php require "block/header.php"?>
   <main>
    <h1>Контакты</h1>
    <form >
        <label for="username">Ваше Имя</label>
        <input type="username" name="username" id="username">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="mess">Сообщение</label>
        <textarea name="mess" id="mess"></textarea>

        <div class="error_mess" id="error_block"></div>

        <button type="button" id="mess_send">Отправить</button>
    </form>
   </main>
   <?php require "block/aside.php"?>
   <?php require "block/footer.php"?>
   <script>
    $('#add_article').click(function(){
        let name = $('#username').val();
        let email = $('#email').val();
        let mess = $('#mess').val();

        $.ajax({
            url:'ajax/mail.php',
            type:'POST',
            cache: false,
            data:{'name': name,'email': email,'mess': mess},
            dataType: 'html',
            success: function(data){
                console.log(data);
                if(data === "Done"){
                    $("#add_article").text("Все готово");
                    $("#error_block").hide();
                    $('#username').val("");
                    $('#email').val("");
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