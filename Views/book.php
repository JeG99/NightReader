<?php 
	session_start();
	$options = "";
	$buttons = "";
	if (isset($_SESSION['id'])) {
		$options .= '<li><a class="left" href="search.php">My NightReadings</a></li><li><a class="left" href="profile.php">Profile</a></li><li><a class="right" href="logout.php">Logout</a></li>';
		$buttons .= '<button id="submit" type="submit">New poem</button> &nbsp; <button id="save" type="save">Save</button></div>'; 
	} else {
		$options .= '<li><a class="right" href="login.php">Login</a></li><li><a class="right" href="signup.php">Sign Up</a></li>';
		$buttons .= '<button id="submit" type="submit">New poem</button>';
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
		<script src="../resources/js/poems.js"></script>
		<title>NightReads</title>
	</head>
	<body>

		<ul>
			<li><a class="logo" href="/">NightReader</a></li>
			<?php
				echo $options;
			?>
		</ul>

		<div class="container poem-box">
			<div class="buttons-container">
				<h1 id="title" class=""></h1>
				<h2 id="author"></h2>
				<br>
				<div id="poem"></div>
				<br><br>
				<?php echo $buttons ?>
		</div>

		<!--
		<footer>
			<p>NightReader footer</p>
		</footer>
		-->
		<div class="loading"></div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</body>
</html>