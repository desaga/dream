<?php  
	if(!defined("LOGIN")) die;  
	include "top.php";
	include 'conndb.php';// ����������� � ��
?>
<div class = "loginBody">
	<div class="loginForm" align="center">
		
		<?php  
			include "logo.php";
		?>

<!-- ������� -->
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
				$query="SELECT `id`, `date`, `title`,`description`, `text` FROM activity ORDER BY date DESC";
				$sql = mysql_query($query) or die(mysql_error());
				while	($row = mysql_fetch_assoc($sql))
				{
				if ($id==$row['id']){$idlink='0';$title='��������';}
					else {$idlink=$row['id'];$title='������� ����� �����������.';}
				echo "<a href='index.php?op=activity&id=$idlink' title='$title'><div id='lib_title'><strong>$row[title]</strong> (���� : $row[date])</div></a>
				<div id='lib_description'>�������� :$row[description]</div>";
				if ($id==$row['id']){
					if ($_SERVER['HTTP_HOST'] != 'localhost')
					  { 
						echo "<script type='text/javascript'>_gaq.push(['_trackEvent', '������','�����������','".$row[id]."; ".$row[title]."']);</script>"; // ����������� ������
					  }
					echo "<div id='lib_text'>$row[text]</div>";
					}
				}
				?>
			</div>
		</td>
	</tr>
</table>

	</div>
	<div class = "loginFooter">
		<div class="contact">
		<img alt="mail box" src="images/contact.gif" />��� �����:
		<a href="mailto:liderstar@gmail.com?subject=��������� � �����">e-mail: liderstar@gmail.com;</a>
		Skype: liderstar4770
		</div>
	</div>
</div>