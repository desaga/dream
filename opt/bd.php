 <?php
  $db = mysql_connect('localhost', 'desaga_base', 'n90EG5KA');
  if (!$db) {
      die('���������� �����������: ' . mysql_error());
  }
  echo '������� ���������';
  //mysql_close($db);
  mysql_select_db ("desaga_base",$db);
?>