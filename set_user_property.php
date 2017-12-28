<?php //
    $query = "SELECT * FROM `kons_property` WHERE konsnubmer={$login}";
    $sql = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_assoc($sql); //
    $status=$row['status'];// Статус 0-10
    $permit=$row['permit'];// Разрешения доступа к расширенным функциям
    $avatar=$row['avatar_link'];//ссылка на фото консультанта
    //echo "<div id='debuginfo' style='position:absolute; top:250px;'>Свойства $konsnubmer, $status, $permit, $avatar.</div>";
?>
