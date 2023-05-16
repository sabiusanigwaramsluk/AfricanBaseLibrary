<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/FRL.php');
include('includes/on.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 
    if(isset($_POST['send']))
    {
      $studentid=strtoupper($_POST['studentid']);
$massage=$_POST['massage'];
$sql="INSERT INTO userfeedback(StudentId,message) VALUES (:student,:massage)";
$query = $dbh->prepare($sql);
$query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
$query->bindParam(':massage',$massage,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId){
    $_SESSION['msg']="Your feedback send sucessfully";
header('location:user-feedback.php');
}
else{
    $_SESSION['error']="Something went wrong. Please try again";
header('location:user-feedback.php');

}    

}  

    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | User Feedback</title>
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
    
    <style type="text/css">
       
        #Rep{
            float: right;
            }
            label {
                font-size:12px;
               color: chocolate;
             }
             #Rep textarea{
                width:400px; 
                height:50px; 
                font-family: cursive;
                font-weight: lighter;
                background: whitesmoke; 
                font-style: italic;
             }
             #Rep sup{
                color: darkcyan;
                font-weight: bold;
             }
             #feed{
                float: left;

             }
             #feed textarea{
                width:400px; 
                height:50px; 
                font-family: cursive;
                font-weight: lighter;
                background: wheat; 
                font-style: italic;
             }
             #feed sup{
                color: darkgoldenrod;
                font-weight: bold;
             }
             
    </style>


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
                <h4 style="color:darkred" class="header-line">Feedback Replay  View</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
<div class="panel panel-info">
<div class="panel-heading">
ELS feedback
</div>
<div class="panel-body">

<?php 
$sid=$_SESSION['stdid'];
$sql = "SELECT * from  tblstudents,userfeedback,feedback_replay where tblstudents.StudentId=userfeedback.StudentId and tblstudents.StudentId=:sid and feedback_replay.msgid=userfeedback.id ";
$query = $dbh -> prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>   
    <div class="form-group">

<!-- feedback mesage -->

<div id="feed">
    <sub><i class="fa fa-user"></i><?php echo htmlentities($result->FullName);?></sub>
    <textarea readonly class="form-control"><?php echo htmlentities($result->message);?></textarea>
    <i class="fa fa-send"></i>  on <sup><?php echo htmlentities($result->reportTime);?></sup>
</div>

<!-- replay -->

<div id="Rep">
   <sub><i class="fa fa-pencil"></i>Admin</sub>
    <textarea readonly class="form-control" style=""><?php echo htmlentities($result->replay);?></textarea>
    <i class="fa fa-send"></i>  on <sup><?php echo htmlentities($result->CreationDate);?></sup>
</div>
<?php }}
else{
        ?>
        <input type="text" class="form-control" value="No Replay yet" readonly>
    <?php } ?>


</div>
</div>


                                                             </div>
                        </div>
                        <div class="form-group">
                        <button class="btn btn-success" ><a  class="btn btn-success" href="dashboard.php">Ok </a></button>&nbsp | <sub style="color:darkmagenta;"> it was helfull</sub> |
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
