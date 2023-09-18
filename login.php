<!DOCTYPE html>
<html lang="ru">
<head>
<?php
$website_title = "Авторизация";
require "block/head.php"
?>
</head>
<body>
    <?php require "block/header.php"?>
   <main>
    <?php if(!isset($_COOKIE['log'])):?>
    <h1>Авторизация</h1>
    <form >
        <label for="login">Логин</label>
        <input type="text" name="login" id="login">

        <label for="password">Пароль</label>
        <input type="password" name="password" id="password">

        <div class="error_mess" id="error_block"></div>

        <button type="button" id="login_user">Войти</button>
    </form>
    <?php else: ?>
        <h2><?= $_COOKIE['log']?></h2>
        <form>
            <button type="button" id="exit_user">Выйти</button>
        </form>
    <?php endif; ?>
   </main>
   <?php require "block/aside.php"?>
   <?php require "block/footer.php"?>
   <script>
    $('#login_user').click(function(){
        let login = $('#login').val();
        let password = $('#password').val();

        $.ajax({
            url:'ajax/login.php',
            type:'POST',
            cache: false,
            data:{'login': login,'password': password},
            dataType: 'html',
            success: function(data){
                console.log(data);
                if(data === "Done"){
                    $("#login_user").text("Все готово");
                    $("#error_block").hide();
                    document.location.reload(true);
                }else{
                    $("#error_block").show();
                    $("#error_block").text(data);
                }
            }
        })
    })

    $('#exit_user').click(function(){
        $.ajax({
            url:'ajax/exit.php',
            type:'POST',
            cache: false,
            data:{},
            dataType: 'html',
            success: function(data){
                document.location.reload(true);
            }
            
        })
    })
   </script>
</body>
</html>