<nav id="sidebar" class='sidebar mx-lt-5 bg-secondary' >
	<?php 
	require_once("db_connect.php");
	$qry1 = mysqli_query($conn,"SELECT COUNT(status) as total FROM sales_list WHERE status='Pending';");
	$c = mysqli_fetch_assoc($qry1);
	$qry2 = mysqli_query($conn,"SELECT COUNT(status) as total FROM receiving_list WHERE status='Pending';");
	$a = mysqli_fetch_assoc($qry2);
	?>
		<div class="sidebar-list " >
		        <a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
		        <a href="index.php?page=supplier" class="nav-item nav-supplier"><span class='icon-field'><i class="fa fa-truck-loading"></i></span> Supplier</a>
				<a href="index.php?page=customer" class="nav-item nav-customer"><span class='icon-field'><i class="fa fa-user-friends"></i></span> Indentor List</a>
				<a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-list"></i></span> Category</a>
				<a href="index.php?page=product" class="nav-item nav-product"><span class='icon-field'><i class="fa fa-boxes"></i></span> Product</a>
				<a href="index.php?page=receiving" class="nav-item nav-receiving nav-manage_receiving"><span class='icon-field'><i class="fa fa-truck"></i></span> Receiving Requests <?php echo $a['total']?></a>
				<a href="index.php?page=inventory" class="nav-item nav-inventory"><span class='icon-field'><i  class="fa fa-list"></i></span> Inventory </a>
				<a href="index.php?page=sales" class="nav-item nav-sales"><span class='icon-field'><i class="fa fa-shopping-bag"></i></span> Issue Requests <?php echo $c['total']?></a>
				<a href="index.php?page=issue_requests_status" class="nav-item nav-sales-status"><span class='icon-field'><i class="fa fa-shopping-bag"></i>
				</span> Issue Requests Status  <?php echo $c['total']?></a>
				<a href="index.php?page=receiving_requests_status" class="nav-item nav-receiving-status"><span class='icon-field'><i class="fa fa-shopping-cart"></i>
				</span> Receiving Requests  <?php echo $a['total']?></a>
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
<?php if($_SESSION['login_type'] != 1): ?>
	<style>
		.nav-item{
			display: none!important;
		}
		.nav-home ,.nav-inventory ,.nav-sales-status, .nav-receiving-status{
			display: block!important;
			
		}
		
	</style>
<?php endif ?>
<?php if($_SESSION['login_type'] != 2): ?>
	<style>
		.nav-item{
			display: none!important;
		}
		.nav-home ,.nav-inventory ,.nav-supplier ,.nav-customer ,.nav-categories ,.nav-receiving ,.nav-sales ,.nav-users ,.nav-product{
			display: block!important;
			
		}
		
	</style>
<?php endif ?>