<?php
//This returns the teams in a given session.
$DATABASE_USER = 'gkralik';
$DATABASE_PASS = '174cancer';
$DATABASE_HOST = 'dbserver.engr.scu.edu/db11g';
$DATABASE_NAME = '';

$conn = oci_connect($DATABASE_USER, $DATABASE_PASS, $DATABASE_HOST);
$data="SELECT team_name FROM team_accounts";
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

echo "Session: Team_Name: Score<br><br>";
arsort($dataOut);
foreach ($dataOut as $key => $val) {
	
	$conn = oci_connect($DATABASE_USER, $DATABASE_PASS, $DATABASE_HOST);
	$data="SELECT session_name FROM team_accounts WHERE team_name='" .$key . "'";
	$stid = oci_parse($conn,$data);
	oci_execute($stid);
	$team_array=array();
	while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
		foreach ($row as $item) {
			 $session_name=$item;
		}
	}
	//echo count($team_array);
	oci_free_statement($stid);
    echo "$session_name : $key : $val<br>";
}



oci_close($conn);
?>
