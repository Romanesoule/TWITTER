$(document).ready(function() {

    $("#input_mail").toggle('hidden');
    $("#utiliserTel").toggle('hidden');

    $("#utiliserMail").click(function(e) {
        e.preventDefault()
        $("#input_tel").toggle('show')
        $("#input_mail").toggle('show')
        $("#utiliserMail").toggle('hidden');
        $("#utiliserTel").toggle('show');
    })
    $("#utiliserTel").click(function(e) {
        e.preventDefault()
        $("#input_tel").toggle('show')
        $("#input_mail").toggle('show')
        $("#utiliserMail").toggle('hidden');
        $("#utiliserTel").toggle('show');
    })

    $.ajax({
        url : "http://localhost:8000/controller/inscription_verif.php",
        type: 'POST',
        success: function(dat) {
            dat = dat.trim();
            if (dat == "error") {
                alert('Une erreur est survenue...')
            }
            else {
                console.log(dat)
                tab = dat.split(" ")
            }
        },
        error: function() {
            $("#submit").after("<span>Une erreur est survenue...</span>");
        }
    });

    $("#input_pseudo").keyup(function() {
        $.each(tab, function(index, value) { 
            if (index %2 == 1) {
                if ($("#input_pseudo").val() == value) {
                    alert('pseudo deja utilisé')
                    pseudoCheck = false
                }
                else {
                    pseudoCheck = true
                }
            }
        });
    })

    $("#input_mail").keyup(function() {
        $.each(tab, function(index, value) { 
            if (index %2 == 0) {
                if ($("#input_mail").val() == value) {
                    alert('mail deja utilisé')
                    mailCheck = false
                }
                else {
                    mailCheck = true
                }
            }
        });
    })

    
    $("#inscription").submit(function(e){
        e.preventDefault()
        if (pseudoCheck == true && mailCheck == true) {
    
            if ($("#input_nickname").val() == "") {
                alert('nom')
                return 0;
            }
        
            if ($("#input_date").val() == "") {
                alert('date')
                return 0
            }
        
            if ($("#input_location").val() == "") {
                alert('localisation')
                return 0
            }
        

            mail = $("#input_mail").val()
            tel = $("#input_tel").val()
            if (mail == "" || tel == "") {
                if (mail == "" && tel !== "") {
                    mail == "NULL"
                }
                else if (mail !== "" && tel == "") {
                    tel == "0000000000"
                }
                else {
                    alert('remplir champs mail ou num')
                    return 0
                }
            }
        
            if ($("#input_pwd").val() !== $("#input_pwd_verify").val()) {
                alert('pwd')
                return 0
            }

            $.ajax({
                url : "http://localhost:8000/controller/inscription.php",
                type: 'POST',
                data : {
                    nickname : $("#input_nickname").val(),
                    pseudo : $("#input_pseudo").val(),
                    date : $("#input_date").val(),
                    location : $("#input_location").val(),
                    mail : mail,
                    tel : tel,
                    pwd : $("#input_pwd").val()
                    
                },
                success: function(data) {
                    if(data == "true") {
                        window.location.href = "http://localhost:8000/view/connexion.html";
                    }
                    if (data == "false") {
                        alert('erreur')
                    }
                },
                error: function() {
                    $("#submit").after("<span>Une erreur est survenue...</span>");
                }
            });
        }
    })
})