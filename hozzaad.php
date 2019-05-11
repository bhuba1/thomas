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
<?php 
	function createSelect($table,$rowName,$name) {
		try{
			//$conn = oci_connect('SYSTEM', 'system', $tns,'UTF8');
			$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');
		}catch(PDOException $e){
			echo ($e->getMessage());
		}
		
		$select = "SELECT $rowName FROM $table ";
		
		$stid = oci_parse($conn, $select);

		oci_execute($stid);
		oci_execute($stid);

			echo "<select name = '$name'>";
			while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {
				
				
				foreach ($row as $item) {
					echo "<option value='$item'>" . $item . '</option>';
				}
				
			}
			echo'</select>';
			oci_close($conn);
	}
	function getLastId($table) {
		try{
			//$conn = oci_connect('SYSTEM', 'system', $tns,'UTF8');
			$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');
		}catch(PDOException $e){
			echo ($e->getMessage());
		}
		
		$select = "SELECT id FROM $table ORDER BY ID DESC OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY";
		//echo $select;
		$stid = oci_parse($conn, $select);

		oci_execute($stid);
		
		$count = -1;
		while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {
				
			
			foreach ($row as $item) {
				$count = $item;
			}
			
		}
		
		$count++;
		echo "<input type = 'number' name = 'id' value ='$count' max = '$count' min = '1' readonly/>";
		oci_close($conn);
		
	}
	
?>

<form action="hozzaad.php" method="post">
	<legend>Új járat hozzáadása</legend>
	<table>
		<tr>
			<th>Azonosító:</th>
			<td><?php getLastId("jarat");?></td>
		</tr>
		<tr>
			<th>Honnan:</th>
			<td><?php createSelect("megallok","nev","Honnan") ?></td>
		</tr>
		<tr>
			<th>Hova:</th>
			<td><?php createSelect("megallok","nev","Hova") ?></td>
		</tr>
		<tr>
			<th>Dátum:</th>
			<td><input type="date" name="Datum" size="20" value="2010-07-29" min="2010-05-01"/></td>
		</tr>
		<tr>
			<th>Indulás:</th>
			<td><input type="time" name="Indulas" size="20" value="00:00"/></td>
		</tr>
		<tr>
			<th>Járműszám:</th>
			<td><?php createSelect("jarmu","jarmuszam","jarmuszam") ?></td>
		</tr>
		<tr>
			<th>Menetidő:</th>
			<td><input type="time" name="Menetido" size="20" value="02:00"/></td>
		</tr>
		<tr>
			<th>Hely:</th>
			<td><input type="number" name="Hely" size="20" value = '10' min = '10'/></td>
		</tr>
			<td></td>
			<td style="text-align:center;" colspan="2"><input type="submit" name="reg" value="Hozzáad" class="gomb" /></td>
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
		
		//header("Location: hozzaad.php");
		echo "<meta http-equiv=refresh content=\"0; URL=hozzaad.php\">";
	}
	?>
<!--<a href="index.php">Vissza</a>-->
	<form action="hozzaad.php" method="post">
		<legend>Új foglalás hozzáadása</legend>
		<table>
			<tr>
				<th>Foglalás azonosítója:</th>
				<td><?php getLastId("foglalas") ?></td>
			</tr>
			<tr>
				<th>Ügyfélazonosító:</th>
				<td><?php createSelect("ugyfel","id","ugyfel") ?></td>
			</tr>
			<tr>
				<th>Járatazonosító:</th>
				<td><?php createSelect("jarat","id","jarat") ?></td>
			</tr>
			<tr>
				<th>Osztály:</th>
				<td><input type="number" name="osztaly" value='1' min = '1' max= '2'/></td>
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
		//echo $sql;
		
		$stid1 = oci_parse($conn, $q);
		oci_execute($stid1);
		$stid = oci_parse($conn, $sql);
		oci_execute($stid);
		oci_close($conn);
		echo "Foglalás hozzáadva";
		
		echo "<meta http-equiv=refresh content=\"0; URL=hozzaad.php\">";
	}
	?>
	<form action="hozzaad.php" method="post">
		<legend>Új jármű hozzáadása</legend>
		<table>
			<tr>
				<th>Járműszám:</th>
				<td><input type="text" name="Jarmuszam" maxlength="4" size="4" required /></td>
			</tr>
			<tr>
				<th>Férőhely:</th>
				<td><input type="number" name="Ferohely" value='10' min = '10'/></td>
			</tr>
			<tr>
				<th>Osztály:</th>
				<td><input type="number" name="Osztaly" value='1' min = '1' max = '2'/></td>
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
		
		echo "<meta http-equiv=refresh content=\"0; URL=hozzaad.php\">";
	}
	?>
	
	<form action="hozzaad.php" method="post">
		<legend>Új állomás hozzáadása</legend>
		<table>
			<tr>
				<th>Név:</th>
				<td><input type="text" name="nev" maxlength="40" size="30" required/></td>
			</tr>
			<tr>
				<th>Megye:</th>
				<td><input type="text" name="megye" maxlength="40" size="30" required/></td>
			</tr>
			<tr>
				<th>Város:</th>
				<td><input type="text" name="varos" maxlength="40" size="30" required/></td>
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
		
		echo "<meta http-equiv=refresh content=\"0; URL=hozzaad.php\">";
	}
	?>
	<form action="hozzaad.php" method="post">
		<legend>Új ügyfél hozzáadása</legend>
		<table>
			<tr>
				<th>Azonosító:</th>
				<td><?php getLastId("ugyfel");?></td>
			</tr>
			<tr>
				<th>Név:</th>
				<td><input type="text" name="Nev" maxlength="50" size="20"/></td>
			</tr>
			<tr>
				<th>Város:</th>
				<td><?php createSelect("megallok","varos","Varos") ?></td>
			</tr>
			<tr>
				<th>Utca:</th>
				<td><input type="text" name="Utca" size="50"/></td>
			</tr>
			<tr>
				<th>Házszám:</th>
				<td><input type="number" name="Hazszam" value = '1' min = '1' /></td>
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
		
		echo "<meta http-equiv=refresh content=\"0; URL=hozzaad.php\">";
	}
	?>
	
	<form action="hozzaad.php" method="post">
		<legend>Új távolság hozzáadása</legend>
		<table>
			<tr>
				<th>Első város:</th>
				<td><?php createSelect("megallok","nev","Varos1") ?></td>
			</tr>
			<tr>
				<th>Második város:</th>
				<td><?php createSelect("megallok","nev","Varos2") ?></td>
			</tr>
			<tr>
				<th>Távolság:</th>
				<td><input type="number" name="Tavolsag" size="20" value='10' min = '2'/></td>
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
		
		echo "<meta http-equiv=refresh content=\"0; URL=hozzaad.php\">";
	}
	?>
</body>
</html>