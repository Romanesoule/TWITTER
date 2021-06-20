$(document).ready(function () {
    
    $(".deconnect").click(function (e) { 
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "../controller/deconnect.php",
            
            success: function (response) {
                window.location = "connexion.html";
            }
        });
        
    });
    
});