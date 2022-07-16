<?php include 'db_connect.php';
$result = mysqli_query($conn, "SELECT * FROM sales_list");
 ?>

<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<button class="col-md-2 float-right btn btn-primary btn-sm" id="new_sales"><i class="fa fa-plus"></i> New Request</button>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<form name="frmUser" method="post" action="">
						<table class="table table-bordered table-hover">
							<thead>
							<th class="text-center"><button type="button" class="btn btn-danger" name="delete" value="Delete"  onClick="setDeleteAction();">Delete</button></th>
								<th class="text-center">Date</th>
								<th class="text-center">Reference #</th>
								<th class="text-center">Indentor</th>
								<th class="text-center">Status</th>
								<th class="text-center">Action</th> 
								
								
							</thead>
							<tbody>
							<?php 
								$customer = $conn->query("SELECT * FROM customer_list order by name asc");
								while($row=$customer->fetch_assoc()):
									$cus_arr[$row['id']] = $row['name'];
								endwhile;
                                $i=0;
								
								while($row1 = mysqli_fetch_array($result)) {
									if($i%2==0)
									$classname="evenRow";
									else
									$classname="oddRow";
								// $i = 1;
								// $sales = $conn->query("SELECT * FROM sales_list order by date(date_updated) desc");
								// while($row1 = $sales->fetch_assoc()):
							?>
								<tr class="<?php if(isset($classname)) echo $classname;?>">
								    <td class='text-center'><input type="checkbox" name="sales_del[]" value="<?= $row1['id'];?>"></td>
								    <td class='text-center'><?php echo $row1['date_updated']?></td>
									<td class='text-center'><?php echo $row1['ref_no']?></td>
									<td class='text-center'><?php echo $cus_arr[$row1['customer_id']]?></td>
									<td class='text-center'><?php echo $row1['status']?>
                                    </td>
									<td class='text-center'>
									<!-- <a href="delete_sales.php?id=<?php echo $row1['id']?>"><button class='btn-danger btn-sm mr-2'  >Delete</button></a> -->
									<a class="btn btn-sm btn-secondary mr-2" href="index.php?page=pos&id=<?php echo $row1['id'] ?>">Edit</a>
									<a class="btn btn-sm btn-primary mr-2" href="index.php?page=view_order&id=<?php echo $row1['id'] ?>">View</a>
									<a class="btn btn-sm btn-danger delete_sales" href="javascript:void(0)" data-id="<?php echo $row1['id'] ?>">Delete</a>
									
									<!-- <a href='index.php?page=view_order&id=<?php echo $row1['id']?>'><button class='btn-info btn-sm ' >View</button></a> -->
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
	function setDeleteAction() {
if(confirm("Are you sure want to delete these rows?")) {
document.frmUser.action = "delete_sales_list.php";
document.frmUser.submit();
}
}
</script>