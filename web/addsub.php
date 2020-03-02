<html>
 <body>
 <h3>Adicionar sub-categoria a <?=$_REQUEST['nomesup']?></h3>
 <form action="addsub2.php" method="post">
 <p><input type="hidden" name="nomesup"
 value="<?=$_REQUEST['nomesup']?>"/></p>
<p>Nome: <input type="text" name="novasub"/></p>
 <p><input type="submit" value="Submeter"/></p>
 </form>
 </body>
</html>