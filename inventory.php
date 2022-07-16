<?php include 'db_connect.php' ?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4><b>Inventory</b></h4>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<th class="text-center">#</th>
								<th class="text-center">Product Name</th>
								<th class="text-center">Stock In</th>
								<th class="text-center">Stock Out</th>
								<th class="text-center">Stock Available</th>
								
							</thead>
							<tbody>
							<?php 
								$i = 1;
								$product = $conn->query("SELECT * FROM product_list r order by name asc");
								while($row=$product->fetch_assoc()):
							  
								$inn = $conn->query("SELECT sum(qty) as inn FROM inventory where type = 1 and product_id = ".$row['id']);
								$inn = $inn && $inn->num_rows > 0 ? $inn->fetch_array()['inn'] : 0;
								$out = $conn->query("SELECT sum(qty) as `out` FROM inventory where type = 2 and product_id = ".$row['id']);
								$out = $out && $out->num_rows > 0 ? $out->fetch_array()['out'] : 0;
								$ret = $conn->query("SELECT sum(qty) as `ret` FROM inventory where type = 3 and product_id = ".$row['id']);
								$ret = $ret && $ret->num_rows > 0 ? $ret->fetch_array()['ret'] : 0;
								$status = $conn->query("SELECT * FROM inventory Where status='Rejected' and id=".$row['id']);
								// while($row=mysqli_fetch_assoc($status)){
								// 	if($row['status']=='Accepted'and  $row['id']){
								     $available = $inn - $out;
									// echo ($row['id']);
									// // exit;
									// } }
							?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="text-center"><?php echo $row['name'] ?></td>
									<td class="text-center"><?php echo $inn ?></td>
									<td class="text-center"><?php echo $out ?></td>
									<td class="text-center"><?php echo $available ?></td>
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