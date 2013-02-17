<?php 
###############################################################
#
#	Cleaner keywords by beerhack from http://beerhack.name
#	ICQ: 274717
#
###############################################################

set_time_limit(0);
if(!empty($_POST['filename']) and !empty($_POST['language'])): ?>
<?php 
$filename = $_POST['filename']; //Имя файла для очистки. Файл должен быть в той же директории где и сам скрипт. Кодировка файла UTF-8
$lang = $_POST['language']; //Допустимые буквы: ru - русские; en - английские ; ruen - русские и английские
$sym = $_POST['symbols']; //Допустимые символы.

for($i=0;$i<strlen($sym);$i++){
	$sympattern .= '\\'.$sym[$i];
}
if($lang=='en'){
	$pattern = "/[^a-zA-Z0-9 $sympattern]+/u";
}elseif($lang=='ru'){
	$pattern = "/[^а-яА-Я0-9 $sympattern]+/u";
}elseif($lang=='ruen'){
	$pattern = "/[^a-zA-Zа-яА-Я0-9 $sympattern]+/u";
}
$keys = @file($filename); 
$fgood = fopen('good-'.$filename,'w'); //файл с очищенными кеями
$fbad = fopen('bad-'.$filename,'w'); //файл с отсеянными плохими кеями
foreach ($keys as $key) 
{ 
	$key = trim($key);
	if(!preg_match($pattern, $key)){
		fwrite($fgood,$key."\r\n");
	} else {
		fwrite($fbad,$key."\r\n");
	}
}
fclose($fgood); 
fclose($fbad); 
?> <?php else : ?>
<html>
<form method="POST" action="">
Filename: <input type="text" name="filename" value=""><br>
Language: <br>
<input type="radio" name="language" value="ru"> Russian<br>
<input type="radio" name="language" value="en"> English<br>
<input type="radio" name="language" value="ruen"> Russian and English<br>
Symbols: <input type="text" name="symbols" value="-.)($_,!'"><br>
<input type="submit" value="START" name="B1">
</form>
</html>
<?php endif; ?>