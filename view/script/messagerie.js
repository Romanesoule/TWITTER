$(document).ready(function() {

    url = window.location.href;
    urlCheck = "http://localhost:8000/view/messagerie.php"
    
    //VERIF DE L'URL SI ID EST DEFINI DANS L'URL ALORS AJAX NON EXEC
    if (url === urlCheck) {
        $.ajax({
            type: "GET",
            url: "http://localhost:8000/controller/messagerie_index.php",
            success: function (data) {
                $('.my_ctn_msg').append(data)
            }
        });
    }
    //SI ID DEFINI ALORS CHARGEMENT DE LA CONVERSATION VIA L'ID RECUPERÉ DANS L'URL && REFRESH 3s
    else {
        url = url.split('id=');
        id = url[1];
        get_message(id);
        $("#form").append('<form> <input type="text" id="content"> <input type="submit" value="Envoyer" id="submit"> </form>')
        setInterval("get_message(id)", 3000);
    }

    $('#submit').on('click', function(e) {
        e.preventDefault();
        url = window.location.href;
        url = url.split('id=');
        id = url[1];
        send_message(id)
    })

    $('.receiver').on('click', function() {
        test()
    });
})

function get_message(id) {
    $.ajax({
        type: "GET",
        url: "http://localhost:8000/controller/messagerie_get_msg.php",
        data: {
            id : id,  
        },
        success: function (data) {

            $(".my_ctn_msg").empty();

            var url = window.location.href;
            var urlCheck = "http://localhost:8000/view/messagerie.php"
            
            if (url === urlCheck) {
                window.location.href += "?id=" + id;
            }

            data = data.split("//&&&&&&&&//")
            data.pop()

            $.each(data, function (index, value) {
                //SI C'EST PAIR DONC UN ID
                if(index %2 == 0) {
                    if(value == id) {
                        check = true;
                    }
                    else {
                        check = false;
                    }
                }
                //SI C'EST IMPAIR DONC CONTENT
                else {
                    if(check == true) {
                        $(".my_ctn_msg").append("<span class='msg_received'> J'ai recu : " + value + "</span><br>")
                    }
                    else {
                        $(".my_ctn_msg").append("<span class='msg_send'> J'ai envoyé : " + value + "</span><br>")
                    }
                }
            });
        },
        error: function() {
            $(".my_ctn_msg").empty();
            $(".my_ctn_msg").html("Une erreur lors de la récupération des messages est survenue. Redirection vers l'index de la messagerie.");
            setTimeout(location, 5000);
            function location() {
                window.location.href = "http://localhost:8000/view/messagerie.php";
            }
        }
    })
}

function send_message(id) {
    $.ajax({
        type: "POST",
        url: "http://localhost:8000/controller/messagerie_send_msg.php",
        data: {
            id : id,
            content : $('#content').val(),
        },
        success: function (response) {
            get_message(id);
        }
    });
}

function test() {
    alert('ss')
}