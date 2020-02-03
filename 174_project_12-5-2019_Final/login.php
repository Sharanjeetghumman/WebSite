<?php
session_start();
$DATABASE_USER = '';
$DATABASE_PASS = '';
$DATABASE_HOST = 'dbserver.engr.scu.edu/db11g';
$DATABASE_NAME = '';
$conn = oci_connect($DATABASE_USER, $DATABASE_PASS, $DATABASE_HOST);	
if(!$conn) {
		print "<br> connection failed:";
		exit;
	}
$usernameIn = prepare_input($_POST['uname']);
$passwordIn=prepare_input($_POST['psw']);
$usernameIn=Strtolower($usernameIn);
$passwordIn=Strtolower($passwordIn);
$data="SELECT judge_id, judge_password FROM judge_accounts WHERE judge_id = '" .$usernameIn . "'";

if ( !isset($_POST['uname'], $_POST['psw']) ) {
	print "<br> Please fill both the username and password field!";
}



$stid = oci_parse($conn, $data);
oci_execute($stid);
$passwordHash="";
$checker=0;
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
        	$passwordHash= $item;
		$checker=1;
    }
}

oci_free_statement($stid);
oci_close($conn);

if ($checker==0){
	$conn = oci_connect($DATABASE_USER, $DATABASE_PASS, $DATABASE_HOST);
	$data="SELECT admin_id, admin_password FROM admins WHERE admin_id = '" .$usernameIn . "'";
	$stid = oci_parse($conn, $data);
	oci_execute($stid);
	while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
	    foreach ($row as $item) {
        	$passwordHash= $item;
		$checker=2;	
	    }
	}
	oci_free_statement($stid);
	oci_close($conn);
}
$options = [
	'cost' => 12,
	];
if (password_verify($passwordIn, $passwordHash)){
	$_SESSION['authorized'] = TRUE;
	if ($checker==1){
		$conn=oci_connect('gkralik', '174cancer', 'dbserver.engr.scu.edu/db11g');
		$data="SELECT judge_name,session_name FROM judge_accounts where judge_id='" .$usernameIn . "'";
		$stid = oci_parse($conn, $data);
		oci_execute($stid); 
		while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$i=0;
			foreach ($row as $item){
				if ($i==0){
					$jname=$item;
				}
				else{
					$sname=$item;
				}
				$i=$i+1;
			}
		}
		OCILogoff($conn);
		$_SESSION['session'] = $sname;
		$_SESSION['judge_name'] = $jname;
		$_SESSION['admin_status'] =FALSE;
		header("Location: judges.php");
	}
	else{
		$_SESSION['admin_status'] =TRUE;
	header("Location: admin.php");
	}
	//echo "Login Successful";
}
else{
	echo"Incorrect Username/Password";
}
/*
if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	if (password_verify($_POST['psw'], $password)) {
		header("Location: judges.html");
	} else {
		print '<br> Incorrect password!';
	}
} else {
	print '<br> Incorrect username!';
}
$stmt->close();
}
*/

function prepare_input($input_data) {
	$input_data = trim($input_data);
	$input_data = stripslashes($input_data);
	$input_data = htmlspecialchars($input_data);
	return $input_data;
}
?>
