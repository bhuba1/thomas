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
		echo "<input type = 'number' name = 'id' value ='$count' max = '$count'/>";
		oci_close($conn);
		
	}
	
?>

<form action="delete.php" method="post">
	<legend>Járat törlése</legend>
	<table>
		<tr>
			<th>Azonosító:</th>
			<td><?php getLastId("jarat");?></td>
		</tr>
		</tr>
			<td></td>
			<td style="text-align:center;" colspan="2"><input type="submit" name="reg" value="Töröl" class="gomb" /></td>
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
	
	if( isset($_POST['id'])){
		
		$q = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";
		
		$id = $_POST['id'];
		
		
		$sql = "DELETE FROM jarat WHERE id = '$id'";

		
		$stid1 = oci_parse($conn, $q);
		oci_execute($stid1);
		$stid = oci_parse($conn, $sql);
		oci_execute($stid);
		oci_close($conn);
		echo "Járat Törölve";
		
		//header("Location: hozzaad.php");
		echo "<meta http-equiv=refresh content=\"0; URL=delete.php\">";
	}
	?>
</body>
</html>