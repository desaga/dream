<?
// Dream Poll v1.0
// ������ ��� �������� ������� �����������
//
// ����� �������: V. Kuznyetsov (desaga@gmail.com) 2013�.
//
//if(!defined("LOGIN")) die;  
include("conf.php");//���� ������������
include("func.php");//���� � ���������
//setcookie("epoll_admin_lastvisit",tdate("-"),time()+60*60*24*365);//��������� ����  ���� ��������� �� ���
include '../conndb.php';// ����������� � ��
$do=$_GET['do'];
if (isset($_POST['pass'])){ //���� ������ ���������
	$_GET['pass']=md5($_POST['pass']); //������� ������
}
//++++++++++++++++++ �������� ������� login �������� ������, ������ ����� �� �� users -> pass
if (!auth($_GET['pass'])){ //���������� ������ � ����� � ���� ������������, ��
	$pc=false;
	if (isset($_POST['pass'])){ //������ ��� ������?
	$error="�� ����� �������� ������";
	}else{ //������ �� ��������
	$error="��� ���������� ����������������";
	}
}else{ //������ ����������
	$pc=true;
	if (isset($_POST['pass'])){
	$error="�� ������ �����";
	}
}
if ($pc){
// ~~~~~~~~~START~~~~~~~~~~~
// STATISTIC
	if(isset($_GET['id'])){//���� ������� id �������
		$query="SELECT `date_finish`,`date_start`,`variants`,`text`,`id`  FROM `poll`";//������� ��� ������ �� ������� �������
		$result = mysql_query($query) or die(mysql_error());
		while	($row = mysql_fetch_assoc($result))
			{
			if($row['id']==$_GET['id']){
			$find=true;//����� ������
			$id=$row['id'];
			$text=$row['text'];
			$variants=$row['variants'];
			}
		}
	// +++++++
		if($find){
			$stat=true;//������ ������
		}else{
			$error="����� �� ������!";
			$stat=false;//������ �� ������
		}
}
}
?>
<html>
<head>
<title>����������.</title>
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
<h3 style="margin-top:1;margin-bottom:1;">������ ���������� ������������ v1.0</h3>
</td></tr>
</table>
</td></tr>
</table>
<table width="600" bgcolor="#000066" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td>
<table align="center" width="600" cellspacing="1" cellpadding="1" border="0" class="main">
<?
if($error!=""){//������� ��������� ���� ����
?>
<tr><td bgcolor="#cccccc" align="center" class="error">
<?
print$error;
?>
</td></tr>
<?
}
if(!$pc){//���� ������ ������������
?>
<tr><td align="center" bgcolor="#d5d5d5">
<form method="post" style="margin-top:5;margin-bottom:5;">
<input type="password" name="pass" style="width:150;"><br>
<input type="submit" value="�����" class="button">
</form>
</td></tr>
<?
}else{//������ ���������� - ������� ���������
?>
<tr><td align="center" bgcolor="#d5d5d5" class="sm">
<a href="?do=stat&pass=<?print$_GET['pass'];?>">���������� �������</a><br>
<a href="?">�����</a><br>
</td></tr>
<?
if($do=="stat"){//���� ���������� �������� stat ���������� ���������� �������

if(!$stat){//���� ����� ����� �� ������ - ������� ������ �������
	?>
	<tr><td align="left" bgcolor="#d5d5d5" class="sm">
	<div align="center" class="main"><b>���������� �������</b></div>
	</td></tr>
	<tr><td align="center" bgcolor="#AAAAAA" class="sm">
	<table bgcolor="#000066" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td>
	<table align="center" width="590" cellspacing="1" cellpadding="1" border="0" class="sm">
	<?
	
	$query="SELECT *  FROM `poll`";//������� ��� ������ �� ������� �������
	$result = mysql_query($query) or die(mysql_error());
	$num = mysql_num_rows($result);
	
	if($num!=0){//���� ���� ������
	while	($row = mysql_fetch_assoc($result))
		{
		$data=explode("|::|",$row['variants']);
		print "<tr class=\"sm\"><td align=center width=\"20%\" bgcolor=#d5d5d5><a href=\"?do=stat&pass=".$_GET['pass']."&id=".$row[id]."\" title=\"�������� ����������\"><b>".$row['id']."</b></a></td><td align=left width=\"80%\" bgcolor=#d5d5d5><a href=\"?do=stat&pass=".$_GET['pass']."&id=".$row[id]."\" title=\"�������� ����������\">".$data[1]."</td></a></tr>";
		}
	}else{//���� ������� ���
	print "<tr class=\"sm\"><td align=center width=\"100%\" bgcolor=#d5d5d5>�� �� ������� �� ������ ������!</td></tr>";
	}
	?>
	</table>
	</td></tr>
	</table>
	</td></tr>
	<?
}else{//���� ����� ������ - ������� ���������� �� ��������� �������
	?>
	<tr><td align="left" bgcolor="#d5d5d5" class="sm">
	<div align="center" class="main"><b>���������� ������ - <?echo $id;?></b></div>
	<div align="left" style="margin-left:25;margin-top:4;margin-bottom:4;">
	<br>
	<?
	$data1=explode("|::|",$text);//�������� ������ �� ����������� �� $n ������
	$num=0;
	for($i=1;$i<sizeof($data1)-2;$i++){
		$num=$num+1;//������� ���������� ��������� ������
		$a1[$i-1]=$data1[$i];//�������� ������ ����������� �������
	}
	$all=0;
	for($i=0;$i<$num;$i++){
		$all=$all+$a1[$i];//�������� ������� ����� �������
	}
	$last=$data1[$num+1];//���� ���������� ������
	$data2=explode("|::|",$variants);//������� ������ � �������� � ���������� �������
	for($i=2;$i<sizeof($data2)-1;$i++){
		$a2[$i-2]=$data2[$i];//�������� ������ �������� � ����������
	}
	$question=$data2[1];//������
	//������ ������� �� �� ������� �� id ������ 
	$query="SELECT `poll_answers`.`id`, `konsult_date`.`name`,`poll_answers`.`date`, `poll_answers`.`answer` FROM poll_answers LEFT JOIN konsult_date ON `poll_answers`.`id_kons`= `konsult_date`.`id` WHERE`poll_answers`.`id`='$id'";
	//echo $query;
	$sql=mysql_query($query);
	$row=1;
	while ($answers[$row++]=mysql_fetch_assoc($sql))
	{
	echo "<br>������ ".($row-1)." : ".$answers[($row-1)]['name'].$answers[($row-1)]['answer'];
	}
	$total_answers=$row-2;// ����� ������� �� �����
	echo "<br>����� ������� $total_answers";
	$question=stripslashes($question);//������� ���� �������
	print "<div align=left><b>������:</b> ".$question."</div><br>";//������� ������
	if($all!=0){//���� ���� �������� �������
		for($i=0;$i<$num;$i++){
			$apr[$i]=round(($a1[$i]/$all)*100)."%";//�������� ������� ��� ��������
			if(round(($a1[$i]/$all)*100)==0){//���� ����� 1%
			$apr[$i]=round(($a1[$i]/$all)*100,2)."%";//������� ������� ����
			}
		}
		for($i=0;$i<$num;$i++){//������� �������� ������� �� �����������
			$il=$i+1;//����� �� ��������
			print "<div align=left style='color:red' class=text><u>������� ������ �".$il.":</u> ".$a2[$i]." - <b>".$apr[$i]."</b> ( ".$a1[$i]." )</div>";
			if ($a1[$i]>0){
				for ($j=0;$j<$total_answers;$j++){
					if($answers[($j+1)]['answer']==$il){
					echo $answers[($j+1)]['name']."; ".dateToString($answers[($j+1)]['date'])."<br>";
					}
				}
			}
		}
		print "<br><div align=left><b>����� �������:</b> ".$all."</div>";
		print "<div align=left><b>��������� ����� �����:</b> ".$last."</div><br>";
	}else{//���� ����� �� ���������
	print "��� ����� �� ������������!";
	print "<div align=left>���� �������� ������: ".$last."</div><br>";
	}
	?>
	<br>
	<div align="center"><b><a href="?do=stat&pass=<?print$_GET['pass'];?>"><<< ��������� �����</a></b></div>
	</div><br>
	</td></tr>
<?
}}
//+++++++++++ ����������: ������ ���������� ���,
if($do=="add"){//���� ���������� �������� add ��������� ����� �����
	if($addp==0 || $addp==""){//���� �������� =0 ��� �� ���������� ������� 1-� ��� �������� ������
		?>
		<tr><td align="left" bgcolor="#d5d5d5" class="sm">
		<div align="center"><b>�������� ������ (��� 1):</b></div>
		<div align="left" style="margin-left:25;margin-top:4;margin-bottom:4;">
		<form method="get" style="margin-top:5;margin-bottom:5;">
		������ �����������:<br>
		<input type="text" name="question" size="45"><br>
		����� ��������� :<br>
		C <input type="date" name="date_start" size="45" value=<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>> ��
		<input type="date" name="date_finish" size="45" value=<?php echo date('Y-m-d', strtotime('+1 week',time())); ?>><br>
		���������� ��������� ������:<br>
		(�� ������ 99-�) (�������������: ������ 15 ����)<br>
		<input type="text" name="num" size="5" maxlength="2"><br>
		<input type="hidden" name="pass" value="<?print$_GET['pass'];?>">
		<input type="hidden" name="do" value="add">
		<input type="submit" value="�����" class="button">
		</form>
		</div><br>
		</td></tr>
		<?
// +++++++ ��� �������� 1 ��� �� �����, �.�. �� ���� ��������� ��� ������, ��  ���������� addp=1 �����
// ��� ����� ��������������� �������� �������� ����� ����� "���������� ���������" � "������ �����������"
	}elseif($addp==1){//���� 1 ��� �������� ������ ������� �� ��� 2 ������� �������� �������
	?>
	<tr><td align="left" bgcolor="#d5d5d5" class="sm">
	<div align="center"><b>�������� ������ (��� 2):</b></div>
	<div align="left" style="margin-left:25;margin-top:4;margin-bottom:4;">
	<form method="get" style="margin-top:5;margin-bottom:5;">
	<?
	$_GET['question']=stripslashes($_GET['question']);
	$_GET['question']=ereg_replace("\"","&quot;",$_GET['question']);
	?>
	<b><?print$_GET['name'];?></b> - <?print$_GET['question'];?><br>
	<br>
	��������� �������� ������:<br>
	<?
	for($i=0;$i<$_GET['num'];$i++){//������� ���� ��� ����� ��������� �������
	$il=$i+1;//������ ������
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
	<input type="submit" value="������� �����" class="button">
	</form>
	<br>
	<div align="center"><b><a href="?do=add&pass=<?print$_GET['pass'];?>"><<< ��������� �����</a></b></div>
	</div><br>
	</td></tr>
	<?
}elseif($addp==2){//���� ����� ������� �������� ������� ������ "��������� �����"
	?>
	<tr><td align="left" bgcolor="#d5d5d5" class="sm">
	<div align="center"><b><a href="?do=add&pass=<?print$_GET['pass'];?>"><<< ��������� �����</a></b></div>
	</td></tr>
	<?
}
}
if($do=="del"){//���� ������� �������� del ������� �����
if(!$del){//���� ����� �� ������ ��� �� ������
	?>
	<tr><td align="left" bgcolor="#d5d5d5" class="sm">
	<div align="center" class="main"><b>�������� �������</b></div>
	</td></tr>
	<tr><td align="center" bgcolor="#AAAAAA" class="sm">
	<table bgcolor="#000066" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td>
	<table align="center" width="590" cellspacing="1" cellpadding="1" border="0" class="sm">
	<?
	
	
	//$dat=file($pollcfg);//�������� ������ �������
	$query="SELECT *  FROM `poll`";//������� ��� ������ �� ������� �������
	$result = mysql_query($query) or die(mysql_error());
	$num = mysql_num_rows($result);
	if($num!=0){//���� ������ �� ����� 0
	while ($row=mysql_fetch_assoc($result)){
		$data=explode("|::|",$row['variants']);//�������� ������ ������ � ������ � ������� ��� ������ � ������
		print "<tr class=\"sm\"><td align=center width=\"20%\" bgcolor=#d5d5d5><b>".$row['id']."</b></td><td align=left width=\"80%\" bgcolor=#d5d5d5><a href=\"?do=del&pass=".$_GET['pass']."&id=".$row['id']."&text=".$data[1]."\" title=\"������� ���� �����\">".$data[1]."</a></td></tr>";
	}
	}else{//���� ������� ��� ���
		print "<tr class=\"sm\"><td align=center width=\"100%\" bgcolor=#d5d5d5>�� �� ������� �� ������ ������!</td></tr>";
	}
	?>
	</table>
	</td></tr>
	</table>
	</td></tr>
	<?
}else{//���� ����� ������� ������
	?>
	<tr><td align="left" bgcolor="#d5d5d5" class="sm">
	<div align="center"><b><a href="?do=del&pass=<?print$_GET['pass'];?>"><<< ��������� �����</a></b></div>
	</td></tr>
	<?
}}
		if($do=="cp"){//���� ������ �������� 'cp' ������ ������
			if(!$cpok){//���� ������ ��� �� �������
					?>
					<tr><td align="left" bgcolor="#d5d5d5" class="sm">
					<div align="center"><b>����� ������</b></div>
					<div align="center" style="margin-left:25;margin-top:4;margin-bottom:4;">
					<form method="get" style="margin-top:5;margin-bottom:5;">
					����� ������:<br>
					<input type="text" name="npass" size="20" value=""><br>
					<input type="hidden" name="pass" value="<?print$_GET['pass'];?>">
					<input type="hidden" name="do" value="cp">
					<input type="submit" value="�������">
					</form>
					</div><br>
					</td></tr>
					<?
			}else{//���� ������ ������� �������
			?>
				<tr><td align="left" bgcolor="#d5d5d5" class="sm">
				<div align="center"><b><a href="?do=cp&pass=<?print$_GET['pass'];?>"><<< ��������� �����</a></b></div>
				</td></tr>
				<?
			}
		}	//����� ��������� ������
} //����� ������� �������� ������
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
