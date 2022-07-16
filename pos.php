<?php include 'db_connect.php';

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM sales_list where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k => $val){
		$$k = $val;
	}
	$inv = $conn->query("SELECT * FROM inventory where form_id=".$_GET['id']);
}
   if(isset($_POST['issue'])){
	   $id=$_POST['id'];
	   $ref_no = 'ref_no';
	   $customer_id = $_POST['customer_id'];
	   $recommended = $_POST['recommended'];
	   $approved = $_POST['approved'];
	   $issued = $_POST['issued'];
	   $comment = $_POST['comment'];
	   $status = "Pending";
	   if(empty($id)){
		$ref_no = sprintf("%'.08d\n", $ref_no);
		$i = 1;
		// while($i == 1){
		// 	$chk = ("SELECT * FROM sales_list where ref_no =".$ref_no);
		// 	$res = mysqli_query($conn,$chk);
		// 	if($res > 0){
				$ref_no = mt_rand(1,99999999);
				$ref_no = sprintf("%'.08d\n", $ref_no);
		// 	}else{
		// 		$i=0;
		// 	}
		// }
		
	}
	// foreach($id as $idx){
		$query="INSERT INTO sales_list (`id`, `ref_no`, `customer_id`, `recommended`, `approved`, `issued`, `comment`, `status`  ) VALUES ('','$ref_no','$customer_id','$recommended','$approved','$issued','$comment','$status')";
	    $result=mysqli_query($conn,$query);
	// }
		if($result){
			$_SESSION['success']="Success";
			?>
			<script>location.href = "index.php?page=sales"</script>
		<?php }
		else{
			echo "Data not inserted, Please try again!";
		}
	
	   
	   
	 
	//	$query="INSERT INTO sales_list SET customer_id='$customer_id', recommended='$recommended', approved='$approved', issued='$issued', comment = '$comment', status = '$status' WHERE id=".$id;
		
   }


?>


<div class="container-fluid">
<?php
      if(isset($_SESSION['success'])){
		//   echo $_SESSION['success'];
	  }
	?>
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Issue</h4>
			</div>
			<div class="card-body">
				<form action="" id="manage-sales">
					<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
					<input type="hidden" name="ref_no" value="<?php echo isset($ref_no) ? $ref_no : '' ?>">
					<div class="col-md-12">
						<div class="row">
							<div class="form-group col-md-5">
								<label class="control-label">Indetor</label>
								<select name="customer_id" id="" class="custom-select browser-default select2">
									<option value="" selected=""></option>
								<?php 

								$customer = $conn->query("SELECT * FROM customer_list order by name asc");
								while($row=$customer->fetch_assoc()):
								?>
									<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
								<?php endwhile; ?>
								</select>
							</div>
						</div>
						<hr>
						<div class="row mb-3">
								<div class="col-md-4">
									<label class="control-label">Product</label>
									<select name="" id="product" class="custom-select browser-default select2">
										<option value=""></option>
									<?php 
									$cat = $conn->query("SELECT * FROM category_list order by name asc");
										while($row=$cat->fetch_assoc()):
											$cat_arr[$row['id']] = $row['name'];
										endwhile;
									$product = $conn->query("SELECT * FROM product_list  order by name asc");
									while($row=$product->fetch_assoc()):
										$prod[$row['id']] = $row;
									?>
										<option value="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-description="<?php echo $row['description'] ?>"><?php echo $row['name'] . ' | ' . $row['product_id'] ?></option>
									<?php endwhile; ?>
									</select>
								</div>
								<div class="col-md-2">
									<label class="control-label">Qty</label>
									<input type="number" class="form-control text-right" step="any" id="qty" >
								</div>
								<div class="col-md-3">
									<label class="control-label">&nbsp</label>
									<button class="btn btn-block btn-sm btn-primary" type="button" id="add_list"><i class="fa fa-plus"></i> Add to List</button>
								</div>


						</div>
						<div class="row">
							<table class="table table-bordered" id="list">
								<colgroup>
									<col width="15%">
									<col width="5%">
									<col width="20%">
									<col width="20%">
									<col width="10%">
									<col width="20%">
									<col width="10%">


								</colgroup>
								<thead>
									<tr>
										<th class="text-center">Product</th>
										<th class="text-center">Qty</th>
										<th class="text-center">Recommended</th>
										<th class="text-center">Approved</th>
										<th class="text-center">Issued</th>
										<th class="text-center">Comment</th>
										<th class="text-center"></th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if(isset($id)):
									while($row = $inv->fetch_assoc()): 
										foreach(json_decode($row['other_details']) as $k=>$v){
											$row[$k] = $v;
										}
									?>
										<tr class="item-row">
											<td>
												<input type="hidden" name="inv_id[]" value="<?php echo $row['id'] ?>">
												<input type="hidden" name="product_id[]" value="<?php echo $row['product_id']?>">
												<p class="pname">Name: <b><?php echo $prod[$row['product_id']]['name']?></b></p>
												<p class="pdesc"><small><i>Description: <b><?php echo $prod[$row['product_id']]['description'] ?></b></i></small></p>
											</td>
								            <td>
												<input type="number" min="1" step="any" name="qty[]" value="<?php echo $row['qty'] ?>" class="text-right">
											</td>
											<td>
												<input type="text" name="recommended[]" value="<?php echo $row['recommended'] ?>" class="form-control">
											</td>
											<td>
											<input type="text" name="approved[]" value="<?php echo $row['approved'] ?>" class="form-control">
											</td>
											<td>
											<input type="text" name="issued[]" value="<?php echo $row['issued'] ?>" class="form-control" value="Admin">
											</td>
											<td>
											<textarea name="comment" class="form-control"></textarea>
											</td>
											<td class="text-center">
												<button class="btn btn-sm btn-danger" onclick = "rem_list($(this))"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
									<?php endwhile; ?>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
						<div class="row">
						<button type="button" class="btn btn-primary btn-block" id='submit' onclick="$('#manage-sales').submit()">Issue Request </button>
						</div>
					</div>
				</form>
			</div>
			
		</div>
	</div>
</div>
<div id="tr_clone">
	<table>
	<tr class="item-row">
		<td>
			<input type="hidden" name="inv_id[]" value="">
			<input type="hidden" name="product_id[]" value="">
			<p class="pname">Name: <b>product</b></p>
			<p class="pdesc"><small><i>Description: <b>Description</b></i></small></p>
		</td>
		<td>
			<input type="number" min="1" step="any" name="qty[]" value="" class="form-control">
		</td>
		<td>
			<input type="text"  name="recommended[]" value="" class="form-control">
		</td>
		<td>
			<input type="text"  name="approved[]" value="" class="form-control">
		</td>
		<td>
			<input type="text"  name="issued[]" value="Admin" class="form-control">
		</td>
		<td>
			<textarea name="comment" value="" class="form-control"></textarea>
		</td>
		<td class="text-center">
			<buttob class="btn btn-sm btn-danger" onclick = "rem_list($(this))"><i class="fa fa-trash"></i></buttob>
		</td>
	</tr>
	</table>
</div>
<style type="text/css">
	#tr_clone{
		display: none;
	}
	td{
		vertical-align: middle;
	}
	td p {
		margin: unset;
	}
	td input[type='number']{
		height: calc(100%);
		width: calc(100%);

	}
	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
	  -webkit-appearance: none; 
	  margin: 0; 
	}
</style>
<script>
	$('.select2').select2({
	 	placeholder:"Please select here",
	 	width:"100%"
	})
	// $('#pay').click(function(){
	// 	if($("#list .item-row").length <= 0){
	// 		alert_toast("Please insert atleast 1 item first.",'danger');
	// 		end_load();
	// 		return false;
	// 	}
	// 	$('#pay_modal').modal('show')
	// })
	$(document).ready(function(){
		if('<?php echo isset($id) ?>' == 1){
			$('[name="supplier_id"]').val('<?php echo isset($supplier_id) ? $supplier_id :'' ?>').select2({
				placeholder:"Please select here",
	 			width:"100%"
			})
			calculate_total()
		}
	})
	function rem_list(_this){
		_this.closest('tr').remove()
	}
	$('#add_list').click(function(){
		// alert("TEST");
		// return false;

		var tr = $('#tr_clone tr.item-row').clone();
		var product = $('#product').val(),
			qty = $('#qty').val(),
			price = $('#price').val();
			if($('#list').find('tr[data-id="'+product+'"]').length > 0){
				alert_toast("Product already on the list",'danger')
				return false;
			}

			if(product == '' || qty == ''){
				alert_toast("Please complete the fields first",'danger')
				return false;
			}
			$.ajax({
				url:'ajax.php?action=chk_prod_availability',
				method:'POST',
				data:{id:product},
				success:function(resp){
					resp = JSON.parse(resp);
					if(resp.available >= qty){
						tr.attr('data-id',product)
						tr.find('.pname b').html($("#product option[value='"+product+"']").attr('data-name'))
						tr.find('.pdesc b').html($("#product option[value='"+product+"']").attr('data-description'))
						// tr.find('.price').html(resp.price)
						tr.find('[name="product_id[]"]').val(product)
						tr.find('[name="qty[]"]').val(qty)
						// tr.find('[name="price[]"]').val(resp.price)
						// tr.find('[name="recommeded"]').val(recommended)
						// tr.find('[name="approved"]').val(approved)
						// tr.find('[name="issued"]').val(issued)
						// tr.find('[name="comment"]').val(comment)
						// var amount = parseFloat(price) * parseFloat(qty);
						// tr.find('.amount').html(parseFloat(amount).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
						$('#list tbody').append(tr)
						calculate_total()
						$('[name="qty[]"]').keyup(function(){
							calculate_total()
						})
						 $('#product').val('').select2({
						 	placeholder:"Please select here",
					 		width:"100%"
						 })
							$('#qty').val('')
							// $('#price').val('')
							$('#price').val('')
					}else{
						alert_toast("Product quantity is greater than available stock.",'danger')
					}
				}
			})
			
		
	})
	function calculate_total(){
		var total = 0;
		$('#list tbody').find('.item-row').each(function(){
			var _this = $(this).closest('tr')
		var amount = parseFloat(_this.find('[name="qty[]"]').val()) * parseFloat(_this.find('[name="price[]"]').val());
		amount = amount > 0 ? amount :0;
		_this.find('p.amount').html(parseFloat(amount).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
		total+=parseFloat(amount);
		})
		$('[name="tamount"]').val(total)
		$('#list .tamount').html(parseFloat(total).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
	}
	$('[name="amount_discount"]').keyup(function(){
		var discount = $(this).val();
		var tamount = $('[name="tamount"]').val();
		$('[name="totalamount"]').val(parseFloat(tamount) - parseFloat(discount))

	})
$('#manage-sales').submit(function(e){
		e.preventDefault()
		start_load()
		if($("#list .item-row").length <= 0){
			alert_toast("Please insert atleast 1 item first.",'danger');
			end_load();
			return false;
		}
		$.ajax({
			url:'ajax.php?action=save_sales',
		    method: 'POST',
		    data: $(this).serialize(),
			success:function(resp){
				if(resp > 0){
					end_load()
					alert_toast("Data successfully submitted",'success')
					uni_modal('Print',"print_sales.php?id="+resp)
					$('#uni_modal').modal({backdrop:'static',keyboard:false})

				}
				
			}
		})
	})
</script>