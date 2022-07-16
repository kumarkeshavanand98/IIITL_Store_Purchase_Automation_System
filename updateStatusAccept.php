<?php
include("db_connect.php");
$id = $_GET['id'];
	$add_to_db = mysqli_query($conn,"UPDATE sales_list SET status='Accepted' WHERE id=".$id);
				if($add_to_db){	
					header("Location: index.php?page=requests_status");
				}
				else{
					echo "Query Error : " . "UPDATE sales_list SET status='Accepted' WHERE id='".$id."' AND ref_no='".$ref_no."'" . "<br>" . mysqli_error($conn);
				}
	ini_set('display_errors', true);
	error_reporting(E_ALL);      
?>