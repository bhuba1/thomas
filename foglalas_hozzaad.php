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

<form action="foglalas_hozzaad.php" method="post">
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
    $conn = oci_connect('SYSTEM', 'system', $tns,'UTF8');
	}catch(PDOException $e){
    echo ($e->getMessage());
	}
	
	if( isset($_POST['id']) &&  isset($_POST['ugyfel']) && isset($_POST['jarat']) && isset($_POST['osztaly'])){
		
		$q = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";
		
		 $id = $_POST['id'];
		$ugyfel = $_POST['ugyfel'];
		$jarat = $_POST['jarat'];
		$osztaly = $_POST['osztaly'];
		
		
		$sql = "INSERT INTO jarat Values('$id', '$ugyfel', '$jarat', '$osztaly')";

		
		$stid1 = oci_parse($conn, $q);
		oci_execute($stid1);
		$stid = oci_parse($conn, $sql);
		oci_execute($stid);
		oci_close($conn);
		echo "Foglalás hozzáadva";
		
		
	}
	?>
<a href="index.php">Vissza</a>
</body>
</html>