 <?php
  include 'msqllocal.php';
 
  $db = mysql_connect($host, $user, $pasuser);

  if (!$db) {
      die('���������� �����������: ' . mysql_error());
  }
  //echo '������� ���������';
  //mysql_close($db);
  mysql_query("SET NAMES 'cp1251'");
  mysql_query("SET CHARACTER SET 'cp1251'");
  mysql_select_db ($dbname,$db);
?>