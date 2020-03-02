<html>
 <body>
<?php
 $ean = $_REQUEST['ean'];
 try
 {
 $host = "db.ist.utl.pt";
 $user ="ist424949";
 $password = "ibwy6237";
 $dbname = $user;
 $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql1 = "DELETE FROM fornece_sec WHERE ean='$ean';";
$db->query($sql1);


$sql2 = "DELETE FROM produto WHERE ean='$ean';";
$db->query($sql2);



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