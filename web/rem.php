<html>
 <body>
<?php
 $nome = $_REQUEST['nome'];
 try
 {
 $host = "db.ist.utl.pt";
 $user ="ist424949";
 $password = "ibwy6237";
 $dbname = $user;
 $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$ecategsimples = $db->query("SELECT count(nome) FROM categoria_simples WHERE nome='$nome';")->fetchColumn();
if ($ecategsimples == 0) {
	$temsupercat = $db->query("SELECT count(super_categoria) FROM constituida WHERE categoria='$nome';")->fetchColumn();
	if ($temsupercat == 1) {
		$supercat = $db->query("SELECT super_categoria FROM constituida WHERE categoria='$nome';")->fetchColumn();
		$nsubcateg = $db->query("SELECT count(categoria) FROM constituida WHERE super_categoria='$supercat';")->fetchColumn();
		if ($nsubcateg == 1) {
			$sql1 = "DELETE FROM super_categoria WHERE nome='$supercat';";
			$db->query($sql1);
			$sql2 = "INSERT INTO categoria_simples values ('$supercat')";
			$db->query($sql2);
		}
	}
	$sql3 = "DELETE FROM categoria WHERE nome='$nome';";
	$db->query($sql3);
}


if ($ecategsimples == 1) {
	$temsupercat = $db->query("SELECT count(super_categoria) FROM constituida WHERE categoria='$nome';")->fetchColumn();
	if ($temsupercat == 1) {
		$supercat = $db->query("SELECT super_categoria FROM constituida WHERE categoria='$nome';")->fetchColumn();
		$nsubcateg = $db->query("SELECT count(categoria) FROM constituida WHERE super_categoria='$supercat';")->fetchColumn();
		if ($nsubcateg == 1) {
			$sql1 = "DELETE FROM super_categoria WHERE nome='$supercat';";
			$db->query($sql1);
			$sql2 = "INSERT INTO categoria_simples values ('$supercat')";
			$db->query($sql2);
		}
	}
	$sql3 = "DELETE FROM categoria WHERE nome='$nome';";
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