<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | IIITL Store and Purchase Automation System</title>
 	<link rel="icon" href="stationary_logo.png"/>

<?php include('./header.php'); ?>
<?php include('./db_connect.php'); ?>
<?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['setting_'.$key] = $value;
		}
?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		position: absolute;
		right:0;
		padding-top:20px;
		width:30%;
		height: calc(100%);
		background:#E8EDF2;
		display: flex;
		align-items: center;
		flex-direction: column;
		

		
	}
	#login-left{
		position: absolute;
		left:0;
		width:70%;
		height: calc(100%);
		background:#E8EDF2;
		display: flex;
		align-items: center;
	}
	#login-right .card{
		margin: auto
	}
    .center {
		
		width: 100%;
		height: 725px;
  
}
	.admin{
		top: 20px;
		border-radius:2px;
        
		
	}
	.card{
		box-shadow: 0 50px 50px -50px darkslategray;
	}
	div.card div.card-body button{
		color: white;
		background-color: #1c1c1e;
		margin-top:40px;
		border:none;
		outline: none;
		border-radius:5px;
		
	}
	/* @media (min-width: 481px) and (max-width: 786px){
		#main #login-left, #login-right{
			display: block;
			width: 100%;
			float:left;
			position: relative;
		}
		#main #login-right{
			display: block;
			width: 100%;
			float:left;
			padding:15px;
			position: relative;
		}
		#main .admin-logo img{
		 
		 margin-left:38%;
		 margin-bottom:2%;
		
		
	  }
		#main .btn{
			
			width:auto;

		}
		 #main .admin{
		  text-align:center;
		
	  }
		#main iiit-img img{
			width:50px;
			height:auto;
		}
	} 
	*/
	@media (max-width: 600px){
      #main #login-left {
        width:100%;
		
		display:block;
		position: relative;
	  }
	  #main .iiit-img{
		  width:auto;
		  height:50%;
	  
	  }
	  #main .iiit-img img{
		  
		  height:auto;
	  
	  }
	  #main #login-right{
        width:100%;
		padding:20px;
		display:block;
		position: relative;
	  }
	  #main .admin-logo img{
		 
		 margin-left:38%;
		 margin-bottom:2%;
		 padding:5%;
		
	  }
	  #main .admin{
		  text-align:center;
		
	  }
	  #main .btn{
		  width:auto;
	}
	
	}
	@media (min-width: 601px)and (max-width:786px) {
		#login-left {
	
        height:100%;
			
		}
		#main .iiit-img{
		  width:auto;
		  height:100%;
	  
	  }
	  #main .iiit-img img{
		  
		  height:100%;
	  
	  }
		#login-right {
			padding: 15px;
			height:100%;
			
		}
		#login-right .card-body{
			margin-bottom:35px;
			padding:10px;
		}
		 #main .admin{
		  text-align:center;
		
	  }
	  
	  #main .btn{
		  width:auto;
	}
}
	@media (min-width: 787px){
	
		#login-left {
			display: block;
			height:100%;
			
			
		}
		#main .iiit-img{
		  width:auto;
		  height:100%;
	  
	  }
	  #main .iiit-img img{
		  
		  height:100%;
	  
	  }
		
		#login-right .card-body{
			margin-bottom:35px;
			padding:10px;
			
			
			
			
		}
		#login-right .card{
			width:100%;
		}
		#main .admin{
		  text-align:center;
		
	  }
	  
	  #main login-right .btn{
		  width:auto;
	}
		
	}

	
	
	
</style>

<body>


  <main id="main" class=" bg-dark">
  		<div id="login-left">
  			
			<div class="iiit-img">
  				<img src="store.jpg"  class="center"  >
				</div>
  			
  		</div>
  		<div id="login-right">
		  <div class="admin" >
		     <h4><b>IIITL Store and Purchase Automation System</b></h4>
		   </div>
		<div class="admin-logo" >
		     <img src="admin_logo.png" width="100px" >
		   
		   </div>
		   
  			<div class="card col-md-8">
  				<div class="card-body">
  					<form id="login-form" >
  						<div class="form-group">
							  <i class="fa fa-user icon"></i>
  							<label for="username" class="control-label">Username <span class="text-danger">*</span></label>
  							<input type="text" placeholder="Enter UserID"id="username" name="username" class="form-control">
  						</div>
  						<div class="form-group">
						  <i class="fa fa-key icon"></i>
  							<label for="password" class="control-label">Password <span class="text-danger">*</span></label>
  							<input type="password" placeholder="Enter Password"id="password" name="password" class="form-control">
  						</div>
  						<center><button class="btn btn-primary pull-right btn-wave col-md-4 ">Login</button></center>
  					</form>
  				</div>
  			</div>
  		</div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>