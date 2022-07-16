<?php include 'db_connect.php';

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM sales_list where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k => $val){
		$$k = $val;
	}
	$inv = $conn->query("SELECT * FROM sales_list where  ref_no=".$_GET['id']);

}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>View Issue </h4>
			</div>
			<div class="card-body">
				<form action="" id="manage-receiving">
					<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
					<input type="hidden" name="ref_no" value="<?php echo isset($ref_no) ? $ref_no : '' ?>">
					<div class="col-md-12">
                       
						<div class="row mb-3">
								<div class="col-md-4">
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
									?>
										<!-- <?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-description="<?php echo $row['description'] ?>"><?php echo $row['name'] . ' | ' . $row['product_id'] ?> -->
									<?php endwhile; ?>
									<!-- </select> -->
								</div>
								<!-- <div class="col-md-2">
									<label class="control-label">Qty</label>
									<input type="number" class="form-control text-right" step="any" id="qty" >
								</div>
								<div class="col-md-3">
									<label class="control-label">Price</label>
									<input type="number" class="form-control text-right" step="any" id="price" >
								</div>
								<div class="col-md-3">
									<label class="control-label">&nbsp</label>
									<button class="btn btn-block btn-sm btn-primary" type="button" id="add_list"><i class="fa fa-plus"></i> Add to List</button>
								</div> -->
						</div>
						<div class="row">
							<table class="table table-bordered" id="list">
								<colgroup>
									<col width="15%">
									<col width="5%">
									<col width="20%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="20%">
									
								</colgroup>
								<thead>
									<tr>
										<th class="text-center">Product</th>
										<th class="text-center">Qty</th>
										<th class="text-center">Recommended By</th>
										<th class="text-center">Approved By</th>
                                        <th class="text-center">Issued By</th>
                                        <th class="text-center">Comment By</th>
										
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
												<input type="text" name="inv_id[]" value="<?php echo $row['id'] ?>">
												<input type="text" name="product_id[]" value="<?php echo $row['product_id'] ?>">
												<p class="pname">Name: <b><?php echo $prod[$row['product_id']]['name'] ?></b></p>
												<p class="pdesc"><small><i>Description: <b><?php echo $prod[$row['product_id']]['description'] ?></b></i></small></p>
											</td>
											<td>
												<input type="number" min="1" step="any" name="qty[]" value="<?php echo $row['qty'] ?>" class="text-right" readonly="">
											</td>
											<td>
												<input type="text" name="recommended" value="<?php echo $row['recommended'] ?>" class="text-right" readonly="">
											</td>
											<td>
                                               <input type="text" name="approved[]" value="<?php echo $row['approved'] ?>" class="text-right" readonly="">
											</td>
                                            <td>
                                               <input type="text" name="issued[]" value="<?php echo $row['issued'] ?>" class="text-right" readonly="">
											</td>
                                            <td>
                                               <input type="text" name="comment[]" value="<?php echo $row['comment'] ?>" class="text-right" readonly="">
											</td>
											
										</tr>
									<?php endwhile; ?>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
						<!-- <div class="row">
							<button class="btn btn-primary btn-sm btn-block float-right .col-md-3">Save</button>
						</div> -->
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
			<input type="number" min="1" step="any" name="qty[]" value="" class="text-right" readonly="">
		</td>
		<td>
			<input type="number" min="1" step="any" name="price[]" value="" class="text-right" readonly="">
		</td>
		<td>
												<input type="text" name="recommended[]" value="<?php echo $row['recommended'] ?>" class="text-right" readonly="">
											</td>
											<td>
                                            <input type="text" name="approved[]" value="<?php echo $row['approved'] ?>" class="text-right" readonly="">
											</td>
                                            <td>
                                            <input type="text" name="issued[]" value="<?php echo $row['issued'] ?>" class="text-right" readonly="">
											</td>
                                            <td>
                                            <input type="text" name="comment[]" value="<?php echo $row['comment'] ?>" class="text-right" readonly="">
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
  
	// $('.select2').select2({
	//  	placeholder:"Please select here",
	//  	width:"100%"
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
	

</script>