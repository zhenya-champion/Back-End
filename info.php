<?php 
// Извлекаем массивы из json
$str_1 = file_get_contents("json/data_cars.json");
$str_2 = file_get_contents("json/data_attempts.json");

// Из строки в массив
$array_1 = json_decode($str_1);
$array_2 = json_decode($str_2);

// Складываем
$merge_array = array_merge($array_1, $array_2);

// Выводим в таблицу HTML
echo "<table>";
foreach ($data as $key => $row) {
   echo "<tr>";
   foreach ($row as $column) {
      echo "<td>$column</td>";
   }
   echo "</tr>";
}    
echo "</table>";

// Складываем результаты(result)
// $summResult = array_sum(array_column($data,'result'));
