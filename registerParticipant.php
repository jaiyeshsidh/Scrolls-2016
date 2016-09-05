<?php
// var_dump($_POST);
ini_set('max_execution_time', 30000);
if(isset($_POST['submit']))
{
	$participant= curl_init();
	$participant_url="http://akgec-scrolls.com/rest/api/Participants/CreateParticipant";
	if($_POST['college']=="")
	{	$college=curl_init();
		$college_array=array("CollegeName"=>$_POST['college_name']);
		$college_url="http://akgec-scrolls.com/rest/api/Colleges/CreateCollege";
			curl_setopt_array($college, array( CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
							CURLOPT_RETURNTRANSFER => 1,
							CURLOPT_POST => 1, 
							CURLOPT_URL => $college_url,
							CURLOPT_POSTFIELDS => json_encode($college_array),
						));

	$college_sucess= curl_exec($college);
	$college_sucess=json_decode($college_sucess);
	curl_close($college);	
	$_POST['college']=$college_sucess->CollegeId;
	}
	
	$participant_array=array("Name" =>$_POST['name'],
						 "CourseId"=>$_POST['course'],
						 "Year"=>$_POST['year'],
						 "CollegeId"=>$_POST['college'],
						 "StudentId"=>$_POST['studentId'],
						 "MobileNo"=>$_POST['number'],
						 "EmailId"=>$_POST['email'],
						 "Accomodation"=>$_POST['accomodation'],
						 "Source"=>"web");
	curl_setopt_array($participant, array( CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
							CURLOPT_RETURNTRANSFER => 1,
							CURLOPT_POST => 1, 
							CURLOPT_URL => $participant_url,
							CURLOPT_POSTFIELDS => json_encode($participant_array),
						));

	$participant_sucess= curl_exec($participant);
	$participant_sucess=json_decode($participant_sucess);
	curl_close($participant);
	$participant_sucess=(array)$participant_sucess;
	// var_dump($participant_sucess);
		if(isset($participant_sucess[0]))
		{
			echo "<script language='javascript'>alert('".$participant_sucess[0]."'); location.href='index.php'; </script>"; 
		}
		else
		{
			echo "<script language='javascript'>alert('Individual Registration Completed.'); location.href='index.php'; </script>";
		}

}
?>