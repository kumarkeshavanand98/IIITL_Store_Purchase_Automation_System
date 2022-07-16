<style>
   
</style>

<div class="containe-fluid">

	<div class="row">
		<div class="col-lg-12">
			
		</div>
	</div>

	<div class="row mt-3 ml-3 mr-3">
			<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
				<?php echo "Welcome back <b>".$_SESSION['login_name']."</b>!"  ?>
									
				</div>
				<hr>
				<div class="row">
				<div class="alert alert-success col-md-4 ml-4">
					<p><b><large>Total Issue Requests Today</large></b></p>
				<hr>
					<p class="text-right"><b><large><?php 
					include 'db_connect.php';
					$sales = $conn->query("SELECT COUNT(customer_id) as customer_id FROM sales_list where status='Approved' and date(date_updated)= '".date('Y-m-d')."'");
					// echo $sales->num_rows > 0 ? number_format($sales->fetch_array()['customer_id'],2) : "0.00";
					echo $sales->fetch_array()['customer_id'];

					 ?></large></b></p>
				</div>
				<div class="alert alert-success col-md-4 ml-4">
					<p><b><large>Total Receiving Requests Today</large></b></p>
				<hr>
					<p class="text-right"><b><large><?php 
					include 'db_connect.php';
					$sales = $conn->query("SELECT COUNT(supplier_id) as supplier_id FROM receiving_list where status='Approved' and date(date_added)= '".date('Y-m-d')."'");
					// echo $sales->num_rows > 0 ? number_format($sales->fetch_array()['supplier_id'],2) : "0.00";
					echo $sales->fetch_array()['supplier_id'];

					 ?></large></b></p>
				</div>
				</div>
			</div>
			
		</div>
		</div>
	</div>

</div>
<script>
	
</script>