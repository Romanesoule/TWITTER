$(document).ready(function () {

    setTimeout(function(){ 

        $(".reply").css("display" , "none");  

        var class_reply = $('.fa-comment');
        var count = class_reply.length;

        for(let i = 0; i < count; i++) { 

            class_reply.eq(i).one("click" , function() {
            
                var id_tweet = $(this).attr('id').substring(3);
                var id_textarea = "rep" + id_tweet;

                $("#" + id_textarea).css("display" , "flex")

                $("#" + id_textarea).keypress(function (e) { 

                    if (e.keyCode === 13) {
                        
                        $.ajax({
                            type: "POST",
                            url: "../controller/find_tweet.php",
                            data: {
                                id_tweet : id_tweet
                            },
                            success: function (response) {
                                
                                $.ajax({

                                    type: "POST",
                                    url: "../controller/send_tweet.php",
                                    data: {
                                        tweet_content :response + " " + $("#" + id_textarea).val(),
                                        media : " "
                                    },
                                    success: function (data) {
                                        alert("votre réponse a bien été publiée");
                                    }
                                });
                            }
                        });

                        
                    }

                });


            })
        }
    }, 1000);


});

