$(document).ready( function () {

    $('#search-button').click( function () {
        var query = $('#query').val();
        console.log(user_id);
        $("input").each( function () { // jala pero no como debería jejeje
            console.log("this: ", $(this).val());
            if($(this).val() === "") {
                alert("Enter some keywords first.");
                xhr.abort();
            }
        });
        
        $.get("../../Controllers/search_poems.php", {query: query, id: user_id}, function (data) {
            console.log(data);
            if(data.lenght > 0) {
                console.log(data.lenght)
                objList = JSON.parse('{"a":' + data + '}')['a'];
                console.log(objList[0]);
                entries = "";
                objList.forEach(element => {
                    entries += "<tr><td>" + element.POEM_TITLE + "</td>";
                    entries += "<td>" + element.POET_NAME + "</td>";
                    entries += '<td><a class="poem-link" target="_blank" href=' + element.POEM_URL + '>Read "' + element.POEM_TITLE + '" in Poemist.com</a></td></tr>';
                });
                $(".note").hide();
                $("#result").html(
                    "<thead><tr><th>Title</th><th>Author</th><th>URL</th></tr><thead><tbody>" + entries + "</tbody>"
                );
            } else {
                $(".note").html( "No poems found. Try using different search terms or saving some poems first!" );
            }
            
        });
    });
});