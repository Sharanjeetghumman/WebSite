<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['authorized']) && $_SESSION['authorized'] === TRUE) {
} else {
    header('Location: index.html');
}
?>
<!--link to css style sheet-->
<link rel="stylesheet" type="text/css" href="mystyle.css"> 
<link rel="stylesheet" type="text/css" href="listbox.css"> 
<script src="listbox.js"></script>


<p>Welcome Judges</p>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'evalForm')">Evaluation Form</button>
  <button class="tablinks" onclick="openCity(event, 'expForm')">Experience Form</button>
  <form action = "logOut.php" method="post">  
	<input class="tablinks" style="float:right" type = "submit" value = "Logout">
  </form>
</div>


<div id="evalForm" class="tabcontent">
	<div>
		<iframe src="form_project.php" name="evalFrame" allowTransparency="true" scrolling="yes" frameborder="0" width="100%" height="1000"></iframe>
	</div>
	

</div>

<div id="expForm" class="tabcontent">
	<div>
		<iframe src="form_judges.php" name="expFrame" allowTransparency="true" scrolling="yes" frameborder="0" width="100%" height="1000"></iframe>
	</div>
	

</div>



</html>
