<?php 
include 'db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM sales_list where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k => $val){
		$$k = $val;
	}
	$inv = $conn->query("SELECT * FROM inventory where type=0 and form_id=".$_GET['id']);
	if($customer_id > 0){
		$cname = $conn->query("SELECT * FROM customer_list where id = $customer_id ");
		$cname = $cname->num_rows > 0 ? $cname->fetch_array()['name']: "Guest";
	}else{
		$cname = "Guest";
	}
}
$product = $conn->query("SELECT * FROM product_list  order by name asc");
	while($row=$product->fetch_assoc()):
		$prod[$row['id']] = $row;
	endwhile;

?>
<div class="container-fluid" id="print-sales">
	<style>
		table{
			border-collapse: collapse;
		}
		.wborder{
			border:1px solid gray;
		}
		.bbottom{
			border-bottom: 1px solid black
		}
		td p , th p{
			margin: unset
		}
			.text-center{
				text-align: center
			}
			.text-right{
				text-align: right
			}
			.clear{
				padding: 10px
			}
			#uni_modal .modal-footer{
				display: none;
			}
	</style>
	<table width="100%">
			
				<tr>
					<th class="text-center">
						<p>
							<b>IIITL Store and Purchase Automation System<br> Receipt</b>
						</p>
					</th>
				</tr>
				<tr>
					<td class="clear">&nbsp;</td>
				</tr>
				<tr>
					<td>
						<table width="100%">
							<tr>
								<td width="20%" class="text-right">Indentor :</td>
								<td width="40%" class="bbottom"><?php echo ucwords($cname) ?></td>
								<td width="20%" class="text-right">Date :</td>
								<td width="20%" class="bbottom"><?php echo date("Y-m-d",strtotime($date_updated)) ?></td>
							</tr>
							<tr>
								<td width="20%" class="text-right">Reference Number :</td>
								<td width="80%" class="bbottom" colspan="3"><?php echo $ref_no ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="clear">&nbsp;</td>
				</tr>
				<tr>
					<table width="100%">
						<tr>
							<th class="wborder  text-left">Product</th>
							<th class="wborder text-left">Qty</th>
							<th width="25%" class="wborder">Recommended</th>
							<th width="25%" class="wborder">Issued</th>
							<th width="25%" class="wborder">Approved</th>
						</tr>
						<?php 
						
						while($row = $inv->fetch_assoc()): 
							foreach(json_decode($row['other_details']) as $k=>$v){
								$row[$k] = $v;
							}
						?>
						<tr>
							
							<td class="wborder text-left">
							<input type="hidden" name="inv_id[]" value="<?php echo $row['id'] ?>">
							<input type="hidden" name="product_id[]" value="<?php echo $row['product_id'] ?>">
								<p class="pname">Name: <b><?php echo $prod[$row['product_id']]['name'] ?></b></p>
								<p class="pdesc"><small><i>Description: <b><?php echo $prod[$row['product_id']]['description'] ?></b></i></small></p>
							</td>
							<td class="wborder text-center">
								<?php echo $row['qty'] ?>
							</td>
							<td class="wborder text-right"><?php echo $row['recommended']?></td>
							<td class="wborder text-right"><?php echo $row['issued']?></td>
							<td class="wborder text-right"><?php echo $row['approved']  ?></td>
							
							<!-- //$sales = $conn->query("SELECT * FROM inventory WHERE type=2 id=".$_GET['id']);
							//while($row1 = $sales->fetch_assoc()):
							
							//<td class="wborder text-right"><?php echo $row1['recommended']?></td>
							//<td class="wborder text-right"><?php echo $row1['issued']?></td>
							//<td class="wborder text-right"><?php echo $row1['approved']  ?></td> -->
                         
						  <?php endwhile;?>
						</tr>
						
						
						<!-- <tr>
							<th class="text-left wborder">Recommended By</th>
							<th class="text-center wborder" ><?php echo $recommended ?></th>
						</tr>
						<tr>
							<th class="text-left wborder">Approved By</th>
							<th class="text-center wborder" ><?php echo $approved ?></th>
						</tr>
						<tr>
							<th class="text-left wborder">Issued By</th>
							<th class="text-center wborder" ><?php echo $issued ?></th>
						</tr> -->
					
					</table>
				</tr>
				<tr>
					<td class="clear">&nbsp;</td>
				</tr>
				
	</table>


</div>
<hr>
<div class="text-right">
	<div class="col-md-12">
		<div class="row">
			<button type="button" class="btn btn-sm btn-primary" id="print"><i class="fa fa-print"></i> Print</button>
        	<button type="button" class="btn btn-sm btn-secondary"  onclick="location.reload()"><i class="fa fa-plus"></i> New Sales</button>

		</div>
	</div>
</div>

<script>
	$('#print').click(function(){
		var _html = $('#print-sales').clone();
		var newWindow = window.open("","_blank","menubar=no,scrollbars=yes,resizable=yes,width=700,height=600");
		newWindow.document.write(_html.html())
		newWindow.document.close()
		newWindow.focus()
		newWindow.print()
		setTimeout(function(){;newWindow.close();}, 1500);
	})

</script>

