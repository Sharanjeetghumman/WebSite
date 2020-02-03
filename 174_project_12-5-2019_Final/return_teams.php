<?php
//This returns the teams in a given session.
$DATABASE_USER = 'gkralik';
$DATABASE_PASS = '174cancer';
$DATABASE_HOST = 'dbserver.engr.scu.edu/db11g';
$DATABASE_NAME = '';

$conn = oci_connect($DATABASE_USER, $DATABASE_PASS, $DATABASE_HOST);
$data = prepare_input($_POST['session_name']);
$data=Strtolower($data);
$data="SELECT team_name,student_name,session_name,year FROM team_accounts WHERE session_name = '" .$data . "'";
//echo $data;
// Parse the statement. Note there is no final semi-colon in the SQL statement //change based off the input
$stid = oci_parse($conn, $data);
//oci_bind_by_name($stid, ':datain', $data);
oci_execute($stid);
Echo "Team_Name|Student_Name|Session_Number|Year";
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
oci_close($conn);
function prepare_input($input_data) {
	$input_data = trim($input_data);
	$input_data = stripslashes($input_data);
	$input_data = htmlspecialchars($input_data);
	return $input_data;
}
?>
