<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/Tview.php');
include('includes/on.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
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
<!-- status  -->



<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
<div class="panel panel-info">
   
<div class="panel-heading">
Electronic Data Interchange Status
<i style="float:right" class="fa fa-search"></i>
<div>
    
<div class="panel panel-info" style="color:green;background-color:lavender;">
   
    
</div>

</div>

</div>
<div class="panel-body">
<div class="form-group">
    <?php
    $sid=$_SESSION['stdid'];
         $sql = "SELECT tblstudents.FullName,infochartstatus.Message,infochartstatus.DateandTime,infochartstatus.id,infochartstatus.StudentId as rid from  infochartstatus join tblstudents on tblstudents.StudentId=infochartstatus.StudentId  order by infochartstatus.id desc ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
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
                    <textarea readonly class="form-control" style="width:450px;height: 50px;background-color: wheat;font-family: cursive;"><?php echo htmlentities($result->Message);?></textarea>
                    On<sup>&nbsp&nbsp<?php echo htmlentities($result->DateandTime);?></sup>
                    
                </li>
                <li class=" col-md-offset-0">
                       <a href="inforchartreplay.php?msgid=<?php echo htmlentities($result->id);?>"><button class="btn btn-primary"><i class="fa fa-send "></i> comment</button> </a>|

                      
                
                </li>
            </ul>
        </div>

        
    </div>
<?php }  }?>
</div>


                               
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>


<!--  status End -->






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
