<?php include 'db_connect.php';
$rowCount = count($_POST["receiving_del"]);
for($i=0;$i<$rowCount;$i++) {
$del1=mysqli_query($conn, "DELETE FROM receiving_list WHERE id='" . $_POST["receiving_del"][$i] . "'");
$del2=mysqli_query($conn, "DELETE FROM inventory where type = 1 and form_id='" . $_POST["receiving_del"][$i] . "'");
if($del1 && $del2)
header("Location:index.php?page=receiving");
	
}
?>