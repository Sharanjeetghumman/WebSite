<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
 	$year = date("Y");
	$economic = $environmental = $sustainability = $manufacturability = $ethical = $health_and_safety = $social = $political = $other_comments = "";
	// Get question answers
	$session_name = prepare_input($_POST['sname']);
	$project_name = prepare_input($_POST['tname']);
	$judge_name = prepare_input($_POST['jname']);
	$answer1  = prepare_input($_POST['q1']);
    $answer2  = prepare_input($_POST['q2']);
    $answer3  = prepare_input($_POST['q3']);
    $answer4  = prepare_input($_POST['q4']);
    $answer5  = prepare_input($_POST['q5']);   
    $answer6  = prepare_input($_POST['q6']);
    $answer7  = prepare_input($_POST['q7']);
    $answer8  = prepare_input($_POST['q8']);
    $answer9  = prepare_input($_POST['q9']);
    $answer10 = prepare_input($_POST['q10']);
    $answer11 = prepare_input($_POST['q11']);
    $answer12 = prepare_input($_POST['q12']);	
	if ( !empty($_POST['Economic']) )
		$economic = prepare_input($_POST['Economic']);
	if ( !empty($_POST['Environmental']) )
		$environmental = prepare_input($_POST['Environmental']);
	if ( !empty($_POST['Sustainability']) )
		$sustainability = prepare_input($_POST['Sustainability']);
	if ( !empty($_POST['Manufacturability']) )
		$manufacturability = prepare_input($_POST['Manufacturability']);
	if ( !empty($_POST['Ethical']) )
		$ethical = prepare_input($_POST['Ethical']);
	if ( !empty($_POST['Health_and_Safety']) )
		$health_and_safety = prepare_input($_POST['Health_and_Safety']);
	if ( !empty($_POST['Social']) )
		$social = prepare_input($_POST['Social']);
	if ( !empty($_POST['Political']) )
		$political = prepare_input($_POST['Political']);
    if ( !empty($_POST['commentsection']) )
		$other_comments = prepare_input($_POST['commentsection']);
	
	$checkbox = $economic . $environmental . $sustainability . $manufacturability . $ethical . $health_and_safety . $social . $political;
	$conn=oci_connect('gkralik', '174cancer', 'dbserver.engr.scu.edu/db11g');

	if(!$conn) {
		print "<br> connection failed:";
		exit;
	}

	$query = oci_parse($conn, "INSERT INTO project_eval_forms(
								session_name,
								judge_name,
								project_name,
								question1_answer,
								question2_answer,
								question3_answer,
								question4_answer,
								question5_answer,
								question6_answer,
								question7_answer,
								question8_answer,
								question9_answer,
								question10_answer,
								question11_answer,
								question12_answer,
								checkboxes,
								other_comments,
								year)
								VALUES(
								lower(:session_name),
								lower(:judge_name),
								lower(:project_name),
								:answer1,
								:answer2,
								:answer3,
								:answer4,
								:answer5,
								:answer6,
								:answer7,
								:answer8,
								:answer9,
								:answer10,
								:answer11,
								:answer12,
								lower(:checkboxes),
								lower(:other_comments),
								:year)");
	
	oci_bind_by_name($query, ':session_name', $session_name);
	oci_bind_by_name($query, ':judge_name', $judge_name);
	oci_bind_by_name($query, ':project_name', $project_name);
	oci_bind_by_name($query, ':answer1', $answer1);
	oci_bind_by_name($query, ':answer2', $answer2);
	oci_bind_by_name($query, ':answer3', $answer3);
	oci_bind_by_name($query, ':answer4', $answer4);
	oci_bind_by_name($query, ':answer5', $answer5);
	oci_bind_by_name($query, ':answer6', $answer6);
	oci_bind_by_name($query, ':answer7', $answer7);
	oci_bind_by_name($query, ':answer8', $answer8);
	oci_bind_by_name($query, ':answer9', $answer9);
	oci_bind_by_name($query, ':answer10', $answer10);
	oci_bind_by_name($query, ':answer11', $answer11);
	oci_bind_by_name($query, ':answer12', $answer12);
	oci_bind_by_name($query, ':checkboxes', $checkboxes);
	oci_bind_by_name($query, ':other_comments', $other_comments);
	oci_bind_by_name($query, ':year', $year);	
	
	$res = oci_execute($query);

	if($res)
		echo '<br><br> <p style="color:green;font-size:20px">Data successfully inserted</p>';
	else {
		$e = oci_error($query);
		echo $e['message'];
	}

	OCILogoff($conn);
}
     
function prepare_input($input_data) {
	$input_data = trim($input_data);
	$input_data = stripslashes($input_data);
	$input_data = htmlspecialchars($input_data);
	return $input_data;
}

?>	
