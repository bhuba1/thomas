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
			
			//$count++;
			echo "<input type = 'number' name = 'id' value ='$count' max = '$count' min = '1'/>";
			oci_close($conn);
			
		}
		
	?>

	<form action="update.php" method="post">
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
				<td style="text-align:center;" colspan="2"><input type="submit" name="reg" value="Módosít" class="gomb" /></td>
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
			
			$sql = "UPDATE jarat set honnan = '$Honnan', 
			hova = '$Hova',
			datum = '$Datum',
			indulas = '$Indulas',
			jarmuszam = '$jarmuszam',
			menetido = '$Menetido',
			hely = $Hely WHERE id = '$id'";

			echo $sql;
			$stid1 = oci_parse($conn, $q);
			oci_execute($stid1);
			$stid = oci_parse($conn, $sql);
			oci_execute($stid);
			oci_close($conn);
			echo "Járat updatelve";
			
			//header("Location: hozzaad.php");
			//echo "<meta http-equiv=refresh content=\"0; URL=update.php\">";
		}
	?>
</body>
</html>