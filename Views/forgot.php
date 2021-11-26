<?php 
	session_start();
	$options = "";
	if (isset($_SESSION['id'])) {
		$options .= '<li><a class="left" href="search.php">My NightReadings</a></li><li><a class="left" href="">Profile</a></li><li><a class="right" href="logout.php">Logout</a></li>';
	} else {
		$options .= '<li><a class="right" href="login.php">Login</a></li><li><a class="right" href="signup.php">Sign Up</a></li>';
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="../resources/css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="../resources/js/ajax.js"></script>
		<title>Forgot password</title>
	</head>
	<body>

		<ul>
			<li><a class="logo" href="/">NightReader</a></li>
			<li><a class="left" href="book.php">NightReadings</a></li>
			<?php
				echo $options;
			?>
		</ul>

		<div class="success">
			<h1>Password successfully changed</h1> <br>
		</div>
		<div class="container">
			<h1>Forgot password</h1> <br>
			<form id="forgot">
				<p id="error"></p>
				<label for="email">Email:</label>
				<input type="email" id="email" name="email"><br><br>
				<label for="password1">New password:</label>
				<input type="password" id="password1" name="password1"><br><br>
				<label for="password2">Repeat password:</label>
				<input type="password" id="password2" name="password2"><br><br>
				<button id="submit" type="submit">Change password</button>
			</form>
		</div>

		<footer>
			<p>NightReader footer</p>
		</footer>
		<script type="text/javascript" href="../resources/js/ajax.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</body>
</html>