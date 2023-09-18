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
$website_title = "Список пользователей";
require "block/head.php";
?>
</head>
<body>
<?php require "block/header.php"?>
   <main>
    <h1>Список пользователей</h1>
    <div class=con>
        <?php
        require_once "lib/mysql.php";
        $query = $pdo->query('SELECT * FROM `users`');
        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
            echo 
            '<div class="spisoc">'.'<b> Имя: </b>'.$row['name'].'<b> Фамилия: </b>'.$row['surname'].'<b> Логин: </b>'.$row['login'].
            '<button onclick='."deleteusers($row[id])".'>Удалить</button>'.
            '</div>';
        }
        ?>
    </div>
   </main>
<?php require "block/aside.php"?>
<?php require "block/footer.php"?>

<script>
function deleteusers(id){
    $.ajax({
            url:'ajax/deleteusers.php',
            type:'POST',
            cache: false,
            data:{'id': id},
            dataType: 'html',
            success: function(data){
                console.log(data);
                document.location.reload(true);
            }
            
        })
    
}

</script>
</body>
</html>