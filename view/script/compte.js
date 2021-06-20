$.ajax({
    url: "../controller/compte.php",
    data: {
        username: $('#username').html()
    },
    success: function (data) {
        data = data.trim()
        var info = data.split('----');

        $('#suivre').toggle('hidden');

        var month = [
            "Janvier",
            "Fevrier",
            "Mars",
            "Avril",
            "Mai",
            "Juin",
            "Juillet",
            "Aout",
            "Septembre",
            "Octobre",
            "Novembre",
            "Decembre"
        ];

        $('#nickname_header').html(info[1]);
        $('#username').html(info[2]);
        $('#nickname').html(info[1]);
        $('#avatar').attr("src", info[11])
        $('#biography').html(info[7]);
        $('#location').html("<i class='fas fa-map-marker-alt'></i> " + info[10]);
        $('#website').html("<a href='" + info[6] + "'>" + info[6] + "</a>");
        $('#birthday').html("Naissance le " + info[8]);
        
        var date = info[8].split('-');
        var date_inscription = info[9].split('-')

        var user_month = date[1];
        var user_creation_month = date_inscription[1];

        var array = [];
        
        $.each(month, function (index, value) { 
            index++;
            if (index < 10) {
                index = "0" + index;
            } else {
                index = "" + index;
            }

            array.push(index);
        });

        $.each(array, function (index, value) { 

            if (value == user_month) {
                $('#birthday').html("<i class='far fa-calendar-alt'></i> " + date[2] + " " + month[index] + " " + date[0]);
            }
        });

        $.each(array, function (index, value) { 
             if (value == user_creation_month) {
                $('#inscription_date').html("A rejoint Twitter en " + month[index] + " " + date_inscription[0]);
            }
        });

    }
});

var nbr = document.cookie.split('=')

$('#gomsg').addEventListener('click', function() {
    $.ajax({
        type: "POST",
        url: "http://localhost:8000/controller/gomessagerie.php",
        data: "data",
        dataType: "dataType",
        success: function (response) {
            if(data == "true") {
                window.location.href = "http://localhost:8000/view/messagerie.php"
            }
            else {
                alert('error')
            }
        }
    });
})