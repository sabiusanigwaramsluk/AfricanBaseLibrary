<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/comment.php');
include('includes/on.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
    if($_GET['msgid']){

if(isset($_POST['replay'])){
  
    $msg=$_POST['msg']; 
    $stdid=$_SESSION['stdid'];
    $msgid=$_GET['msgid'];  
  

 $sql = "INSERT INTO infochartreplay(MessageId,StudentId,Replay) VALUES (:msgid,:stdid,:msg)";
$query=$dbh->prepare($sql);
$query->bindParam(':msgid', $msgid,PDO::PARAM_STR);
$query->bindParam(':stdid', $stdid,PDO::PARAM_STR);
$query->bindParam(':msg', $msg,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId){
    
  //  $_SESSION['msg']="replay send sucessfully";
header('location:Status-View.php');
}
else{

   $_SESSION['error']="Something went wrong. Please try again";
header('location:inforchartreplay.php');


}  
}
}
//
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
{               
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | <?php echo htmlentities($result->FullName);?> replay bar</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- status STYLE  -->
    <link href="assets/css/status.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- CUSTOM BACKGROUND STYLE -->
    <link href="assets/css/custom.css" rel="stylesheet" />

    <style type="text/css">
        sup{
            font-size:10px;
            color:darkmagenta;
            font-weight: bold;
        }
        sub{
            font-family: monospace;
        }
    </style>
</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 style="color:darkred"  class="header-line"><i class="fa fa-certificate"></i> <?php echo htmlentities($result->FullName);?> </h4>

                <div class="row">
    <?php if($_SESSION['error']!="")
    {?>
<div class="col-md-6">
<div class="alert alert-danger" >
 <strong>Error :</strong> 
 <?php echo htmlentities($_SESSION['error']);?>
<?php echo htmlentities($_SESSION['error']="");?>
</div>
</div>
<?php } ?>
<?php if($_SESSION['msg']!="")
{?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['msg']);?>
<?php echo htmlentities($_SESSION['msg']="");?>
</div>
</div>
<?php } ?>
<?php if($_SESSION['updatemsg']!="")
{?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['updatemsg']);?>
<?php echo htmlentities($_SESSION['updatemsg']="");?>
</div>
</div>
<?php } ?>


   <?php if($_SESSION['delmsg']!="")
    {?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['delmsg']);?>
<?php echo htmlentities($_SESSION['delmsg']="");?>
</div>
</div>
<?php } ?>

</div>
<!-- replay  -->



<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
<div class="panel panel-info">
   
<div class="panel-heading">
InfoChart Status Replay
<a style="float:right;text-decoration-line:none;"  href="Status-View.php"><i style="font-size: 22px;color: black;" class="fa fa-angle-right"></i></a>
<div>
    
<div class="panel panel-info" style="color:green;background-color:lavender;">
   
    
</div>

</div>

</div>
<div class="panel-body">
<div class="form-group">
    <?php
    $sid=$_SESSION['stdid'];
    $msgid=$_GET['msgid'];
         $sql = "SELECT tblstudents.FullName,infochartstatus.Message,infochartstatus.DateandTime,infochartstatus.id,infochartstatus.StudentId as rid from  infochartstatus join tblstudents on tblstudents.StudentId=infochartstatus.StudentId  WHERE infochartstatus.id=:msgid";
$query = $dbh -> prepare($sql);
$query->bindParam(':msgid', $msgid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   
 
   ?>  



    <div style="background-color:whitesmoke;" class="panel panel-info">

        <div >
            <ul style="list-style:none">
                <li class=" col-md-offset-0">
                    <sub><i class="fa fa-user"> </i><?php echo htmlentities($result->FullName);?></sub>
                </li>
                <li class=" col-md-offset-0">
                    <textarea readonly class="form-control" style="width:450px;height: 50px;background-color: wheat;font-family: cursive;"><?php  echo htmlentities($result->Message);?></textarea>
                    On<sup>&nbsp&nbsp<?php echo htmlentities($result->DateandTime);?></sup>
                    
                </li>
                <form method="post">
                <li class="col-md-offset-1">
                    <textarea style="width: 420px; " class="form-control" type="text" name="msg" autocomplete="off" required ></textarea>
                </li><br>
                <li class="col-md-offset-1">
                       <button type="submit" name="replay" class="btn btn-primary"><i class="fa fa-send "></i> Replay</button> </a>
                       <hr>
                </li>
            </form>
            </ul>
        </div>

        
    </div>
<?php }  }?>
</div>

<!--  replay End -->   
                            </div>
                           
                                <label>Topic: </label>
                               <samp>'<?php echo htmlentities($result->Message);?>'</samp> <br>
                                 <span style="font-family: serif;color: darkred;">says:</span>&nbsp
                                 <sub style="font-family:monospace;"> <?php echo htmlentities($result->FullName);?></sub>

                        <hr>
                            <label>Comment:</label>
                           

                                <!-- second  infochartreplay(MessageId,StudentId,Replay)-->

                            
<div class="panel-body">
<div class="form-group">
    <?php
    $sid=$_SESSION['stdid'];
    $msgid=$_GET['msgid'];
         $sql = "SELECT * FROM infochartstatus,infochartreplay,tblstudents WHERE infochartstatus.id=infochartreplay.MessageId AND infochartreplay.MessageId =:msgid AND tblstudents.StudentId=infochartreplay.StudentId ";
$query = $dbh -> prepare($sql);
$query->bindParam(':msgid', $msgid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   

   ?>           


   
        <div >
            <ul style="list-style:none">
              
                <li class="col-md-offset-1">
                     <sub><i class="fa fa-user"> </i><?php echo htmlentities($result->FullName);?></sub>
                    <textarea readonly style="width: 420px;color:darkcyan;background-color:lavender; " class="form-control" type="text" autocomplete="off" ><?php  echo htmlentities($result->Replay);?></textarea>
                    On<sup>&nbsp&nbsp<?php echo htmlentities($result->DateandTime);?></sup>
                </li>
                
            </ul>
        </div>

        

<?php }  }
else{
?>
<input class="form-control" type="" name="" readonly value="No any responds yet">
<?php }?>
</div>
                                      <!-- second end -->



                        </div>

                            </div>

        </div>
   
    </div>
    </div>








 </div>
</div>

            
    </div>
    </div>
        <?php }} ?>

     <!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE status TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
     <!-- STATUS SCRIPTS  -->
    <script src="assets/js/status.js"></script>
</body>
</html>
<?php } ?>