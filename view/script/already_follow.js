$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "../controller/already_follow.php",
        data: {
            username_follow: $('#username').html()
        },
        success: function (data) {
            //console.log(data);
            data = data.trim()
            if (data == "Success") {
                $('#suivre').off('click');
                $('#suivre').addClass('active');
                $('#suivre').html('Abonné');

                $('#suivre').attr('id', 'unfollow');

                $('#unfollow').on('click', function (e){
                    e.preventDefault();
    
                    unfollow();
                });
                
                $('#unfollow').hover(function () {
                    $('#unfollow').html("Ne plus suivre");
                    $('#unfollow').css('background-color', '#FF0000');
    
                        
                    }, function () {
                        $('#unfollow').html("Abonné");
                        $('#unfollow').css('background-color', '');
                    }
                );

            }
        }
    });
});

function suivre() { 
    
    $.ajax({
        type: "POST",
        url: "../controller/suivre.php",
        data: {
            username_follow: $('#username').html()
        },
        success: function (data) {
            console.log(data);
            $('#suivre').addClass('active');
            $('#suivre').html('Abonné');
            $('#suivre').off('click');

            $('#suivre').attr('id', 'unfollow');

            $('#unfollow').on('click', function (e){
                e.preventDefault();

                unfollow();
            });
            
            $('#unfollow').hover(function () {
                $('#unfollow').html("Ne plus suivre");
                $('#unfollow').css('background-color', '#FF0000');

                    
                }, function () {
                    $('#unfollow').html("Abonné");
                    $('#unfollow').css('background-color', '');
                }
            );
        }
    });
};

function unfollow(){
    console.log('unfollow')
    var confirmUnfollow = confirm("Se désabonner de @" + $('#username').html() + " ?");
    
    if (confirmUnfollow == true) {
        $.ajax({
            type: "POST",
            url: "../controller/unfollow.php",
            data: {
                username_follow: $('#username').html()
            },
            success: function (data) {
                $('#unfollow').removeClass('active');
                $('#unfollow').html('Suivre');
                $('#unfollow').off('click');
    
                $('#unfollow').attr('id', 'suivre');

                $('#suivre').on('click', function(e){
                    e.preventDefault();

                    suivre();
                });
            }
        });
    }
}