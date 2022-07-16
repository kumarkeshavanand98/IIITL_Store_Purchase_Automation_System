<style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 5px 11px;
    border-radius: 50%;
    color: #000000b3;
}
    .img{
		width: 50px;
		
	}
	.bg-blue{
	background:#1F242A	;
}
</style>

<nav class="navbar navbar-dark bg-primary fixed-top " style="padding:0;">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" style="display: flex;">
  			
      <a href="index.php?page=home"><img src="logo.png"  class="img"  ></a>
  		
  		</div>
      <div class="col-md-4 float-left text-white">
        <large><b>IIITL Store and Purchase Automation System</b></large>
      </div>
	  	<div class="col-md-2 float-right text-white">
	  		<a href="ajax.php?action=logout" class="text-white"><?php echo $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a>
	    </div>
    </div>
  </div>
  
</nav>