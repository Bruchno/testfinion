<?php
$login = strtolower(htmlspecialchars($_POST['login']));
$db = new PDO("mysql:host=localhost;dbname=usersinformation", "mama", "2609");
$stmt = $db->prepare("SELECT * FROM users WHERE USER=?");
$stmt->execute(array($login));
$count = $stmt->rowCount();
if ($count > 0)
{
	echo "Логін зайнятий!</br>";
} else echo "";
$db = null;
?>