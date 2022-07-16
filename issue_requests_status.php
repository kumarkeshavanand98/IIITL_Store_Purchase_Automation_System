<?php include 'db_connect.php';
if(isset($_POST['approved'])){ 
	// 	extract($_POST);
		 $status="Approved";
		 $form_id = $_POST['form_id'];
		 $id = $_POST['id'];
			// $id =$this->db->insert_id;
				$type = "2";
				$stock_from = "Sales";
				$query="UPDATE inventory SET status='$status', type='$type', stock_from='$stock_from' WHERE form_id=".$form_id;
				$result=mysqli_query($conn,$query);
				if($result){
					$_SESSION['success']="Success";
					?>
					<script>location.href = "index.php?page=issue_requests_status"</script>
				<?php }
				else{
					echo "Data not inserted, Please try again!";
				}
			
			// if(isset($save2)){
			// 	return $id;
			// }
		
		 $query="UPDATE sales_list SET status='$status' WHERE id=".$id;
		 $res=mysqli_query($conn,$query);
	 
	 if($res){
		 $_SESSION['success']="Success";
	 }
	 else{
		 echo "Data not inserted, Please try again!";
	 }
	}
	if(isset($_POST['rejected'])){ 
		$status="Rejected";
		$form_id = $_POST['form_id'];
		$id = $_POST['id'];
		$type = "3";
				$stock_from = "returning";
				$query="UPDATE inventory SET status='$status', type='$type', stock_from='$stock_from' WHERE form_id=".$form_id;
				$result=mysqli_query($conn,$query);
				if($result){
					$_SESSION['success']="Success";
					?>
					<script>location.href = "index.php?page=issue_requests_status"</script>
				<?php }
				else{
					echo "Data not inserted, Please try again!";
				}
		$query="UPDATE sales_list SET status='$status' WHERE id=".$id;
		$res=mysqli_query($conn,$query);
	
	if($res){
		$_SESSION['success'];
	}
	else{
		echo "Data not inserted, Please try again!";
	}
	
	}
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
				<div class="card-header">
						<h4><b>Issue Requests Update</b></h4>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
							    <th class="text-center">#</th>
								<th class="text-center">Form_Id</th>
								<th class="text-center">Indentor</th>
								<th class="text-center">Date</th>
								<th class="text-center">Reference #</th>
								<th class="text-center">Status</th>
								<th class="text-center">Comment</th>
								<th class="text-center">Action</th> 
							</thead>
							<tbody>
							<?php 
							    global $row;
								$customer = $conn->query("SELECT * FROM customer_list order by name asc");
								while($row=$customer->fetch_assoc()):
									$cus_arr[$row['id']] = $row['name'];
								endwhile;
									$cus_arr[0] = "GUEST";

								$i = 1;
								$query = mysqli_query($conn,"SELECT * FROM sales_list  WHERE status='Pending'");
								while($row=$query->fetch_assoc()):
									 ?>
								<tr>
								<td class='text-center'><?php echo $i++ ?></td>
   									<td class='text-center'><?php echo $row['id']?></td>
								    <td class='text-center'><?php echo $row['date_updated']?></td>
									<td class='text-center'><?php echo $row['ref_no']?></td>
									<td class='text-center'><?php echo $cus_arr[$row['customer_id']]?></td>
									<td class='text-center'><?php echo $row['status']?>
                        
									</td>
									<td class='text-center'><?php echo $row['comment']?>
						</td>
									<!-- <td class='text-center'><?php if($row['status']=='Pending'): ?>
                          				<span class="label label-info">Pending</span>
                          				<?php elseif($row['status']=='Approved'): ?>
                          				<span class="label label-success">Approved</span>
                          				<?php elseif($row['status']=='Rejected'): ?>
                          				<span class="label label-danger">Rejected</span>
                          				<?php endif; ?>
									</td> -->
										<td class='text-center'>
										<form action="" method="post">
										 <input type="hidden" name="id" value="<?php echo $row['id'];?>">
										 <input type="hidden" name="form_id" value="<?php echo $row['id'];?>">
										  <a class="btn btn-sm btn-primary mr-2" href="index.php?page=view_order&id=<?php echo $row['id'] ?>">View</a> 
											<button type="submit" name="approved" class="btn btn-success btn-sm mr-2">Approve</button>
											<button type="submit" name="rejected" class="btn btn-danger btn-sm mr-2">Reject</button>
                                             
						                </form>
						                </td>
													
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$('table').dataTable()
	$('#new_sales').click(function(){
		location.href = "index.php?page=pos"
	})
	$('.delete_sales').click(function(){
		_conf("Are you sure to delete this data?","delete_sales",[$(this).attr('data-id')])
	})
	function delete_sales($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_sales',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>