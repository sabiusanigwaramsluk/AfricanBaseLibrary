<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/index.php');
include('includes/on.php');
if($_SESSION['login']!=''){
$_SESSION['login']='';
}
if(isset($_POST['login']))
{
  //code for captach verification
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
        echo "<script>alert('Incorrect verification code');</script>" ;
    } 
        else {
$email=$_POST['emailid'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password,StudentId,Status FROM tblstudents WHERE EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
 foreach ($results as $result) {
 $_SESSION['stdid']=$result->StudentId;
if($result->Status==1)
{
$_SESSION['login']=$_POST['emailid'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else {
echo "<script>alert('Your Account Has been blocked .Please contact admin');</script>";

}
}

} 

else{
echo "<script>alert('Invalid Details');</script>";
}
}
}
?>

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
    <link href="assets/css/custome.css" rel="stylesheet" />
    <link href="assets/css/normalize.css" rel="stylesheet" />
    <link href="assets/css/skeleton.css" rel="stylesheet" />
   
   <style type="text/css">
       .row p i{
        color: wheat;
       }
   </style>

    

</head>
<body>
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->


<!-- cover -->


<div class="row">
    <div class="form-group">
        
    <div id="hero" style="background-image: url(admin/assets/img/3.jpg);">
        <div class="container">
            <div class="row">
                    <div class="six columns">
                        <div class="hero-content">
                                <h2 id="learn">Learn Something Today</h2>
                                <p class="tagline"> Special Offer, any course free.</p>
                                <form action="#" id="search" method="post" class="form">
                                    <input class="u-full-width" type="text" placeholder="What Do You Want To Learn? " id="search-course">
                                    <input style="background-image: url(assets/img/mglass.png);" type="submit" id="submit-search-course" class="submit-search-course" autocomplete="off" >
                                </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="main-bar">
        <div class="container">
            <div class="row">
                    <div class="four columns icon icon1" style="background-image:url(assets/img/icon1.png);">
                        <p>20,000 online books &nbsp&nbsp<i class="fa fa-book"></i><i class="fa fa-good"></i> <br>
                        Learn new skills</p>
                    </div>
                    <div class="four columns icon icon2" style="background-image:url(assets/img/icon2.png);">
                        <p>Expert Instructors &nbsp<i class="fa fa-random"></i><br>
                        Learn with different teach styles</p>
                    </div>
                    <div class="four columns icon icon3" style="background-image:url(assets/img/icon3.png);">
                        <p>Lifetime access &nbsp<i class="fa fa-sliders"></i><br>
                        learn at your own pace</p>
                    </div>
            </div>
        </div>

    </div>

    

    </div>
</div>


<!-- cover -->


      
<div class="panel-heading"></div>
    



 <div class="row">



                        <div class="col-md-2 col-sm-3 col-xs-6">
                      <div style="background-image: url(assets/img/african.jpg);background-repeat: no-repeat;background-position: center" class="alert alert-warning back-widget-set text-center">
                            <i class="fa fa-file-world fa-2x"></i>


                            <h3><sup>54</sup> <br><sub>Countries in</sub>   </h3>
                           <p style="color:#fff" >African Contnent</p> 
                        </div>
                    </div>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                      <div class="alert alert-danger back-widget-set text-center">
                            <i class="fa fa-file-archive-o fa-2x"></i>
<?php 
$sql5 ="SELECT id from tblBrand WHERE Status=1";
$query5 = $dbh -> prepare($sql5);
$query5->execute();
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$listdcats=$query5->rowCount();
?>

                            <h3><?php echo htmlentities($listdcats);?> </h3>
                           Brand Available
                        </div>
                    </div>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                      <div class="alert alert-danger back-widget-set text-center">
                            <i class="fa fa-file-archive-o fa-2x"></i>
<?php 
$sql5 ="SELECT id from tblBrand WHERE Status=1";
$query5 = $dbh -> prepare($sql5);
$query5->execute();
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$listdcats=$query5->rowCount();
?>

                            <h3><?php echo htmlentities($listdcats);?> </h3>
                           Brand Available
                        </div>
                    </div>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                      <div class="alert alert-danger back-widget-set text-center">
                            <i class="fa fa-file-archive-o fa-2x"></i>
<?php 
$sql5 ="SELECT id from tblBrand WHERE Status=1";
$query5 = $dbh -> prepare($sql5);
$query5->execute();
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$listdcats=$query5->rowCount();
?>

                            <h3><?php echo htmlentities($listdcats);?> </h3>
                           Brand Available
                        </div>
                    </div>

                       <div class="col-md-2 col-sm-3 col-xs-6">
                      <div class="alert alert-danger back-widget-set text-center">
                            <i class="fa fa-file-archive-o fa-2x"></i>
<?php 
$sql5 ="SELECT id from tblBrand WHERE Status=1";
$query5 = $dbh -> prepare($sql5);
$query5->execute();
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$listdcats=$query5->rowCount();
?>

                            <h3><?php echo htmlentities($listdcats);?> </h3>
                           Brand Available
                        </div>
                    </div>

            <div class="col-md-2 col-sm-3 col-xs-6">
                      <div style="background-image: url(assets/img/african.jpg);background-repeat: no-repeat;background-position: center" class="alert alert-warning back-widget-set text-center">
                            <i class="fa fa-file-world fa-2x"></i>


                             <h3><sup>54</sup> <br><sub>Countries in</sub>   </h3>
                           <p style="color:#fff" >African Contnent</p> 
                        </div>
                    </div>
             </div>

             <!-- comment section -->
             <sup style="float:left; margin-left: 12px;font-weight: bolder;">What people says&nbsp......................................</sup>


<?php
$sql = "SELECT * from comment order by id desc";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?> 
<div class="col-md-6 col-sm-6">  
<div class="container">       
        <div class="panel-heading">
            <label><i style="color:magenta;" class="fa fa-user"></i><?php echo htmlentities($result->FullName);?></label>
            <sup style="color: darkcyan;">&nbsp&nbsp&nbsp<?php echo htmlentities($result->Email);?></sup>
            <sub>&nbsp&nbsp&nbsp<?php echo htmlentities($result->reportTime);?></sub>
            <textarea style="font-family:cursive;border:none;background-color: wheat;" readonly class="form-control"><?php echo htmlentities($result->Comment);?></textarea>
            
        </div>
    </div>
</div>
        <?php } } ?>
        <?php 
        if(isset($_POST['cmt']))
{
$email=$_POST['email'];
$fullname=$_POST['fullname'];
$comment=$_POST['comment'];
$sql="INSERT INTO  comment(Email,FullName,Comment) VALUES(:email,:fullname,:comment)";
$query = $dbh->prepare($sql);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
$query->bindParam(':comment',$comment,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
   // echo "<script>alert('comment send');</script>";

header('location:index.php');
}
}
else 
{
   // echo "<script>alert('comment not send');</script>";

header('location:index.php');
}
?>
        <div class="col-md-8 col-sm-6">
            <div class="container">
                Leave your comment:
                <form method="post">
                <input style="font-family: cursive;" class="form-group" type="text" name="email" placeholder="EmailAddress" autocomplete="off" maxlength="25" required>
                <input style="font-family: cursive;" class="form-group" type="text" name="fullname" placeholder="Fullname" autocomplete="off" maxlength="25" required>
                 <input style="font-family: cursive;" class="form-group" type="text" name="comment" placeholder="Comment" autocomplete="off" maxlength="50" required>
                <button style="font-family: cursive;" class="btn btn-success" type="submit" name="cmt">submit</button>
            </form>
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
  
    </div>
    <div class="panel-heading"></div>
     <!-- CONTENT-WRAPPER SECTION END-->
 <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
