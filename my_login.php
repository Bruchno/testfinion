<?php
$db = new PDO("mysql:host=localhost;dbname=usersinformation", "root", "2609");
$login = strtolower(htmlspecialchars($_POST['login']));
$stmt = $db->prepare("SELECT * FROM users WHERE USER= :user");
$stmt->bindParam(':user', $login);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$pass = $row['PASS'];
		} $db = null;
		echo $pass;
?>