<?php
//capthca.php
//количество символов в капче
$captcha_length = 6;
//создаем изображение 245 пикселей на 30
$img_handle = @ImageCreate ( 245, 30 );
//задаем цвет фона
$back_color = @ImageColorAllocate ( $img_handle, 255, 255, 255 );
$code = "";
//для каждого символа в коде
for($i = 0; $i < $captcha_length; $i ++) {
//устанавливаем произовальные координаты символа
$x_axis = 90 + ($i * 10);
$y_axis = 5 + rand ( 0, 7 );
//задаем произовальный цвет символа
$color1 = rand ( 001, 150 );
$color2 = rand ( 001, 150 );
$color3 = rand ( 001, 150 );
$txt_color [$i] = @ImageColorAllocate ( $img_handle, $color1, $color2,
$color3 );
//задаем произовальный размер символа
$size = rand ( 3, 5 );
//генерируем символа кода
//в данном случае — числа от 0 до 9
$number = rand ( 0, 9 );
$code .= "$number";
//печатаем символ на картинке
ImageString($img_handle,$size,$x_axis,$y_axis,"$number",$txt_color[$i]);
}
//запоминаем проверочный код в сессии
$_SESSION ['captcha'] = $code;
//запрещаем кеширование изображения
header ( "Cache-Control: no-cache" );
//сообщаем браузеру, что выводим изображение png
header ( "Content-type: image/png" );
//выводим капчу
ImagePng ( $img_handle );
exit;
?>
