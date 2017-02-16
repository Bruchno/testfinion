<?php
include 'header.php';

	$dbnew = dbconnect();
	$s = $dbnew->query("SELECT * FROM records");//Найдем номер записи
	$n = 0;
	while ($row = $s->fetch(PDO::FETCH_ASSOC))
	{
		if ($n < $row['ID_RECORD'])
		{
			$n = $row['ID_RECORD'];
		}
	}
	$RECORD_ID = $n + 1;// нашли или присвоили 1
	$dbnew = null;// Закрыли соединение
	$news = $_POST['redaction_text'];//get_post('redaction_text');
	//$news = sanitizeString($newsprev);
	//$news = iconv('utf8', 'cp1251', $news);//Сохранили в переменной текст записи
	date_default_timezone_set('UTC');
	$dey = date("y.m.d.H.i");// Здесь надо определить переменную для даты
	$un = $_SESSION['user'];
	$dbh = dbconnect();//Следующее соединение для нахождения номера пользователя
			$query = "SELECT * FROM users";
			$stm = $dbh->query($query);
			while ($r = $stm->fetch(PDO::FETCH_ASSOC))
			{
				if ($r['USER'] == $un)
				{
					$id_user = $r['ID'];
				}
			}
			$dbh = null;// Нашли, закрыли
		$str = $un.",cgjxfnre Ваш запис №:".$RECORD_ID." від ".$dey;	
			$pdo = dbconnect();//Вставляем запись в новости
			$st = $pdo->prepare("INSERT INTO records (DATA, ID_USER, ID_RECORD, TEXT_RECORD) 
			VALUES (:DATA, :ID_USER, :RECORD_ID, :TEXT_RECORD)");
			$st->bindParam(':DATA', $dey);
			$st->bindParam(':ID_USER', $id_user);
			$st->bindParam(':ID_RECORD', $RECORD_ID);
			$st->bindParam(':TEXT_RECORD', $news);
			$st->execute();
			$pdo = null;
	
	      $imagejson = $_POST['imageArray'];
         $arrayImage = explode(", ", $imagejson);//Вставляем картинки
			$dbn = dbconnect();
			for ($i = 0; $i< count($arrayImage); $i++)
			{
				$img_record = $arrayImage[$i];
				$stn = $dbn->prepare("INSERT INTO images (imagepath, id_record) VALUES (:imagepath, :id_record)");
				$stn->bindParam(':imagepath', $img_record);
				$stn->bindParam(':id_record', $RECORD_ID);
				$stn->execute();
			}
	$dbn = null;
	
	
	$str = $un.", Ваш запис №:".$RECORD_ID." від ".$dey;
	

echo $str;
$db = dbconnect();
$st = $db->prepare("INSERT INTO count_information (record, count_view, count_like, count_notlike) 
VALUES (:record, :count_view, :count_like, :count_notlike)");
$n = 0;
$st->bindParam(':record', $RECORD_ID);
$st->bindParam(':count_view', $n);
$st->bindParam(':count_like', $n);
$st->bindParam(':count_notlike', $n);
$st->execute();
recording($id_user, $RECORD_ID);

$id_record = $RECORD_ID;
	$db = dbconnect();
		$st = $db->prepare("SELECT * FROM count_information WHERE record = :idrecord");
		$st->bindParam(':idrecord', $id_record);
		$st->execute();
		while ($r = $st->fetch(PDO::FETCH_ASSOC))
		{
			$countview = $r['count_view'];
			$countlike = $r['count_like'];
			$countnotlike = $r['count_notlike']; 
		}
		$countview ++;
		$db = null;
		$dbupdate = dbconnect();
		$sql = "UPDATE count_information SET count_view =? WHERE record =?";
		$q = $dbupdate->prepare($sql);
		$q->execute(array($countview, $id_record));
		?>
		<form action = "" method = "post">
		<table class = "countview"> <tr><th>Переглядів</th>
		<th><input type = "button" onclick = "likeclik(<?php echo $id_record;?>)" id = "like" value = "Подобається"/></th>
		<th><input type = "button" onclick = "notlikeclik(<?php echo $id_record;?>)" id = "notlike" value = "Неподобається"/></th>
		</tr><tr><th><?php echo $countview;?></th>
		<th><div id = "countlike"><?php echo $countlike;?></div></th>
		<th><div id = "notlikeclik"><?php echo $countnotlike;?></div></th></tr>
		<tr>Номер новости: <?php echo $id_record; ?></tr></table></form>
<script src="jquery-3.0.0.min.js"></script>
<script src="script.js"></script>
</body>
</html>