<?php
session_start();
$data=file_get_contents( $_FILES['uploadedfile']['tmp_name']);
$target_file = basename($_FILES["uploadedfile"]["name"]);
$pdfFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if ($_FILES["uploadedfile"]["size"] > 2726297) {
	echo '<script language="javascript">';
	echo 'alert("Sorry, your file is larger than 2.5 MB. Please check the rules");location.href="home.php";';
	echo '</script>';
    exit;
}
else if($pdfFileType != "pdf" ) {
	echo '<script language="javascript">';
	echo 'alert("Sorry, your file is not a pdf. Please check the rules");location.href="home.php";';
	echo '</script>';
    exit;
}

$data = base64_encode($data);



	$createCollegeCurl = curl_init();

	$postCollegeData= array("DomainName" => $_SESSION["DomainName"],
							"TopicName" =>$_SESSION["TopicName"],
							"TeamId"=>substr($_SESSION["TeamId"],7),
							"FileName"=>"",
							"FileArray" => $data);
print(" ");

	curl_setopt_array($createCollegeCurl, array( CURLOPT_HTTPHEADER =>array('Content-Type: application/json'),
											CURLOPT_RETURNTRANSFER => 1,
											CURLOPT_URL => 'http://akgec-scrolls.com/rest/api/Teams/UploadFile',
											CURLOPT_POST => 1,
											CURLOPT_POSTFIELDS => json_encode($postCollegeData),
										));
										
										

	$createCollegeResponse = curl_exec($createCollegeCurl);
	
	
	
	$http_status = curl_getinfo($createCollegeCurl, CURLINFO_HTTP_CODE);
	curl_close($createCollegeCurl);
	// echo $http_status;
	if($http_status != 201)
	{
	echo '<script language="javascript">';
	echo "<script language='javascript'>alert('Sorry, an error occured.Your file could not be uploaded.Please try again');location.href='home.php';</script>"; 
	echo '</script>';
    exit;
	}
	
	// echo "Finally";
		$_SESSION["SynopsisAvailable"]=1;
	echo "<script language='javascript'>alert('Final Paper successfully submitted!');location.href='home.php';</script>"; 
	
?>