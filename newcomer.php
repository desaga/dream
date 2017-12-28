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
				<?php
				isset($_GET['id'])? $id=$_GET['id']:$id = 0;
				$query="SELECT `id`, `data`, `author`, `title`, `description`, `text` FROM newcomer";
				$sql = mysql_query($query) or die(mysql_error());
				while	($row = mysql_fetch_assoc($sql))
				{
				if ($id==$row['id']){$idlink='0';$title='Свернуть';}
					else {$idlink=$row['id'];$title='Нажмите чтобы просмотреть.';}
				echo "<a href='index.php?op=newcomer&id=$idlink' title='$title'><div id='lib_title'>$row[title]</div></a>
				<div id='lib_description'>Описание : $row[description]<br />Источник/Автор : $row[author]</div>";
				if ($id==$row['id']){echo "<div id='lib_text'>$row[text]</div>";}
				}
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