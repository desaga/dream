<?php
//echo "<div id='debuginfo' style='position:absolute; top:200px;'>�������� ��������</div>";
if(!defined("LOGIN")) die;
// �������� ������
session_start();
?>
	  <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Frameset//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd'>
	  <html>
	  <head>
		  <title>���� �������� ������ ������-����� ���������� ��������</title>
		  <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
		  <meta name="description" content="����������� ����������� �� ������� �������� ���� ���" />
		  <meta name="keywords" content="���� ���, MaryKay, �����������, �����, ������-������, �����" />
		  <link href="style.css" rel="stylesheet" type="text/css" />
		  <link href="/favicon.ico" rel="icon" type="image/x-icon" />
		  <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	
<?php	//��������� ������� �� ���������
	if ($_SERVER['HTTP_HOST'] != 'localhost')
	{
	include 'analytics.php';
	}
?>
	  </head>
	  <body>
<?php
// �������� �������� op �� URL
empty($_GET['op'])? $op='poster':$op = $_GET['op'];
if ($op != 'exit')
{
//echo "<div id='debuginfo' style='position:absolute; top:220px;'>�������� ���� �� ������� ������ � ����� ����� (�� ���������� enter �� �������� ����)</div>";
// �������� ���� �� ������� ������ � ����� ����� (�� ���������� enter �� �������� ����)
if(!empty($_POST['enter']))
  {//echo "<div id='debuginfo' style='position:absolute; top:240px;'>����� ����������".$_POST['login'].",".$_POST['passw']." (�����/������)</div>";
  include 'conndb.php';// ����������� � ��
  //  � ���� ��� ������������ �������� � �������
  if (isset($_POST['login']) && isset($_POST['passw'])) //���� ������� ���� � ������
	{
		//echo "<div id='debuginfo' style='position:absolute; top:230px;'>������� ���� � ������</div>";
		$login = mysql_real_escape_string($_POST['login']);
		$password = mysql_real_escape_string($_POST['passw']);//$password = md5($_POST['password']); //���� �� ����� ����������
		//����������� ���� � ������ MySQL
		$passwDB = substr($password,-4).substr($password,2,2).substr($password,0,2);
		//echo "<div id='debuginfo' style='position:absolute; left:50px; top:250px;'>$password ����������������� ���� ($passwDB).</div>";
		// ������ ������ � ��
		// � ���� ����� � ����� ������� � �������
		//echo "<div id='debuginfo' style='position:absolute; top:250px;'>����� ($login). ������ ($password).</div>";
		$query = "SELECT `id`,`name`,`date_born` FROM `konsult_date` WHERE `id` = '{$login}' AND `date_born` = '{$passwDB}';";
		//echo "<div id='debuginfo' style='position:absolute; top:270px;'>������ ($query).</div>";
		//echo "��������� ������";
		$sql = mysql_query($query) or die(mysql_error());
		//echo "������ ��������.";
		// ���� ����� ������������ �������
		//$rows=mysql_num_rows($sql); �-�� �����������
		$row = mysql_fetch_assoc($sql); //������ ���������
		$userName=$row['name'];
		$dateBorn=$row['date_born'];
		$konsnubmer=$row['id'];
		//echo "konsnubmer.. $konsnubmer $dateBorn";
		//echo "<div id='debuginfo' style='position:absolute; top:290px;'>������ ��� ��������� $rows ,$userName</div>";
		if (mysql_num_rows($sql) == 1) {
			// ��������� � ��������� �������������� �������� ������������
			include 'set_user_property.php';
			// ��������� ����� � ������  
			$_SESSION['login'] = $login;// ����� - ����� ������������ ��� ��������� ����� �� ������ �������
			$_SESSION['passw'] = $password;
			$_SESSION['userName'] = $userName; 	// ���
			$_SESSION['status'] = $status;		// ������ �� ��� �������
			$_SESSION['permit'] = $permit;		// ���������� �� ������ �� ��� �������
			$_SESSION['avatar'] = $avatar;		// ������ �� ���� �� ��� �������
			$trackName=$login."; ".$userName; 	// ����� � ��� ������������ ��� �������
			$_SESSION['trackName'] = $trackName;
			$_SESSION['konsnubmer'] = $konsnubmer; //����� ������������
			
				echo "<script type='text/javascript'>_gaq.push(['_trackEvent', '������������','���� �� ����','".$_SESSION['trackName']."']);</script>"; // ����������� ���� ������������ �� ����.
			
			// ������, ��� ��� ������ � ����������� �������, � ��� � ������ ������� ������ �������������� session_start();
		}

    }
  }
} else
  { // ���� ������������ ����� "�����"
    $_SESSION['login'] = "";
    $_SESSION['passw'] = "";
  }

// ���� ����� � ������ ��� �� ��������� ��� ���� ������� �����������
// ������ �� ������
if(empty($_SESSION['login']))
{
include "authform.php";
die;

}else
{
	//echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Frameset//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd'>";
  switch  ($op)
  {
  case "main" : include "main.php";
  break;
  case "contact" : include "contact.php";
  break;
  case "info" : include "info.php";
  break;
  case "list" : include "showtbl.php";
  break;
  case "faq" : include "faq.php";
  break;
  case "team" : include "team.php";
  break;
  case "library" : include "library.php";
  break;
  case "poster" : include "poster.php";
  break;
  case "newcomer" : include "newcomer.php";
  break;
  case "gallery" : include "gallery.php";
  break;
  case "video" : include "video.php";
  break;
  case "activity" : include "activity.php";
  break;
  default:include "poster.php";
  break;
  }
} 
?>
</body>
</html>