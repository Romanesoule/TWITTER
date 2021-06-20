$(document).ready(function () {

    $.ajax({
        type: "POST",
        url: "../controller/actuality.php",

        success: function (response) {
            response = response.trim();
            var tab = response.split("*");
            i=0;
            $.each(tab, function (index, value) { 
                 if (i == 0) {
                     $(".actuality").append('<div class="tweet"><img class="tweet_picture" width="50" height="50" src="'+ value + '">')
                     i++;
                 } else if (i == 1) {
                    $(".actuality").append(value);
                    i++;
                 } else if (i == 2) {
                    $(".actuality").append("@" + value);
                    i++;
                 } else if (i == 3) {
                    $(".actuality").append("<p>" + value + "</p>" );//CONTENU
                    i++;
                 } else if (i == 4) {
                    $(".actuality").append("<p>" + value + "</p>")
                    i++;
                 } else if (i == 5) {
                    $(".actuality").append("<i class='far fa-comment' id='com" + value + "'></i><textarea placeholder='Entrez votre réponse' cols='30' rows='1' class='reply' id='rep" + value + "'></textarea><i class='fas fa-retweet' id='" + value + "'></i>");
                    i++;
                 } else if (i == 6) {
                    $(".actuality").append(value + "<i class='far fa-heart'> </i><i class='fas fa-share-square'></i></p></div>");
                    i = 0;
                 } 
                
            });
        }
    });
});