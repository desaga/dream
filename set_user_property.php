<?php //
    $query = "SELECT * FROM `kons_property` WHERE konsnubmer={$login}";
    $sql = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_assoc($sql); //
    $status=$row['status'];// ������ 0-10
    $permit=$row['permit'];// ���������� ������� � ����������� ��������
    $avatar=$row['avatar_link'];//������ �� ���� ������������
    //echo "<div id='debuginfo' style='position:absolute; top:250px;'>�������� $konsnubmer, $status, $permit, $avatar.</div>";
?>
