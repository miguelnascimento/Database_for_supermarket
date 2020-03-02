<html>
 <body>
<?php
 $ean = $_REQUEST['ean'];
 $design = $_REQUEST['design'];
 $categoria = $_REQUEST['categoria'];
 $nif_forn_primario = $_REQUEST['nif_forn_primario'];
 $nome_forn_primario = $_REQUEST['nome_forn_primario'];
 $data = $_REQUEST['data'];
 $nif_forn_secundario = $_REQUEST['nif_forn_secundario'];
 $nome_forn_secundario = $_REQUEST['nome_forn_secundario'];
 try
 {
 $host = "db.ist.utl.pt";
 $user ="ist424949";
 $password = "ibwy6237";
 $dbname = $user;
 $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->beginTransaction();

$nRows = $db->query("SELECT nif FROM fornecedor WHERE nif='$nif_forn_primario';")->fetchColumn(); 

 if ($nRows == 0) {
	$sql1 = "insert into fornecedor values ('$nif_forn_primario','$nome_forn_primario');";
	$db->query($sql1);
}


 $nRows2 = $db->query("SELECT nif FROM fornecedor WHERE nif='$nif_forn_secundario';")->fetchColumn(); 


 if ($nRows2 == 0) {
	$sql4 = "insert into fornecedor values ('$nif_forn_secundario','$nome_forn_secundario');";
	$db->query($sql4);
}

 $sql3 = "insert into produto values ('$ean','$design','$categoria','$nif_forn_primario','$data');";
$db->query($sql3);

$sql2 = "insert into fornece_sec values ('$nif_forn_secundario','$ean');";
	$db->query($sql2);

$db->commit();

 $db = null;
 }
 catch (PDOException $e)
 {
 echo("<p>ERROR: {$e->getMessage()}</p>");
 }
?>
<meta http-equiv="refresh" content="0.001; url=http://web.ist.utl.pt/ist424949/produtos.php" />
 </body>
</html>