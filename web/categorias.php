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
 <h3>Categorias</h3>
<?php
 try
 {
 $host = "db.ist.utl.pt";
 $user ="ist424949";
 $password = "ibwy6237";
 $dbname = $user;

 $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $sql = "SELECT nome FROM categoria;";

 $result = $db->query($sql);

 echo("<td><a href=\"addcateg.php\">Adicionar nova categoria</a></td>\n");
 echo("<table border=\"0\" cellspacing=\"5\">\n");
 echo("<tr><td>Nome</td></tr>\n");
 foreach($result as $row)
 {
 echo("<tr>\n");
 echo("<td>{$row['nome']}</td>\n");
 echo("<td><a href=\"addsub.php?nomesup={$row['nome']}\">Inserir sub-categoria</a></td>\n");
 echo("<td><a href=\"rem.php?nome={$row['nome']}\">Remover</a></td>\n");
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