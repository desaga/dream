<?php  

// Данный файл всегда будит "включаться" в другие файлы  
// директивой include поэтому следует запретить его самостоятельный вызов  
// из строки запроса путём указания его имени  
// Если не определена константа IN_ADMIN – завершаем работу скрипта  
if(!defined("IN_ADMIN")) die;  

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
?>
	<div class = "loginHeader">
	</div>
	<div class = "loginBody">
		<div class="loginForm" align="center">
			<div class="UIContainer">
				<div class="logo">
					Сайт Старшего Лидера Бизнес-Групп Кузнецовой Светланы<br>
					Будущая Национальная ветвь «Мечта»
				</div>
			</div>
			<img class = "foto" src="images/lider.png" border="0">
			<form method="post" action="index.php" id="auth">
				<div class="texttitle">Консультантский номер (9 цифр):</div>
				<div><input name="login" type="text"></div>
				<div class="texttitle">Пароль:</div>
				<div><input name="passw" type="password"></div>
				<div style="padding-bottom:10px;">
					<input id = "loginButton" class="submit" value="Зайти на сайт" type="submit">
					<input type=hidden name=enter value=yes> 
				</div>
				<a href="/">Регистрация</a>
			</form>	
			<div style="clear: both; height: 115px;"></div>
		</div>
		<div class = "loginFooter">
			<div class="contact">
				<img alt="mail box" src="images/contact.gif" />Для связи: 
				<a href="mailto:liderstar@gmail.com?subject=Сообщение с сайта">e-mail: liderstar@gmail.com;</a>
				Skype: liderstar4770
			</div>
		</div>
	</div>
<?php
die;
}  
?>