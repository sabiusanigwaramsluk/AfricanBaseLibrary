<?php 
session_start();
include('includes/config.php');
include('includes/AFH.php');
include('includes/on.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
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
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Online Library Management System | User Dictionary</title>
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
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 style="color:darkred; font-style: italic;" class="header-line">Our Ask for Help</h4>
    </div>


        </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Ask for help collection    &nbsp&nbsp&nbsp&nbsp<sub style="color:darkred">Just search for a keyword</sub>
                         
                          <sub style="color:green;float: right;">Search for your help</sub>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Question ID</th>
                                            <th>Question</th>
                                            <th>Creation Date</th>
                                            <th>Updation Date</th>
                                            <th>Action &nbsp<sub style="color:green">Click <span style="color:red">View</span> to show the answer</sub></th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql = "SELECT * from askJob where Question like '%$ask%' ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr class="odd gradeX">
                                            <td  class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($result->QuestionId);?></td>
                                              <td class="center"><?php echo htmlentities($result->Question);?></td>
                                             <td class="center"><?php echo htmlentities($result->reportTime);?></td>
                                             <td class="center"><?php echo htmlentities($result->UpdateTime);?></td>
                  
                                            <td class="center">
  <a href="ask-For-Help-View.php?fbv=<?php echo htmlentities($result->id);?>"><button class="btn btn-primary"><i class="fa fa-eye "></i> View</button> 
     <a href="ask-For-Help-download.php?fbv=<?php echo htmlentities($result->id);?>"><button class="btn btn-success"><i style="color:lawngreen;" class="fa fa-download "></i>Download Now</button> 
                                         
                                          
                                            </td>
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
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
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
