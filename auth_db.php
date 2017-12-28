<?php
//echo "<div id='debuginfo' style='position:absolute; top:200px;'>Начинаем проверку</div>";
if(!defined("LOGIN")) die;
// Начинаем сессию
session_start();
?>
	  <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Frameset//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd'>
	  <html>
	  <head>
		  <title>Сайт Старшего Лидера Бизнес-Групп Кузнецовой Светланы</title>
		  <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
		  <meta name="description" content="Независимый консультант по красоте компании Мэри Кэй" />
		  <meta name="keywords" content="Мэри Кэй, MaryKay, консультант, лидер, бизнес-группа, Мечта" />
		  <link href="style.css" rel="stylesheet" type="text/css" />
		  <link href="/favicon.ico" rel="icon" type="image/x-icon" />
		  <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	
<?php	//Отключаем трекинг на локалхост
	if ($_SERVER['HTTP_HOST'] != 'localhost')
	{
	include 'analytics.php';
	}
?>
	  </head>
	  <body>
<?php
// Получаем параметр op из URL
empty($_GET['op'])? $op='poster':$op = $_GET['op'];
if ($op != 'exit')
{
//echo "<div id='debuginfo' style='position:absolute; top:220px;'>Проверям были ли посланы данные с нашей формы (по переменной enter из скрытого поля)</div>";
// Проверям были ли посланы данные с нашей формы (по переменной enter из скрытого поля)
if(!empty($_POST['enter']))
  {//echo "<div id='debuginfo' style='position:absolute; top:240px;'>Форма отправлена".$_POST['login'].",".$_POST['passw']." (логин/пароль)</div>";
  include 'conndb.php';// Соединяемся с бд
  //  и ищем там консультанта сномером и паролем
  if (isset($_POST['login']) && isset($_POST['passw'])) //если посланы логи и пароль
	{
		//echo "<div id='debuginfo' style='position:absolute; top:230px;'>посланы логи и пароль</div>";
		$login = mysql_real_escape_string($_POST['login']);
		$password = mysql_real_escape_string($_POST['passw']);//$password = md5($_POST['password']); //пока не нужно шифрование
		//Преобразуем дату в формат MySQL
		$passwDB = substr($password,-4).substr($password,2,2).substr($password,0,2);
		//echo "<div id='debuginfo' style='position:absolute; left:50px; top:250px;'>$password Отформатированная дата ($passwDB).</div>";
		// делаем запрос к БД
		// и ищем юзера с таким логином и паролем
		//echo "<div id='debuginfo' style='position:absolute; top:250px;'>Логин ($login). Пароль ($password).</div>";
		$query = "SELECT `id`,`name`,`date_born` FROM `konsult_date` WHERE `id` = '{$login}' AND `date_born` = '{$passwDB}';";
		//echo "<div id='debuginfo' style='position:absolute; top:270px;'>Запрос ($query).</div>";
		//echo "Выполняем запрос";
		$sql = mysql_query($query) or die(mysql_error());
		//echo "Запрос выполнен.";
		// если такой пользователь нашелся
		//$rows=mysql_num_rows($sql); к-во результатов
		$row = mysql_fetch_assoc($sql); //первый результат
		$userName=$row['name'];
		$dateBorn=$row['date_born'];
		$konsnubmer=$row['id'];
		//echo "konsnubmer.. $konsnubmer $dateBorn";
		//echo "<div id='debuginfo' style='position:absolute; top:290px;'>Запрос дал результат $rows ,$userName</div>";
		if (mysql_num_rows($sql) == 1) {
			// проверяем и сохраняем дополнительные свойства пользователя
			include 'set_user_property.php';
			// сохраняем логин и пароль  
			$_SESSION['login'] = $login;// Логин - номер консультанта или Отдельный логин из другой таблицы
			$_SESSION['passw'] = $password;
			$_SESSION['userName'] = $userName; 	// ФИО
			$_SESSION['status'] = $status;		// Статус из доп таблицы
			$_SESSION['permit'] = $permit;		// Разрешения на доступ из доп таблицы
			$_SESSION['avatar'] = $avatar;		// Ссылка на фото из доп таблицы
			$trackName=$login."; ".$userName; 	// Номер и имя консультанта для трекера
			$_SESSION['trackName'] = $trackName;
			$_SESSION['konsnubmer'] = $konsnubmer; //Номер консультанта
			
				echo "<script type='text/javascript'>_gaq.push(['_trackEvent', 'Консультанты','Вход на сайт','".$_SESSION['trackName']."']);</script>"; // Отслеживаем вход консультанта на сайт.
			
			// помним, что для работы с сессионными данными, у нас в каждом скрипте должно присутствовать session_start();
		}

    }
  }
} else
  { // если пользователь нажал "Выйти"
    $_SESSION['login'] = "";
    $_SESSION['passw'] = "";
  }

// Если логин и пароль еще не вводились или были введены неправильно
// просим их ввести
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