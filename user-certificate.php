<?php 
session_start();
include('includes/config.php');
include('includes/UC.php');
include('includes/on.php');
error_reporting(0);
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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>ELS | Certificate <?php echo htmlentities($result->StudentId);?> | <?php echo htmlentities($result->FullName);?></title>
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
        strong{

            text-underline-position: under;
            font-weight: bold;
            font-style: oblique;
            

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
                <h4 style="color:darkred" class="header-line"></h4>
                
                            </div>

        </div>
             <div class="row">
           
<div class="col-md-9 col-md-offset-1">
               <div class="panel panel-danger ">
                        <div style="text-align: center; color: black; font-weight: bolder;" class="panel-heading">
                           ELECTRONIC LIBRARY SYSTEM  <br>
                                LIBRARY CERTIFICATE
                        </div>
                        <div style="text-align:center;" class="">
                            <sub style="text-decoration: underline 5px; color:green;font-size: 12px;">This Certificate Is Awarded From To</sub>
                        </div>
                        <div class="panel" style="letter-spacing: 1px; ">
                            <div style="list-style-type: none; display:flex;">
                            <ul style="list-style: none; list-style-type: none">
                                <li>
                            <label>Chief Exacative Officer: </label> 
                            <p style="font-family: cursive;">Sabiu Sani Gwaram<br>
                            B.sc. Comp Sci(SLU)<br>
                            sabiusanigrm@gmail.com<br>
                            08145158016</p>
                        </li>
                    </ul>
                    <ul  style="list-style:none;">
                    
                    
                                <li style="padding-left: 65vh;">
                            <label ><?php echo htmlentities($result->StudentId);?>: </label> 
                            <p style="font-family: cursive;"><?php echo htmlentities($result->RegDate);?><br>
                            <?php echo htmlentities($result->EmailId);?><br>
                            

                        <?php if($result->Status==1){?>
                            <span style="color: green">Active</span>
                                <?php } else { ?>
                                    <span style="color: red">Blocked</span>
                        <?php }?>
                    <br>
                               <?php echo htmlentities($result->MobileNumber);?></p>
                        </li>
                        
                    </ul>
                </div>
                <div style="text-align:center;color: ;">
                    <label>Motto:</label><sub></sub>To Protect The Interest Of Student
                </div>
                        </div><br><br>


                        <div class="panel-body">
                            

<div class="form-group">

<div class="panel" style="text-align: center; color:chocolate;font-size: 22px;font-weight: lighter;font-family: serif;">
        <sub style="text-decoration:underline 2px;">Certificate of Merit</sub>
    </div>
<div class="panel">
    
    <div class="panel">
     <span style="font-family:monospace; word-spacing: 10px;">
        <div style="display:flex;">
        <ul style="list-style: none">
         <li>This is certify that&nbsp <strong><?php echo htmlentities($result->FullName);?></strong>
         
 
            
          has sucessfully served as <strong>Student</strong>
          
    
            in his/her selfless, meritorious and emulation service rendered to the dud, this certificate is awarded as a taken of appreciation for the above organisation<strong>(ELS)</strong> with roll ID <strong><?php echo htmlentities($result->StudentId);?></strong>.
           </li>
       </ul>
    </div>
     
    
</div>

</div>  <br><br> <br><br><br><br>
<div style="display: inline-flex; text-align:center;word-spacing: 4px; font-family: cursive; padding: 0 0 0 30px;">
    <ul style="list-style:none;">
        <li>__________________________________<br> CEO. Electronic Library System</li>
    </ul>
    <ul style="list-style:none; text-align: center;">
        <li><i style="color:red;font-size: 70px;" class="fa fa-certificate"></i> </li>
    </ul>
    <ul style="list-style:none; le ">
        <li>____________________________________<br>Chief Administartor</li>
    </ul>
</div>    


<?php }} ?>
                              

                                    
                           
                        </div>

                            </div>

        </div>

        <div style="float:right" class="panel panel-danger">
            <label>Date Printed:</label>
            <?php 
             echo date("Y/m/d") . "<br/>";

?>
        </div>
        <div class="panel panel-default">
            

        </div>
        
    </div>
    </div>
    <div style="text-align:center">
        <button style="text-align:center; 54px" onclick="window.print();" type="" name="" class="btn btn-primary" id="submit"><i class="fa fa-download"></i> Generate  </button>
    </div>

     <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php 

 }
 ?>
