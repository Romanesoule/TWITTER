$(document).ready(function () {

    setTimeout(function(){ 
        var class_retweet = $('.fa-retweet');
        var count = class_retweet.length;

        for(let i = 0; i < count; i++) { 

            class_retweet.eq(i).one("click" , function() {
            
            var id_tweet = $(this).attr('id');

            $.ajax({
                type: "POST",
                url: "../controller/retweet.php",
                data: {
                    id_tweet : id_tweet
                },
    
                success: function (response) {
                    
                        $.ajax({
                        type: "POST",
                        url: "../controller/send_tweet.php",
                        data: {
                            tweet_content : response,
                            media : " "
                        },
                        success: function (data) {
                            alert(data);
                        }
                    });
                }

            });

        })
    }
    }, 1000);

});