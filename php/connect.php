<?php
$dblocation = "localhost";
$dbname = "dream";
$dbuser = "им€ пользовател€ базы данных";
$dbpasswd = "пароль к базе выбранного пользовател€";
$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
if (!$dbcnx) 
{
echo( "<P> ¬ насто€щий момент сервер базы данных не доступен, поэтому корректное отображение страницы невозможно. </P>" );
exit();
}
if (!@mysql_select_db($dbname, $dbcnx)) 
{
echo( "<P> ¬ насто€щий момент база данных не доступна, поэтому корректное отображение страницы невозможно. .</P>" );
exit();
}
?>