 <?php
  $db = mysql_connect('localhost', 'desaga_base', 'n90EG5KA');
  if (!$db) {
      die('Невозможно соединиться: ' . mysql_error());
  }
  echo 'Успешно соединено';
  //mysql_close($db);
  mysql_select_db ("desaga_base",$db);
?>