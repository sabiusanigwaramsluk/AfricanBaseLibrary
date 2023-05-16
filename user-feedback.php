<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/UFB.php');
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
<script>
// function for get student name
function getstudent() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_student.php",
data:'studentid='+$("#studentid").val(),
type: "POST",
success:function(data){
$("#get_student_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function getbook() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_book.php",
data:'bookid='+$("#bookid").val(),
type: "POST",
success:function(data){
$("#get_book_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script> 
<style type="text/css">
 .error{
    background: #F2DEDE;
    color:  #A94442;
    padding: 10px;
    width: 95%;
    border-radius: 5px;
    margin-right: 20px auto;
    
}

.success{
    background: #D4EDDA;
    color:  #40754C;
    padding: 10px;
    width: 95%;
    border-radius: 5px;
    margin-right: 20px auto;
    
}
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
            <div class="col-md-12 ">
                <h4 style="color:darkred"  class="header-line">User feedback</h4>
                <sup style="color:back;font-size: 12px;">Note:</sup><sub style="color:green">Make sure user Id Is correct in capital letter</sub>
                
                            </div>
                        </div>

<?php if (isset($_GET['error']))  { ?>
        <p class="error"><?php echo $_GET['error'];  ?></p>
    <?php }  ?>
        
   <?php if (isset($_GET['success']))  { ?>
        <p class="success"><?php echo $_GET['success'];  ?></p>
    <?php }  ?>


             
               
<div class="col-md-8">

    <form action = "feedback-checkup.php" method="POST">

<div class="form-group">
<label>Roll ID Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" placeholder="ELS/23/STD/0000" name="studentid" id="studentid" onBlur="getstudent()" autocomplete="off"  />
</div>

<div class="form-group">
<span id="get_student_name" style="font-size:16px;"></span> 
</div>


   <label>Message<span style="color:red;">*</span></label>

    <textarea placeholder="write your feedback here......." class="form-control" style="width:736px; height: 200px;" name="massage" maxlength="200" required ></textarea><br>

 <button type="submit"  class="btn btn-info"><i style="color:green" class="fa fa-send"></i> SEND </button> 

    </form>
                
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
