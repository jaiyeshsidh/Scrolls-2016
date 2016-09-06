<?php
	ini_set('max_execution_time', 30000);
	$loginCurl= curl_init();							

	$postLoginData= array("TeamId" => substr(trim($_POST['teamId']),7), 
							"Password" =>$_POST['password']); 
	curl_setopt_array($loginCurl, array( CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
											CURLOPT_RETURNTRANSFER => 1,
											CURLOPT_URL => 'http://akgec-scrolls.com/rest/api/Teams/IsTeamValid',
											CURLOPT_POST => 1 ,
											CURLOPT_POSTFIELDS => json_encode($postLoginData),
										));

	 $success = curl_exec($loginCurl);
	 $success=json_decode($success);
	 $success=(array)$success;
	 $teamIds=substr(trim($_POST['teamId']),7);
		curl_close($loginCurl);
	//print_r(json_encode($postLoginData));
	$scrollsIdCurl= curl_init();
	$url= "http://akgec-scrolls.com/rest/api/Teams/GetTeam?teamId=".trim($teamIds);
	//echo $url
	curl_setopt_array($scrollsIdCurl, array( CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
											CURLOPT_RETURNTRANSFER => 1,
											CURLOPT_URL => $url,
										));
	//var_dump($scrollsIdCurl);
	$scrollIdResponse= curl_exec($scrollsIdCurl);
	$scrollIdResponse=json_decode($scrollIdResponse);
	curl_close($scrollsIdCurl);
	  //var_dump($scrollIdResponse);
	$scrollIdResponse=(array)$scrollIdResponse;
//	   echo $teamIds;
//	   var_dump($_POST);
//	   var_dump($success);
//	   var_dump($scrollIdResponse);
//var_dump($success);
	if (!(empty($success)) && isset($scrollIdResponse))
	{
		if(isset($success["Message"]))
			echo "<script language='javascript'>alert('Our Servers are  busy right now . \\n Please try again later .'); location.href='index.php'; </script>";
		session_start();
		$_SESSION["TeamId"] =$_POST['teamId'];
		$_SESSION["DomainName"]=$success["DomainName"];
		$_SESSION["TopicName"]=$success["TopicName"];
		$_SESSION["TeamName"]=$scrollIdResponse["TeamName"];
		$_SESSION["SynopsisAvailable"]=$scrollIdResponse["SynopsisAvailable"];
//		var_dump($_SESSION);
		header("location: home.php");
	}
	else
	{
		echo "<script language='javascript'>alert('Invalid Credentials'); location.href='index.php'; </script>";

	}

?>