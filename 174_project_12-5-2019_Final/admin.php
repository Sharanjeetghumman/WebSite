<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['authorized']) && $_SESSION['authorized'] === TRUE && $_SESSION['admin_status']==TRUE) {
} else {
    header('Location: index.html');
}
?>
<!link to css style sheet>
<link rel="stylesheet" type="text/css" href="mystyle.css"> 
<link rel="stylesheet" type="text/css" href="listbox.css"> 
<script src="listbox.js"></script>

<h>Welcome to admin page</h>

 <!-- Tab links: switch between tabs -->
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'makeSess')">Make Session</button>
  <button class="tablinks" onclick="openCity(event, 'viewSess')">View Individual Session</button>
  <button class="tablinks" onclick="openCity(event, 'summary')">Summary of Conference</button>
  <button class="tablinks" onclick="openCity(event, 'experience')">Summary Experience Forms</button>
  <button class="tablinks" onclick="openCity(event, 'j_eval_form')">Judge Evaluation Forms</button>
  <button class="tablinks" onclick="openCity(event, 'j_exp_form')">Judge Experience Forms</button>
  <form action = "logOut.php" method="post">  
	<input class="tablinks" style="float:right" type = "submit" value = "Logout">
  </form>
</div>

<!-- Tab content -->

<!-- Create Session page -->
<div id="makeSess" class="tabcontent">
  <h3>Create a Session</h3>
  <p>1) Enter Session Name<br>
	 2) Enter Judges Name(s)<br>
	 3) Enter Team Name<br>
	 4) Enter Team Member Name(s)<br>
	 5) Create Session<br>
  </p>
	<body id="main">
		<!-- creates session using data from input fields -->
		<form action="create_sessions.php" method="post" id="main2">
		<label for="judgename">Session Name</label>
		<input type="text" id="sessionname" name="sname" placeholder="Session name"><br>
		
		<div id="judges">
				  Judge Names (enter as a comma-separated list of judges' names):
				  <br>
				  <input type="text" id="judgemembers" name="jname" placeholder="First Last, First Last"><br>
		</div>
		
		<div id="testing">
				<p id="team">
					Team Name:
					<br>
					<input type="text" id="team0" name="team0" placeholder="Team Name"><br>
					<br>
						Team Member Names:
						<br>
						<input type="text" id="teammembers" name="name0team0" placeholder="First Name, Last Name">
					<button onclick="addmember(this.id, this.value)" id="memButton0" value="0">Add Members</button>
				</p>
		<br>
		</div>
		
		<!-- addTeam() creates a new text input box to submit into the database -->
		<button onclick="addTeam()" id="teamButton" value="1">Add Team</button>
		<br id = "brrr">
		<input type="submit" id="sButton" value="Create Session">
		</form>
	</body>
</div>

<!-- View Session page -->
<div id="viewSess" class="tabcontent">
  <h3>Individual Sessions</h3>
  <p>Enter a Session</p>
	  <!-- php scripts gets judges and teams from a given session  -->
	  <form action = "return_judges_teams.php" method="post">
		<input id = "session_name" name="session_name" placeholder="session name">
	  	<input type = "submit" name = "view_team_button" value = "View Teams">
		<input type = "submit" name = "view_judge_button" value = "View Judges">
	  </form>
</div>

<!-- Summary page -->
<div id="summary" class="tabcontent">
  <h3>Session Winners for the Conference</h3>
	<!-- php scripts gets calculated tabulated data from a given session  -->
	<form action = "tabulate_data.php" method="post">
		<input id = "session_name" name="session_name" placeholder="session name">
	  	<input type = "submit" name = "view_tab_data" value = "Get Tabulated Data">
		<input type = "submit" name = "view_judge_data" value = "Get Individual Judge Scores">
	</form>
	<!-- php scripts gets sumamry data for the conference  -->
	<form action = "view_all_results.php" method = "post">
		<input type = "submit" value = "View All Results">
	</form>
</div> 

<!-- Judges experience page -->
<div id="experience" class="tabcontent">
  <h3>View a Judge's Experience Form</h3>
	<!-- php scripts gets the results from a judges experience form  -->
	<form action="return_judge_forms.php" method="post">
		<input id = "judge_name" name="judge_name" placeholder="judge name">	
		<input type = "submit" value = "View Form">
	</form>
	<!-- php scripts gets average scores from all judge's experience form  -->
	<form action = "view_average.php" method = "post">
		<input type = "submit" value = "View Average Results per Question">
	</form>
  <br>

</div> 

<!-- View blank evaluation form -->
<div id="j_eval_form" class="tabcontent">
  <h3>Evaluation Form (View only)</h3>
	<div>
		<?php
			$_SESSION['session'] = '';
			$_SESSION['judge_name'] = 'admin';
		?>
		<iframe src="form_project.php" name="evalFrame" allowTransparency="true" scrolling="yes" frameborder="0" width="100%" height="1000"></iframe>
	</div>
  <br>

</div> 

<!-- View blank experience form -->
<div id="j_exp_form" class="tabcontent">
  <h3>Experience Form (View only)</h3>
	<div>
		<iframe src="form_judges.php" name="expFrame" allowTransparency="true" scrolling="yes" frameborder="0" width="100%" height="1000"></iframe>
	</div>
  <br>

</div> 

</html>
