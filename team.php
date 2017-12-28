<?php  
	if(!defined("LOGIN")) die;  
	include "top.php";
	include 'conndb.php';// Соединяемся с бд
?>
<div class = "loginBody">
	<div class="loginForm" align="center">
		
		<?php  
			include "logo.php";
		?>

		<!-- Таблица -->
		<table>
			<tr>
				<td id="nav">
					<?php  
						include "navigation.php";
					?>
				</td>
				<td id="text">
					<div>
					
					<?php  // Подключаемся к таблице team_articles
					$query = "SELECT `id`,`title`,`text` FROM `team_articles`"; // пока только одна статья
					$sql = mysql_query($query) or die(mysql_error());
					$row = mysql_fetch_assoc($sql); //первый результат
					printf ("
					<table>
					<tr><td>%s</td></tr>
					<tr><td>%s</td></tr>
					</table>
					", $row['title'],$row['text']);
					?>
					</div>
				</td>
			</tr>
		</table>

	</div>
	<div class = "loginFooter">
		<div class="contact">
		<img alt="mail box" src="images/contact.gif" />Для связи:
		<a href="mailto:liderstar@gmail.com?subject=Сообщение с сайта">e-mail: liderstar@gmail.com;</a>
		Skype: liderstar4770
		</div>
	</div>
</div>