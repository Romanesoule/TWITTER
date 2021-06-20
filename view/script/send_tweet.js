$(document).ready(function () {

    $(".media").click(function (e) { 
        e.preventDefault();
        $("#lien").css("visibility" , "visible");
    });

    $("#tweet").submit(function (e) { 
        e.preventDefault();
        
        $.ajax({
            type: "POST",
            url: "../controller/send_tweet.php",
            data : { 
                tweet_content : " " + $('#send-twt').val(),
                media : $('#lien').val()
            },
            
            success: function (response) {
                alert(response);
            }
        });
    });
});

