<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 5px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
 <body>
 <h3>Eventos de reposicao do produto com ean <?=$_REQUEST['ean']?></h3>
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

 $sql = "SELECT operador, instante, unidades FROM reposicao WHERE ean='$ean';";
 $result = $db->query($sql);

 echo("<table border=\"0\" cellspacing=\"5\">\n");
 echo("<tr><td>Operador</td><td>Instante</td><td>Unidades</td></tr>\n");
 foreach($result as $row)
 {
 echo("<tr>\n");
 echo("<td>{$row['operador']}</td>\n");
 echo("<td>{$row['instante']}</td>\n");
 echo("<td>{$row['unidades']}</td>\n");
 echo("</tr>\n");
 }
 echo("</table>\n");

 echo("<td><a href=\"produtos.php\">Produtos</a></td>\n");

 $db = null;
 }
 catch (PDOException $e)
 {
 echo("<p>ERROR: {$e->getMessage()}</p>");
 }
?>
 </body>
</html>