$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "../controller/number_follow.php",
        data: {
            // Utilisation en tant que $_POST dans le controlleur
            username: $('#username').html()
        },
        success: function (data) {
            data = data.trim();
            console.log(data);
            data = data.split('----');
            $("#followed").html(data[0] + " abonnés");

            $("#followed").on('click', function () {
                //alert("test");
                $("#modal_followed").css("display", "inline");
                $('#modal_followed').html("");
                for (let i = 1; i < data.length - 1; i++) {
                    $('#modal_followed').append("@" + data[i] + "<br>");
                }

                $("#modal_followed").on('click', function () {
                    $("#modal_followed").css("display", "none");

                });    

            });
            $('body').keyup(function (e) {
                if (e.which == 27) {
                    $("#modal_followed").css("display", "none");
                }
            });
        }
    });

    $.ajax({
        type: "POST",
        url: "../controller/number_followed.php",
        data: {
            username: $('#username').html()
        },
        success: function (data) {
            data = data.split('----');
            $('#follower').html(data[0] + " abonnement");

            $("#follower").on('click', function () {
                //alert("test");
                $("#modal_follower").css("display", "inline");
                $('#modal_follower').html("");
                for (let i = 1; i < data.length - 1; i++) {
                    $('#modal_follower').append("@" + data[i] + "<br>");
                }
                $("#modal_follower").on('click', function () {
                    $("#modal_follower").css("display", "none");

                });    

            });
            $('body').keyup(function (e) {
                if (e.which == 27) {
                    $("#modal_follower").css("display", "none");
                }
            });
            
        }
    });
});