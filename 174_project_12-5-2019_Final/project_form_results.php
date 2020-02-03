<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
	$other_comments = "";
	// Get question answers
	$answer1  = prepate_input($_POST['q1']);
    $answer2  = prepate_input($_POST['q2']);
    $answer3  = prepate_input($_POST['q3']);
    $answer4  = prepate_input($_POST['q4']);
    $answer5  = prepate_input($_POST['q5']);   
    $answer6  = prepate_input($_POST['q6']);
    $answer7  = prepate_input($_POST['q7']);
    $answer8  = prepate_input($_POST['q8']);
    $answer9  = prepate_input($_POST['q9']);
    $answer10 = prepate_input($_POST['q10']);
    $answer11 = prepate_input($_POST['q11']);
    $answer12 = prepate_input($_POST['q12']);
    $other_comments = prepare_input($_POST['comment']);
    //echo "<div id='results'>$answer1 result</div>";
}
     
function prepare_input($input_data) {
	$input_data = trim($input_data);
	$input_data = stripslashes($data);
	$input_data = htmlspecialchars($input_data);
	return $input_data;
}

function insert_form_to_db() {
	$conn=oci_connect('gkralik', '174cancer', 'dbserver.engr.scu.edu/db11g');
	if(!$conn) {
		print "<br> connection failed:";
		exit;
	}
	$query = oci_parse($conn, "INSERT INTO test_project_eval_forms(
								session_name,
								judge_first_name,
								judge_last_name,
								team_name,
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

								");
}

?>	
