<?php include 'db_connect.php';
if(isset($_POST['approved'])){ 
	// 	extract($_POST);
		 $status="Approved";
		 $form_id = $_POST['form_id'];
		 $id = $_POST['id'];
			// $id =$this->db->insert_id;
				$type = "1";
				$stock_from = "receiving";
				$query="UPDATE inventory SET status='$status', type='$type', stock_from='$stock_from' WHERE form_id=".$form_id;
				$result=mysqli_query($conn,$query);
				if($result){
					$_SESSION['success']="Success";
					?>
					<script>location.href = "index.php?page=receiving_requests_status"</script>
				<?php }
				else{
					echo "Data not inserted, Please try again!";
				}
			
			// if(isset($save2)){
			// 	return $id;
			// }
		
		 $query="UPDATE receiving_list SET status='$status' WHERE id=".$id;
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
					<script>location.href = "index.php?page=receiving_requests_status"</script>
				<?php }
				else{
					echo "Data not inserted, Please try again!";
				}
		$query="UPDATE receiving_list SET status='$status' WHERE id=".$id;
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
						<h4><b>Receiving Requests Update</b></h4>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
							<th class="text-center">#</th>
									<th class="text-center">Form_Id</th>
									<th class="text-center">Supplier</th>
									<th class="text-center">Date</th>
									<th class="text-center">Reference #</th>
									<th class="text-center">Status</th>
									<th class="text-center">Action</th> 
							</thead>
							<tbody>
							<?php 
							    global $row;
								$supplier = $conn->query("SELECT * FROM supplier_list order by supplier_name asc");
								while($row=$supplier->fetch_assoc()):
									$sup_arr[$row['id']] = $row['supplier_name'];
                                endwhile;
								$i = 1;
								$query = mysqli_query($conn,"SELECT * FROM receiving_list  WHERE status='Pending'");
								while($row=$query->fetch_assoc()):
									 ?>
								<tr>
								<td class='text-center'><?php echo $i++ ?></td>
   									<td class='text-center'><?php echo $row['id']?></td>
                                       <td class='text-center'><?php echo isset($sup_arr[$row['supplier_id']])? $sup_arr[$row['supplier_id']] :'N/A'?></td>
                                       <td class='text-center'><?php echo date("M d, Y",strtotime($row['date_added'])) ?></td>
									<td class='text-center'><?php echo $row['ref_no']?></td>
									
									<td class='text-center'><?php echo $row['status']?>
                        
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
										 <a class="btn btn-sm btn-primary mr-2" href="index.php?page=view_receiving&id=<?php echo $row['id'] ?>">View</a> 
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
	$('#new_receiving').click(function(){
		location.href = "index.php?page=manage_receiving"
	})
	$('.delete_receiving').click(function(){
		_conf("Are you sure to delete this data?","delete_receiving",[$(this).attr('data-id')])
	})
	function delete_receiving($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_receiving',
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