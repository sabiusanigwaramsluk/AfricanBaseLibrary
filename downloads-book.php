<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 
$fileid=intval($_GET['fileid']);
$sql = "SELECT * from tblbooks WHERE id=:fileid";
$query = $dbh->prepare($sql);
$query->bindParam(':fileid',$fileid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{              
    $file=$result->name;
    $dld=$result->downloads;

    echo $file . "<br>";
    $filepath='admin/uploads/' . $file;


    echo "$filepath";

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('admin/uploads/' . $file));
        
        //This part of code prevents files from being corrupted after download
        ob_clean();
        flush();
        
        readfile('admin/uploads/' . $file);

        // Now update downloads count
        $newCount = $dld + 1;
        $sql = "UPDATE tblbooks SET downloads=$newCount WHERE id=$fileid";
       $query = $dbh->prepare($sql);
        $query->bindParam(':fileid',$fileid,PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        exit;
    }

}
}


    
}

?>