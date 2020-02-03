<!-- logout script that returns to login page -->
<?php
$_SESSION['authorized'] = FALSE;
session_destroy();
header("location:index.html");
?>
