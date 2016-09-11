<?php
// var_dump($_POST);?
ini_set('max_execution_time', 30000);
if(isset($_POST["submit"]))
{		
	if(strlen($_POST['member3_id'])!=0)
		$member3=substr(trim($_POST['member3_id']),4);
	else
		$member3=(int)0;
	$team_array=array("TeamName"=>$_POST['team_name'],
					  "TotalMembers"=>(int)$_POST['number_of_participants'],
					  "Mem1Name"=>$_POST['member1_name'],
					  "Mem2Name"=>$_POST['member2_name'],
					  "Mem3Name"=>$_POST['member3_name'],
					  "Member1RegId"=>substr(trim($_POST['member1_id']),4),
					  "Member2RegId"=>substr(trim($_POST['member2_id']),4),
					  "Member3RegId"=>$member3,
					  "DomainId"=>$_POST['domains'],
					  "TopicId"=>$_POST['topics'],
					  "Password"=>$_POST['password'],
					  "TeamLeader"=>$_POST['team_leader'],
					  "Source"=>'web');

	$team= curl_init();
	$team_url="http://akgec-scrolls.com/rest/api/Teams/CreateTeam";
	curl_setopt_array($team, array( CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
									CURLOPT_RETURNTRANSFER => 1,
									CURLOPT_POST => 1, 
									CURLOPT_URL => $team_url,
									CURLOPT_POSTFIELDS => json_encode($team_array),
								));

			$team_sucess= curl_exec($team);
			$team_sucess=json_decode($team_sucess);
			curl_close($team);
		$team_sucess=(array)$team_sucess;
//		var_dump($team_sucess);
		if(isset($team_sucess["Message"]))
		{
			echo "<script language='javascript'>alert('".$team_sucess["Message"]."'); location.href='index.php'; </script>";
		}
		else
		{
//		    var_dump($team_sucess);
			echo "<script language='javascript'>alert(' Your Team ID is SCROLLS ".$team_sucess["TeamId"].".\\n Your Details have also been sent to you by email.\\n Proceed to Login .'); location.href='index.php'; </script>";
		}
}		