<html>
 <body>
 <h3>Alterar designacao do produto <?=$_REQUEST['ean']?></h3>
 <form action="updatedesign.php" method="post">
 <p><input type="hidden" name="ean"
value="<?=$_REQUEST['ean']?>"/></p>
 <p>Nova designacao: <input type="text" name="design"/></p>
 <p><input type="submit" value="Submeter"/></p>
 </form>
 </body>
</html>