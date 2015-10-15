<?php
		
	session_start();

	include("connection.php");

	function checkEmail($postvar) {
		if (!$_POST[$postvar] OR 
			!filter_var($_POST[$postvar], FILTER_VALIDATE_EMAIL)) {
				return "<br />Please enter valid email";
		}
	}

	function checkPassword($postvar) {
		if (!$_POST[$postvar])
			$err.="<br />Please enter your password";
		else {
			if (strlen($_POST[$postvar]) < 8)
				$err.="<br />Please enter a password of at least 8 characters";	

			if ( !preg_match('`[A-Z]`', $_POST[$postvar]))
				$err.="<br />Please have at least one capital letter in your passowrd";
		}
		return $err;
	}


	function emailExist($link, $useremail) {
		// Query DB to see if email already exist
		// use escape function to avoid sql injection attacks
		$email = mysqli_real_escape_string($link, $_POST[$useremail]);
		$query = "SELECT `email` FROM users WHERE email='".$email."'";

		$result = mysqli_query($link, $query);
		return mysqli_num_rows($result);
	}

	function createNewUser($link, $useremail, $userpasswd) {	
		if (emailExist($link, $useremail)) 
			return "Error: email account already exist for user";
		else {
			// Create new user	
			$email = mysqli_real_escape_string($link, $_POST[$useremail]);
			$passwd = mysqli_real_escape_string($link, $_POST[$userpasswd]);
			$passwd = md5(md5($email).$passwd);
			$query = "INSERT INTO `users` (`email`, `password`) VALUES('".$email."', '".$passwd."')";
			$result = mysqli_query($link, $query);
		}
	}

	function authenticateLogin($link, $loginemail, $loginpasswd) {
		if(!$_POST[$loginpasswd]) return "Please enter password";
		if (emailExist($link, $loginemail)) {
			$email = mysqli_real_escape_string($link, $_POST[$loginemail]);
			$passwd = mysqli_real_escape_string($link, $_POST[$loginpasswd]);
			$passwd = md5(md5($email).$passwd);
			$query = "SELECT * FROM users WHERE email='".$email."' AND password='".$passwd."' LIMIT 1";

			$result = mysqli_query($link, $query);
			$row = mysqli_fetch_array($result);
			
			if ($row) {
				//echo "Login Successful";
				$_SESSION['id'] = $row['id'];
				//print_r($_SESSION);


			}
			else 
				return "Password is incorrect";

		}
		else
			return "Your email is not found. Try again or Sign Up";

	}

	// Sign Up Submission
	if ($_POST['submit'] ) {
		$error.=checkEmail('email');
		$error.=checkPassword('password');

		if($error) {
			$error = "Errors:".$error;
		}
		else {

			$error = createNewUser($link, 'email', 'password');

			// return id of most recently inserted user in DB
			if (!$error) $_SESSION['id']=mysqli_insert_id($link);
			//print_r($_SESSION);

			// can no redirect, see reason below.	
		}
		echo $error;
	}

	// Log In Submission
	if ($_POST['login']) {
		$error.=checkEmail('login-email');

		if($error) 
			$error = "Errors:".$error;
		else{

			$error = authenticateLogin($link, 'login-email', 'login-pass');

			// can not redirect to logged in page from php code if the index page is making form submission through ajax. redirecting here would cause the div within the index page to redirect to diary.php which would look really messy
		}
		echo $error;
	}


?>
