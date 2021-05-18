$(document).ready(function(){
    let more = null;
    let countLi = 0;
    /* Slide right and left div on the side */
    $("#slika").click(function(){
        $("#idMenu").animate({
            width: "toggle"
        });
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
    $( ".flipProject" ).mouseenter(function(){
        $("#hoverImgProject").show();
    });

    $(".projectPlus").click(function () { 
        
        
    });

    $(".flipArchived").mouseenter(function () {
        $("#hoverImgArchived").show();
    })

    $(".flipArchived").mouseleave(function () {
        $("#hoverImgArchived").hide();
    })

    $( ".flipProject" ).mouseleave(function () { 
        $("#hoverImgProject").hide();
    });
    // $("#hoverImgProject").click(function (e) {
    //     e.stopPropagation();
    //     let tmpLi = $("<li></li>");
    //     let tmpDiv = $("<div></div>")
    //     tmpDiv.addClass("liElem").append("Project1")
    //     tmpLi.append(tmpDiv)
    //    $(".panelProject ul").append(
    //        tmpLi
    //    );
    // });
    // Adding 3 dots on project
    $('.panelProject').on('mouseenter','.liElem', function(event){
        event.preventDefault();
        console.log(event.currentTarget);

        $(event.target).append($("<img>").attr("src", "http://localhost/PSI-projekat/Implementacija/img/moreOptions.png")
                 .addClass("moreOptionsImg"));
    });
    $('.list').on('mouseleave', '.liElem', function (e) {
        e.preventDefault();
        console.log(e.currentTarget);
        $('.panelProject img').remove();
    })
    
    // $('#createProjectBtn').click(function () { 
    //     let projectName = $('#nameProjectInput').val();
    //     if(projectName != ""){
    //         let tmpLi = $("<li></li>");
    //         let tmpDiv = $("<div></div>");
    //         tmpDiv.addClass("liElem").append(projectName);
    //         tmpLi.append(tmpDiv);
    //         $(".panelProject ul").append(
    //             tmpLi
    //         );
    //         $('#myModal').modal('hide');
            
    //     }
    //  })
});
