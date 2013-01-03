<?php 
###############################################################
#
#	Cleaner keywords by beerhack from http://beerhack.name
#	ICQ: 274717
#
###############################################################

$filename = 'koffboy.txt'; //Имя файла для очистки. Файл должен быть в той же директории где и сам скрипт
$lang = 'ruen'; //Допустимые буквы: ru - русские; en - английские ; ruen - русские и английские
$sym = '-.)($_€,"!'.chr(39); //Допустимые символы. .chr(39) — это одинарная кавычка

/* настройки выше, ниже ничего не трогать */

for($i=0;$i<strlen($sym);$i++){
	$sympattern .= '\\'.$sym[$i];
}
if($lang=='en'){
	$pattern = "/[^a-zA-Z0-9 $sympattern]+/";
}elseif($lang=='ru'){
	$pattern = "/[^а-яА-Я0-9 $sympattern]+/";
}elseif($lang=='ruen'){
	$pattern = "/[^a-zA-Zа-яА-Я0-9 $sympattern]+/";
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
?>