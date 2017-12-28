<?php  
echo "Connecting...";
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
				<?php
					$query="SELECT `id`,`name`,`description`,`video_link` FROM `video`";
					$sql = mysql_query($query) or die(mysql_error());
				while	($row = mysql_fetch_assoc($sql))
				{
				if ($_SERVER['HTTP_HOST'] != 'localhost')
				{ 
				$track = "onclick = '_gaq.push(['_trackEvent', 'Видео', 'Просмотр',".$row[name]."]);";
				}
				echo "
				<div id='gallery' style='width:360px'>$row[video_link]				
					<div id='video_description'>Альбом: $row[name] <br /> Описание : $row[description]</div>
				</div>";
				}
				$track="";
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