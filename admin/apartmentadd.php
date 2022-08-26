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
                    <h1 class="page-header">Add Paper</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
                <div class="col-md-10 col-md-offset-1">
				
				
	

		<?php

if($_POST)
{

$volume = $_POST["volume"];
$title = $_POST["title"];
$detail = str_replace("'", '', $_POST["detail"]);
$authors = $_POST["authors"];
$status = $_POST["status"];
$user = $usid['id'];
$date = $_POST["date"];


$bgimg="";

// IMAGE UPLOAD //////////////////////////////////////////////////////////
if(isset($_FILES['bgimg']['name'])){
	$folder = "img/paper/";
	$extention = strrchr($_FILES['bgimg']['name'], ".");
	$bgimg = $_FILES['bgimg']['name'];
	//$bgimg = $new_name.'.jpg';
	$uploaddir = $folder . $bgimg;
	move_uploaded_file($_FILES['bgimg']['tmp_name'], $uploaddir);
}

$res = $pdo->exec("INSERT INTO `apartments` SET volume='".$volume."', title='".$title."', description='".$detail."', user='".$user."',`authors`='".$authors."',`status`='".$status."', date='".$date."', doc='".$bgimg."'");
if($res){

echo "<div class='alert alert-success alert-dismissable'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>	

Paper Added Successfully!

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
				
				
				
				
				
				    <form action="" method="post" enctype="multipart/form-data" >
		
                    <div class="form-group">
					
                        <label>Select Category</label>
                        
                        <select name="volume" class="form-control">
                        <option value="0">Please Select a Category</option>
                        <?php
    
						$ddaa = $pdo->query("SELECT id, title FROM volume ORDER BY id desc");
							while ($data = $ddaa->fetch(PDO::FETCH_ASSOC))
							{									
						 echo "<option value='$data[id]'>$data[title]</option>";
							}
						?>
											
                                        </select><br/>
                    
                    </div>
                
                <div class="form-group">
					
					<label>Title</label><br/>
                 	<input type="text" name="title" style="width:200px; height: 40px;" /><br/><br/>
				</div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Abstract</label><br/><br/>
                  <textarea name="detail" value="" class="form-control"> </textarea>
                </div>
			
              	<div class="form-group">
					
					<label>Authors</label><br/>
                 	<input type="text" name="authors" style="width:200px; height: 40px;" /><br/><br/>
				</div>
                
                <div class="form-group">
					
                    <label>Status</label>
                    
                    <select name="status" class="form-control">
                    	<option value="Pending">Pending</option>
                        <option value="Rejected">Rejected</option>
                        <option value="In Review">In Review</option>
                        <option value="Correction Needed">Correction Needed</option>
                        <option value="Awaiting Publication">Awaiting Publication</option>
                        <option value="Published">Published</option>
                    </select><br/>
                
                </div>
				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Upload Paper</label><br/><br/>
				  <input name="bgimg" type="file" id="bgimg" />
                </div>
				
                <div class="form-group">
					
					<label>Date</label><br/>
                 	<input type="date" name="date" style="width:200px; height: 40px;" /><br/><br/>
				</div>
				
					<input type="submit" class="btn btn-lg btn-success btn-block" value="ADD">
			    	</form>
                </div>
						
						
						
						
						
				
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