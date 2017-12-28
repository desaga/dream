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
					$query="SELECT `id`,`name`,`description`,`foto_link`,`web_link` FROM `gallery`";
					$sql = mysql_query($query) or die(mysql_error());
				while	($row = mysql_fetch_assoc($sql))
				{
				if ($_SERVER['HTTP_HOST'] != 'localhost')
				{
				$name="Фотоальбом ".$row['name'];
				$track ="onclick = \"_gaq.push(['_trackEvent','Альбомы','Просмотр','$name']);_gaq.push(['_trackPageview']);\"";
				}
				echo "
				<div id='gallery' >
				<a target='_blank' href='$row[web_link]' title='Нажмите чтобы перейти к альбому.' $track>
					<img src='$row[foto_link]' />
					<div id='lib_description'>Альбом: $row[name] <br /> Описание : $row[description]</div>
					</div>
				</a>";
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