<?
// Dream Poll v1.0
// Скрипт для создания опросов посетителей
//
// Автор скрипта: V. Kuznyetsov (desaga@gmail.com) 2013г.
//
//if(!defined("LOGIN")) die;  
include("conf.php");//файл конфигурации
include("func.php");//файл с утилитами
//setcookie("epoll_admin_lastvisit",tdate("-"),time()+60*60*24*365);//установим куку  дата посещения на год
include '../conndb.php';// Соединяемся с бд
$do=$_GET['do'];
if (isset($_POST['pass'])){ //если пароль отправлен
	$_GET['pass']=md5($_POST['pass']); //шифруем пароль
}
//++++++++++++++++++ Заменить функцию login проверки пароля, пароль брать из БД users -> pass
if (!auth($_GET['pass'])){ //сравниваем пароль с нашим и если неправильный, то
	$pc=false;
	if (isset($_POST['pass'])){ //пароль был введен?
	$error="Вы ввели неверный пароль";
	}else{ //пароль не вводился
	$error="Вам необходимо авторизироваться";
	}
}else{ //пароль правильный
	$pc=true;
	if (isset($_POST['pass'])){
	$error="Вы удачно вошли";
	}
}
if ($pc){
// ~~~~~~~~~START~~~~~~~~~~~
// STATISTIC
	if(isset($_GET['id'])){//если выбрано id запроса
		$query="SELECT `date_finish`,`date_start`,`variants`,`text`,`id`  FROM `poll`";//выберем все записи из таблицы опросов
		$result = mysql_query($query) or die(mysql_error());
		while	($row = mysql_fetch_assoc($result))
			{
			if($row['id']==$_GET['id']){
			$find=true;//нашли запрос
			$id=$row['id'];
			$text=$row['text'];
			$variants=$row['variants'];
			}
		}
	// +++++++
		if($find){
			$stat=true;//запрос найден
		}else{
			$error="Опрос не найден!";
			$stat=false;//запрос не найден
		}
}
}
?>
<html>
<head>
<title>Статистика.</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<style>
<!--
body{background:#FFFFFF;color:#000000;font-family:verdana;font-size:9pt;}
a:link{color:#0000AA;text-decoration:none;}
a:active{color:red;text-decoration:none;}
a:visited{color:#0000AA;text-decoration:none;}
a:hover{color:red;text-decoration:none;}
.main{color:#000000;font-family:verdana;font-size:9pt;}
.sm{font-size:8pt;}
.error{font-size:8pt;color:red;}
.button{font-family:verdana;font-size:8pt;font-weight:600;width:150;border:#000000 1px Solid;background-color:#C0C0C0;margin-top:3;}
input {border:#000000 1px Solid; background-color:#E9E9E9;font-family:verdana;font-size:8pt;}
-->
</style>
</head>
<body top-margin="0" left-margin="0" right-margin="0">
<table style="margin-top:0;margin-bottom:4;" width="600" bgcolor="#000066" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td>
<table align="center" width="600" cellspacing="1" cellpadding="1" border="0" class="main">
<tr><td bgcolor="#cccccc" align="center" class="main">
<h3 style="margin-top:1;margin-bottom:1;">Панель управления голосованием v1.0</h3>
</td></tr>
</table>
</td></tr>
</table>
<table width="600" bgcolor="#000066" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td>
<table align="center" width="600" cellspacing="1" cellpadding="1" border="0" class="main">
<?
if($error!=""){//выведем сообщение если есть
?>
<tr><td bgcolor="#cccccc" align="center" class="error">
<?
print$error;
?>
</td></tr>
<?
}
if(!$pc){//если пароль неправильный
?>
<tr><td align="center" bgcolor="#d5d5d5">
<form method="post" style="margin-top:5;margin-bottom:5;">
<input type="password" name="pass" style="width:150;"><br>
<input type="submit" value="Войти" class="button">
</form>
</td></tr>
<?
}else{//пароль правильный - выводим заголовок
?>
<tr><td align="center" bgcolor="#d5d5d5" class="sm">
<a href="?do=stat&pass=<?print$_GET['pass'];?>">Статистика опросов</a><br>
<a href="?">Выход</a><br>
</td></tr>
<?
if($do=="stat"){//если установлен параметр stat отображаем статистику опросов

if(!$stat){//если такой опрос не найден - выводим список опросов
	?>
	<tr><td align="left" bgcolor="#d5d5d5" class="sm">
	<div align="center" class="main"><b>Статистика опросов</b></div>
	</td></tr>
	<tr><td align="center" bgcolor="#AAAAAA" class="sm">
	<table bgcolor="#000066" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td>
	<table align="center" width="590" cellspacing="1" cellpadding="1" border="0" class="sm">
	<?
	
	$query="SELECT *  FROM `poll`";//выберем все записи из таблицы опросов
	$result = mysql_query($query) or die(mysql_error());
	$num = mysql_num_rows($result);
	
	if($num!=0){//если есть записи
	while	($row = mysql_fetch_assoc($result))
		{
		$data=explode("|::|",$row['variants']);
		print "<tr class=\"sm\"><td align=center width=\"20%\" bgcolor=#d5d5d5><a href=\"?do=stat&pass=".$_GET['pass']."&id=".$row[id]."\" title=\"Смотреть статистику\"><b>".$row['id']."</b></a></td><td align=left width=\"80%\" bgcolor=#d5d5d5><a href=\"?do=stat&pass=".$_GET['pass']."&id=".$row[id]."\" title=\"Смотреть статистику\">".$data[1]."</td></a></tr>";
		}
	}else{//если опросов нет
	print "<tr class=\"sm\"><td align=center width=\"100%\" bgcolor=#d5d5d5>Вы не создали ни одного опроса!</td></tr>";
	}
	?>
	</table>
	</td></tr>
	</table>
	</td></tr>
	<?
}else{//если опрос выбран - выводим статистику по выбраному вопросу
	?>
	<tr><td align="left" bgcolor="#d5d5d5" class="sm">
	<div align="center" class="main"><b>Статистика опроса - <?echo $id;?></b></div>
	<div align="left" style="margin-left:25;margin-top:4;margin-bottom:4;">
	<br>
	<?
	$data1=explode("|::|",$text);//получаем массив со статистикой по $n опросу
	$num=0;
	for($i=1;$i<sizeof($data1)-2;$i++){
		$num=$num+1;//получим количество вариантов ответа
		$a1[$i-1]=$data1[$i];//заполним массив статистикой ответов
	}
	$all=0;
	for($i=0;$i<$num;$i++){
		$all=$all+$a1[$i];//вычислим сколько всего ответов
	}
	$last=$data1[$num+1];//дата последнего ответа
	$data2=explode("|::|",$variants);//получим массив с вопросом и вариантами ответов
	for($i=2;$i<sizeof($data2)-1;$i++){
		$a2[$i-2]=$data2[$i];//заполним массив опросами с вариантами
	}
	$question=$data2[1];//вопрос
	//Делаем выборку из БД ответов по id опроса 
	$query="SELECT `poll_answers`.`id`, `konsult_date`.`name`,`poll_answers`.`date`, `poll_answers`.`answer` FROM poll_answers LEFT JOIN konsult_date ON `poll_answers`.`id_kons`= `konsult_date`.`id` WHERE`poll_answers`.`id`='$id'";
	//echo $query;
	$sql=mysql_query($query);
	$row=1;
	while ($answers[$row++]=mysql_fetch_assoc($sql))
	{
	echo "<br>Запись ".($row-1)." : ".$answers[($row-1)]['name'].$answers[($row-1)]['answer'];
	}
	$total_answers=$row-2;// всего ответов на опрос
	echo "<br>Всего записей $total_answers";
	$question=stripslashes($question);//убираем спец символы
	print "<div align=left><b>Вопрос:</b> ".$question."</div><br>";//выведем вопрос
	if($all!=0){//если есть варианты ответов
		for($i=0;$i<$num;$i++){
			$apr[$i]=round(($a1[$i]/$all)*100)."%";//вичислим процент для варианта
			if(round(($a1[$i]/$all)*100)==0){//если менее 1%
			$apr[$i]=round(($a1[$i]/$all)*100,2)."%";//выведем десятые доли
			}
		}
		for($i=0;$i<$num;$i++){//выводим вырианты ответов со статистикой
			$il=$i+1;//номер по прорядку
			print "<div align=left style='color:red' class=text><u>Вариант ответа №".$il.":</u> ".$a2[$i]." - <b>".$apr[$i]."</b> ( ".$a1[$i]." )</div>";
			if ($a1[$i]>0){
				for ($j=0;$j<$total_answers;$j++){
					if($answers[($j+1)]['answer']==$il){
					echo $answers[($j+1)]['name']."; ".dateToString($answers[($j+1)]['date'])."<br>";
					}
				}
			}
		}
		print "<br><div align=left><b>Всего голосов:</b> ".$all."</div>";
		print "<div align=left><b>Последний голос отдан:</b> ".$last."</div><br>";
	}else{//если никто не голосовал
	print "Ещё никто не проголосовал!";
	print "<div align=left>Дата создания опроса: ".$last."</div><br>";
	}
	?>
	<br>
	<div align="center"><b><a href="?do=stat&pass=<?print$_GET['pass'];?>"><<< Вернуться назад</a></b></div>
	</div><br>
	</td></tr>
<?
}}
//+++++++++++ Переделать: убрано уникальное имя,
if($do=="add"){//если установлен параметр add добавляем новый опрос
	if($addp==0 || $addp==""){//если параметр =0 или не существует выводим 1-й шаг создания опроса
		?>
		<tr><td align="left" bgcolor="#d5d5d5" class="sm">
		<div align="center"><b>Создание опроса (Шаг 1):</b></div>
		<div align="left" style="margin-left:25;margin-top:4;margin-bottom:4;">
		<form method="get" style="margin-top:5;margin-bottom:5;">
		Вопрос голосования:<br>
		<input type="text" name="question" size="45"><br>
		Опрос действует :<br>
		C <input type="date" name="date_start" size="45" value=<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>> По
		<input type="date" name="date_finish" size="45" value=<?php echo date('Y-m-d', strtotime('+1 week',time())); ?>><br>
		Количество вариантов ответа:<br>
		(Не больше 99-и) (Рекомендовано: меньше 15 штук)<br>
		<input type="text" name="num" size="5" maxlength="2"><br>
		<input type="hidden" name="pass" value="<?print$_GET['pass'];?>">
		<input type="hidden" name="do" value="add">
		<input type="submit" value="Далее" class="button">
		</form>
		</div><br>
		</td></tr>
		<?
// +++++++ Шаг проверки 1 уже не нужен, т.к. не надо проверять имя опроса, но  переменная addp=1 нужна
// она будет сигнализировать успешную проверку полей ввода "Количество вариантов" и "Вопрос голосования"
	}elseif($addp==1){//если 1 шаг создания опроса успешен то шаг 2 добавим варианты ответов
	?>
	<tr><td align="left" bgcolor="#d5d5d5" class="sm">
	<div align="center"><b>Создание опроса (Шаг 2):</b></div>
	<div align="left" style="margin-left:25;margin-top:4;margin-bottom:4;">
	<form method="get" style="margin-top:5;margin-bottom:5;">
	<?
	$_GET['question']=stripslashes($_GET['question']);
	$_GET['question']=ereg_replace("\"","&quot;",$_GET['question']);
	?>
	<b><?print$_GET['name'];?></b> - <?print$_GET['question'];?><br>
	<br>
	Возможные варианты ответа:<br>
	<?
	for($i=0;$i<$_GET['num'];$i++){//выводим поля для ввода вариантов ответов
	$il=$i+1;//индекс списка
	print "<input type=\"text\" name=\"a".$il."\" size=\"45\"><br>";
	}
	?>
	<input type="hidden" name="date_start" value="<?print$_GET['date_start'];?>">
	<input type="hidden" name="date_finish" value="<?print$_GET['date_finish'];?>">
	<input type="hidden" name="pass" value="<?print$_GET['pass'];?>">
	<input type="hidden" name="do" value="add">
	<input type="hidden" name="question" value="<?print$_GET['question'];?>">
	<input type="hidden" name="num" value="<?print$_GET['num'];?>">
	<input type="hidden" name="name" value="<?print$_GET['name'];?>">
	<input type="submit" value="Создать опрос" class="button">
	</form>
	<br>
	<div align="center"><b><a href="?do=add&pass=<?print$_GET['pass'];?>"><<< Вернуться назад</a></b></div>
	</div><br>
	</td></tr>
	<?
}elseif($addp==2){//если опрос успешно добавлен вывести секцию "Вернуться назад"
	?>
	<tr><td align="left" bgcolor="#d5d5d5" class="sm">
	<div align="center"><b><a href="?do=add&pass=<?print$_GET['pass'];?>"><<< Вернуться назад</a></b></div>
	</td></tr>
	<?
}
}
if($do=="del"){//если передан параметр del удаляем опрос
if(!$del){//если опрос не выбран или не найден
	?>
	<tr><td align="left" bgcolor="#d5d5d5" class="sm">
	<div align="center" class="main"><b>Удаление опросов</b></div>
	</td></tr>
	<tr><td align="center" bgcolor="#AAAAAA" class="sm">
	<table bgcolor="#000066" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td>
	<table align="center" width="590" cellspacing="1" cellpadding="1" border="0" class="sm">
	<?
	
	
	//$dat=file($pollcfg);//получаем список опросов
	$query="SELECT *  FROM `poll`";//выберем все записи из таблицы опросов
	$result = mysql_query($query) or die(mysql_error());
	$num = mysql_num_rows($result);
	if($num!=0){//если список не равен 0
	while ($row=mysql_fetch_assoc($result)){
		$data=explode("|::|",$row['variants']);//помещаем строку опроса в массив и выведем имя опроса и вопрос
		print "<tr class=\"sm\"><td align=center width=\"20%\" bgcolor=#d5d5d5><b>".$row['id']."</b></td><td align=left width=\"80%\" bgcolor=#d5d5d5><a href=\"?do=del&pass=".$_GET['pass']."&id=".$row['id']."&text=".$data[1]."\" title=\"Удалить этот опрос\">".$data[1]."</a></td></tr>";
	}
	}else{//если опросов еще нет
		print "<tr class=\"sm\"><td align=center width=\"100%\" bgcolor=#d5d5d5>Вы не создали ни одного опроса!</td></tr>";
	}
	?>
	</table>
	</td></tr>
	</table>
	</td></tr>
	<?
}else{//если опрос успешно удален
	?>
	<tr><td align="left" bgcolor="#d5d5d5" class="sm">
	<div align="center"><b><a href="?do=del&pass=<?print$_GET['pass'];?>"><<< Вернуться назад</a></b></div>
	</td></tr>
	<?
}}
		if($do=="cp"){//если выбран параметр 'cp' меняем пароль
			if(!$cpok){//если пароль еще не изменен
					?>
					<tr><td align="left" bgcolor="#d5d5d5" class="sm">
					<div align="center"><b>Смена пароля</b></div>
					<div align="center" style="margin-left:25;margin-top:4;margin-bottom:4;">
					<form method="get" style="margin-top:5;margin-bottom:5;">
					Новый пароль:<br>
					<input type="text" name="npass" size="20" value=""><br>
					<input type="hidden" name="pass" value="<?print$_GET['pass'];?>">
					<input type="hidden" name="do" value="cp">
					<input type="submit" value="Сменить">
					</form>
					</div><br>
					</td></tr>
					<?
			}else{//если пароль успешно изменен
			?>
				<tr><td align="left" bgcolor="#d5d5d5" class="sm">
				<div align="center"><b><a href="?do=cp&pass=<?print$_GET['pass'];?>"><<< Вернуться назад</a></b></div>
				</td></tr>
				<?
			}
		}	//конец изменения пароля
} //конец условия проверки пароля
?>
</table>
</td></tr>
</table>
<table style="margin-top:4;margin-bottom:0;" width="600" bgcolor="#000066" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td>
<table align="center" width="600" cellspacing="1" cellpadding="1" border="0" class="main">
<tr><td align="center" bgcolor="#cccccc" class="sm">Copyright 2013 Viktor Kuznyetsov</a></td></tr>
</table>
</td></tr>
</table>
</body>
</html>
