<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php require "blocks/header.php" ?>
<?php require "info.php" ?>

<input type="text" id="check">
<button type="button" id="summ">Посчитать/Записать</button>

<?php require "blocks/footer.php" ?>

<script>
     $("#summ").click(function(){

        // Складываем результаты столбца result
        $summResult = array_sum(array_column($data,'result'));

            $.ajax({
                url: 'summResult.php', // какой файл будет все это получать
                type: 'POST', // метод передачи данных
                cache: false, // наличие кеша
                data: {
                    'check': $summResult
                },
                dataType: 'html', // в каком формате получим данные
                success: function(data){ // сработает когда получим данные
                    $("#check").val($summResult);
                }
            });
        });
</script>
</body>
</html>