<?php
 $file = fopen('json/result.csv', 'w');
 fwrite($file, $summResult);
 fclose($file);