<?php  

// ������ ���� ������ ����� "����������" � ������ �����  
// ���������� include ������� ������� ��������� ��� ��������������� �����  
// �� ������ ������� ���� �������� ��� �����  
// ���� �� ���������� ��������� IN_ADMIN � ��������� ������ �������  
if(!defined("IN_ADMIN")) die;  

// �������� ������  
session_start();  
// �������� �������� op �� URL  
empty($_GET['op'])? $op='none':$op = $_GET['op'];
if ($op != 'exit')
{
	// �������� ���������� ����� � ������  
	$access = array();  
	$access = file("access.php");  
	// �������� �������� �� ���������� � ��������� ������ ������ ����� - 0  
	$login = trim($access[1]);  
	$passw = trim($access[2]);  
	// �������� ���� �� ������� ������  
	if(!empty($_POST['enter']))  
	{  
			$_SESSION['login'] = $_POST['login'];  
			$_SESSION['passw'] = $_POST['passw'];  
	}  
} else
{
	$_SESSION['login'] = "";
	$_SESSION['passw'] = "";
}
// ���� ����� �� ����, ��� ��� �� �����  
// ������ �� ������  
if(empty($_SESSION['login']) or  
   $login != $_SESSION['login'] or  
   $passw != $_SESSION['passw']    )  

{  
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
			<form method="post" action="index.php" id="auth">
				<div class="texttitle">��������������� ����� (9 ����):</div>
				<div><input name="login" type="text"></div>
				<div class="texttitle">������:</div>
				<div><input name="passw" type="password"></div>
				<div style="padding-bottom:10px;">
					<input id = "loginButton" class="submit" value="����� �� ����" type="submit">
					<input type=hidden name=enter value=yes> 
				</div>
				<a href="/">�����������</a>
			</form>	
			<div style="clear: both; height: 115px;"></div>
		</div>
		<div class = "loginFooter">
			<div class="contact">
				<img alt="mail box" src="images/contact.gif" />��� �����: 
				<a href="mailto:liderstar@gmail.com?subject=��������� � �����">e-mail: liderstar@gmail.com;</a>
				Skype: liderstar4770
			</div>
		</div>
	</div>
<?php
die;
}  
?>