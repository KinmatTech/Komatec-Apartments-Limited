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
 
$memberr = $pdo->query("SELECT COUNT(*) as sum FROM users"); 
$volumer = $pdo->query("SELECT COUNT(*) as sum FROM `volume`");
$incomer = $pdo->query("SELECT sum(amount) as sum FROM `income`");
$paperr = $pdo->query("SELECT COUNT(*) as sum FROM `paper`");

$member = $memberr->fetch(PDO::FETCH_ASSOC); 
$booking_date = $volumer->fetch(PDO::FETCH_ASSOC);
$income = $incomer->fetch(PDO::FETCH_ASSOC);
$paper = $paperr->fetch(PDO::FETCH_ASSOC);

include ('header.php');
?>


    

         <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $member['sum'] ?></div>
                                    <div>Total Members!</div>
                                </div>
                            </div>
                        </div>
                        <a href="memberview.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
				 <div class="col-lg-3 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-credit-card fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $paper['sum'] ?></div>
                                    <div>Total Papers</div>
                                </div>
                            </div>
                        </div>
                        <a href="paperview.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $volume['sum'] ?></div>
                                    <div>Total Volumes!</div>
                                </div>
                            </div>
                        </div>
                        <a href="volumeview.php">
                            <div class="panel-footer">
                            	<span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">‎<?php echo $currency.$income['sum'] ?></div>
                                    <div>Total Income</div>
                                </div>
                            </div>
                        </div>
                        <a href="incview.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
               
            </div>

            <!-- /.row -->
            <div class="wrapper">
                <div class="panel-body" style="width: 100%; float: left;">
                        <table class="table" width="97%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                           <th scope="col">Transactions for Last 30 days</th>
                          </tr>
                          <tr class="inner">
                            <td ><canvas id="myChart" height="400px" width="800"></canvas></td>
                          </tr>  
                        </table>
                </div>  
			</div>
        </div>
        <!-- /#page-wrapper -->
<?php
function income($today,$pdo) {
	$sites = $pdo->query("SELECT sum(amount) as sum FROM `income` WHERE date LIKE '%$today%'");
	$sites = $sites->fetch(PDO::FETCH_ASSOC);
	return $sites['sum'];
}

function expenses($today,$pdo) {
	$sites = $pdo->query("SELECT sum(amount) as sum FROM expense WHERE date LIKE '%$today%'");
	$sites = $sites->fetch(PDO::FETCH_ASSOC);
	$site = $sites['sum'];
	return $site;	
}

$income = '"'.income( date('m/d/Y', (strtotime(date('m/d/Y'))-((29*60*60*24)))),$pdo).'"';
$dates = '"'.date('Y-m-d', strtotime(date('Y-m-d')) - (29*60*60*24) ).'"';	
		
for ($i = 28; $i >= 1; $i--) {
	$income .= ',"'.income( date('m/d/Y', (strtotime(date('m/d/Y'))-($i*60*60*24)) ) ,$pdo).'"';
	$dates .= ',"'.( date('Y-m-d', (strtotime(date('Y-m-d'))-($i*60*60*24)) ) ).'"';	
}
$dates .= ',"'.date('Y-m-d').'"';
$income .= ',"'.income(date('m/d/Y'),$pdo).'"';

$expenses = '"'.expenses( date('Y-m-d', (strtotime(date('Y-m-d'))-((29*60*60*24)))) ,$pdo).'"';
for ($i = 28; $i >= 1; $i--) {
	$expenses .= ',"'.expenses( date('Y-m-d', (strtotime(date('Y-m-d'))-($i*60*60*24)) ) ,$pdo).'"';
}
$expenses .= ',"'.expenses(date('Y-m-d'),$pdo).'"';

?>

<script>
//current year income / expense	
var barChartData3 = {
		labels : [<?php echo $dates; ?>],
		datasets : [
			{
				label: "Expenses",
				fillColor : "rgba(220,0,0,0.2)",
				strokeColor : "rgba(220,0,0,1)",
				pointColor : "rgba(220,0,0,1)",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(220,220,220,1)",
				data : [<?php echo $expenses; ?>]
			} ,
			{
				label: "Income",
				fillColor : "rgba(0,120,0,0.2)",
				strokeColor : "rgba(0,120,0,1)",
				pointColor : "rgba(0,320,0,1)",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(220,220,220,1)",
				data : [<?php echo $income; ?>]
			} 
		]

	}
	window.onload = function(){
		var ctx = document.getElementById("myChart").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData3, {
			responsive : true
		});
	}	 

	
</script>
<?php
 include ('footer.php');
 ?>