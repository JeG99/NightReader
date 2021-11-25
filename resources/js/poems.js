$(document).ready( function() {
    let endpoint = 'https://www.poemist.com/api/v1/randompoems';

    $.ajax({
        url: endpoint,
        contentType: 'application/json',
        dataType: 'json',
        success: function(data) {
            $('.poem-box').css("visibility", 'visible');
            $('#poem').text(data[0].content);
            $('#title').text(data[0].title);
        }
     })

     $(function () {
        $('#submit').click( function () {
            $.ajax({
                url: endpoint,
                contentType: 'application/json',
                dataType: 'json',
                success: function(data) {
                    $('#poem').text(data[0].content);
                    $('#title').text(data[0].title);
                }
             })
        })
    })
})