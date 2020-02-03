<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
 	// begin getting required info
 	$year = date("Y");
	$session_name = prepare_input($_POST['sname']);
	
	//$projs_studs = prepare_input($_POST['tname']);
	//$judge_names = prepare_input($_POST['jname']);
	$judges_str = prepare_input($_POST['jname']);
	$judges = explode(',', $judges_str);
	for($i=0; $i < count($judges); $i++) {
		$judges[$i] = prepare_input($judges[$i]);
	}
	$teams = array();
	$curteam = '';
	
	
	foreach($_POST as $key => $value) {
		if(substr($key, 0, 4) == 'team') {
			$curteam = Strtolower(prepare_input($value));
		} elseif(substr($key, 0, 4) == 'name') {
			if(array_key_exists($curteam, $teams)) { 
				array_push($teams[$curteam], Strtolower(prepare_input($value)));
			} else {
				$teams[$curteam] = array(Strtolower(prepare_input($value)));
			}
		}
	}
    
	// create login information for judges
	$judge_html = '<br>
				   Judge Name | Judge Login ID | Judge Password
				   <br>
				   <br>';
	$judge_accounts = array();
	foreach($judges as $judge) {
		$judge_id = $judge[0] . explode(' ', $judge)[1];
		if (array_key_exists($judge_id, $judge_accounts)) {
			$judge_id .= '1';
		}
		$judge_password = generate_password(10);
		$judge_accounts[$judge_id] = array($judge, $judge_id, $judge_password);
		$judge_html .=Strtolower( $judge . ' | ' . $judge_id . ' | ' . $judge_password . '<br>');
	}

	// connect to db
	$conn=oci_connect('gkralik', '174cancer', 'dbserver.engr.scu.edu/db11g');
	if(!$conn) {
		print "<br> connection failed:";
		exit;
	}
	// insert judge information
	$insert_judge = oci_parse($conn, "INSERT INTO judge_accounts(
									  judge_name,
									  judge_id,
									  judge_password,
									  session_name,
									  year)
									  VALUES(
									  lower(:judge_name),
									  lower(:judge_id),
								 	  :judge_password,
									  lower(:session_name),
									  :year)");
	oci_bind_by_name($insert_judge, ':session_name', $session_name);
	oci_bind_by_name($insert_judge, ':year', $year);
	foreach($judge_accounts as $judge) {
		$judge_name=Strtolower($judge[0]);
		oci_bind_by_name($insert_judge, ':judge_name', $judge_name);
		$judge_id=Strtolower($judge[1]);
		oci_bind_by_name($insert_judge, ':judge_id', $judge_id);
		$hashedIn=Strtolower($judge[2]);
		$hashed_password=password_hash($hashedIn,PASSWORD_DEFAULT);
		oci_bind_by_name($insert_judge, ':judge_password',$hashed_password);
		
		$res = oci_execute($insert_judge);
		/*
		if($res)
			echo '<br><br> <p style="color:green;font-size:20px">Data successfully inserted</p>';
		else {
			$e = oci_error($query);
			echo $e['message'];
		} */
	}
	
	// insert team information
	$insert_team = oci_parse($conn, "INSERT INTO team_accounts(
									 session_name,
									 team_name,
									 student_name,
									 year)
									 VALUES(
									 lower(:session_name),
									 lower(:team_name),
									 lower(:student_name),
									 :year)");
	oci_bind_by_name($insert_team, ':session_name', $session_name);
	oci_bind_by_name($insert_team, ':year', $year);
	foreach($teams as $team => $students) {
		foreach($students as $student) {
			oci_bind_by_name($insert_team, ':team_name', $team);
			oci_bind_by_name($insert_team, ':student_name', $student);
			$res = oci_execute($insert_team);
		}
	}
	echo $judge_html;
	OCILogoff($conn);
	

}
     
function prepare_input($input_data) {
	$input_data = trim($input_data);
	$input_data = stripslashes($input_data);
	$input_data = htmlspecialchars($input_data);
	return $input_data;
}

function generate_password($strlen = 16) {
	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$input_len = strlen($permitted_chars);
	$random_string = '';
	for($i = 0; $i < $strlen; $i++) {
		$random_char = $permitted_chars[mt_rand(0, $input_len - 1)];
		$random_string .= $random_char;
	}
	return $random_string;
}

?>	
