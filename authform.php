<?php  
	if(!defined("LOGIN")) die;  
?>
	<div class = "loginHeader">
	</div>
	<div class = "loginBody">
		<div class="loginForm" align="center">
			<div class="UIContainer">
				<div class="logo">
				���� �������� ������ ������-����� ���������� ��������<br>
				������� ������������ ����� ������
				</div>
			</div>
			<img class = "foto" src="images/lider.png" border="0">
			<form method="post" action="index.php?op=poster" id="auth">
				<div class="texttitle">����� ������������(9 ����):</div>
				<div><input id="login_field" name="login" type="text"></div>
				<div class="texttitle">������:</div>
				<div><input id="login_field" name="passw" type="password"></div>
				<div style="padding:10px 10px; display: inline-block;">
					<input id = "loginButton" class="submit" value="" type="submit">
					<a href="#" onclick="document.getElementById('auth').submit(); return false;">
					<div>
					<ul><li id="login_btn">����</li></ul>
					</div>
					</a>
					<input type=hidden name=enter value=yes>
				</div>
			</form>
			<div style="clear: both; height: 40px;"></div>
			</div>
			<div class = "loginFooter">
			<div class="contact">
			<img alt="mail box" src="images/contact.gif" />��� �����:
			<a href="mailto:liderstar@gmail.com?subject=��������� � �����">e-mail: liderstar@gmail.com;</a>
			Skype: liderstar4770
			</div>
		</div>
	</div>