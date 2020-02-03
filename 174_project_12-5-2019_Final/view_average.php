<?php
//This returns the teams in a given session.
$DATABASE_USER = 'gkralik';
$DATABASE_PASS = '174cancer';
$DATABASE_HOST = 'dbserver.engr.scu.edu/db11g';
$DATABASE_NAME = '';


$conn = oci_connect($DATABASE_USER, $DATABASE_PASS, $DATABASE_HOST);
$data="SELECT AVG(question0_answer),AVG(question1_answer), AVG(question2_answer),AVG(question3_answer),AVG(question4_answer),AVG(question5_answer),AVG(question6_answer),AVG(question7_answer),AVG(question8_answer),AVG(question9_answer),AVG(question10_answer),AVG(question11_answer),AVG(question12_answer) from senior_design_exp_forms";
$stmt = oci_parse($conn, $data);
oci_execute($stmt);
echo "Average per Question in Experience Form<br>";
echo "<br>q1|q2|q3|q4|q5|q6|q7|q8|q9|q10|q11|q12|q13";
echo "<table border='1'>\n";
while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
		$item=round($item,3);
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";
oci_free_statement($stmt);




oci_close($conn);
?>
