<?php
include "top.php";
include "conndb.php";
mysql_query("SET NAMES 'cp1251'");
mysql_query("SET CHARACTER SET 'cp1251'");
$sql="SELECT * FROM `konsult_date` ORDER BY `konsult_date`.`organizator` ASC";

// �� ������� ���������� �� ID
// ORDER BY `id` DESC <-- �� �������� � ��������
// ORDER BY `id` ASC <-- �� �������� � ��������
$result=mysql_query($sql) or die(mysql_error());
$num = mysql_num_rows($result);
echo "<br>����� ������� $num <br>";
// ������ �������
echo "<div id='list'>";
print "<table cellspacing='0' border='1' cellpadding='5'>";
echo "<tr><td>�����</td><td>��� �������</td><td>�����������</td><td>��� ������������</td><td>���� ��������</td><td>���� ����������</td><td>��������� �����</td><td>���� ������</td><td>������</td></tr>";
while($data=mysql_fetch_array($result)) // ���� ������
{
	print "<tr>";
	print "<td>$data[0]</td>";// ����� ����
	print "<td>$data[1]</td>";// ��� �������
	//$data[2]=str_replace("\r\n","<br>",$data[2]);
	print "<td>$data[2]</td>";// �����������
	print "<td>$data[3]</td>";// ��� ������������
	print "<td>$data[4]</td>";// ���� ��������
	print "<td>$data[5]</td>";// ���� ����������
	print "<td>$data[6]</td>";// ��������� �����
	print "<td>$data[7]</td>";// ���� ������
	print "<td>$data[8]</td>";// ������
}
print "</table>";
echo "</div>";
?>
