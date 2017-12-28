 <?php
  include 'msqllocal.php';
 
  $db = mysql_connect($host, $user, $pasuser);

  if (!$db) {
      die('Невозможно соединиться: ' . mysql_error());
  }
  //echo 'Успешно соединено';
  //mysql_close($db);
  mysql_query("SET NAMES 'cp1251'");
  mysql_query("SET CHARACTER SET 'cp1251'");
  mysql_select_db ($dbname,$db);
?>