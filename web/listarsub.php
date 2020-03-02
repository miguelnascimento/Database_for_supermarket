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
 <h3>Lista de sub-categorias de <?=$_REQUEST['nomesup']?></h3>
<?php
 $nomesup = $_REQUEST['nomesup'];
 try
 {
 $host = "db.ist.utl.pt";
 $user ="ist424949";
 $password = "ibwy6237";
 $dbname = $user;
 $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql1 = $db->prepare("SELECT categoria FROM constituida WHERE super_categoria='$nomesup';");
$sql1->execute();
$result1 = $sql1->fetchAll(PDO::FETCH_COLUMN, 0);
function f($r,$lista) {
	global $db;
	$res = $r;
	$length = count($lista);
	if (count($lista) != 0) {
		for($x = 0; $x < $length; $x++) {
			$sql2 = $db->prepare("SELECT categoria FROM constituida WHERE super_categoria='$lista[$x]';");
			$sql2->execute();
			$result2 = $sql2->fetchAll(PDO::FETCH_COLUMN, 0);
			$res[count($res)]="$lista[$x]";
			if (count($result2) != 0) {
				$z=f($res,$result2);
				$lz=count($z);
				for ($j=0;$j<$lz;$j++) {
					$res[count($res)]="$z[$j]";
				}
			}
		}
	}
	return $res;
}
function g($w) {
	global $db;
	$r=array();
	$l = count($w);
	for ($x = 0; $x < $l; $x++) {
		$sql3 = $db->prepare("SELECT categoria FROM constituida WHERE super_categoria='$w[$x]';");
		$sql3->execute();
		$result3 = $sql3->fetchAll(PDO::FETCH_COLUMN, 0);
		$r[count($r)]="$w[$x]";
		if (count($result3) != 0) {
			$y=f(array(),$result3);
			$ly=count($y);
			for ($j=0;$j<$ly;$j++) {
				$r[count($r)]="$y[$j]";
			}
		}
	}
	return $r;
}

$c=g($result1);
$t= array_keys(array_count_values($c)); 

echo("<table border=\"0\" cellspacing=\"5\">\n");
 foreach($t as $row)
 {
 echo("<tr>\n");
 echo("<td>{$row}</td>\n");
 echo("</tr>\n");
 }
 echo("</table>\n");
 echo("<td><a href=\"super_categorias.php\">Voltar as super-categorias</a></td>\n");
 $db = null;
 }
 catch (PDOException $e)
 {
 echo("<p>ERROR: {$e->getMessage()}</p>");
 }
?>
 </body>
</html>