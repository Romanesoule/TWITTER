$(document).ready(function () {

    $.ajax({
        type: "POST",
        url: "../controller/display_tweet.php",

        success: function (response) {
            

        var tab = response.split(" ");

        $.each(tab, function (index, value) { 
             if (value.substring(0, 1) =='@') {
                 
                 value = "<a href='#'>" + value + "</a>";
                 
                 tab.splice(index, 1, value );

             } else if (value.substring(0, 1) =='#') {
                 
                 value = "<a href='#'>" + value + "</a>";
                 
                 tab.splice(index, 1, value );
             }

        });
        
        var str = tab.join(" ");
        console.log(str);
        $(".display").html(str);
    }
    });
});