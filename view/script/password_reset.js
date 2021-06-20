$('#password_reset').submit(function(e){

    e.preventDefault();
    $.post(
        '../controller/password_reset.php',
        {
            user: $('#info_user').val()
        },
        function(data){
            data = data.trim();
            if (data == "") {
                $('#user_not_exist').html("<h3>L'utilisateur n'existe pas</h3>");
            } else {
                $('#user_not_exist').html("");
                console.log(data);
                
            }
        }
    )
})

