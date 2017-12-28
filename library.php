<?php  
	if(!defined("LOGIN")) die;  
	include "top.php";
	include 'conndb.php';// Соединяемся с бд
?>
<div class = "loginBody">
<script>
function SwitchTab(my_tab, my_content) {
	document.getElementById('content_1').style.display = 'none';
	document.getElementById('content_2').style.display = 'none';
	document.getElementById('content_3').style.display = 'none';
	document.getElementById(my_content).style.display = 'block';  
	document.getElementById('tb_1').className = 'lib_tab_passive';
	document.getElementById('tb_2').className = 'lib_tab_passive';
	document.getElementById('tb_3').className = 'lib_tab_passive';
	document.getElementById(my_tab).className = 'lib_tab_active';
}
</script>
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
<?php isset($_GET['cat'])? $cat=$_GET['cat']:$cat = 3;//вкладка по умолчанию?>
			<ul>
			<li style='display:inline;'><a href="javascript:SwitchTab('tb_1', 'content_1');" id="tb_1" <?php if ($cat==1){echo "class='lib_tab_active'";}else{echo "class='lib_tab_passive'";}?>>Ведение Бизнеса</a></li>
			<li style='display:inline;'><a href="javascript:SwitchTab('tb_2', 'content_2');" id="tb_2" <?php if ($cat==2){echo "class='lib_tab_active'";}else{echo "class='lib_tab_passive'";}?>>О компании «Мэри Кэй»</a></li>
			<li style='display:inline;'><a href="javascript:SwitchTab('tb_3', 'content_3');" id="tb_3" <?php if ($cat==3){echo "class='lib_tab_active'";}else{echo "class='lib_tab_passive'";}?>>Продукция</a></li>
			</ul>
<?php

$catalog=0;
while (++$catalog<=3){// распределяем статьи по вкладкам
if ($catalog==$cat) // если это текущий каталог
	{
	$display="id='content_$catalog'"; // то показываем div 
	}else{
	$display="id='content_$catalog' style='display:none;'";} // иначе гасим
?>
<div <?php echo $display; ?>> 
	<!-- содержимое вкладки -->
				<?php
					isset($_GET['id'])? $id=$_GET['id']:$id = 0;
					$query="SELECT `id`, `data`,`theme`, `author`, `title`, `description`, `text` FROM library";
					$sql = mysql_query($query) or die(mysql_error());
				while	($row = mysql_fetch_assoc($sql))
				{
				if ($row['theme']==$catalog){
				if ($id==$row['id']){$idlink='0';$title='Свернуть';}
					else {$idlink=$row['id'];$title='Нажмите чтобы просмотреть.';}
				echo "<a href='index.php?op=library&id=$idlink&cat=$catalog' title='$title'><div id='lib_title'>$row[title]</div></a>
				<div id='lib_description'>Описание : $row[description]<br />Источник/Автор : $row[author]</div>";
				if ($id==$row['id']){
					if ($_SERVER['HTTP_HOST'] != 'localhost')
					  { 
						echo "<script type='text/javascript'>_gaq.push(['_trackEvent', 'Статьи','Библиотека','".$row[id]."; ".$row[title]."']);</script>"; // Отслеживаем статьи
					  }
					echo "<div id='lib_text'>$row[text]</div>";}
				}
				}
				

echo "</div> ";
}?>

				
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