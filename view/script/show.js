$(document).ready(function(){

    $(document).keyup(function(e) {
        if (e.keyCode === 13) {
            
            if ($("#recherche").val().substring(0, 1) =='#') {
                $.ajax({
                type: "POST",
                url: "../controller/show_hashtag.php",
                data : { 
                recherche_hashtag : $("#recherche").val()  
                },
                success: function (data) {
                    $("#show").html(data);
                    $("#hide").hide();
                }
            });
            }

            if ($("#recherche").val().substring(0, 1) =='@') {
                $.ajax({
                type: "POST",
                url: "../controller/show_user.php",
                data : { 
                recherche_user : $("#recherche").val().substring(1)  
                },
                success: function (data) {
                    data = data.trim()
                    $("#show").html(data);
                    $("#hide").hide();
                    
                }
            });
            }
            
        } 
    });

});
