<?php  
	if(!defined("LOGIN")) die;  
?>
<html>
<head>
	<title>Сайт Независимого Консультанта по красоте Кузнецовой Светланы</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<<meta name="description" content="Независимый консультант по красоте компании Мэри Кэй" />
	<meta name="keywords" content="Мэри Кэй, MaryKay, консультант, лидер, бизнес-группа, Мечта" />
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
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
			<form method="post" action="index.php?op=main" id="auth">
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