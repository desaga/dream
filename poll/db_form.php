<?
// BEGIN
// ���� ���� ���������� ����� ���� ������ ����� date_start � date_finish
// � ������������ ��� �� ������������ - ������� ����� ��� �����������
// ���� ���� ��������� ������� - ���������� ����� �� ������ �� ���� ��������
// ����� ����������� - ��������� ������� �������� - ������� ��� ������������� �, ���� ����, ����� �����
if(!$inc){
include($p_path."func.php");
include($p_path."conf.php");
$inc=true;
}
// �������� ���������
$p_path="poll/";//���� � ����� ������
$p_submit="����������";//�������� ������
$p_align="center";//������������
$p_width="100%";//������
$p_font="Arial";//�����
$p_txtsize="3em";//������ ������
$p_bcolor="#000000";//���� ����1
$p_bgcolor="#E5E5E5";//���� ����
$p_txtcolor="#000000";//����
$p_bwidth="1";
$p_coltype="1";
$p_rwidth="500";
// -------------------------
$konsnubmer=$_SESSION['konsnubmer'];
//echo "konsnubmer.. $konsnubmer $dateBorn";
//$konsnubmer=((isset($_GET['kons_number']) AND $_GET['kons_number']!="") ?$_GET['kons_number'] : '000282018');
// ���� ����������� � �� � ������ ���������� ������� �� ���� � ������� ������������ ��� �� ���������
$query="SELECT * FROM poll WHERE `date_start`<=CURDATE() AND `date_finish`>=CURDATE()";
$result=mysql_query($query);
//�������� �������� ������� poll_answers ��������� ������, � ������� ����������
$num = 0; // ���������� ����������� �������
$id_q='';	// id ������ ��� ���������
while ($next=mysql_fetch_array($result)){// ���� ������������ ������ � ����� ������ ����������
$query="SELECT * FROM poll_answers WHERE `id_kons`=$konsnubmer AND `id`=$next[id]";
$result_answ=mysql_query($query);
$row=mysql_fetch_assoc($result_answ);
if (!$row['id']){$num = $num +1;$id_q=$next['id'];}
}
//echo "� ��� ���� ".$num." ����������� ������ # $id_q";
//---------------------------------------------------
if($num>0){
//echo "������� $num ����� (�,��).";
$query="SELECT * FROM poll WHERE `id`='$id_q'";
$result=mysql_query($query);
$rows=mysql_fetch_assoc($result);
$ex=true;
$data_poll=explode("|::|",$rows['variants']);
$p_q=$data_poll[1];
$id_q=$rows['id'];
for($i=2;$i<sizeof($data_poll)-1;$i++){
$q[$i-2]=$data_poll[$i];
}
if($ex){
?>

<form id='poll_form' name="<?print$name;?>" action="<?print$p_path;?>db_add.php" method="get" style="{font-size:<?print$p_txtsize;?>;color:<?print$p_txtcolor;?>;font-family:<?print$p_font;?>;margin:0,0,0,0;}">
<div id='poll_head'><?print$p_q;?></div>
<?
	for($i=0;$i<sizeof($q);$i++){
		$il=$i+1;
		print "<div id='poll_quest'><input type=radio name=\"vote\" value=\"".$il."\"> ".$q[$i]."</div>";
	}
for($i=0;$i<sizeof($q);$i++){
$q[$i]="";
}
$q="";
?>
<?php
// �������� id ������ � ����� ������������-����� �� ���������� �� �������� index.php->auth_db.php ��� ������ � ��
//
?>

<script type="text/javascript">
function show(name) {
	var attrcheck;
	var obj = document.getElementsByName(name);
	for(var i = 0; i < obj.length; i++) {
		if(obj[i].checked) {
		return true;
       }
	}
}
</script>

<input type="hidden" name="id" value="<?print$id_q;?>" />
<div style="padding:10px 10px; display: inline-block; align:center;">
<div ><input id='poll_submit' type="submit" "disabled" value="" /></div>
<a href="#" onclick="javascript:if (show('vote')){document.getElementById('poll_form').submit();} return false;">
					<div>
					<ul id='poll_btn'><li id="login_btn"><?print$p_submit;?></li></ul>
					</div>
					</a>
</div>
<!--<div id='poll_btn'><a href="<?print$p_path;?>db_add.php?name=<?print$name;?>&w=<?print$p_rwidth;?>&coltype=<?print$p_coltype;?>" target="_blank" title="���������� ���������� ������">����������</a></div>-->
</form>

<?
}else{
?>
<table align=<?print$p_align;?> width="<?print$p_width;?>" cellpadding=0 cellspacing=0 border=0 bgcolor="<?print$p_bcolor;?>"><tr><td>
<table width="<?print$p_width;?>" align=center cellpadding=2 cellspacing=<?print$p_bwidth;?> border=0><tr bgcolor="<?print$p_bgcolor;?>" style="{font-size:<?print$p_txtsize;?>;color:<?print$p_txtcolor;?>;font-family:<?print$p_font;?>;}"><td>
<div align="center">����� <b><?print$name;?></b> �� ������!</b></div>
</td></tr></table>
</td></tr></table>
<?
}
}else{
?>
<table align=<?print$p_align;?> width="<?print$p_width;?>" cellpadding=0 cellspacing=0 border=0 bgcolor="<?print$p_bcolor;?>"><tr><td>
<table width="<?print$p_width;?>" align=center cellpadding=2 cellspacing=<?print$p_bwidth;?> border=0><tr bgcolor="<?print$p_bgcolor;?>" style="{font-size:<?print$p_txtsize;?>;color:<?print$p_txtcolor;?>;font-family:<?print$p_font;?>;}"><td>
<div align="center">��������� ��� �� ���������� ������� � �������!!!</b></div>
</td></tr></table>
</td></tr></table>
<?
}
//}
// END
?>