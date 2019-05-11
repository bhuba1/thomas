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
	function getLastId($table,$id,$post) {
		try{
			//$conn = oci_connect('SYSTEM', 'system', $tns,'UTF8');
			$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');
		}catch(PDOException $e){
			echo ($e->getMessage());
		}
		
		$select = "SELECT $id FROM $table ORDER BY ID DESC OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY";
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
		echo "<input type = 'number' name = '$post' value ='$count' max = '$count' min='1'/>";
		oci_close($conn);
	}
	
	?>

	<form action="delete.php" method="post">
		<legend>Járat törlése</legend>
		<table>
			<tr>
				<th>Azonosító:</th>
				<td><?php getLastId("jarat","id","jaratid");?></td>
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
<form action="delete.php" method="post">
	<legend>Foglás törlése</legend>
	<table>
		<tr>
			<th>Azonosító:</th>
			<td><?php getLastId("foglalas","id","fogid");?></td>
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

if( isset($_POST['fogid'])){

	$q = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";

	$id = $_POST['fogid'];


	$sql = "DELETE FROM foglalas WHERE id = '$id'";


	$stid1 = oci_parse($conn, $q);
	oci_execute($stid1);
	$stid = oci_parse($conn, $sql);
	oci_execute($stid);
	oci_close($conn);
	echo "Ügyfél Törölve";

	echo "<meta http-equiv=refresh content=\"0; URL=delete.php\">";
}
?>
<form action="delete.php" method="post">
	<legend>Jármű törlése</legend>
	<table>
		<tr>
			<th>Azonosító:</th>
			<td><?php createSelect("jarmu","jarmuszam","jarmuid");?></td>
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

if( isset($_POST['jarmuid'])){

	$q = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";

	$id = $_POST['jarmuid'];


	$stid1 = oci_parse($conn, $q);
	oci_execute($stid1);

	$sql = "SELECT id FROM jarat WHERE jarmuszam = '$id'";
	$stid = oci_parse($conn, $sql);
	oci_execute($stid);
	while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {

		foreach ($row as $item) {
					//echo '<p>' . $item . ' </p>';
			$sql = "DELETE FROM foglalas WHERE jarat = '$item'";
			$stid = oci_parse($conn, $sql);
			oci_execute($stid);
		}
	}

	$sql = "DELETE FROM jarat WHERE jarmuszam = '$id'";
	$stid = oci_parse($conn, $sql);
	oci_execute($stid);

	$sql = "DELETE FROM jarmu WHERE jarmuszam = '$id'";
	$stid = oci_parse($conn, $sql);
	oci_execute($stid);

	oci_close($conn);
	echo "Jármű Törölve";
}
?>
<form action="delete.php" method="post">
	<legend>Megálló törlése</legend>
	<table>
		<tr>
			<th>Azonosító:</th>
			<td><?php createSelect("megallok","nev","megid");?></td>
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

if( isset($_POST['megid'])){

	$q = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";

	$id = $_POST['megid'];


	$sql = "DELETE FROM megallok WHERE nev = '$id'";


	$stid1 = oci_parse($conn, $q);
	oci_execute($stid1);
	$stid = oci_parse($conn, $sql);
	oci_execute($stid);
	oci_close($conn);
	echo "Ügyfél Törölve";

	echo "<meta http-equiv=refresh content=\"0; URL=delete.php\">";
}
?>
<form action="delete.php" method="post">
	<legend>Ügyfél törlése</legend>
	<table>
		<tr>
			<th>Azonosító:</th>
			<td><?php createSelect("ugyfel","id","ugyid");?></td>
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

if( isset($_POST['ugyid'])){

	$q = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";

	$id = $_POST['ugyid'];


	$sql = "DELETE FROM ugyfel WHERE id = '$id'";


	$stid1 = oci_parse($conn, $q);
	oci_execute($stid1);
	$stid = oci_parse($conn, $sql);
	oci_execute($stid);
	oci_close($conn);
	echo "Ügyfél Törölve";

	echo "<meta http-equiv=refresh content=\"0; URL=delete.php\">";
}
?>
<form action="delete.php" method="post">
	<legend>Távolság törlése</legend>
	<table>
		<tr>
			<th>Varos 1:</th>
			<td><?php createSelect("varostav","Varos1","varos1");?></td>
		</tr>
		<tr>
			<th>Varos 2:</th>
			<td><?php createSelect("varostav","Varos2","varos2");?></td>
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

if( isset($_POST['varos1']) && isset($_POST['varos2'])){

	$q = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";

	$v1 = $_POST['varos1'];
	$v2 = $_POST['varos2'];


	$sql = "DELETE FROM varostav WHERE varos1 = '$v1' AND varos2 = '$v2'";


	$stid1 = oci_parse($conn, $q);
	oci_execute($stid1);
	$stid = oci_parse($conn, $sql);
	oci_execute($stid);
	oci_close($conn);
	echo "Távolság Törölve";
	
	echo "<meta http-equiv=refresh content=\"0; URL=delete.php\">";
}
?>
</body>
</html>