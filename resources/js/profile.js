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
        $('#preview').html(
            entries
        );
    });

});