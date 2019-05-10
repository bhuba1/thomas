<?php 
session_start();

if (!isset($_SESSION["felhasznalo"])){
	header("Location: bejelentkezes.php");
}

if ( $_SESSION["felhasznalo"] != "admin"){
	header("Location: bejelentkezes.php");
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
</head>
<body>


<form action="megallo_hozzaad.php" method="post">
<table>
	<tr>
		<th>Név:</th>
		<td><input type="text" name="nev" maxlength="40" size="30"/></td>
	</tr>
	<tr>
		<th>Megye:</th>
		<td><input type="text" name="megye" maxlength="40" size="30"/></td>
	</tr>
	<tr>
		<th>Város:</th>
		<td><input type="text" name="varos" maxlength="40" size="30"/></td>
	</tr>
		<td></td>
		<td style="text-align:center;" colspan="2"><input type="submit" name="reg" value="Hozzáad" class="gomb"/></td>
	</tr>
</table>
</form>

	<?php
$tns = "  
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
    )
    (CONNECT_DATA =
	  
      (SID = xe)
    )
  )";
  
 
	try{
    $conn = oci_connect('SYSTEM', 'system', $tns,'UTF8');
	}catch(PDOException $e){
    echo ($e->getMessage());
	}
	
	if( isset($_POST['nev']) &&  isset($_POST['megye']) && isset($_POST['varos'])){
		
		$q = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";
		
		$nev = $_POST['nev'];
		$megye = $_POST['megye'];
		$varos = $_POST['varos'];
	
		
		$sql = "INSERT INTO megallok Values('$nev', '$megye', '$varos')";

		
		$stid1 = oci_parse($conn, $q);
		oci_execute($stid1);
		$stid = oci_parse($conn, $sql);
		oci_execute($stid);
		oci_close($conn);
		echo "Megálló hozzáadva";
		
		
	}
	?>
<a href="index.php">Vissza</a>
</body>
</html>