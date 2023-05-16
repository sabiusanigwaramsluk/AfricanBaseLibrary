<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_POST['studentid']) && isset($_POST['massage'])) {

	function validate($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
}
	$studentid = validate ($_POST['studentid']);
		$massage = validate ($_POST['massage']);

if (empty($studentid)) {
	header("Location: user-feedback.php?error= Roll ID Number is required");
	exit();
}
elseif (empty($massage)) {
	header("Location: user-feedback.php?error=User Message is requeired&");
	exit();
}
else{
			$sql="SELECT * FROM tblstudents WHERE StudentId=:studentid";

			$query=$dbh->prepare($sql);
			$query->bindParam(':studentid' ,$studentid,PDO::PARAM_STR);
			$query->execute();
			//$results=$query->fetchAll(PDO::FETCH_OBJ);

			if($query->rowCount() > 0){


				$sql="INSERT INTO userfeedback(StudentId,message) VALUES (:studentid,:massage)";

				$query = $dbh->prepare($sql);
				$query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
				$query->bindParam(':massage',$massage,PDO::PARAM_STR);
				$query->execute();
				$lastInsertId = $dbh->lastInsertId();
				if($lastInsertId)
					{
							header("Location: user-feedback.php?success=Your message has been send successfully");
							
							exit();
						}

				else{
							header("Location: user-feedback.php?error=Unknown Error");
					exit(); 
						}
					}else{
						header("Location: user-feedback.php?error= Roll ID Number is Invalid");
					}

			
					}
			
				}
			
			