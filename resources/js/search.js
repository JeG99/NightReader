$(document).ready( function () {

    $('#search-button').click( function () {
        var query = $('#query').val();
        $("#result").html('&nbsp;');
        $(".note").html('&nbsp;');
        $("input").each( function () { // jala pero no como debería jejeje
            if($(this).val() === "") {
                alert("Enter some keywords first.");
                xhr.abort();
            }
        });
        
        $.get("../../Controllers/search_poems.php", {query: query, id: user_id}, function (data) {            
            objList = JSON.parse('{"a":' + data + '}')['a'];
            if(objList.length != 0) {
                $(".note").hide();
                console.log(objList[0]);
                entries = "";
                objList.forEach(element => {
                    entries += "<tr><td>" + element.POEM_TITLE + "</td>";
                    entries += "<td>" + element.POET_NAME + "</td>";
                    entries += '<td><a class="poem-link" target="_blank" href=' + element.POEM_URL + '>Read "' + element.POEM_TITLE + '" in Poemist.com</a></td></tr>';
                });
                $("#result").html(
                    "<thead><tr><th>Title</th><th>Author</th><th>URL</th></tr><thead><tbody>" + entries + "</tbody>"
                );
            } else {
                $(".note").html( "No poems found. Try using different search terms or saving some poems first!" );
                $(".note").show();
            }
            
        });
    });
});