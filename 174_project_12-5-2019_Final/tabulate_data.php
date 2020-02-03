<?php
//This returns the teams in a given session.
$DATABASE_USER = 'gkralik';
$DATABASE_PASS = '174cancer';
$DATABASE_HOST = 'dbserver.engr.scu.edu/db11g';
$DATABASE_NAME = '';
if (isset($_POST['view_tab_data'])){
$conn = oci_connect($DATABASE_USER, $DATABASE_PASS, $DATABASE_HOST);
$data = prepare_input($_POST['session_name']);
$data=Strtolower($data);
$data="SELECT team_name FROM team_accounts WHERE session_name = '" .$data . "'";
$stid = oci_parse($conn,$data);
oci_execute($stid);
$team_array=array();
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		if (!in_array($item, $team_array)) 
		{ 
		  array_push($team_array,$item);
		} 
    }
}
//echo count($team_array);
oci_free_statement($stid);

$dataOut=array();
for ($i = 0; $i < count($team_array); $i++) {
	$data="SELECT question1_answer,question2_answer,question3_answer,question4_answer,question5_answer,question6_answer,question7_answer,question8_answer,question9_answer,question10_answer,question11_answer,question12_answer FROM project_eval_forms WHERE project_name= '".$team_array[$i] ."'";
	$stmt = oci_parse($conn, $data);
	oci_execute($stmt);
	$max=0;
	$number=0;
	$score=0;
	while ($row1 = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
		foreach ($row1 as $item2) {
			$max=$max+$item2;
		} 
		$number++;
	}
	if ($number !=0)
	{
		$score=$max/($number*12);
	}
	oci_free_statement($stmt);
	//$team_array[$team_array[$i]]=$score;
	$key=$team_array[$i];
	$dataOut[$key]=$score;
}

echo "Team_Name: Score<br><br>";
arsort($dataOut);
foreach ($dataOut as $key => $val) {
    echo "$key : $val<br>";
}



oci_close($conn);
}


else{
$conn = oci_connect($DATABASE_USER, $DATABASE_PASS, $DATABASE_HOST);
$data = prepare_input($_POST['session_name']);
$data=Strtolower($data);
$data="SELECT team_name FROM team_accounts WHERE session_name = '" .$data . "'";
$stid = oci_parse($conn,$data);
oci_execute($stid);
$team_array=array();
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		if (!in_array($item, $team_array)) 
		{ 
		  array_push($team_array,$item);
		} 
    }
}
//echo count($team_array);
oci_free_statement($stid);



echo "Team_Name: Judge Data<br><br>";
foreach ($team_array as $key ) {
    echo "<br>$key :<br>";
	$conn = oci_connect($DATABASE_USER, $DATABASE_PASS, $DATABASE_HOST);
	$data="SELECT * FROM project_eval_forms WHERE project_name = '" .$key . "'";
	//echo $data;
	// Parse the statement. Note there is no final semi-colon in the SQL statement //change based off the input
	$stid = oci_parse($conn, $data);
	//oci_bind_by_name($stid, ':datain', $data);
	oci_execute($stid);
	Echo "Session_Name|Judge_Name|Team_Name|q1|q2|q3|q4|q5|q6|q7|q8|q9|q10|q11|q12|Checkboxes|Other Comments|Year";
	echo "<table border='1'>\n";
	while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
		echo "<tr>\n";
		foreach ($row as $item) {
			echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
		}
		echo "</tr>\n";
	}
	echo "</table>\n";


	oci_free_statement($stid);
}



oci_close($conn);
}
function prepare_input($input_data) {
	$input_data = trim($input_data);
	$input_data = stripslashes($input_data);
	$input_data = htmlspecialchars($input_data);
	return $input_data;
}
?>
