<?php
require_once('function.php');
dbconnect();
session_start();

if (!is_user()) {
	redirect('index.php');
}

?>

		

<?php
 $user = $_SESSION['username'];
$usid = $pdo->query("SELECT id FROM users WHERE username='".$user."'");
$usid = $usid->fetch(PDO::FETCH_ASSOC);
 $uid = $usid['id'];
 include ('header.php');
 ?>



 
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Member</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
                <div class="col-md-10 col-md-offset-1">
				
				
	

		<?php
$eid = $_GET["id"];

if($_POST)
{

$address = $_POST["address"];
$fullname = $_POST["fullname"];
$phonenumber = $_POST["phonenumber"];
$email = $_POST["email"];
$membership = $_POST["membership"];

///////////////////////-------------------->> Catid  ki 0??
$error = 0;

 

$res = $pdo->exec("UPDATE `users` SET `name`='".$fullname."',`phonenumber`='".$phonenumber."',`address`='".$address."',`email`='".$email."',`membership`='".$membership."' WHERE id='".$eid."'");

	if($res){
		echo "<div class='alert alert-success alert-dismissable'>
	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>	
	
	UPDATED Successfully!
	<meta http-equiv='refresh' content='2; url=memberview.php' />
	
	</div>";
	}else{
		echo "<div class='alert alert-danger alert-dismissable'>
	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>	
	
	Some Problem Occurs, Please Try Again. 
	
	</div>";
	}
 
}
?>
		


	 <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>		
				
<?php
$oldd = $pdo->query("SELECT * FROM users WHERE id='".$eid."'");
$old = $oldd->fetch(PDO::FETCH_ASSOC)
?>								
				
				
				
				    <form action="" method="post">
		
                    
                <div class="form-group">
					
					<label>Full Name</label><br/>
                 	<input type="text" name="fullname" style="width:200px; height: 40px;" value="<?php echo($old['name']) ?>" /><br/><br/>
				</div> 
                
                <div class="form-group">
					
					<label>Address</label><br/>
                 	<input type="text" name="address" style="width:200px; height: 40px;" value="<?php echo($old['address']) ?>" /><br/><br/>
				</div>  
                   
                <div class="form-group">
					
					<label>Phone Number</label><br/>
                 	<input type="text" name="phonenumber" style="width:200px; height: 40px;" value="<?php echo($old['phonenumber']) ?>" /><br/><br/>
				</div>
				
				<div class="form-group">
					
                    <label>Membership</label>
                    
                    <select name="membership" class="form-control">
                    	<option value="<?php echo($old['membership']) ?>"><?php echo($old['membership']) ?></option>
                    	<option value="Author">Author</option>
                        <option value="Editorial Board">Editorial Board</option>
                        <option value="Editor in Chief">Editor in Chief</option>
                    </select><br/>
                
                </div>
				
				<div class="form-group">
					
					<label>Email</label><br/>
                 	<input type="text" name="email" style="width:200px; height: 40px;" value="<?php echo($old['email']) ?>" /><br/><br/>
				</div>
                
							
                <br/>
                
                
					<input type="submit" class="btn btn-lg btn-success btn-block" value="Update">
			    	</form>
						
						
						
						
						
				
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
	    



<script src="js/bootstrap-timepicker.min.js"></script>


<script>
jQuery(document).ready(function(){
    
  
  jQuery("#ssn").mask("999-99-9999");
  
  // Time Picker
  jQuery('#timepicker').timepicker({defaultTIme: false});
  jQuery('#timepicker2').timepicker({showMeridian: false});
  jQuery('#timepicker3').timepicker({minuteStep: 15});

  
});
</script>







<?php
 include ('footer.php');
 ?>