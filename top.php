<?php  
	if(!defined("LOGIN")) die;  
?>

	<div class = "loginHeader">
	    <ul class="top-links">
			<li><a href="index.php" class="first"><img alt="Home" title="������� �� ������� ��������" src="images/home_3977.png" /></a></li>
			<li><a href="mailto:liderstar@gmail.com?subject=��������� � �����"><img alt="mail box" title="�������� ������"src="images/contact.gif" /></a></li>
			<li><a href="index.php?op=exit"><img alt="Exit" title="�����" src="images/quit_8328.png" /></a></li>
		</ul>
	</div>
<?php
if(!empty($_SESSION['userName'])) echo "<div id='user_name'>������������, $_SESSION[userName].</div>";
?>	