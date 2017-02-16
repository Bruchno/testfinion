<?php
$record = $_POST['record'];
$db = new PDO("mysql:host=localhost;dbname=usersinformation", "root", "2609");
$stmt = $db->prepare("SELECT * FROM count_information WHERE record =?");
$stmt->execute(array($record));
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$n = $row['count_like'];
		}
		$n++;
		$db = null;
		$db = new PDO("mysql:host=localhost;dbname=usersinformation", "root", "2609");
		$sql = "UPDATE count_information SET count_like =? WHERE record =?";
		$q = $db->prepare($sql);
		$q->execute(array($n, $record));
		echo $n;
?>
