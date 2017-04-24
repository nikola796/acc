<?php

$files = array(0 => "error505.png", 1 => "settingsCognos.jpg" );
$labels =  array(0 => "Грешка", 1 => "Настройки" );

$c = array_combine($files, $labels);

print_r($c);

//foreach ($files as $k => $v){
//
//    echo 'Име на Файла => ' . $v . ' --- Описание => ' . $labels[$k] . '<br />';
//
//}