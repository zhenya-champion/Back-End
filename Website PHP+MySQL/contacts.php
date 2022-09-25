
<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    $website_title = "Контакты";
    require "blocks/head.php";
    ?>
</head>

<body>
    <?php require "blocks/header.php" ?>

    <main>
        <h1>Контакты</h1>

        <!-- форма -->
        <form> 
            <label for="username">Название статьи</label>
            <input type="text" name="username" id="username">

            <label for="email">Email</label>
            <input type="email" name="email" id="email">

            <label for="mess">Сообщения</label>
            <textarea name="mess" id="mess"></textarea>

            <div class="error-mess" id="error-block"></div>

            <button type="button" id="mess_send">Отправить</button>
        </form>
    </main>

    <?php require "blocks/aside.php" ?>
    <?php require "blocks/footer.php" ?>

    <script>
        $("#mess_send").click(function(){
            let name = $('#username').val();
            let email = $('#email').val();
            let mess = $('#mess').val();

            $.ajax({
                url: 'ajax/mail.php', // какой файл будет все это получать
                type: 'POST', // метод передачи данных
                cache: false, // наличие кеша
                data: {'name': name,'email': email,'mess': mess}, // какие объекты будут переданы
                dataType: 'html', // в каком формате получим данные
                success: function(data){ // сработает когда получим данные
                    if(data === "Done"){
                        $("#mess_send").text("Всё готово");
                        $("#error-block").hide();
                        $('#username').val("");
                        $('#email').val("");
                        $('#mess').val("");
                    }
                    else{
                        $("#error-block").show();
                        $("#error-block").text(data);
                    }
                }
            });
        })
    </script>
</body>

</html>