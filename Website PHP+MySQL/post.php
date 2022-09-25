<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    require_once "lib/mysql.php";
    $sql = 'SELECT * FROM articles WHERE `id` = ?'; // новые статьи вверху, старые внизу
    $query = $pdo->prepare($sql); // подготавливаем записи
    $query->execute([$_GET['id']]); // подставляем

    $article = $query->fetch(PDO::FETCH_OBJ); // получаем запись и помещаем ее

    $website_title = $article->title; // выводим название статьи 
    require "blocks/head.php";
    ?>
</head>

<body>
    <?php require "blocks/header.php" ?>

    <main>
        <?php
                echo "<div class='post'>
                <h1>". $article->title . "</h1>
                <p>" . $article->anons . "</p><br>
                <p>" . $article->full_text . "</p>
                <p class='avtor'>Автор: <span>" . $article->avtor . "</span></p>
                <p><b>Время публикации:</b>" . date("H:i:s", $article->date) . "</p>
                </div>";
        ?>

        <h3>Комментарии</h3>
        <form> 
            <label for="username">Ваше имя</label>
            <?php if(isset($_COOKIE['login'])): ?>
                <input type="text" name="username" id="username" value="<?=$_COOKIE['login']?>">
            <?php else: ?>
                <input type="text" name="username" id="username">
            <?php endif; ?>

            <label for="mess">Сообщения</label>
            <textarea type="mess" id="mess"></textarea>

            <div class="error-mess" id="error-block"></div>

        <!-- после нажатия перекидывает на comment_add.php -->
            <button type="button" id="mess_send">Добавить комментарий</button>
        </form>

       <div class="comments">        
            <?php
                $sql = 'SELECT * FROM comments WHERE `article_id` = ? ORDER BY id DESC'; // выбираем все статьи с нужным id
                $query = $pdo->prepare($sql); // подготавливаем записи
                $query->execute([$_GET['id']]); // подставляем

                $comments = $query->fetchAll(PDO::FETCH_OBJ); // получаем все комменты
                foreach($comments as $el){ // перебрали и вывели
                    echo "<div class='comment'
                        <h2>" . $el->name . "</h2>
                        <p>" . $el->mess . "</p>
                    </div>";
                }
            ?>
        </div> 
    </main>

    <?php require "blocks/aside.php" ?>
    <?php require "blocks/footer.php" ?>

    <script>
        $("#mess_send").click(function(){
            let name = $('#username').val();
            let mess = $('#mess').val();

            $.ajax({
                url: 'ajax/comment_add.php', // какой файл будет все это получать
                type: 'POST', // метод передачи данных
                cache: false, // наличие кеша
                data: {'username': name,'mess': mess, 'id': '<?=$_GET['id']?>'}, // какие объекты будут переданы
                dataType: 'html', // в каком формате получим данные
                success: function(data){ // сработает когда получим данные
                    if(data === "Done"){
                        $(".comments").prepend(`<div class='comment'>
                            <h2>${name}</h2>
                            <p>${mess}</p>
                        </div>`); // помещаем html в начало кода (текст который ввел пользователь)
                        $("#mess_send").text("Всё готово");
                        $("#error-block").hide();
                        $("#mess").val(""); // очищаем
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