<?php  
	if(!defined("LOGIN")) die;  
?>

	<div class = "loginHeader">
	    <ul class="top-links">
			<li><a href="index.php" class="first"><img alt="Home" title="Перейти на главную страницу" src="images/home_3977.png" /></a></li>
			<li><a href="mailto:liderstar@gmail.com?subject=Сообщение с сайта"><img alt="mail box" title="Написать письмо"src="images/contact.gif" /></a></li>
			<li><a href="index.php?op=exit"><img alt="Exit" title="Выход" src="images/quit_8328.png" /></a></li>
		</ul>
	</div>
<?php
if(!empty($_SESSION['userName'])) echo "<div id='user_name'>Здравствуйте, $_SESSION[userName].</div>";
?>	