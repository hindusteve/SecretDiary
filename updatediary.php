<?php

	session_start();
	
	include("connection.php");



	// $query="UPDATE users SET Diary='".mysqli_real_escape_string($_POST[`password`])."' WHERE `ID`='".$_SESSION['ID']."' LIMIT 1";

	$query="UPDATE users SET diary='".mysqli_real_escape_string($link, $_POST['diary'])."'WHERE ID='".$_SESSION['id']."' LIMIT 1";


	mysqli_query($link, $query);

	print_r($_SESSION);

?>
