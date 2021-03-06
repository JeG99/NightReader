<?php 
	session_start();
	$options = "";
	if (isset($_SESSION['id'])) {
		$options .= '<li><a class="left" href="search.php">My NightReadings</a></li><li><a class="left" href="profile.php">Profile</a></li><li><a class="right" href="logout.php">Logout</a></li>';
	} else {
		$options .= '<li><a class="right" href="login.php">Login</a></li><li><a class="right selected" href="signup.php">Sign Up</a></li>';
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" type="image/jpg" href="resources/img/favicon.ico"/>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="../resources/css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="../resources/js/ajax.js"></script>
		<title>Sign up</title>
	</head>
	<body>

		<ul>
			<li><a class="logo" href="/">NightReader</a></li>
			<li><a class="left" href="book.php">NightReadings</a></li>
			<?php
				echo $options;
			?>
		</ul>

		<div class="container">
			<h1>Sign up</h1> <br>
			<form id="signup">
				<p id="error"></p>
				<label for="fname">First name:</label>
				<input type="text" id="fname" name="fname"><br><br>
				<label for="lname">Last name:</label>
				<input type="text" id="lname" name="lname"><br><br>
				<label for="email">Email:</label>
				<input type="email" id="email" name="email"><br><br>
				<label for="username">Username:</label>
				<input type="text" id="username" name="username"><br><br>
				<label for="password">Password:</label>
				<input type="password" id="password" name="password"><br><br>
				<button id="submit" type="submit">Register</button>
			</form>
		</div>

		<footer>
			<p>Made with ❤️ by the NightReader team</p>
		</footer>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</body>
</html>