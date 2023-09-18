<header>
        <span class="logo">BlogMaster</span>
        <nav>
            <a href="/"></a>
            <a href="index_a.php" class="btn">Главная</a>
            <a href="contacts.php" class="btn">Контакты</a>
            <?php if(isset($_COOKIE['log'])):?>
                <a href="add-article.php" class="btn">Добавить статью</a>
                <a href="login.php" class="btn">Кабинет пользователя</a>
                <a href="users.php" class="btn">Список пользователей</a>
                <a href="chat.php" class="btn">Чат</a>
            <?php else: ?>
                <a href="login.php" class="btn">Войти</a>
                <a href="register.php"class="btn">Регистрация!</a>
            <?php endif; ?>
        </nav>
</header>