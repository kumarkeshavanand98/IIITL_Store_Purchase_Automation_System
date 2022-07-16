<?php include 'db_connect.php';
$result = mysqli_query($conn, "SELECT * FROM receiving_list");
 ?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<button class="col-md-2 float-right btn btn-primary btn-sm" id="new_receiving"><i class="fa fa-plus"></i> New Receiving</button>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<form name="frmUser" method="post" action="">
						<table class="table table-bordered">
							<thead>
								<th class="text-center"><button type="button" class="btn btn-danger" name="delete" value="Delete"  onClick="setDeleteAction();">Delete</button></th>
								<th class="text-center">Date</th>
								<th class="text-center">Reference #</th>
								<th class="text-center">Supplier</th>
								<th class="text-center">Status</th>
								<th class="text-center">Action</th>
							</thead>
							<tbody>
							<?php 
								$supplier = $conn->query("SELECT * FROM supplier_list order by supplier_name asc");
								while($row=$supplier->fetch_assoc()):
									$sup_arr[$row['id']] = $row['supplier_name'];
								endwhile;
								$i=0;
								
								while($row1 = mysqli_fetch_array($result)) {
									if($i%2==0)
									$classname="evenRow";
									else
									$classname="oddRow";
								// $i = 1;
								// $receiving = $conn->query("SELECT * FROM receiving_list r order by date(date_added) desc");
								// while($row=$receiving->fetch_assoc()):
							?>
								<tr class="<?php if(isset($classname)) echo $classname;?>">
									<td class="text-center"><input type="checkbox" name="receiving_del[]" value="<?= $row1['id'];?>"></td>
									<td class="text-center"><?php echo date("M d, Y",strtotime($row1['date_added'])) ?></td>
									<td class="text-center"><?php echo $row1['ref_no'] ?></td>
									<td class="text-center"><?php echo isset($sup_arr[$row1['supplier_id']])? $sup_arr[$row1['supplier_id']] :'N/A' ?></td>
									<td class="text-center"><?php echo $row1['status']?>
									<td class="text-center">
										<a class="btn btn-sm btn-primary mr-2" href="index.php?page=view_receiving&id=<?php echo $row1['id'] ?>">View</a>
										<a class="btn btn-sm btn-secondary mr-2" href="index.php?page=manage_receiving&id=<?php echo $row1['id'] ?>">Edit</a>
										<a class="btn btn-sm btn-danger delete_receiving" href="javascript:void(0)" data-id="<?php echo $row1['id'] ?>">Delete</a>
									</td>
								</tr>
							<?php $i++;} ?>
							</tbody>
						</table>
					  </form>
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
	function setDeleteAction() {
if(confirm("Are you sure want to delete these rows?")) {
document.frmUser.action = "delete_receiving_list.php";
document.frmUser.submit();
}
}
</script>