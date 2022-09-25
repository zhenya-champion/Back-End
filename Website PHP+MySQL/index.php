<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    $website_title = "Blog Master";
    require "blocks/head.php";
    ?>
</head>

<body>
    <?php require "blocks/header.php" ?>

    <main>
        <?php
            require_once "lib/mysql.php";

            $sql = 'SELECT * FROM articles ORDER BY `date` DESC'; // новые статьи вверху, старые внизу
            $query = $pdo->query($sql); // получаем записи
            while($row = $query->fetch(PDO::FETCH_OBJ)){ // перебираем объекты по одному пока есть все записи
                echo "<div class='post'>
                <h1>". $row->title . "</h1>
                <p>" . $row->anons . "</p>
                <p class='avtor'>Автор: <span>" . $row->avtor . "</span></p>
                <a href='/post.php?id=" . $row->id . "' title='" . $row->title . "'>Прочитать</a>
                </div>";
            }
        ?>
    </main>

    <?php require "blocks/aside.php" ?>
    <?php require "blocks/footer.php" ?>
</body>

</html>