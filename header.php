<html>
<title>Tеcтовый блог</title>
<head><script src="jquery-3.0.0.min.js"></script>
<script src="script.js"></script>
<link rel="stylesheet" href="styles.css" type = "text/css" />

</head>
<body>
<?php
header("Content-Type: text/html; charset=utf-8");
include 'function.php';
session_start();
$userstr = ' (Guest)';
$user = '';
echo '<header>Життя - це наявність новин</header><br /><br /><br />';
if (isset($_SESSION['user']))
{
	$user = $_SESSION['user'];
	$logeddin = true;
	$userstr = " ($user)";
} else $logeddin = false;
date_default_timezone_set('UTC');
	$dey = date("d.m.y.H.i");
	echo '<div style=" width:100%; height:1px; clear:both;">.</div>';
if ($logeddin)
{	
	echo '<div class = "hello">Вітаємо на сайті! '.$user.'<br />'.$dey.'</div>';
} else { echo '<form action = "" name="registration" class = "formregistration " method = "post">'.

'Логин: <input type = "text" name="login" size="20" onBlur="mylogin()" /></br>'.
'Пароль: <input type = "text" name = "pass" size="12" onBlur="mylogin()"  /></br>'.
'<span id="my_login"></span>'.
'<input type = "submit" id = "enter" name = "user" disabled="disabled" value = "Ввійти"/>'.
'</form><div id ="responseajax"></div>';

}
?>