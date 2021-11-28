$(document).ready( function () {

    $.get("../../Controllers/preview.php", function (data) {
        console.log(data);
        objList = JSON.parse('{"a":' + data + '}')['a'];
        console.log(objList[0]);
        entries = "";
        objList.forEach(element => {
            entries += '<span class="poem"><div class="poem-title">' + element.POEM_TITLE + '</div>';
            entries += '<div class="poem-content">' + element.POEM_CONTENT.substring(0, 100) + "...</div>";
            entries += '<div class="poem-link"><a href=' + element.POEM_URL + '>Read "' + element.POEM_TITLE + '" in Poemist.com</a></div></span>';
        });
        if (entries != '') {
            $('.on-delete').before('<h1 class="preview-label">Your last 3 favorite poems:</h1><div id="preview"></div>');
        }
        else {
            $('.on-delete').before('<h1 class="preview-label">You have no saved poems, go read some!</h1><div id="preview"></div>');
        }
        $('#preview').html(
            entries
        );
    });

    $('.delete').click( function () {
        console.log("delete");

        $('.on-delete').css('visibility', 'visible');
        $('#on-delete-button').click( function () {

            $("input").each( function () { // jala pero no como debería jejeje
				console.log("this: ", $(this).val());
				if($(this).val() === "") {
					alert("One or more empty fields");
					xhr.abort();
				}
			});

            if (email == $('#on-delete-field-email').val()) {
                $.ajax({
                    type: 'post',
                    url: '../../Controllers/login.php',
                    data: {
                        email: $('#on-delete-field-email').val(),
                        password: $('#on-delete-field-pass').val()
                    },
                    success: function(data) {
                        console.log(data)
                        switch(data) {
                            case '1':
                                $.ajax({
                                    url: '../../Controllers/delete.php',
                                    contentType: 'application/json',
                                    dataType: 'json',
                                    success: function(data) {
                                        console.log(data)
                                        if (data == '1') {
                                            console.log("Account deleted :(");
                                            $(location).prop('href', '/');
                                        } else if (data == '2') {
                                            console.log("Error on account deletion");
                                        } else {
                                            console.log("Wrong password");
                                        }
                                    }
                                });
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
                            document.getElementById("on-delete-field-email").style.background = "#FF8A97";
                            document.getElementById("on-delete-field-pass").style.background = "#FF8A97";
                            $("#on-delete-field-email").effect("shake", {distance: 5});
                            $("#on-delete-field-pass").effect("shake", {distance: 5});
                        }
                    }
                });
            } else {
                document.getElementById("error").innerHTML = "ERROR: Check your email or password.";
                document.getElementById("on-delete-field-email").style.background = "#FF8A97";
                document.getElementById("on-delete-field-pass").style.background = "#FF8A97";
                $("#on-delete-field-email").effect("shake", {distance: 5});
                $("#on-delete-field-pass").effect("shake", {distance: 5});
            }
        });
        $('#on-delete-cancel').click( function () {
            $('.on-delete').css('visibility', 'hidden');
        });

    });

    $('.changepass').click( function () {
        console.log("changepass");
        $(location).prop('href', '/forgot.php');
    });

});