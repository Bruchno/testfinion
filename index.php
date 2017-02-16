<?php
include 'header.php';
$num = 0;
if (isset($_POST['next']))
{
	$GLOBALS['num'] += 10;
}
$n = $GLOBALS['num'];
	$m = $n + 10;
	$db = dbconnect();
	$query = "SELECT * FROM records LIMIT 50";
	$stmt = $db->query($query);
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$idrecord = $row['RECORD_ID'];
		$datawrite = $row['DATA'];
		$text = $row['TEXT_RECORD'];
		$id_user = $row['ID_USER'];
		$dbn = dbconnect();
		$st = $dbn->prepare("SELECT * FROM users WHERE ID = :iduser");
		$st->bindParam(':iduser', $id_user);
		$st->execute();
		foreach ($st as $r)
		{
			$avatar = $r['AVATAR'];
			$login = $r['USER'];
		} $dbn = null;
		echo '<div class = "blog"><table><tr><td>
		<div class = "avatarka" style = "float:left"><p>'.$login.'</p> <p>'.$datawrite.'</p>
		<img src = "'.$avatar.'" style = "width: 100%;"><br />
		</div></td><td>';
		echo '<p>'.$text.'</p>';
		
		$dbh = dbconnect();//
		$stm = $dbh->prepare("SELECT * FROM images WHERE id_record = :idrecord");
		$stm->bindParam(':idrecord', $id_record);
		$stm->execute();
		echo '<div class = "blokfoto">';
		while ($rowimg = $stm->fetch(PDO::FETCH_ASSOC))
		{
			echo '<img src ="'.$rowimg['imagepath'].'" style = "width: 47%;">';
		}
		echo '</div>';
		$dbh = null;				
		
		echo '</td></tr></table></div>';
	} $db = null;
	
?>
   <br/><br /><form action = "" method = "post">
	<input type = "submit" name = "next" class = "nextButton" value = "Далі">
	</form></body>