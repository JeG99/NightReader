$(document).ready( function() {
    let endpoint = 'https://www.poemist.com/api/v1/randompoems';
    var response; 

    $.ajax({
        url: endpoint,
        contentType: 'application/json',
        dataType: 'json',
        success: function(data, textStatus, xhr) {
            console.log(xhr.status);
            response = data;
            $('.poem-box').css("visibility", 'visible');
            $('#author').text(data[0].poet.name);
            $('#title').text(data[0].title);
            $('#poem').text(data[0].content);
        },
        complete: function(xhr, textStatus) {
            if(xhr.status == 429) {
                $('.failure').html(
                    '<h1>Too many poems requested! Please wait a little and refresh.</h1>'
                );
                $('.failure').show("fast");
            }
        } 
     })

     $(function () {
        $('#submit').click( function () {
            $.ajax({
                url: endpoint,
                contentType: 'application/json',
                dataType: 'json',
                success: function(data, textStatus, xhr) {
                    console.log(xhr.status);
                    response = data;
                    $('#save').show();
                    $('#author').text(data[0].poet.name);
                    $('#title').text(data[0].title);
                    $('#poem').text(data[0].content);
                },
                complete: function(xhr, textStatus) {
                    if(xhr.status == 429) {
                        $('.failure').html(
                            '<h1>Too many poems requested! Please wait a little and refresh.</h1>'
                        );
                        $('.failure').show("fast").delay(1000).fadeOut();
                    }
                } 
            })
        })
    })

    $('#save').click( function () {
        $.ajax({
            type: 'post',
            url: '../../Controllers/save_poem.php',
            data: response[0],
            success: function(data) {
                $('.failure').hide("fast");
                $('#save').hide("fast");
                $('#success').show("fast").delay(1000).fadeOut();
                console.log(data);
            }
        })
    })

})