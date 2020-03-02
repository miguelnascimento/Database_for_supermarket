<html>
 <body>
 <h3>Supermercado</h3>
<?php
 try
 {
 $host = "db.ist.utl.pt";
 $user ="ist424949";
 $password = "ibwy6237";
 $dbname = $user;

 $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 echo("<td><a href=\"produtos.php\">Produtos</a></td>\n");
 echo("<td><a href=\"categorias.php\">Categorias</a></td>\n");
 echo("<td><a href=\"super_categorias.php\">Super-categorias</a></td>\n");
 echo("<td><a href=\"categorias_simples.php\">Categorias-simples</a></td>\n");


 $db = null;
 }
 catch (PDOException $e)
 {
 echo("<p>ERROR: {$e->getMessage()}</p>");
 }
?>
 </body>
</html>