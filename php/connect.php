<?php
$dblocation = "localhost";
$dbname = "dream";
$dbuser = "��� ������������ ���� ������";
$dbpasswd = "������ � ���� ���������� ������������";
$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
if (!$dbcnx) 
{
echo( "<P> � ��������� ������ ������ ���� ������ �� ��������, ������� ���������� ����������� �������� ����������. </P>" );
exit();
}
if (!@mysql_select_db($dbname, $dbcnx)) 
{
echo( "<P> � ��������� ������ ���� ������ �� ��������, ������� ���������� ����������� �������� ����������. .</P>" );
exit();
}
?>