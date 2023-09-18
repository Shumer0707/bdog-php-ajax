<!DOCTYPE html>
<html lang="ru">
<head>
<?php
$website_title = "Регистрация";
require "block/head.php"
?>
</head>
<body>
    <?php require "block/header.php"?>
   <main>
    <h1>Регистрация</h1>
    <form >
        <label for="username">Ваше Имя</label>
        <input type="text" name="username" id="username">

        <label for="surname">Вашa Фамилия</label>
        <input type="text" name="surname" id="surname">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="login">Логин</label>
        <input type="text" name="login" id="login">

        <label for="password">Пароль</label>
        <input type="password" name="password" id="password">

        <label for="age">Ваш Возраст</label>
        <input type="int" name="age" id="age">

        <div class="error_mess" id="error_block"></div>

        <button type="button" id="reg_user">Отправить</button>
    </form>
   </main>
   <?php require "block/aside.php"?>
   <?php require "block/footer.php"?>
   <script>
    $('#reg_user').click(function(){
        let name = $('#username').val();
        let surname = $('#surname').val();
        let email = $('#email').val();
        let login = $('#login').val();
        let password = $('#password').val();
        let age = $('#age').val();

        $.ajax({
            url:'ajax/reg.php',
            type:'POST',
            cache: false,
            data:{'username': name,'surname': surname,'email': email,'login': login,'password': password,'age': age,},
            dataType: 'html',
            success: function(data){
                console.log(data);
                if(data === "Done"){
                $("#reg_user").text("Все готово");
                $("#error_block").hide();
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