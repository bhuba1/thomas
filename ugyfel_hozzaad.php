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


<form action="ugyfel_hozzaad.php" method="post">
<table>
	<tr>
		<th>Azonosító:</th>
		<td><input type="number" name="id"/></td>
	</tr>
	<tr>
		<th>Név:</th>
		<td><input type="text" name="Nev" maxlength="50" size="20"/></td>
	</tr>
	<tr>
		<th>Város:</th>
		<td><input type="text" name="Varos" maxlength="50" size="20"/></td>
	</tr>
	<tr>
		<th>Utca:</th>
		<td><input type="date" name="Utca" size="50"/></td>
	</tr>
	<tr>
		<th>Házszám:</th>
		<td><input type="number" name="Hazszam"/></td>
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
	
	if( isset($_POST['id']) &&  isset($_POST['Nev']) && isset($_POST['Varos']) && isset($_POST['Utca']) && isset($_POST['Hazszam'])){
		
		$q = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";
		
		 $id = $_POST['id'];
		$Nev = $_POST['Nev'];
		$Varos = $_POST['Varos'];
		$Utca = $_POST['Utca'];
		$Hazszam = $_POST['Hazszam'];
		
		$sql = "INSERT INTO Ugyfel Values('$id', '$Nev', '$Varos', '$Utca', '$Hazszam')";

		
		$stid1 = oci_parse($conn, $q);
		oci_execute($stid1);
		$stid = oci_parse($conn, $sql);
		oci_execute($stid);
		oci_close($conn);
		echo "Ügyfél hozzáadva";
		
		
	}
	?>
<a href="index.php">Vissza</a>
</body>
</html>