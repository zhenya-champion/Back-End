<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    $website_title = "Авторизация";
    require "blocks/head.php";
    ?>
</head>

<body>
    <?php require "blocks/header.php" ?>

    <main>
        <!-- проверка на существование cookie -->
        <?php if(!isset($_COOKIE['login'])): ?>

        <h1>Авторизация</h1>
        <!-- форма -->
        <form>
            <label for="login">Логин</label>
            <input type="text" name="login" id="login">

            <label for="password">Пароль</label>
            <input type="password" name="password" id="password">

            <div class="error-mess" id="error-block"></div>
        <!-- после нажатия перекидывает на login.php -->
            <button type="button" id="login_user">Войти</button>
        </form>
        <?php else: ?>
            <h2><?=$_COOKIE['login'] //если авторизованы?></h2>
            <form>
                <button type="button" id="exit_user">Выйти</button>
            </form>
        <?php endif; // для вывода html ?>
    </main>

    <?php require "blocks/aside.php" ?>
    <?php require "blocks/footer.php" ?>

    <script>
        $("#login_user").click(function(){
            let login = $('#login').val();
            let pass = $('#password').val();

            $.ajax({
                url: 'ajax/login.php', // какой файл будет все это получать
                type: 'POST', // метод передачи данных
                cache: false, // наличие кеша
                data: {
                    'login': login,
                    'password': pass
                },
                dataType: 'html', // в каком формате получим данные
                success: function(data){ // сработает когда получим данные
                    if(data === "Done"){
                        $("#login_user").text("Всё готово");
                        $("#error-block").hide();
                        document.location.reload(true) // перезагружаем
                    }
                    else{
                        $("#error-block").show();
                        $("#error-block").text(data);
                    }
                }
            });
        });

        $("#exit_user").click(function(){

            $.ajax({
                url: 'ajax/exit.php', // какой файл будет все это получать
                type: 'POST', // метод передачи данных
                cache: false, // наличие кеша
                data: {}, // что передаем
                dataType: 'html', // в каком формате получим данные
                success: function(data){ // сработает когда получим данные
                        document.location.reload(true) // перезагружаем
                    }
                });
            });
    </script>
</body>

</html>