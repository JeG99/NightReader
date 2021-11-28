$(document).ready( function() {

	$(document).on({
		ajaxStart: function() { $('.loading').css('visibility', 'visible');},
		ajaxStop: function() { $('.loading').css('visibility', 'hidden'); }    
	});

	const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

	function generateToken() {
		let result = ' ';
		const charactersLength = characters.length;
		for ( let i = 0; i < 6; i++ ) {
			result += characters.charAt(Math.floor(Math.random() * charactersLength));
		}

		return result;
	}

	var xhr;
	var token;

	// login
	$(function () {
		$('#login').on('submit', function (e) {
			e.preventDefault();

			$("input", this).each( function () { // jala pero no como debería jejeje
				console.log("this: ", $(this).val());
				if($(this).val() === "") {
					alert("One or more empty fields");
					xhr.abort();
				}
			});

			xhr = $.ajax({
				type: 'post',
				url: '../../Controllers/login.php',
				data: $('form').serialize(),
				success: function (data) {
					switch(data) {
						case '1':
							console.log("Loggeado");
							$(location).prop('href', '/');
							break;
						case '2':
							document.getElementById("error").innerHTML = "ERROR: This email is not registered.";
							break;
						case '3':
							document.getElementById("error").innerHTML = "ERROR: Check your email or password.";
							break;
						case '4':
							document.getElementById("error").innerHTML = "ERROR: Server not available";
							break;
						default:
							console.log("wtf", data);
					}
					if(data > 1) {
						document.getElementById("email").style.background = "#FF8A97";
						document.getElementById("password").style.background = "#FF8A97";
						$("#email").effect("shake", {distance: 5});
						$("#password").effect("shake", {distance: 5});
					}
				}
			});
		});
	});

	// signup
	$(function () {
		$('#signup').on('submit', function (e) {
			e.preventDefault();

			$("input", this).each( function () { // jala pero no como debería jejeje
				console.log("this: ", $(this).val());
				if($(this).val() === "") {
					alert("One or more empty fields");
					xhr.abort();
				}
			});

			xhr = $.ajax({
				type: 'post',
				url: '../../Controllers/signup.php',
				data: $('form').serialize(),
				success: function (data) {
					switch(data) {
						case '1':
							console.log("Cuenta creada");
							$(".container").hide("drop");
							$(location).prop('href', '/');
							break;
						case '2':
							document.getElementById("error").innerHTML = "ERROR: This account could not be created.";
							break;
						case '3':
							document.getElementById("error").innerHTML = "This username is already in use.";
							break;
						case '4':
							document.getElementById("error").innerHTML = "This email is already in use.";
							break;
						default:
							console.log("wtf", data);
					}
				}
			});
		});
	});

	// forgot pass
	$(function () {
		$('#forgot').on('submit', function (e) {
			e.preventDefault();

			$("input", this).each( function () { // jala pero no como debería jejeje
				console.log("this: ", $(this).val());
				if($(this).val() === "") {
					alert("One or more empty fields");
					xhr.abort();
				}
			});
			if (email == $('#email').val()) {
				console.log(email, $('#email').val());
				xhr = $.ajax({
					type: 'post',
					url: '../../Controllers/forgot_password.php',
					data: $('form').serialize(),
					success: function (data) {
						switch(data) {
							case '1':
								console.log("Contraseña cambiada");
								$(".container").hide("drop");
								$(".success").fadeIn();
								break;
							case '2':
								document.getElementById("error").innerHTML = "ERROR: Passwords must match.";
								break;
							default:
								console.log("wtf", data);
						}
						if(data > '1') {
							document.getElementById("email").style.background = "#FF8A97";
							document.getElementById("password1").style.background = "#FF8A97";
							document.getElementById("password2").style.background = "#FF8A97";
							$("#email").effect("shake", {distance: 5});
							$("#password1").effect("shake", {distance: 5});
							$("#password2").effect("shake", {distance: 5});
						}
					}
				});
			} else {
				document.getElementById("error").innerHTML = "ERROR: Check your email.";
				document.getElementById("email").style.background = "#FF8A97";
				document.getElementById("password1").style.background = "#FF8A97";
				document.getElementById("password2").style.background = "#FF8A97";
				$("#email").effect("shake", {distance: 5});
				$("#password1").effect("shake", {distance: 5});
				$("#password2").effect("shake", {distance: 5});
			}
		});
	});

	$body = $("body");

});