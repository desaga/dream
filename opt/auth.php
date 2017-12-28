<?php
// Данный файл всегда будит "включаться" в другие файлы
// директивой include поэтому следует запретить его самостоятельный вызов
// из строки запроса путём указания его имени
// Если не определена константа LOGIN – завершаем работу скрипта
if(!defined("LOGIN")) die;

// Начинаем сессию
session_start();
// Получаем параметр op из URL
empty($_GET['op'])? $op='none':$op = $_GET['op'];
if ($op != 'exit')
{
// Помещаем содержимое файла в массив
$access = array();
$access = file("access.php");
// Разносим значения по переменным – пропуская первую строку файла - 0
$login = trim($access[1]);
$passw = trim($access[2]);
// Проверям были ли посланы данные
if(!empty($_POST['enter']))
	{
	$_SESSION['login'] = $_POST['login'];
	$_SESSION['passw'] = $_POST['passw'];
	}
} else
{
	$_SESSION['login'] = "";
	$_SESSION['passw'] = "";
}
// Если ввода не было, или они не верны
// просим их ввести
if(empty($_SESSION['login']) or
$login != $_SESSION['login'] or
$passw != $_SESSION['passw']    )
{
include "authform.php";
die;
}else
{
switch  ($op)
{
case "main" : include "main.php";
break;
case "contact" : include "contact.php";
break;
case "info" : include "info.php";
break;
default:include "main.php";
break;
}
}
?>