$(document).ready(function(){
    $("input").keyup(function(){
        var user = document.getElementById('user').value;
        var password_user = document.getElementById('password_user').value;
        
        if (user.length > 0 && password_user.length > 0) {
            document.getElementById('submit_login').disabled = false;
        } else {
            document.getElementById('submit_login').disabled = true;
        }
    })
});

$('#login_form').submit(function(e){
    
    e.preventDefault();

    $.post(
        '../controller/login.php',
        {
            user: $('#user').val(),
            password: $('#password_user').val()
        },

        function(data){
            console.log(data);
            data = data.trim();
            if (data == "Success") {
                
                window.location.href = 'accueil.html';
            } else {
                $("#login_failed").html("Connexion failed");
            }
        }

    )

})