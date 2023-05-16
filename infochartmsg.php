<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{

if (isset($_POST['massage'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
}   
    
        $massage = validate ($_POST['massage']);

if (empty($massage)) {
     $_SESSION['error']="Message is requered";
header('location:chart.php');
}
else{
      $id=$_SESSION['stdid'];
      //$id=strtoupper('sid');
$massage=$_POST['massage'];
$sql="INSERT INTO infochartstatus(Message,StudentId) VALUES (:massage,:id)";
$query = $dbh->prepare($sql);
$query->bindParam(':massage',$massage,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId){
    $msgid=$_SESSION['id'];
    $_SESSION['msg']="Topic send sucessfully";
header('location:chart.php');
}
else{
    $_SESSION['error']="Something went wrong. Please try again";
header('location:chart.php');

}    

}  

}
}