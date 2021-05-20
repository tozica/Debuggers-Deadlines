$(document).ready(function(){
    $counter=0;
    /* Slide right and left div on the side */
    $("#slika").click(function(){
        $counter++;
        $("#idMenu").animate({
            width: "toggle"
        });
//        if($counter%2==0)
//        $('#tasks1').attr({
//            "class" : "col-sm-8 col-sm-offset-2"
//        }).css({"margin-right":"250px", "margin-left":"250px"});
//        else{
//            $('#tasks1').attr({
//                "class" : "col-sm-8 col-sm-offset-2"
//            }).css({"margin-left":"0"}); 
//        }
    });

    /* Slide down and up menu items */
    $(".flipProject").click(function(){
        $(".panelProject").slideToggle("slow");
    });

    $(".flipArchived").click(function(){
        $(".panelArchived").slideToggle("slow");
    });

    $(".flipLabels").click(function(){
        $(".panelLabels").slideToggle("slow");
    });


    /* Show and hide images on hover */
    $( ".flipProject" ).mouseover(function(){
        $("#hoverImgProject").show();
    });

    $( ".flipProject" ).mouseout(function(){
        $("#hoverImgProject").hide();
    });

    $( ".flipArchived" ).mouseover(function(){
        $("#hoverImgArchived").show();
    });

    $( ".flipArchived" ).mouseout(function(){
        $("#hoverImgArchived").hide();
    });

    $( ".flipLabels" ).mouseover(function(){
        $("#hoverImgLabels").show();
    });

    $( ".flipLabels" ).mouseout(function(){
        $("#hoverImgLabels").hide();
    });

    $('#Inbox').click(function(){
        $('#title').text("Inbox");
    });
    $('#Today').click(function(){
        $('#title').text("Today");
    });
    $('#Upcoming').click(function(){
        $('#title').text("Upcoming");
    });
    
    $(".circle").on({
        click : function(){
            $(this.parentNode).hide();
            $(this).hide();
            let id = $(this.parentNode).attr("id");
           $.ajax({
                type: "POST",
                url: "../../../App/Controllers/Guest.php",
                data: {
                id: id
                }
                }).done(function(result_html) {
                    alert(result_html);
                });
                        }
    });
    
    $(".text").click(function(){
        
        let parent=$(this.parentNode);
        let id=parent.attr("id");
        $("."+id).slideToggle("slow");

    })
    $("#Schedule").focus(function(){
        $(this).attr("type", "date");
    })
    
    let counter1=0;
    $('img').click(function(){
         
        let alarmClass = $(this).attr("class");
        if(alarmClass == "alarm"){
            counter1++;
            let id = $(this).attr("name");
            if(counter1%2===1){
                $(this).attr("src", "http://localhost/PSI-project/Implementacija/img/alarm-clock-blue.png");
                $("input[name='alarm']").val("1");
 
            }
            else{
                $(this).attr("src", "http://localhost/PSI-project/Implementacija/img/alarm-clock.png");
                $("input[name='alarm']").val("0");

            }
            
            
        }
    });
    
    
    $('.newAlarm').click(function(){
          let alarmClass = $(this).attr("class");
    
        if(alarmClass == "newAlarm"){
            let name = $(this).attr("name");
            if($(this).attr("src")=="http://localhost/PSI-project/Implementacija/img/alarm-clock-blue.png"){
                $(this).attr("src", "http://localhost/PSI-project/Implementacija/img/alarm-clock.png");
                $("input[name='alarmChange']").val("0");
            }
            else{
                $(this).attr("src", "http://localhost/PSI-project/Implementacija/img/alarm-clock-blue.png");
                $("input[name='alarmChange']").val("1");
            }
        }
    })
   
    
    $('.priority a').click(function(){
        var value=$(this).attr("value");
        $("input[name='priority']").val(value);
    })
    $('.newPriority a').click(function(){
        var value=$(this).attr("value");
        $("input[name='newPriority']").val(value);
    })
    $(".flag").click(function(){
        let id=$(this).attr("name");
        let key="newLabel"+id;
        $("#"+"newLabel"+id).slideToggle("slow");
    })
    
    $(".labela").click(function(){
        $(".labelaModal").slideToggle("slow");
    })
    
    $(".modalForm").focusout(function(){
        $(".labelaModal").hide();
    })
    
});