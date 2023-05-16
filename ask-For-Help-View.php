<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/AFHV.php');
include('includes/on.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Answer View</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- CUSTOM BACKGROUND STYLE -->
    <link href="assets/css/custom.css" rel="stylesheet" />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra">
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 style="color:darkred" class="header-line">Answer  View</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
<div class="panel panel-info">
<div class="panel-heading">
Requested Information
</div>
<div class="panel-body">
<form role="form" method="post">

<?php 
$fbv=intval($_GET['fbv']);
$sql = "SELECT * from  askJob where id=:fbv";
$query = $dbh -> prepare($sql);
$query->bindParam(':fbv',$fbv,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>   
    <div class="form-group">
<label>Question:&nbsp</label>
  
<?php echo htmlentities($result->Question);?><br>

<label style="font-size:12px;color: chocolate;">Answer</label><i style="color:green" class="fa fa-angle-down"></i>&nbsp <sub style="color:green">You can copy the answer</sub>
    <textarea class="form-control" style="width:520px; height:150px; font-family: cursive;font-weight: lighter;background: wheat; font-style: italic;"><?php echo htmlentities($result->Answer);?></textarea><br>
<?php }} ?>
<button type="submit" class="btn btn-success" id="submit"><a style="color:white;" href="ask-For-Help.php">Thanks </a> </button>
</div>


                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>