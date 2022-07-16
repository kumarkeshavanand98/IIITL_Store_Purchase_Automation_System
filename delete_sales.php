<?php
include("db_connect.php");
session_start();
                                     
if (isset($_GET['id']))
{
    $id=$_GET['id'];
    $deleteQuery="DELETE FROM sales_list WHERE id=$id"; 
    $result=mysqli_query($conn,$deleteQuery);
			if($result){
				$_SESSION['success']="Success";
				?>
				<script>location.href = "index.php?page=sales"</script>
			<?php }
    
} else {
    echo "ERROR!";
}

?>