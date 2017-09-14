<?php

	session_start();

	if ($_GET["logout"]==1 AND $_SESSION['id']) {session_destroy();

		$message="You have been logged out. Have a nice day!";

//		echo "DB - here 100";

	}

//		echo "DB - here 0";
	include("connection.php");


	if ($_POST['submit']=='Sign Up') {

//		echo "DB - here 1";

		if (!$_POST['password']) $error.="<br />Please enter your password";
		else {

			if (strlen($_POST['password'])<8) $error.="<br />Please enter a password with at least 8 characters";
			if (!preg_match('`[A-Z]`', $_POST['password'])) $error.="<br />Please include at least 1 capital letter in password";

		}

		if (!$_POST['email']) $error.="<br />Please enter your email address";
		
		else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			// checking if email is not blank, if a valid email is 
			$error.="<br />Please enter a valid email address";
		}

		if ($error) $error = "<br />There were errors in your signup details: ".$error;
		else {

			//check if email address already exists

			if (mysqli_connect_error()) {
				die("could not connect to database");

			} 


			$query = "SELECT * FROM `users` WHERE email ='" .mysqli_real_escape_string($link, $_POST['email'])."'"; //use mysqli_real_escape_string to protect against SQL injections

			$result = mysqli_query($link, $query);
			$results = mysqli_num_rows($result); // either 0 or the number of results in the database


			if ($results) {
				$error= "This email address already exists";
			} else {

//		echo "DB - here 2";

				$query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".md5(md5($_POST['email']).$_POST['password'])."')";

//				echo "DB - here 200";
				mysqli_query($link, $query); //actually run the query
				$success = "You've been signed up!";

				$_SESSION['id']=mysqli_insert_id($link);

				header("Location:mainpage.php");

			}

		}

	}


	if ($_POST['submit']=="Log In") {

	//	echo "DB - here 3";

	//	$link = mysqli_connect("shareddb1d.hosting.stackcp.net", "exampledb-32318f48", "JV6xmMoG3wY0", "exampledb-32318f48");

		if (mysqli_connect_error()) {
			die("could not connect to database");

		} 


		$query = "SELECT * FROM `users` WHERE email ='" .mysqli_real_escape_string($link, $_POST['loginemail'])."' AND password = '" .md5(md5($_POST['loginemail']) .$_POST['loginpassword']). "' LIMIT 1"; 

	//	echo "DB - here 4 ".$query;


		$result = mysqli_query($link, $query);

		$row = mysqli_fetch_array($result);

//		print_r($row);


		if ($row) {

			$_SESSION['id'] = $row['ID'];

		// print_r ($_SESSION['id']);

			header("Location:mainpage.php");

		} else {

			$error= "We could not find a user with that email and password. Please try again.";
		}
	}

?>