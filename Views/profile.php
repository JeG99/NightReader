<?php 
	session_start();
	$options = "";
	if (isset($_SESSION['id'])) {
		$options .= '<li><a class="left" href="search.php">My NightReadings</a></li><li><a class="right" href="logout.php">Logout</a></li>';
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
		<script src="../resources/js/profile.js"></script>
		<title>Profile</title>
	</head>
	<body>
		
		<ul>
			<li><a class="logo" href="/">NightReader</a></li>
			<li><a class="left" href="book.php">NightReadings</a></li>
			<?php echo $options; ?>
		</ul>

		<div class="card">
			<div class="container4">
				<h2 class="username"> 
					Welcome <span class="user"> <?php echo $_SESSION['username'] ?> </span> !
				</h2> <br>
				<h3 class="fullname">
					Full name: <span class="name"> <?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname'] ?> <span>
				</h3>
				<h3 class="email">
					Email: <span class="mail"> <?php echo $_SESSION['email'] ?> <span>
				</h3> <br> <br> <br>
				<button class="delete">Delete account</button> <br> <br>
				<button class="changepass">Change password</button>
			</div>	
		</div>
		
		<h1 class="preview-label">Your last 3 favorite poems:</h1>
		<div id="preview"></div>

		<footer>
			<p>NightReader footer</p>
		</footer>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</body>
</html>