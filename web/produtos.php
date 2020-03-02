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
 <h3>Produtos</h3>
<?php
 try
 {
 $host = "db.ist.utl.pt";
 $user ="ist424949";
 $password = "ibwy6237";
 $dbname = $user;

 $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $sql = "SELECT ean, design, categoria, forn_primario, data FROM produto;";

 $result = $db->query($sql);
 echo("<td><a href=\"addproduto.php\">Adicionar produto</a></td>\n");
 
 echo("<table border=\"0\" cellspacing=\"5\">\n");
 echo("<tr><td>EAN</td><td>Designacao</td><td>Categoria</td><td>Fornecedor primario</td><td>Data</td></tr>\n");
 foreach($result as $row)
 {
 echo("<tr>\n");
 echo("<td>{$row['ean']}</td>\n");
 echo("<td>{$row['design']}</td>\n");
 echo("<td>{$row['categoria']}</td>\n");
 echo("<td>{$row['forn_primario']}</td>\n");
 echo("<td>{$row['data']}</td>\n");
 echo("<td><a href=\"design.php?ean={$row['ean']}\">Mudar designacao</a></td>\n");
 echo("<td><a href=\"listaeventos.php?ean={$row['ean']}\">Eventos de reposicao</a></td>\n");
 echo("<td><a href=\"removproduto.php?ean={$row['ean']}\">Remover</a></td>\n");
 echo("</tr>\n");
 }
 echo("</table>\n");

echo("<td><a href=\"supermercado.php\">Voltar ao supermercado</a></td>\n");

 $db = null;
 }
 catch (PDOException $e)
 {
 echo("<p>ERROR: {$e->getMessage()}</p>");
 }
?>
 </body>
</html>