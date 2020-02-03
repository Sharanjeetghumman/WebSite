<?php
//This returns the teams in a given session.
$DATABASE_USER = 'gkralik';
$DATABASE_PASS = '174cancer';
$DATABASE_HOST = 'dbserver.engr.scu.edu/db11g';
$DATABASE_NAME = '';

$conn = oci_connect($DATABASE_USER, $DATABASE_PASS, $DATABASE_HOST);
$data = prepare_input($_POST['judge_name']);
$data=Strtolower($data);
$data="SELECT * FROM senior_design_exp_forms WHERE judge_name = '" .$data . "'";
//echo $data;
$stid = oci_parse($conn, $data);
//oci_bind_by_name($stid, ':datain', $data);
oci_execute($stid);
Echo "Session|Judge|q1|q2|q3|q4|q5|q6|q7|q8|q9|q10|q11|q12|q13|Other Comments|Year";
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
