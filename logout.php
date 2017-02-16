<?php // logout.php
include_once 'header.php';
if (isset($_SESSI0N['user']))
{
	destroySession();
	echo "«div class=’main'>Ви вже покинули сайт. ".
	"<a href='index.php'>Клацніть тут, щоб вийти</a> ";
}
else echo "<div class=’main'><br />" .
"Ви не можете завершити сеанс работи. Тому що не входили на сайт";
?>
<br /><br /></div></body></html>