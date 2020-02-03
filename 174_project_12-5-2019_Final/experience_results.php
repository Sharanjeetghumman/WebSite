<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
 	$year = date("Y");
	// Get question answers
	$session_name = prepare_input($_POST['sname']);
	$judge_name = prepare_input($_POST['jname']);
	$answer0  = prepare_input($_POST['q0']);
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
    if ( !empty($_POST['commentsection']) )
		$other_comments = prepare_input($_POST['commentsection']);
	
    
	$conn=oci_connect('gkralik', '174cancer', 'dbserver.engr.scu.edu/db11g');
	if(!$conn) {
		print "<br> connection failed:";
		exit;
	}

	$query = oci_parse($conn, "INSERT INTO senior_design_exp_forms(
								session_name,
								judge_name,
								question0_answer,
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
								other_comments,
								year)
								VALUES(
								lower(:session_name),
								lower(:judge_name),
								:answer0,
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
								lower(:other_comments),
								:year)");
	
	oci_bind_by_name($query, ':session_name', $session_name);
	oci_bind_by_name($query, ':judge_name', $judge_name);
	oci_bind_by_name($query, ':answer0', $answer0);
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

	//echo "<div id='results'>$answer1 result</div>";
}
     
function prepare_input($input_data) {
	$input_data = trim($input_data);
	$input_data = stripslashes($input_data);
	$input_data = htmlspecialchars($input_data);
	return $input_data;
}

?>	
