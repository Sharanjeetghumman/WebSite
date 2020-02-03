<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['authorized']) && $_SESSION['authorized'] === TRUE) {
	//echo "<h1>Session: ".$_SESSION['session']."</h1>";
	//echo "<h1>Judge_name: ".$_SESSION['judge_name']."</h1>";
} else {
    header('Location: index.html');
}
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<title>Project Evaluation</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<h3>Judges Project Evaluation Form</h3>
<div id="page-wrap">

	<form action="judges_form_results.php" method="post" id="quiz">
		Session Name:		
		<input type="text" id="sessionname" value="<?php echo htmlentities($_SESSION['session']); ?>" name="sname" READONLY />
		<br>
		
		Team Name:
		<select id="teamname" name="tname" required>
		<?php
		$conn=oci_connect('gkralik', '174cancer', 'dbserver.engr.scu.edu/db11g');
		$data="SELECT DISTINCT team_name FROM team_accounts where session_name='" .$_SESSION['session'] . "'";
		$stid = oci_parse($conn, $data);

		oci_execute($stid); 
		while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			foreach ($row as $item){
				echo "<option>" . $item . "</option>" ;
			}
		}
		OCILogoff($conn);
		?>
		</select>
		<br>
		<!--label for="teamname">Team Name</label>
		<input type="text" id="teamname" name="tname" placeholder="Team name"><br-->


		<label for="judgename">Judge Name</label>
		<input type="text" id="judgename" name="jname" value="<?php echo htmlentities($_SESSION['judge_name']); ?>" READONLY /><br>
		<br>		
		<br>		
		<h3>Design Project</h3>
		<br>		
		<p>Technical Accuracy</p>
		  <input type="radio" name="q1" value=0 required>N/A<br>
		  <input type="radio" name="q1" value=1 required>Poor<br>
		  <input type="radio" name="q1" value=2 required>Below Average<br>
		  <input type="radio" name="q1" value=3 required>Average<br>
		  <input type="radio" name="q1" value=4 required>Good<br>
		  <input type="radio" name="q1" value=5 required>Excellent<br>
		<br>		
		<p>Creativity and Innovation</p>
		  <input type="radio" name="q2" value=0 required>N/A<br>
		  <input type="radio" name="q2" value=1 required>Poor<br>
		  <input type="radio" name="q2" value=2 required>Below Average<br>
		  <input type="radio" name="q2" value=3 required>Average<br>
		  <input type="radio" name="q2" value=4 required>Good<br>
		  <input type="radio" name="q2" value=5 required>Excellent<br>
		<br>		
		<p>Supporting Analytical Work </p>
		  <input type="radio" name="q3" value=0 required>N/A<br>
		  <input type="radio" name="q3" value=1 required>Poor<br>
		  <input type="radio" name="q3" value=2 required>Below Average<br>
		  <input type="radio" name="q3" value=3 required>Average<br>
		  <input type="radio" name="q3" value=4 required>Good<br>
		  <input type="radio" name="q3" value=5 required>Excellent<br>
		<br>		
		<p>Methodical Design Process Demonstrated   </p>
		  <input type="radio" name="q4" value=0 required>N/A<br>
		  <input type="radio" name="q4" value=1 required>Poor<br>
		  <input type="radio" name="q4" value=2 required>Below Average<br>
		  <input type="radio" name="q4" value=3 required>Average<br>
		  <input type="radio" name="q4" value=4 required>Good<br>
		  <input type="radio" name="q4" value=5 required>Excellent<br>
		<br>		
		<p>Addresses Project Complexity Appropriately</p>
		  <input type="radio" name="q5" value=0 required>N/A<br>
		  <input type="radio" name="q5" value=1 required>Poor<br>
		  <input type="radio" name="q5" value=2 required>Below Average<br>
		  <input type="radio" name="q5" value=3 required>Average<br>
		  <input type="radio" name="q5" value=4 required>Good<br>
		  <input type="radio" name="q5" value=5 required>Excellent<br>
		<br>		
		<p>Expectation of Completion (by term’s end)</p>
		  <input type="radio" name="q6" value=0 required>N/A<br>
		  <input type="radio" name="q6" value=1 required>Poor<br>
		  <input type="radio" name="q6" value=2 required>Below Average<br>
		  <input type="radio" name="q6" value=3 required>Average<br>
		  <input type="radio" name="q6" value=4 required>Good<br>
		  <input type="radio" name="q6" value=5 required>Excellent<br> 	
		<br>		
		<p>Design & Analysis of tests</p>
		  <input type="radio" name="q7" value=0 required>N/A<br>
		  <input type="radio" name="q7" value=1 required>Poor<br>
		  <input type="radio" name="q7" value=2 required>Below Average<br>
		  <input type="radio" name="q7" value=3 required>Average<br>
		  <input type="radio" name="q7" value=4 required>Good<br>
		  <input type="radio" name="q7" value=5 required>Excellent<br>
		<br>		
		<p>Quality of Response during Q&A</p>
		  <input type="radio" name="q8" value=0 required>N/A<br>
		  <input type="radio" name="q8" value=1 required>Poor<br>
		  <input type="radio" name="q8" value=2 required>Below Average<br>
		  <input type="radio" name="q8" value=3 required>Average<br>
		  <input type="radio" name="q8" value=4 required>Good<br>
		  <input type="radio" name="q8" value=5 required>Excellent<br>
		<br>		
		<br>		
		<h3>Presentation</h3>
		<br>		
		<p>Organization</p>
		  <input type="radio" name="q9" value=0 required>N/A<br>
		  <input type="radio" name="q9" value=1 required>Poor<br>
		  <input type="radio" name="q9" value=2 required>Below Average<br>
		  <input type="radio" name="q9" value=3 required>Average<br>
		  <input type="radio" name="q9" value=4 required>Good<br>
		  <input type="radio" name="q9" value=5 required>Excellent<br> 	
		<br>		
		<p>Use of Allotted Time</p>
		  <input type="radio" name="q10" value=0 required>N/A<br>
		  <input type="radio" name="q10" value=1 required>Poor<br>
		  <input type="radio" name="q10" value=2 required>Below Average<br>
		  <input type="radio" name="q10" value=3 required>Average<br>
		  <input type="radio" name="q10" value=4 required>Good<br>
		  <input type="radio" name="q10" value=5 required>Excellent<br>
		<br>		
		<p>Visual Aids</p>
		  <input type="radio" name="q11" value=0 required>N/A<br>
		  <input type="radio" name="q11" value=1 required>Poor<br>
		  <input type="radio" name="q11" value=2 required>Below Average<br>
		  <input type="radio" name="q11" value=3 required>Average<br>
		  <input type="radio" name="q11" value=4 required>Good<br>
		  <input type="radio" name="q11" value=5 required>Excellent<br>
		<br>		
		<p>Confidence and Poise</p>
		  <input type="radio" name="q12" value=0 required>N/A<br>
		  <input type="radio" name="q12" value=1 required>Much Worse<br>
		  <input type="radio" name="q12" value=2 required>Worse<br>
		  <input type="radio" name="q12" value=3 required>About the Same<br>
		  <input type="radio" name="q12" value=4 required>Better<br>
		  <input type="radio" name="q12" value=5 required>Much Better<br> 	
		<br>		
		<p> Please check each of the following considerations that were addressed by the presentation:</p>
		  <input type="checkbox" name="Economic" value="Economic">Economic<br>
		  <input type="checkbox" name="Environmental" value="Environmental">Environmental<br>
		  <input type="checkbox" name="Sustainability" value="Sustainablility">Sustainablility<br>
		  <input type="checkbox" name="Manufacturability" value="Manufacturability">Manufacturability <br>
		  <input type="checkbox" name="Ethical" value="Ethical">Ethical<br>
		  <input type="checkbox" name="Health_and_Safety" value="Health and Safety">Health and Safety<br>
		  <input type="checkbox" name="Social" value="Social">Social<br>
		  <input type="checkbox" name="Political" value="Political">Political<br>
		<br>		
		<br>		
		<label for="comment">Comments(Optional)</label><br>
			<input type="text" id="comment" name="commentsection" placeholder="Any comments.."><br>
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
