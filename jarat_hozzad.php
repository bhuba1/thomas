<?php 
session_start();
/*
if (!isset($_SESSION["felhasznalo"])){
	header("Location: bejelentkezes.php");
}

if ( $_SESSION["felhasznalo"] != "admin"){
	header("Location: bejelentkezes.php");
}*/
?>
<!DOCTYPE html>
<html lang="hu">
<?php include 'head.php'?>
<body>
<?php include 'header.php'?>
<form action="jarat_hozzad.php" method="post">
<table>
	<tr>
		<th>Azonosító:</th>
		<td><input type="text" name="id" maxlength="20" size="20"/></td>
	</tr>
	<tr>
		<th>Honnan:</th>
		<td><input type="text" name="Honnan" maxlength="20" size="20"/></td>
	</tr>
	<tr>
		<th>Hova:</th>
		<td><input type="text" name="Hova" maxlength="20" size="20"/></td>
	</tr>
	<tr>
		<th>Dátum:</th>
		<td><input type="date" name="Datum" size="20"/></td>
	</tr>
	<tr>
		<th>Indulás:</th>
		<td><input type="time" name="Indulas" size="20"/></td>
	</tr>
	<tr>
		<th>Járműszám:</th>
		<td><input type="text" name="jarmuszam" maxlength="4" size="4"/></td>
	</tr>
	<tr>
		<th>Menetidő:</th>
		<td><input type="time" name="Menetido" size="20"/></td>
	</tr>
	<tr>
		<th>Hely:</th>
		<td><input type="number" name="Hely" size="20"/></td>
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
		//$conn = oci_connect('SYSTEM', 'system', $tns,'UTF8');
		$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');
	}catch(PDOException $e){
    echo ($e->getMessage());
	}
	
	if( isset($_POST['id']) &&  isset($_POST['Honnan']) && isset($_POST['Hova']) && isset($_POST['Datum']) && isset($_POST['Indulas']) 
		&& isset($_POST['jarmuszam']) && isset($_POST['Menetido']) &&
	isset($_POST['Hely'])){
		
		$q = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";
		
		 $id = $_POST['id'];
		$Honnan =$_POST['Honnan'];
		$Hova = $_POST['Hova'];
		$Datum = $_POST['Datum'];
		$Indulas = $_POST['Indulas'];
		$jarmuszam = $_POST['jarmuszam'];
		$Menetido = $_POST['Menetido'];
		$Hely = $_POST['Hely'];
		
		$sql = "INSERT INTO jarat Values('$id', '$Honnan', '$Hova', '$Datum', '$Indulas', '$jarmuszam', '$Menetido', '$Hely')";

		
		$stid1 = oci_parse($conn, $q);
		oci_execute($stid1);
		$stid = oci_parse($conn, $sql);
		oci_execute($stid);
		oci_close($conn);
		echo "Járat hozzáadva";
		
		
	}
	?>
<a href="index.php">Vissza</a>
</body>
</html>