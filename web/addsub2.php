<html>
 <body>
<?php
 $nomesup = $_REQUEST['nomesup'];
 $novasub = $_REQUEST['novasub'];
 try
 {
 $host = "db.ist.utl.pt";
 $user ="ist424949";
 $password = "ibwy6237";
 $dbname = $user;
 $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$ecategsimples = $db->query("SELECT count(nome) FROM categoria_simples WHERE nome='$nomesup';")->fetchColumn();

if ($ecategsimples == 1) {
 	$sql1 = "DELETE FROM categoria_simples WHERE nome='$nomesup';";
	$db->query($sql1);
	$sql2 = "INSERT into super_categoria values('$nomesup');";
	$db->query($sql2);
	$jaexiste = $db->query("SELECT count(nome) FROM categoria WHERE nome='$novasub';")->fetchColumn();
	if ($jaexiste == 0) {
		$sql4 = "INSERT into categoria values('$novasub');";
		$db->query($sql4);
		$sql3 = "INSERT into categoria_simples values('$novasub');";
		$db->query($sql3);
	}

	$sql5 = "INSERT into constituida values('$nomesup','$novasub');";
	$db->query($sql5);
}

if ($ecategsimples == 0) {
	$jaexiste = $db->query("SELECT count(nome) FROM categoria WHERE nome='$novasub';")->fetchColumn();
	if ($jaexiste == 0) {
		$sql1 = "INSERT into categoria values('$novasub');";
		$db->query($sql1);
		$sql2 = "INSERT into categoria_simples values('$novasub');";
		$db->query($sql2);
	}
	$sql3 = "INSERT into constituida values('$nomesup','$novasub');";
	$db->query($sql3);
}



 $db = null;
 }
 catch (PDOException $e)
 {
 echo("<p>ERROR: {$e->getMessage()}</p>");
 }
?>
<meta http-equiv="refresh" content="0.001; url=http://web.ist.utl.pt/ist424949/categorias.php" />
 </body>
</html>