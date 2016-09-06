<?php
//var_dump($_POST);
if(isset($_POST["submit"])) {
//	var_dump($_POST);
    $query = curl_init();
    $query_url = "http://akgec-scrolls.com/rest/api/Queries/RegisterQuery";
    $query_array = array("Email" => $_POST['email'],
                         "Body"=>$_POST['body'],
        );
        curl_setopt_array($query, array(CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
                                            CURLOPT_RETURNTRANSFER => 1,
                                            CURLOPT_POST => 1,
                                            CURLOPT_URL => $query_url,
                                            CURLOPT_POSTFIELDS => json_encode($query_array),
                                            ));

        $query_sucess = curl_exec($query);
        curl_close($query);
//return $query;
        echo("<script language='javascript'>alert('Your Query has been registered with us. \\n We will reply you soon.'); location.href='index.php'; </script>");
}
