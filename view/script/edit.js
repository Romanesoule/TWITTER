$(document).ready(function () {
    
    var maxLen = 160;
        
    $("#new_biography").keypress(function(event){
        var Length = $("#new_biography").val().length;

        if(Length >= maxLen){
            if (event.which != 8) {
                return false;
            }
        }
    });


    $("#edit").submit(function (e) { 
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "../controller/edit.php",
            data : { 
                avatar : $('#new_avatar').val(),
                nick_name : $('#new_nick_name').val(),
                birthday : $('#new_birthday').val(),
                biography : $('#new_biography').val(),
                website : $('#new_website').val(),
                location : $('#new_location').val()
            },
            
            success: function (response) {
                location.reload();
            }
        });
    });
});