<?php
require_once("db_connect.php");
// session_start();
if(!isset($_SESSION["login_id"])){
	header("Location: index.php?page=requests_status");
  }
else{

	$id = $_GET['id'];

$add_to_db = mysqli_query($conn,"UPDATE sales_list SET status='Rejected' WHERE id=".$id);
	
			if($add_to_db){	
			//   echo "Saved!!";
			header("Location: https://www.geeksforgeeks.org");
			 exit;
			}
			else{
			  echo "Query Error : " . "UPDATE sales_list SET status='Rejected' WHERE id='".$id."' AND ref_no='".$ref_no."'" . "<br>" . mysqli_error($conn);
			}
	}

	ini_set('display_errors', true);
	error_reporting(E_ALL);  
ini_set('display_errors', 1);



		 
?>

