<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['authorized']) && $_SESSION['authorized'] === TRUE) {
} else {
    header('Location: index.html');
}
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<title>Judge Evaluation</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<h3>Judges’ Evaluation of Senior Design Experience</h3>
<div id="page-wrap">
	<form action="experience_results.php" method="post" id="quiz">
		Session Name:	
		<!--Change select to input or text box -->	
		<input type="text" id="sessionname" value="<?php echo htmlentities($_SESSION['session']); ?>" name="sname" READONLY />
		<br>
		<label for="judgename">Judge Name</label>
		<input type="text" id="judgename" name="jname" value="<?php echo htmlentities($_SESSION['judge_name']); ?>" READONLY />
		<br>		
		<p> Which discipline are you judging?</p>
		  <input type="radio" name="q0" value=0 required>Bio Engineering<br>
		  <input type="radio" name="q0" value=1 required>Civil Engineering<br>
		  <input type="radio" name="q0" value=2 required>Computer Engineering<br>
		  <input type="radio" name="q0" value=3 required>Electrical Engineering<br>
		  <input type="radio" name="q0" value=4 required>Mechanical Engineering<br>
		  <input type="radio" name="q0" value=5 required>Interdisciplinary<br>
		<br>		
		<p>1. Do you find evidence that our students have the ability to apply knowledge of mathematics, science, and engineering?</p>
		  <input type="radio" name="q1" value=0 required>No basis for judgement<br>
		  <input type="radio" name="q1" value=1 required>Very Weak<br>
		  <input type="radio" name="q1" value=2 required>Weak<br>
		  <input type="radio" name="q1" value=3 required>Moderate<br>
		  <input type="radio" name="q1" value=4 required>Strong<br>
		  <input type="radio" name="q1" value=5 required>Very Strong<br>
		<br>		
		<p>2. Do you find evidence that our students have the ability to design and conduct experiments or tests, as well as to analyze and interpret the results?</p>
		  <input type="radio" name="q2" value=0 required>No basis for judgement<br>
		  <input type="radio" name="q2" value=1 required>Very Weak<br>
		  <input type="radio" name="q2" value=2 required>Weak<br>
		  <input type="radio" name="q2" value=3 required>Moderate<br>
		  <input type="radio" name="q2" value=4 required>Strong<br>
		  <input type="radio" name="q2" value=5 required>Very Strong<br>
		<br>		
		<p>3. Do you find evidence that our students have the ability to design a system, component or process to meet desired needs?</p>
		  <input type="radio" name="q3" value=0 required>No basis for judgement<br>
		  <input type="radio" name="q3" value=1 required>Very Weak<br>
		  <input type="radio" name="q3" value=2 required>Weak<br>
		  <input type="radio" name="q3" value=3 required>Moderate<br>
		  <input type="radio" name="q3" value=4 required>Strong<br>
		  <input type="radio" name="q3" value=5 required>Very Strong<br>
		<br>		
		<p>4. Do you find evidence that our students have the ability to function well on teams?</p>
		  <input type="radio" name="q4" value=0 required>No basis for judgement<br>
		  <input type="radio" name="q4" value=1 required>Very Weak<br>
		  <input type="radio" name="q4" value=2 required>Weak<br>
		  <input type="radio" name="q4" value=3 required>Moderate<br>
		  <input type="radio" name="q4" value=4 required>Strong<br>
		  <input type="radio" name="q4" value=5 required>Very Strong<br>
		<br>		
		<p>5. Do you find evidence that our students have the ability to identify, formulate and solve engineering problems?</p>
		  <input type="radio" name="q5" value=0 required>No basis for judgement<br>
		  <input type="radio" name="q5" value=1 required>Very Weak<br>
		  <input type="radio" name="q5" value=2 required>Weak<br>
		  <input type="radio" name="q5" value=3 required>Moderate<br>
		  <input type="radio" name="q5" value=4 required>Strong<br>
		  <input type="radio" name="q5" value=5 required>Very Strong<br>
		<br>		
		<p>6. Do you find evidence that our students have an understanding of professional and ethical responsibility?</p>
		  <input type="radio" name="q6" value=0 required>No basis for judgement<br>
		  <input type="radio" name="q6" value=1 required>Very Weak<br>
		  <input type="radio" name="q6" value=2 required>Weak<br>
		  <input type="radio" name="q6" value=3 required>Moderate<br>
		  <input type="radio" name="q6" value=4 required>Strong<br>
		  <input type="radio" name="q6" value=5 required>Very Strong<br> 	
		<br>		
		<p>7. Do you find evidence that our students have the ability to communicate effectively? </p>
		  <input type="radio" name="q7" value=0 required>No basis for judgement<br>
		  <input type="radio" name="q7" value=1 required>Very Weak<br>
		  <input type="radio" name="q7" value=2 required>Weak<br>
		  <input type="radio" name="q7" value=3 required>Moderate<br>
		  <input type="radio" name="q7" value=4 required>Strong<br>
		  <input type="radio" name="q7" value=5 required>Very Strong<br>
		<br>		
		<p>8. Do you find evidence that our students understand the impact of engineering solutions in a societal context?</p>
		  <input type="radio" name="q8" value=0 required>No basis for judgement<br>
		  <input type="radio" name="q8" value=1 required>Very Weak<br>
		  <input type="radio" name="q8" value=2 required>Weak<br>
		  <input type="radio" name="q8" value=3 required>Moderate<br>
		  <input type="radio" name="q8" value=4 required>Strong<br>
		  <input type="radio" name="q8" value=5 required>Very Strong<br>
		<br>		
		<p>9. Do you find evidence that our students have the ability and recognize the need for independent learningoutside the classroom context?</p>
		  <input type="radio" name="q9" value=0 required>No basis for judgement<br>
		  <input type="radio" name="q9" value=1 required>Very Weak<br>
		  <input type="radio" name="q9" value=2 required>Weak<br>
		  <input type="radio" name="q9" value=3 required>Moderate<br>
		  <input type="radio" name="q9" value=4 required>Strong<br>
		  <input type="radio" name="q9" value=5 required>Very Strong<br> 	
		<br>		
		<p>10. Do you find evidence that our students have knowledge of contemporary engineering practice?</p>
		  <input type="radio" name="q10" value=0 required>No basis for judgement<br>
		  <input type="radio" name="q10" value=1 required>Very Weak<br>
		  <input type="radio" name="q10" value=2 required>Weak<br>
		  <input type="radio" name="q10" value=3 required>Moderate<br>
		  <input type="radio" name="q10" value=4 required>Strong<br>
		  <input type="radio" name="q10" value=5 required>Very Strong<br>
		<br>		
		<p>11. Do you find evidence that our students have an ability to use modern engineering tools for analysis and design?</p>
		  <input type="radio" name="q11" value=0 required>No basis for judgement<br>
		  <input type="radio" name="q11" value=1 required>Very Weak<br>
		  <input type="radio" name="q11" value=2 required>Weak<br>
		  <input type="radio" name="q11" value=3 required>Moderate<br>
		  <input type="radio" name="q11" value=4 required>Strong<br>
		  <input type="radio" name="q11" value=5 required>Very Strong<br>
		<br>		
		<p>12. How do the skills and competencies that you observed today compare with those demonstrated by entry-level engineers from other institutions?</p>
		  <input type="radio" name="q12" value=0 required>No basis for judgement<br>
		  <input type="radio" name="q12" value=1 required>Much Worse<br>
		  <input type="radio" name="q12" value=2 required>Worse<br>
		  <input type="radio" name="q12" value=3 required>About the Same<br>
		  <input type="radio" name="q12" value=4 required>Better<br>
		  <input type="radio" name="q12" value=5 required>Much Better<br> 
		<br>		
		<label for="comment">Other Comments</label><br>
			<input type="text" id="comment" name="commentsection" placeholder="Any comments..">
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
