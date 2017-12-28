<?
// BEGIN
session_start();
if($_GET['coltype']==1 || $_GET['coltype']==0){//Установка цвета результатов опроса
$coltype=$_GET['coltype'];
}else{
$coltype=1;
}
if($_GET['w']!="" && is_numeric($_GET['w'])){//Установка ширины таблицы
$w=$_GET['w'];
}else{
$w=500;
}
include("conf.php");
include("func.php");
include "../conndb.php";

if($_GET['id']!=""){// id опроса 
	if($_GET['vote']!=""){	// выбран вариант опроса
	$id=$_GET['id'];		// $name - имя опроса
	// Установим Номер консультанта для автономного запуска - проверки
	
	//$konsnubmer=((isset($_GET['konsnubmer']) AND $_GET['konsnubmer']!="") ?$_GET['konsnubmer'] : '000282018');
	$konsnubmer=$_SESSION['konsnubmer'];
	//echo "konsnubmer.. $konsnubmer $dateBorn";
	// Проверим голосовал ли уже по этому вопросу.
	$query="SELECT * FROM poll_answers WHERE `id_kons`=$konsnubmer AND `id`=$id";
	//echo $query;
	$result = mysql_query($query) or die(mysql_error());
	$num_rows=mysql_num_rows($result);
	//echo "Обнаружено $num_rows записей пользователя  $konsnubmer";
	if(!$num_rows){ // Проверка если еще не проголосовал
		if(is_numeric($_GET['vote'])){//если выбраны варианты ответов
			$query="SELECT * FROM poll WHERE id=$id";
			$result = mysql_query($query) or die(mysql_error());
			$rows=mysql_fetch_assoc($result);
			$stat=$rows['text']; //Здесь статистика по опросу
			//$dat=file($polldata);// статистика опроса
			$data=explode("|::|",$stat);
			//echo "<br>Выведем список статистики ".$data[0].".".$data[1].".".$data[2].".".$data[3]."<br>";
			$str="|::|";
			for($ii=1;$ii<sizeof($data)-2;$ii++){
			if($ii==$_GET['vote']){// Добавляем 1 к выбраному вопросу
			$data[$ii]=$data[$ii]+1;
			$vote=$ii;
			}
			$str=$str.$data[$ii]."|::|";
			}
			$str=$str.tdate($datechar)."|::|\n";
			$stat=$str;
			$anv=true;
			// Записать в базу данных результат и добавить в базу ответов номер консультанта и id вопроса
			$query="UPDATE `poll` SET `text`='$stat' WHERE `id`='$id' LIMIT 1";
			$result = mysql_query($query) or die(mysql_error());
			$query="INSERT INTO `poll_answers` (`id`,`id_kons`,`date`,`answer`) VALUES ($id,'$konsnubmer',CURDATE(),$vote)";
			$result = mysql_query($query) or die(mysql_error());
			if($anv){
			$error="Ваш голос принят";
			}else{
			$error="Ваш голос не принят!";
			}
		}else{
		$error="Ошибка при отправлении данных";
		}
	}else{
	$error="Вы уже проголосовали в этом опросе.";
	}
	}
	?>
	<html>
	<head>
	<title>Результаты опроса</title>
	<style>
	body{background-color:#FFFFFF;font-family:verdana;font-size:8pt;}
	a:link{text-decoration:none;color:#000066;}
	a:hover{text-decoration:none;color:#0000EE;}
	</style>
	</head>
	<body>
	<?
	if(isset($error)){
	?>
	<table align=center width="<?print$w;?>" cellpadding=0 cellspacing=0 border=0 bgcolor="#000000" style="margin-top:5;margin-bottom:5;"><tr><td>
	<table width="<?print$w;?>" align=center cellpadding=2 cellspacing=1 border=0><tr bgcolor="#EEEEEE" style="{font-size:8pt;color:#000044;font-family:verdana;}"><td>
	<div align="center" style="color:red;"><?print$error;?></div>
	</td></tr></table>
	</td></tr></table>
	<?
	}
	?>
	<table align=center width="<?print$w;?>" cellpadding=0 cellspacing=0 border=0 bgcolor="#000000" style="margin-top:5;margin-bottom:5;"><tr><td>
	<table width="<?print$w;?>" align=center cellpadding=2 cellspacing=1 border=0><tr bgcolor="#EEEEEE" style="{font-size:8pt;color:#000044;font-family:verdana;}"><td>
	<h5 align="center" style="margin-bottom:5;">Результаты опроса</h5>
	<div align="left" style="font-size:8pt;">
	<?
	// Выбрать из базы данных строку с опросом
	//$rows - запись из БД с опросом $stat- новая статистика
	$query="SELECT * FROM poll WHERE id=$id";
	$result = mysql_query($query) or die(mysql_error());
	$rows=mysql_fetch_assoc($result);
	$stat=$rows['text']; //Здесь статистика по опросу
	$data1=explode("|::|",$stat);
	$num=0;
	for($i=1;$i<sizeof($data1)-2;$i++){// Заполняем статистику
	$num=$num+1;//Количество вариантов ответа
	//echo "Вариант $i $data1[$i]";
	$a1[$i-1]=$data1[$i];
	}
	$all=0;
	for($i=0;$i<$num;$i++){
	$all=$all+$a1[$i];
	}
	$last=$data1[$num+1];
	$data2=explode("|::|",$rows['variants']);
	for($i=2;$i<sizeof($data2)-1;$i++){
	$a2[$i-2]=$data2[$i];
	}
	$question=$data2[1];
	$question=stripslashes($question);
	print "<div align=center><b>".$question."</b></div><br>";
	if($all!=0){
	for($i=0;$i<$num;$i++){
	$apr[$i]=round(($a1[$i]/$all)*100)."%";
	if(round(($a1[$i]/$all)*100)==0){
	$apr[$i]=round(($a1[$i]/$all)*100,2)."%";
	}
	}
	for($i=0;$i<$num;$i++){
	$il=$i+1;
	$tw=round($a1[$i]/$all,2)*($w-10);
	print "<div align=left><b>".$il."</b>. ".$a2[$i]." - <b>".$apr[$i]."</b> ( ".$a1[$i]." )</div><table align=left bgcolor=#000033 cellpadding=0 cellspacing=0 width=".$tw." height=\"15\"><tr><td><table width=".$tw." cellpadding=0 cellspacing=1 align=left height=\"15\"><tr><td bgcolor=".color($i,$coltype)."><font style=\"font-size:6pt;color:".color($i,$coltype)."\">&nbsp;</font></td></tr></table></td></tr></table><br><br>";
	}
	print "<br><div align=left><b>Всего голосов:</b> ".$all."</div>";
	print "<div align=left><b>Последний голос отдан:</b> ".$last."</div><br>";
	}else{
	print "Ещё никто не проголосовал!";
	print "<div align=left>Дата создания опроса: ".$last."</div><br>";
	}

	?>
	</div>
	</td></tr></table>
	</td></tr></table>
	<?
}else{
	?>
	<html>
	<head>
	<title>Опрос: <?print$_GET['p_q'];?></title>
	<style>
	body{background-color:#FFFFFF;font-family:verdana;font-size:8pt;}
	a:link{text-decoration:none;color:#000066;}
	a:hover{text-decoration:none;color:#0000EE;}
	</style>
	</head>
	<body>
	<table align=center width="<?print$w;?>" cellpadding=0 cellspacing=0 border=0 bgcolor="#000000" style="margin-top:5;margin-bottom:5;"><tr><td>
	<table width="<?print$w;?>" align=center cellpadding=2 cellspacing=1 border=0><tr bgcolor="#EEEEEE" style="{font-size:8pt;color:#000044;font-family:verdana;}"><td>
	<h3 align="center" style="margin-top:10;margin-bottom:10;">Опрос не найден</h3>
	</td></tr></table>
	</td></tr></table>
	<?
}
?>
<table align=center width="<?print$w;?>" cellpadding=0 cellspacing=0 border=0 bgcolor="#000000" style="margin-top:5;margin-bottom:5;"><tr><td>
<table width="<?print$w;?>" align=center cellpadding=2 cellspacing=1 border=0><tr bgcolor="#EEEEEE" style="{font-size:8pt;color:#000044;font-family:verdana;}"><td align="center">
<a href="../index.php?op=poster" title="">Вернуться на сайт.</a>
</td></tr></table>
</td></tr></table>
</body>
</html>
<?
// END
?>