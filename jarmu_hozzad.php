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


<form action="jarmu_hozzaad.php" method="post">
<table>
	<tr>
		<th>Járműszám:</th>
		<td><input type="text" name="Jarmuszam" maxlength="4" size="4"/></td>
	</tr>
	<tr>
		<th>Férőhely:</th>
		<td><input type="number" name="Ferohely"/></td>
	</tr>
	<tr>
		<th>Osztály:</th>
		<td><input type="number" name="Osztaly"/></td>
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
	
	if( isset($_POST['Jarmuszam']) &&  isset($_POST['Ferohely']) && isset($_POST['Osztaly'])){
		
		$q = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";
		
		 $Jarmuszam = $_POST['Jarmuszam'];
		$Ferohely = $_POST['Ferohely'];
		$Osztaly = $_POST['Osztaly'];
		
		$sql = "INSERT INTO Jarmu Values('$Jarmuszam', '$Ferohely', '$Osztaly')";

		
		$stid1 = oci_parse($conn, $q);
		oci_execute($stid1);
		$stid = oci_parse($conn, $sql);
		oci_execute($stid);
		oci_close($conn);
		echo "Jármű hozzáadva";
		
		
	}
	?>
<a href="index.php">Vissza</a>
</body>
</html>