<?php include('db_connect.php');
	$product_id = mt_rand(1,99999999);
	$product_id = sprintf("%'.08d\n", $product_id);
	$i = 1;
	while($i == 1){
		$chk = $conn->query("SELECT * FROM product_list where product_id ='$product_id'")->num_rows;
		if($chk > 0){
			$product_id = mt_rand(1,99999999);
			$product_id = sprintf("%'.08d\n", $product_id);
		}else{
			$i=0;
		}
	}
?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-product">
				<div class="card">
					<div class="card-header">
						    Product Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Product ID</label>
								<input type="text" class="form-control" name="product_id" value="<?php echo $product_id ?>">
							</div>
							
					</div>
					<div class="card-body">
							<div class="form-group">
								<label class="control-label">Category</label>
								<select name="category_id" id="" class="custom-select browser-default">
								<?php 

								$cat = $conn->query("SELECT * FROM category_list order by name asc");
								while($row=$cat->fetch_assoc()):
									$cat_arr[$row['id']] = $row['name'];
								?>
									<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
								<?php endwhile; ?>
								</select>
							</div>
						<div class="form-group">
							<label class="control-label">Product Name</label>
							<input type="text" class="form-control" name="name" >
						</div>
						<div class="form-group">
							<label class="control-label">Product Mfg. Date</label>
							<input type="date" class="form-control" id="mfg_date" name="mfg_date" >
						</div>
						<div class="form-group">
							<label class="control-label">Product Exp. Date</label>
							<input type="date" class="form-control" id="exp_date" name="exp_date" >
						</div>
						<div class="form-group">
							<label class="control-label">Description</label>
							<textarea class="form-control" cols="30" rows="3" name="description"></textarea>
						</div>
						<!-- <div class="form-group">
							<label class="control-label">Product Price</label>
							<input type="number" step="any" class="form-control text-right" name="price" >
						</div>		 -->
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3 mr-2"> Save</button>
								<button class="btn btn-sm btn-secondary col-sm-4" type="button" onclick="$('#manage-product').get(0).reset()">Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Product Info</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$prod = $conn->query("SELECT * FROM product_list order by id asc");
								while($row=$prod->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p>Product ID : <b><?php echo $row['product_id'] ?></b></p>
										<p><small>Category : <b><?php echo $cat_arr[$row['category_id']] ?></b></small></p>
										<p><small>Name : <b><?php echo $row['name'] ?></b></small></p>
										<p><small>Product Mfg.date : <b><?php echo $row['mfg_date'] ?></b></small></p>
										<p><small>Product Exp.date : <b><?php echo $row['exp_date'] ?></b></small></p>
										<p><small>Description : <b><?php echo $row['description'] ?></b></small></p>
										<!-- <p><small>Price : <b><?php echo number_format($row['price'],2) ?></b></small></p> -->
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_product" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-product="<?php echo $row['product_id'] ?>" data-category_id="<?php echo $row['category_id'] ?>"data-mfg="<?php echo $row['mfg_date'] ?>" data-exp="<?php echo $row['exp_date'] ?>" data-description="<?php echo $row['description'] ?>"  >Edit</button>
										<button class="btn btn-sm btn-danger delete_product" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin:unset;
	}
</style>
<script>
	$('table').dataTable()
	$('#manage-product').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_product',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.edit_product').click(function(){
		start_load()
		var cat = $('#manage-product')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='product_id']").val($(this).attr('data-product'))
		cat.find("[name='category_id']").val($(this).attr('data-category_id'))
		cat.find("[name='mfg_date']").val($(this).attr('data-mfg'))
		cat.find("[name='exp_date']").val($(this).attr('data-exp'))
		cat.find("[name='description']").val($(this).attr('data-description'))
		cat.find("[name='price']").val($(this).attr('data-price'))
		end_load()
	})
	$('.delete_product').click(function(){
		_conf("Are you sure to delete this product?","delete_product",[$(this).attr('data-id')])
	})
	function delete_product($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_product',
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