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
   

    $(".flipLabels").click(function(){
        $(".panelLabels").slideToggle("slow");
    });

     /* Slide down and up menu items */
    $(".flipProject").click(function(){
        $(".panelProject").slideToggle("slow");
    });

    $(".flipArchived").click(function(){
        $(".panelArchived").slideToggle("slow");
    });
    /* Show and hide images on hover */
   /* Show and hide images on hover */
    $( ".flipProject" ).mouseenter(function(){
        $("#hoverImgProject").show();
    });
    //dinamicly adding + icon in project section
    $(".flipArchived").mouseenter(function () {
        $("#hoverImgArchived").show();
    })

    $(".flipArchived").mouseleave(function () {
        $("#hoverImgArchived").hide();
    })

    $( ".flipProject" ).mouseleave(function () { 
        $("#hoverImgProject").hide();
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
     $('.panelProject').on('mouseenter','.liElem', function(event){
        event.preventDefault();
        console.log(event.currentTarget);
        event.stopPropagation();
        let tmpHtml = $('<a data-target="#moreOptionModal" data-toggle="modal"></a>');
        tmpHtml.append($("<img>").attr("src", "http://localhost/PSI-project/Implementacija/img/moreOptions.png")
        .addClass("moreOptionsImg"))
        $(event.target).append(tmpHtml);
    });
    $('.panelArchived').on('mouseenter','.liElem', function(event){
        event.preventDefault();
        console.log(event.currentTarget);
        event.stopPropagation();
        let tmpHtml = $('<a data-target="#moreOptionArchivedModal" data-toggle="modal"></a>');
        tmpHtml.append($("<img>").attr("src", "http://localhost/PSI-project/Implementacija/img/moreOptions.png")
        .addClass("moreOptionsImg"))
        $(event.target).append(tmpHtml);
    });
    $('.list').on('mouseleave', '.liElem', function (e) {
        e.preventDefault();
        console.log(e.currentTarget);
        if($('.panelProject img') != null)
            $('.panelProject img').remove();
        if($('.panelArchived img') != null)
            $('.panelArchived img').remove();
    })

    $('.panelProject').on('click','.moreOptionsImg', function(event){
        event.preventDefault();
        console.log(event.currentTarget);
        event.stopPropagation();
        var par = $(this.parentNode);
        let heading = $(par).parent().children('p').html();
        $('#fornamehidden').val(heading);
        $('#titleMoreOption').html(heading);
        
    });    

    $('.panelArchived').on('click','.moreOptionsImg', function(event){
        event.preventDefault();
        console.log(event.currentTarget);
        var par = $(this.parentNode);
        let heading = $(par).parent().children('p').html();
        $('#fornamehiddenArchived').val(heading);
        $('#titleMoreArchivedOption').html(heading);
        
    });   
    
    $('#archiveRadio').click(function () {
        $('#newName').attr("disabled", "true");
        $('#radioHidden').val("archive");
        
    })
    $('#deleteRadio').click(function () {
        $('#newName').attr("disabled", "true");
        $('#radioHidden').val("delete");
        
    })
    $('#renameRadio').click(function () {
        $('#newName').removeAttr("disabled");
        $('#radioHidden').val("rename");
        
    })

    $('#archiveRadioArchived').click(function () {
        $('#newNameArchived').attr("disabled", "true");
        $('#radioHiddenArchived').val("unarchive");
        
    })
    $('#deleteRadioArchived').click(function () {
        $('#newNameArchived').attr("disabled", "true");
        $('#radioHiddenArchived').val("delete");
        
    })
    $('#renameRadioArchived').click(function () {
        $('#newNameArchived').removeAttr("disabled");
        $('#radioHiddenArchived').val("rename");
        
    })
    
    $('#closeModalCreate').click(function () {
        $('#projectForm').hide();
    })

    $('#list1').click(function () {  
        $("#valuerForRadio").val("list");
    })
    $('#board1').click(function () {  
        $("#valuerForRadio").val("board");
    })
    $("#hoverImgProject").click(function (e) {
        $('#projectForm').show();
        $('.create').hide();
    })

    $('#colapseUsername').click(function () {
        $('#userNameFields').attr("display", "flex").removeAttr("display").attr("flex-direction", "column").attr("justify-content", "space-between").slideToggle();
    })
    $('#colapseName').click(function () {
        $('#nameFields').attr("display", "flex").removeAttr("display").attr("flex-direction", "column").attr("justify-content", "space-between").slideToggle();
    })
    $('#colapseLastName').click(function () {
        $('#lastNameFields').attr("display", "flex").removeAttr("display").attr("flex-direction", "column").attr("justify-content", "space-between").slideToggle();
    })

    $('#colapsePass').click(function () {
        $('#passFields').attr("display", "flex").removeAttr("display").attr("flex-direction", "column").attr("justify-content", "space-between").slideToggle();
    })
    $('#colapseEmail').click(function () {
        $('#emailFields').attr("display", "flex").removeAttr("display").attr("flex-direction", "column").attr("justify-content", "space-between").slideToggle();
    })
    $('.clikProject').click(function(){
        $('#nameForProjectView').val($(this).find("p").text());
        $('#formForProject').submit();
    })
});