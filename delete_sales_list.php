<?php include 'db_connect.php';
$rowCount = count($_POST["sales_del"]);
for($i=0;$i<$rowCount;$i++) {
$del1=mysqli_query($conn, "DELETE FROM sales_list WHERE id='" . $_POST["sales_del"][$i] . "'");
$del2=mysqli_query($conn, "DELETE FROM inventory WHERE form_id='" . $_POST["sales_del"][$i] . "'");
if($del1 && $del2)
header("Location:index.php?page=sales");
	
}
?>
