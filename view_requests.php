<?php include 'db_connect.php';

if(isset($_GET['id'])){
	$qry = $conn->query("INSERT INTO `view_requests`(`id`, `product`, `qty`, `recommended`, `approved`, `comment`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')");
	foreach($qry as $k => $val){
		$$k = $val;
	}
	$inv = $conn->query("SELECT * FROM inventory where type=2 and form_id=".$_GET['id']);

}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>View Issue Request</h4>
			</div>
			<div class="card-body">
				<form action="" id="manage-sales">
					<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
					<input type="hidden" name="ref_no" value="<?php echo isset($ref_no) ? $ref_no : '' ?>">
					<div class="col-md-12">
						
						<div class="row mb-3">
								<div class="col-md-3">
									<!-- <label class="control-label">Product</label>
									<select name="" id="product" class="custom-select browser-default select2">
										<option value=""></option> -->
									<?php 
									$cat = $conn->query("SELECT * FROM category_list order by name asc");
										while($row=$cat->fetch_assoc()):
											$cat_arr[$row['id']] = $row['name'];
										endwhile;
									$product = $conn->query("SELECT * FROM product_list  order by name asc");
									while($row=$product->fetch_assoc()):
										$prod[$row['id']] = $row;
                                    $recommended = $conn->query("SELECT * FROM view_requests  order by recommended asc");
                                        while($row=$recommended->fetch_assoc()):
                                            $reco[$row['id']] = $row;
									?>
										<!-- <option value="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-description="<?php echo $row['description'] ?>"><?php echo $row['name'] . ' | ' . $row['product_id'] ?></option> -->
									<?php endwhile; ?>
									<!-- </select> -->
								</div>
								<!-- <div class="col-md-1">
									<label class="control-label">Qty</label>
									<input type="number" class="form-control text-right" step="any" id="qty" >
								</div>
								<div class="col-md-2">
									<label class="control-label">Recommended By</label>
									<input type="text" class="form-control" id="recommended">
								</div>
								<div class="col-md-2">
									<label class="control-label">Approved By</label>
									<input type="text" class="form-control" id="approved" >
								</div>
								<div class="col-md-2">
									<label class="control-label">Comments</label>
									<input type="text" class="form-control" id="comments" >
								</div>
								<div class="col-md-2">
									<label class="control-label">&nbsp</label>
									<button class="btn btn-block btn-sm btn-primary" type="button" id="add_list"><i class="fa fa-plus"></i> Add to List</button>
								</div> -->
						</div>
						<div class="row">
							<table class="table table-bordered" id="list">
								<colgroup>
									<col width="20%">
									<col width="5%">
									<!-- <col width="5%">
									<col width="10%"> -->
									<col width="20%">
									<col width="25%">
									<col width="30%">
									
								</colgroup>
								<thead>
									<tr>
										<th class="text-center">Product</th>
										<th class="text-center">Qty</th>
										<!-- <th class="text-center">Price</th>
										<th class="text-center">Amount</th> -->
										<th class="text-center">Recommended By</th>
										<th class="text-center">Approved By</th>
										<th class="text-center">Comments</th>
										
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
												<input type="number" min="1" step="any" name="qty[]" value="<?php echo $row['qty'] ?>" class="text-right" readonly="">
											</td>
											<!-- <td>
												<input type="hidden" min="1" step="any" name="price[]" value="<?php echo $row['price'] ?>" class="text-right">
												<p class="text-right"><?php echo $row['price'] ?></p>
											</td>
											<td>
												<p class="amount text-right"></p>
											</td> -->
											<td class="text-center">
											    <input type="text" class="form-control" name="recommended[]" value="<?php echo $reco[$row['id]']]['recommended'] ?>" readonly="">
						
											</td>
											<td>
		                                        <input type="text" class="form-control" name="approved[]" value="<?php echo $reco[$row['id]']]['approved'] ?>" readonly="">
		                                    </td>
											<td>
		                                        <textarea class="form-control" name="comments[]" value="<?php echo $reco[$row['id]']]['comment'] ?>"></textarea >
		                                    </td>
											<!-- <td class="text-center">
												<button class="btn btn-sm btn-danger" onclick = "rem_list($(this))"><i class="fa fa-trash"></i></button>
											</td> -->
											
										</tr>
									<?php endwhile; ?>
									<?php endif; ?>
								</tbody>
							
							</table>
						</div>
						
					</div>
					<!-- <div class="modal fade" id="pay_modal" role='dialog'>
					    <div class="modal-dialog modal-md" role="document">
					      <div class="modal-content">
					        <div class="modal-header">
					        <h5 class="modal-title"></h5>
					      </div>
					      <div class="modal-body">
					      	<div class="container-fluid">
								<div class="form-group">
					      			<label for="" class="control-label">Recommended By</label>
					      			<input type="text" class="form-control" name="recommended">
					      		</div>
					      		<div class="form-group">
					      			<label for="" class="control-label">Issued By</label>
					      			<input type="text" class="form-control" value="Admin" name="issued">
					      		</div>
					      		
								<div class="form-group">
					      			<label for="" class="control-label">Approved By</label>
					      			<input type="text" name="approved"class="form-control" >
					      		</div>  
					      	</div>
					      </div> -->
					      <!-- <div class="modal-footer">
					        <button type="button" class="btn btn-primary" id='submit' onclick="$('#manage-sales').submit()">Issue</button>
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					      </div> -->
					      </div>
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
			<input type="number" min="1" step="any" name="qty[]" value="" class="text-right" readonly=""></td>
	    
		<td class="text-center">
		    <input type="text" class="form-control" name="recommended[]" value="" readonly="">
		</td>
		<td class="text-center">
		    <input type="text" class="form-control" name="approved[]" value="" readonly="">
		</td>
		<td class="text-center">
		<textarea class="form-control" name="comments[]" value=""></textarea>
		</td>
		<!-- <td class="text-center">
			<buttob class="btn btn-sm btn-danger" onclick = "rem_list($(this))"><i class="fa fa-trash"></i></buttob>
		</td> -->
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
	// $('.select2').select2({
	//  	placeholder:"Please select here",
	//  	width:"100%"
	// })
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
			recommended = $('#recommended').val(),
			approved = $('#approved').val(),
			comments = $('#comments').val(),
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
						tr.find('.price').html(resp.price)
						tr.find('[name="product_id[]"]').val(product)
						tr.find('[name="qty[]"]').val(qty)
						tr.find('[name="recommended[]"]').val(recommended)
						tr.find('[name="approved[]"]').val(approved)
						tr.find('[name="comments[]"]').val(comments)
						tr.find('[name="price[]"]').val(resp.price)
						 var amount = parseFloat(price) * parseFloat(qty);
						 tr.find('.amount').html(parseFloat(amount).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
						$('#list tbody').append(tr)
						calculate_total()
						$('[name="qty[]"],[name="price[]"]').keyup(function(){
							calculate_total()
						})
						 $('#product').val('').select2({
						 	placeholder:"Please select here",
					 		width:"100%"
						 })
							$('#qty').val('')
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
	$('[name="recommended"]').keyup(function(){
		var recommended = $(this).val();
		var tamount = $('[name="tamount"]').val();
		$('[name="recommended"]').val(<?php echo $row['recommended'] ?>)
		$('[name="approved"]').val(<?php echo $row['approved'] ?>)
		$('[name="issued"]').val(<?php echo $row['issued'] ?>)

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
</script> -->