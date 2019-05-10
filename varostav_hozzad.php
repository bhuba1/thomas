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

<form action="varostav_hozzaad.php" method="post">
<table>
	<tr>
		<th>Első város:</th>
		<td><input type="text" name="Varos1" maxlength="40" size="20"/></td>
	</tr>
	<tr>
		<th>Második város:</th>
		<td><input type="text" name="Varos2" maxlength="40" size="20"/></td>
	</tr>
	<tr>
		<th>Távolság:</th>
		<td><input type="number" name="Tavolsag" size="20"/></td>
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
	
	if( isset($_POST['Varos1']) &&  isset($_POST['Varos2']) && isset($_POST['Tavolsag'])){
		
		$q = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";
		
		 $Varos1 = $_POST['Varos1'];
		$Varos2 = $_POST['Varos2'];
		$Tavolsag = $_POST['Tavolsag'];
		
		
		$sql = "INSERT INTO Varostav Values('$Varos1', '$Varos2', '$Tavolsag')";

		
		$stid1 = oci_parse($conn, $q);
		oci_execute($stid1);
		$stid = oci_parse($conn, $sql);
		oci_execute($stid);
		oci_close($conn);
		echo "Várostáv hozzáadva";
		
		
	}
	?>
<a href="index.php">Vissza</a>
</body>
</html>