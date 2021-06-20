$(document).ready(function(){

    setInterval(function(){ 
        location.reload();
    }, 1800000);

    var maxLen = 140;
        
    $('#send-twt').keypress(function(event){
        var Length = $("#send-twt").val().length;
        
        if(Length >= maxLen){
            if (event.which != 8) {
                return false;
            }
        }
    });

    $('.modal2').css('display','none');
    $('.popin-open').on('click',function(){ 
        $('.modal').css('display','flex');
      });
    
      $('.popin-open2').on('click',function(){ 
        $('.modal2').css('display','flex');
      });
      
    $('.popin-dismiss').on('click',function(){ 
        $('.modal').css('display','none');
    });

    $('.popin-dismiss2').on('click',function(){ 
        $('.modal2').css('display','none');
    });
  
    $(document).keyup(function(e) {
        if (e.keyCode === 27) {
            $('.modal').css('display','none');
            $('.modal2').css('display','none');
        } 
    });

    $(".fa-circle").click(function() {
        $(this).removeClass("fa-circle").addClass("fa-check-circle");
        $(".change").attr('id', $(this).attr('id') );
        $(".changebg").attr('id', 'bg' + $(this).attr('id') );
    });

    $(".fa-circle").dblclick(function() {
        $(this).removeClass("fa-check-circle").addClass("fa-circle");
    });

    $("input[name='size']").click( function() {
        $("body,a").css("font-size", $(this).val());
    });
    
    $(".white").click(function() {
        $("body,a").css("background-color" , "white");
        $("body,a").css("color" , "black");
    })

    $(".blue").click(function() {
        $("body,a").css("background-color" , "rgb(21, 3, 102)");
        $("body,a").css("color" , "white");

    })

    $(".black").click(function() {
        $("body,a").css("background-color" , "black");
        $("body,a").css("color" , "white");
    })

});
