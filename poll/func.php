<?
function color($i,$type){
$color[0]="deepskyblue";
$color[1]="orange";
$color[2]="gold";
$color[3]="lightgrey";
$color[4]="forestgreen";
$color[5]="lightblue";
$color[6]="lime";
$color[7]="lightgrey";
$color[8]="violet";
$color[9]="Bisque";
$color[10]="Burlywood";
$color[11]="Brown";
$color[12]="Darkorange";
$color[13]="deeppink";
$color[14]="blue";
$color[15]="Lightblue";
if ($type==1 || $type==0){
if (is_numeric($i)){
if($type==1){
if($i>15){
$color_="#cccccc";
}else{
$color_=$color[$i];
}
return $color_;
}elseif($type==0){
$color_="#cccccc";
return $color_;
}
}else{
$color_="#FFFFFF";
return $color_;
}
}else{
$color_="#FFFFFF";
return $color_;
}
}

function check($datafile,$cfgfile,$passfile){
if(phpversion()<4.3){
exit("<div align=center style=\"font-family:verdana;font-size:8pt;color:red;\">������ ��������� �������� � PHP ������ 4.3 ��� ����. ���� ������ PHP: ".phpversion()."</div><br>");
}
if(!file_exists($datafile)){
exit("<div align=center style=\"font-family:verdana;font-size:8pt;color:red;\">������ ����������� ����������, �� ������ ����: <b>".$datafile."</b></div><br>");
}
if(!file_exists($passfile)){
exit("<div align=center style=\"font-family:verdana;font-size:8pt;color:red;\">������ ����������� ����������, �� ������ ����: <b>".$passfile."</b></div><br>");
}
if(!file_exists($cfgfile)){
exit("<div align=center style=\"font-family:verdana;font-size:8pt;color:red;\">������ ����������� ����������, �� ������ ����: <b>".$cfgfile."</b></div><br>");
}
if(!is_readable($datafile) || !is_writeable($datafile)){
exit("<div align=center style=\"font-family:verdana;font-size:8pt;color:red;\">�� ����������� ��������� ����� ������� ��� ����� <b>".$datafile."</b></div><br>");
}
if(!is_readable($passfile) || !is_writeable($passfile)){
exit("<div align=center style=\"font-family:verdana;font-size:8pt;color:red;\">�� ����������� ��������� ����� ������� ��� ����� <b>".$passfile."</b></div><br>");
}
if(!is_readable($cfgfile) || !is_writeable($cfgfile)){
exit("<div align=center style=\"font-family:verdana;font-size:8pt;color:red;\">�� ����������� ��������� ����� ������� ��� ����� <b>".$cfgfile."</b></div><br>");
}
}
function login($pass,$passfile){
$dat=file($passfile);
$data=explode("|::|",$dat[1]);
if (md5($pass)==$data[1]){
return true;
}else{
return false;
}
}


function auth($pass){//�������� ���������� ������(������ � ����� $passfile
	$query="SELECT `pass` FROM `users` WHERE `name`='000282018'";
	$result = mysql_query($query) or die(mysql_error());
	$row=mysql_fetch_assoc($result);
	if ($pass==$row['pass']){
		return true;
	}else{
		return false;
	}
}
function tdate($raz){
$day=date('j');
$month=date('m');
$year=date('Y');
$week=date('w');
$hour=date('H');
$min=date('i');
$sec=date('s');
if($month=="1"){$m="������";}
elseif($month=="2"){$m="�������";}
elseif($month=="3"){$m="�����";}
elseif($month=="4"){$m="������";}
elseif($month=="5"){$m="���";}
elseif($month=="6"){$m="����";}
elseif($month=="7"){$m="����";}
elseif($month=="8"){$m="�������";}
elseif($month=="9"){$m="��������";}
elseif($month=="10"){$m="�������";}
elseif($month=="11"){$m="������";}
elseif($month=="12"){$m="�������";}
if($week=="0"){$w="�����������";}
elseif($week=="1"){$w="�����������";}
elseif($week=="2"){$w="�������";}
elseif($week=="3"){$w="�����";}
elseif($week=="4"){$w="�������";}
elseif($week=="5"){$w="�������";}
elseif($week=="6"){$w="�������";}
$string=$w." ".$raz." ".$day." ".$m." ".$year." ".$raz." ".$hour.":".$min.":".$sec;
return $string;
}
function dateToString($data){
$timeData=strtotime($data);
$day=date('j',$timeData);
$month=date('m',$timeData);
$year=date('Y',$timeData);
$week=date('w',$timeData);
$hour=date('H',$timeData);
$min=date('i',$timeData);
$sec=date('s',$timeData);
if($month=="1"){$m="������";}
elseif($month=="2"){$m="�������";}
elseif($month=="3"){$m="�����";}
elseif($month=="4"){$m="������";}
elseif($month=="5"){$m="���";}
elseif($month=="6"){$m="����";}
elseif($month=="7"){$m="����";}
elseif($month=="8"){$m="�������";}
elseif($month=="9"){$m="��������";}
elseif($month=="10"){$m="�������";}
elseif($month=="11"){$m="������";}
elseif($month=="12"){$m="�������";}
if($week=="0"){$w="�����������";}
elseif($week=="1"){$w="�����������";}
elseif($week=="2"){$w="�������";}
elseif($week=="3"){$w="�����";}
elseif($week=="4"){$w="�������";}
elseif($week=="5"){$w="�������";}
elseif($week=="6"){$w="�������";}
//$string=$w." ".$raz." ".$day." ".$m." ".$year." ".$raz." ".$hour.":".$min.":".$sec;
$string=$w." ".$day." ".$m." ".$year;
return $string;
}
?>