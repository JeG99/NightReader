<?php 
	session_start();
	$options = "";
	if (isset($_SESSION['id'])) {
		$options .= '<li><a class="left" href="search.php">My NightReadings</a></li><li><a class="left" href="profile.php">Profile</a></li><li><a class="right" href="logout.php">Logout</a></li>';
	} else {
		$options .= '<li><a class="right" href="login.php">Login</a></li><li><a class="right" href="signup.php">Sign Up</a></li>';
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
		<title>Home</title>
	</head>
	<body>
		
		<ul>
			<li><a class="logo" href="/">NightReader</a></li>
			<li><a class="left" href="book.php">NightReadings</a></li>
			<?php
				echo $options;
			?>
		</ul>

		<div class="container2">
			<h1 class="header">NightReader</h1>
		</div>

		<footer>
			<p>Made with ❤️ by the NightReader team</p>
		</footer>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</body>
</html>