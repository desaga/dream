<?php
// ������ ���� ������ ����� "����������" � ������ �����
// ���������� include ������� ������� ��������� ��� ��������������� �����
// �� ������ ������� ���� �������� ��� �����
// ���� �� ���������� ��������� LOGIN � ��������� ������ �������
if(!defined("LOGIN")) die;

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
include "authform.php";
die;
}else
{
switch  ($op)
{
case "main" : include "main.php";
break;
case "contact" : include "contact.php";
break;
case "info" : include "info.php";
break;
default:include "main.php";
break;
}
}
?>