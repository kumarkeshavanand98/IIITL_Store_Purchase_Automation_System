<?php include 'db_connect.php';

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM sales_list where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k => $val){
		$$k = $val;
	}
	$inv = $conn->query("SELECT * FROM inventory where form_id=".$_GET['id']);

}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4><b>View Requests</b></h4>
			</div>
			<div class="card-body">
			<form action="" id="po-form">  			
				<div class="row">
					<!-- <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
					<input type="hidden" name="ref_no" value="<?php echo isset($ref_no) ? $ref_no : '' ?>"> -->
					<table class="table table-bordered table-hover" id="list">
                       <thead>
					        <th class="text-center">#</th>
							<th class="text-center">Product</th>
							<th class="text-center">Qty</th>
							<!-- <th class="text-center">Indentor</th> -->
							<th class="text-center">Date</th>
							<th class="text-center">Reference #</th>
						    <th class="text-center">Recommended By</th>
							<th class="text-center">Approved By</th> 
							<th class="text-center">Issued By</th> 
							<th class="text-center">Comment</th> 
                        </thead>
                        <tbody>
							<?php 
							// global $row;
							// $cat = $conn->query("SELECT * FROM category_list order by name asc");
							// 	while($row=$cat->fetch_assoc()):
							// 		$cat_arr[$row['id']] = $row['name'];
							// 	endwhile;
							// $product = $conn->query("SELECT * FROM product_list  order by name asc");
							// while($row=$product->fetch_assoc()):
							// 	$prod[$row['id']] = $row;
                            // endwhile;
							// 	$customer = $conn->query("SELECT * FROM customer_list order by name asc");
							// 	while($row=$customer->fetch_assoc()):
							// 		$cus_arr[$row['id']] = $row['name'];
							// 	endwhile;
							// 		$cus_arr[0] = "GUEST";
							// 		$i = 1;
							// 		$query = mysqli_query($conn,"SELECT * FROM sales_list  WHERE id=".$id);
							// 		$numrow = mysqli_num_rows($query);
							// 		if($query){
							// 		// while($row=$sales->fetch_assoc()):
							// 		 if($numrow!=0){
							// 			 $cnt =1;
							// 			 while($row = mysqli_fetch_assoc($query)){
							// 				echo "<tr>
							// 						 <td class='text-center'>$cnt</td>
							// 						 <td class='text-center'>{$cus_arr[$row['customer_id']]}</td>
							// 						 <td class='text-center'>{$row['date_updated']}</td>
							// 						 <td class='text-center'>{$row['ref_no']}</td>
							// 						 <td class='text-center'>{$row['recommended']}</td>
							// 						 <td class='text-center'>{$row['approved']}</td>
							// 						 <td class='text-center'>{$row['issued']}</td>
							// 						 <td class='text-center'>{$row['comment']}</td>
							// 						 <td class='text-center'>
							// 						 <button type='button' class='btn btn-success btn-sm' id='submit' onclick='$('#accepted-issue').submit()'>Accepted</button>
							// 						 <button type='button' class='btn btn-danger btn-sm' id='submit' onclick='$('#accepted-issue').submit()'>Rejected</button>
							// 						  </tr>";  
							// 				 $cnt++; }
							// 		 }
							// 		}
							// 		else{
							// 			echo "Query Error : " . "SELECT * FROM sales_list WHERE status='Pending'" . "<br>" . mysqli_error($conn);
							// 		}
							$i = 1;
							$cat = $conn->query("SELECT * FROM category_list order by name asc");
							while($row=$cat->fetch_assoc()):
								$cat_arr[$row['id']] = $row['name'];
							endwhile;
							$product = $conn->query("SELECT * FROM product_list  order by name asc");
							while($row=$product->fetch_assoc()):
								$prod[$row['id']] = $row;
							endwhile;
							$customer = $conn->query("SELECT * FROM customer_list order by name asc");
							
							while($row=$customer->fetch_assoc()):
								$cus_arr[$row['id']] = $row['name'];
							endwhile;
							$cus_arr[0] = "GUEST";
							if(isset($id)):
								while($row = $inv->fetch_assoc()): 
									foreach(json_decode($row['other_details']) as $k=>$v){
										$row[$k] = $v;
									}
							 ?>
							 <tr class="item-row">
								<td class="text-center"><?=$i++?></td>
								<!-- <td class="text-center"><?=$cus_arr[$row['customer_id']]?></td> -->
								<td>
								 <input type="hidden" name="inv_id[]" value="<?php echo $row['id'] ?>">
								 <input type="hidden" name="product_id[]" value="<?php echo $row['product_id'] ?>">
								 <p class="pname">Name: <b><?php echo $prod[$row['product_id']]['name'] ?></b></p>
								 <p class="pdesc"><small><i>Description: <b><?php echo $prod[$row['product_id']]['description'] ?></b></i></small></p>
								</td>
								<td class="text-center"><?=$row['qty']?></td>
								<td class="text-center"><?=$row['date_updated']?></td>
								<?php
								$sales = $conn->query("SELECT * FROM sales_list Where id=".$_GET['id']);
								while($row1 = $sales->fetch_assoc()):?>
								<td class="text-center"><?=$row1['ref_no']?></td> 
								<?php endwhile; ?>
								<td class="text-center"><?=$row['recommended']?></td> 
								 <td class="text-center"><?=$row['approved']?></td>
								<td class="text-center"><?=$row['issued']?></td>

								
									<?php
								$sales = $conn->query("SELECT * FROM sales_list Where id=".$_GET['id']);
								while($row1 = $sales->fetch_assoc()):?>
								
								<td class="text-center"><?=$row1['comment']?></td>
								<?php endwhile; ?>
								<?php endwhile; ?>
									<?php endif; ?>
                        
								</tr>
								
						</tbody>
					</table>
			    </div>
			</form>
		    </div>
		</div>
	</div>
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
	$('table').dataTable()
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
	// $('#add_list').click(function(){
	// 	// alert("TEST");
	// 	// return false;

	// 	var tr = $('#tr_clone tr.item-row').clone();
	// 	var product = $('#product').val(),
	// 		qty = $('#qty').val(),
	// 		price = $('#price').val();
	// 		if($('#list').find('tr[data-id="'+product+'"]').length > 0){
	// 			alert_toast("Product already on the list",'danger')
	// 			return false;
	// 		}

	// 		if(product == '' || qty == ''){
	// 			alert_toast("Please complete the fields first",'danger')
	// 			return false;
	// 		}
	// 		$.ajax({
	// 			url:'ajax.php?action=chk_prod_availability',
	// 			method:'POST',
	// 			data:{id:product},
	// 			success:function(resp){
	// 				resp = JSON.parse(resp);
	// 				if(resp.available >= qty){
	// 					tr.attr('data-id',product)
	// 					tr.find('.pname b').html($("#product option[value='"+product+"']").attr('data-name'))
	// 					tr.find('.pdesc b').html($("#product option[value='"+product+"']").attr('data-description'))
	// 					// tr.find('.price').html(resp.price)
	// 					tr.find('[name="product_id[]"]').val(product)
	// 					tr.find('[name="qty[]"]').val(qty)
	// 					// tr.find('[name="price[]"]').val(resp.price)
	// 					// tr.find('[name="recommeded"]').val(recommended)
	// 					// tr.find('[name="approved"]').val(approved)
	// 					// tr.find('[name="issued"]').val(issued)
	// 					// tr.find('[name="comment"]').val(comment)
	// 					// var amount = parseFloat(price) * parseFloat(qty);
	// 					// tr.find('.amount').html(parseFloat(amount).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
	// 					$('#list tbody').append(tr)
	// 					calculate_total()
	// 					$('[name="qty[]"]').keyup(function(){
	// 						calculate_total()
	// 					})
	// 					 $('#product').val('').select2({
	// 					 	placeholder:"Please select here",
	// 				 		width:"100%"
	// 					 })
	// 						$('#qty').val('')
	// 						// $('#price').val('')
	// 						$('#price').val('')
	// 				}else{
	// 					alert_toast("Product quantity is greater than available stock.",'danger')
	// 				}
	// 			}
	// 		})
			
		
	// })
	// function calculate_total(){
	// 	var total = 0;
	// 	$('#list tbody').find('.item-row').each(function(){
	// 		var _this = $(this).closest('tr')
	// 	var amount = parseFloat(_this.find('[name="qty[]"]').val()) * parseFloat(_this.find('[name="price[]"]').val());
	// 	amount = amount > 0 ? amount :0;
	// 	_this.find('p.amount').html(parseFloat(amount).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
	// 	total+=parseFloat(amount);
	// 	})
	// 	$('[name="tamount"]').val(total)
	// 	$('#list .tamount').html(parseFloat(total).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
	// }
	// $('[name="amount_discount"]').keyup(function(){
	// 	var discount = $(this).val();
	// 	var tamount = $('[name="tamount"]').val();
	// 	$('[name="totalamount"]').val(parseFloat(tamount) - parseFloat(discount))

	// })
$('#accepted-issue').submit(function(e){
		e.preventDefault()
		start_load()
		// if($("#list .item-row").length <= 0){
		// 	alert_toast("Please insert atleast 1 item first.",'danger');
		// 	end_load();
		// 	return false;
		// }
		$.ajax({
			url:'ajax.php?action=update_status',
		    method: 'POST',
		    data: $(this).serialize(),
			success:function(resp){
				alert_toast("Data successfully submitted",'success')
				location.href = "index.php?page=requests_status"
				// if(resp > 0){
				// 	end_load()
				// 	alert_toast("Data successfully submitted",'success')
				// 	// uni_modal('Print',"print_sales.php?id="+resp)
				// 	// $('#uni_modal').modal({backdrop:'static',keyboard:false})

				// }
				
			}
		})
	})
			$('#po-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			$('.err-msg').remove();
			$('[name="po_no"]').removeClass('border-danger')
			if($('.po-item').length <= 0){
				alert_toast(" Please add atleast 1 item on the list.",'warning')
				return false;
			}
			start_loader();
			$.ajax({
				url:'ajax.php?action=approve_sale',
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = "./?page=requests_status";
					}else if((resp.status == 'failed' || resp.status == 'po_failed') && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: 0 }, "fast");
                            end_loader()
							if(resp.status == 'po_failed'){
								$('[name="po_no"]').addClass('border-danger').focus()
							}
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})
</script>
