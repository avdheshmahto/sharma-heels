<?php $this->load->view("indexheader.php"); ?>
		
		
		<form method="post" action="master/Item/dashboard" id="tbl">
		<font color="#FF0000" style="display:marker"><b><?php echo $this->session->flashdata('error1');?></b> </font>
		<font color="#FF0000" style="display:marker"><b><?php echo $this->session->flashdata('error');?></b> </font> 
		<h2 id="login"><strong>Welcome</strong>, Please Login Here </h2>
		
			<div class="form-group">
				<input type="text" name="username" placeholder="Username" class="form-control" required>
			</div>                        
			<div class="form-group">
				<input type="password" placeholder="Password" class="form-control" name="password" required>
			</div>
			
			<div class="form-group">
				<input type="submit" class="btn btn-primary btn-block" value="Login">
			</div>
			<p class="text-center"><a  onclick="show();">Forgot your password?</a></p>                        
		</form>
		
		
		
		<form method="post" action="master/Item/forgotPassword" id="tbl1" style="display:none"> 
		                    
		<h2  >Forget Password</h2>
			<div class="form-group">
				<input type="email" name="email_id" placeholder="Email Id" class="form-control" required>
			</div>                        
			
			
			<div class="form-group">
				<input type="submit" class="btn btn-primary btn-block" value="Submit">
			</div>
			<p class="text-center"><a href="index">Login</a></p>                        
		</form>
		
	</div>
</div>
<?php

$this->load->view("indexfooter.php");
?>

<script>
function show()
{

document.getElementById("tbl").style.display="none";
document.getElementById("tbl1").style.display="";
document.getElementById("forgotDisplay").style.display="";
document.getElementById("loginDisplay").style.display="none";
document.getElementById("loginA").style.display="";


}

</script>