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
<form action="hozzaad.php" method="post">
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
<!--<a href="index.php">Vissza</a>-->
	<form action="hozzaad.php" method="post">
<table>
	<tr>
		<th>Foglalás azonosítója:</th>
		<td><input type="number" name="id"/></td>
	</tr>
	<tr>
		<th>Ügyfélazonosító:</th>
		<td><input type="number" name="ugyfel"/></td>
	</tr>
	<tr>
		<th>Járatazonosító:</th>
		<td><input type="number" name="jarat"/></td>
	</tr>
	<tr>
		<th>Osztály:</th>
		<td><input type="number" name="osztaly"/></td>
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
	
	if( isset($_POST['id']) &&  isset($_POST['ugyfel']) && isset($_POST['jarat']) && isset($_POST['osztaly'])){
		
		$q = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";
		
		 $id = $_POST['id'];
		$ugyfel = $_POST['ugyfel'];
		$jarat = $_POST['jarat'];
		$osztaly = $_POST['osztaly'];
		
		
		$sql = "INSERT INTO foglalas Values('".$id."', '".$ugyfel."', '".$jarat."', '".$osztaly."')";
		echo $sql;
		
		$stid1 = oci_parse($conn, $q);
		oci_execute($stid1);
		$stid = oci_parse($conn, $sql);
		oci_execute($stid);
		oci_close($conn);
		echo "Foglalás hozzáadva";
		
		
	}
	?>
	<form action="hozzaad.php" method="post">
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
    //$conn = oci_connect('SYSTEM', 'system', $tns,'UTF8');
	$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');
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
	
	<form action="hozzaad.php" method="post">
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
    //$conn = oci_connect('SYSTEM', 'system', $tns,'UTF8');
	$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');
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
	<form action="hozzaad.php" method="post">
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
		<td><input type="text" name="Utca" size="50"/></td>
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
    //$conn = oci_connect('SYSTEM', 'system', $tns,'UTF8');
	$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');
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
	
	<form action="hozzaad.php" method="post">
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
    //$conn = oci_connect('SYSTEM', 'system', $tns,'UTF8');
	$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');
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
</body>
</html>