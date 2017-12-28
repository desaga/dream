<?php
include "top.php";
include "conndb.php";
mysql_query("SET NAMES 'cp1251'");
mysql_query("SET CHARACTER SET 'cp1251'");
$sql="SELECT * FROM `konsult_date` ORDER BY `konsult_date`.`organizator` ASC";

// мы сделали сортировку по ID
// ORDER BY `id` DESC <-- от большего к меньшему
// ORDER BY `id` ASC <-- от меньшего к большему
$result=mysql_query($sql) or die(mysql_error());
$num = mysql_num_rows($result);
echo "<br>Всего записей $num <br>";
// строим таблицу
echo "<div id='list'>";
print "<table cellspacing='0' border='1' cellpadding='5'>";
echo "<tr><td>Номер</td><td>Имя фамилия</td><td>Организатор</td><td>Имя организатора</td><td>Дата рождения</td><td>Дата оформления</td><td>Последний заказ</td><td>Дата термин</td><td>Статус</td></tr>";
while($data=mysql_fetch_array($result)) // цикл вывода
{
	print "<tr>";
	print "<td>$data[0]</td>";// номер конс
	print "<td>$data[1]</td>";// Имя фамилия
	//$data[2]=str_replace("\r\n","<br>",$data[2]);
	print "<td>$data[2]</td>";// Организатор
	print "<td>$data[3]</td>";// Имя организатора
	print "<td>$data[4]</td>";// Дата рождения
	print "<td>$data[5]</td>";// Дата оформления
	print "<td>$data[6]</td>";// Последний заказ
	print "<td>$data[7]</td>";// Дата термин
	print "<td>$data[8]</td>";// Статус
}
print "</table>";
echo "</div>";
?>
