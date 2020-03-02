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


 $sql1 = "insert into categoria values ('$nome');";
 $sql2 = "insert into categoria_simples values ('$nome');";
 $db->query($sql1);
 $db->query($sql2);

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