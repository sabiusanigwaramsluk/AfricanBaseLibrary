<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/student_d.php');
include('includes/on.php');

if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{?>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
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
    <!-- CUSTOM BACKGROUND STYLE -->
    <link href="assets/css/custom.css" rel="stylesheet" />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 style="color:darkred"  class="header-line">User DASHBOARD <?php echo htmlentities($issuedbooks);  ?></h4>
                <div class="row">
                                    <?php 
$sid=$_SESSION['stdid'];
$sql="SELECT StudentId,FullName,EmailId,MobileNumber,RegDate,UpdationDate,Status from  tblstudents  where StudentId=:sid ";
$query = $dbh -> prepare($sql);
$query-> bindParam(':sid', $sid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<div class="form-group">
<label style="float:right;font-family:cursive ;"><?php echo htmlentities($result->StudentId);?><br>
 <?php echo htmlentities($result->FullName);?><br>

  </label>

</div>
</div>

<!--
<div class="form-group">
<label style="float:right">Profile Status :
<?php if($result->Status==1){?>
<span style="color: green">Active</span>
<?php } else { ?>
<span style="color: red">Blocked</span>
</label>
<?php }?>

<?php }  } ?>
</div>
         -->          
                            </div>

        </div>
          
             <div class="row">



                        <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-danger back-widget-set text-center">
                            <i class="fa fa-comments fa-2x"></i>
<?php
$sid=$_SESSION['stdid']; 
$sql5 ="SELECT * from userfeedback WHERE StudentId=:sid";
$query5 = $dbh -> prepare($sql5);
$query5->bindParam(':sid',$sid,PDO::PARAM_STR);
$query5->execute();
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$yf=$query5->rowCount();
?>

                            <h3><?php echo htmlentities($yf);?> </h3>
                           Your Feedback
                        </div>
                    </div>
             


                           <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-info back-widget-set text-center">
                            <i class="fa fa-question fa-2x"></i>
<?php 
$sql1 ="SELECT * from infochartstatus";
$query1 = $dbh -> prepare($sql1);
$query1->bindParam(':sid',$sid,PDO::PARAM_STR);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$info=$query1->rowCount();
?>

                            <h3><?php echo htmlentities($info);?> </h3>
                            AskInfo Topics
                        </div>
                    </div>


                     <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-success back-widget-set text-center">
                            <i class="fa fa-user fa-2x"></i><i class="fa fa-question fa-2x"></i>
<?php 
//$sid=$_SESSION['stdid'];
$sql5 ="SELECT StudentId from infochartstatus WHERE StudentId=:sid";
$query5 = $dbh -> prepare($sql5);
$query5->bindParam(':sid', $sid, PDO::PARAM_STR);
$query5->execute();
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$ya=$query5->rowCount();
?>

                            <h3><?php echo htmlentities($ya);?> </h3>
                           Your AskInfo Topics
                        </div>
                    </div>



                     <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-danger back-widget-set text-center">
                            <i class="fa fa-user fa-2x"></i>
<?php 
$sid=$_SESSION['stdid'];
$sql="SELECT StudentId,Status from  tblstudents  where StudentId=:sid ";
$query = $dbh -> prepare($sql);
$query-> bindParam(':sid', $sid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
if($result->Status==1){ ?> 
<h3 style="color: green">Active</h3>
<?php } else { ?>
<h3 style="color: red">Blocked</h3>
<?php } } }?>



                          
                          <label>Profile Status:</label>
                        </div>
                    </div>



        </div>








             <div class="row">

              <div class="col-md-10 col-sm-8 col-xs-12 col-md-offset-1">
                    <div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel" >
                   
                    <div class="carousel-inner">
                        <div class="item active">

                            <img src="admin/assets/img/3.jpg" alt="" />
                           
                        </div>
                        <div class="item">
                            <img src="admin/assets/img/6.jpg" alt="" />
                          
                        </div>
                        <div class="item">
                            <img src="admin/assets/img/4.jpg" alt="" />
                           
                        </div>
                        <div class="item">
                            <img src="admin/assets/img/2.jpg" alt="" />
                           
                        </div>
                        <div class="item">
                            <img src="admin/assets/img/5.jpeg" alt="" />
                           
                        </div>
                        <div class="item">
                            <img src="admin/assets/img/1.jpg" alt="" />
                           
                        </div>

                    </div>
                    <!--INDICATORS-->
                     <ol class="carousel-indicators">
                        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example" data-slide-to="1"></li>
                        <li data-target="#carousel-example" data-slide-to="2"></li>
                          <li data-target="#carousel-example" data-slide-to="3"></li>
                            <li data-target="#carousel-example" data-slide-to="4"></li>
                              <li data-target="#carousel-example" data-slide-to="5"></li>
                    </ol>
                    <!--PREVIUS-NEXT BUTTONS-->
                     <a class="left carousel-control" href="#carousel-example" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
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
