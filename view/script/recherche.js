$(document).ready(function(){

    $.ajax({
        type: "POST",
        url: "../controller/recherche.php",
                
        success: function (data) {
            data = data.trim();
            var tableau  = data.split(" ");
            var newtab = [];
            tableau.forEach(function(item, index, array) {
                if (item.substring(0, 1) =='#' || item.substring(0, 1) =='@') {
                    newtab.push(item);
                }
              });
            $( "#recherche" ).autocomplete({
                source: newtab
            });
            
        }
    });

});
