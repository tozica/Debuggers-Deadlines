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
                   $("#formForDelete").submit();
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
    
     $('#searchBox').change(function(){
         $('#hide').val($('#searchBox').val());
         $('#formForSearch').submit(); 
         
     })
     $("#Today").click(function(){
         $("#formForToday").submit();
     })
      $("#Inbox").click(function(){
         $("#formForInbox").submit();
     })
    $(".labelForm").click(function(){
        let form=$(this).parent();
        form.submit();
    })
    $("#Sent").click(function(){
        $("#formForSent").submit();
    })
    
    $("#InformAll").click(function(){
        let htmlString = "<form action='sendToAllUsers' method='post'>" 
            +"<table class='table'>"
                +"<tr>"
                    +"<td><h2 id='title'>Send to all</h2></td>"
                +"</tr>"
                +"<tr>"
                +"<td colspan='2'>Title: <input name='titleAdministrator' type='text' placeholder='Title: '></td>"
                +"</tr>"
                +"<tr>"
                    +"<td><textarea name='message' rows='4' cols='50'>"
                        +"Write message here"
                        +"</textarea></td>"
                +"</tr>"
                +"<tr>"
                    +"<td><input class='btn btn-primary' type='submit' value='Send'></td>"
                +"</tr>"
            +"</table>"
        +"</form>";
        $("#panelAdministation").html(htmlString);
    });
    
    $("#InformUser").click(function(){
        let htmlString = "<form action='sendToUser' method='post'>" 
            +"<table class='table'>"
                +"<tr>"
                    +"<td colspan='2'><h2 id='title'>Send to user</h2></td>"
                +"</tr>"
                +"<tr>"
                +"<td colspan='2'>Title: <input name='titleAdministrator' type='text' placeholder='Title: '></td>"
                +"</tr>"
                +"<tr>"
                    +"<td><textarea name='message' rows='4' cols='50'>"
                        +"Write message here"
                        +"</textarea>"
                    +"</td>"
                    +"<td>"
                        +"Username: <input name='usernameAdministrator' type='text' placeholder='To: '>"
                    +"</td>"
                +"</tr>"
                +"<tr>"
                    +"<td colspan='2'><input class='btn btn-primary' type='submit' value='Send'></td>"
                +"</tr>"
            +"</table>"
        +"</form>";
        $("#panelAdministation").html(htmlString);
    });
    
    $(".notices").click(function(){
       let notificationId = $(this).attr("name");
       let title = $(this).text();
       let key = "notificationModal"+notificationId;
       let content = $("#"+key).val();
       $("#noticeModalTitle").html("<h2 class='modal-title'>"+title+"</h2>");
       $("#noticeModalBody").html("<p>"+content+"</p>");
    });
    
    $("#setPremium").click(function(){
        $("#formForRemovePremium").html("");
        let htmlCode = "<table class='table'>"
                            +"<tr>"
                                +"<td>Username:</td>"
                                +"<td><input type='text' placeholder='username' name='usernamePremium'></td>"
                            +"</tr>"
                            +"<tr>"
                                +"<td>Premium expiration:</td>"
                                +"<td><input type='date' name='premiumExpiration'></td>"
                            +"</tr>"
                            +"<tr>"
                                +"<td>Card namber:</td>"
                                +"<td><input type='text' placeholder='card number' name='cardNumber'></td>"
                            +"</tr>"
                            +"<tr>"
                                +"<td>Card expiration:</td>"
                                +"<td><input type='date' name='cardExpiration'></td>"
                            +"</tr>"
                            +"<tr>"
                                +"<td>CVC:</td>"
                                +"<td><input type='text' placeholder='cvc' name='cvc'></td>"
                            +"</tr>"
                            +"<tr>"
                                +"<td colspan='2'><input type='submit' value='Confirm' class='btn btn-primary'></td>"
                            +"</tr>"
                       +"</table>"
        $("#formForSetPremium").html(htmlCode);
    });
    
    $("#removePremium").click(function(){
        $("#formForSetPremium").html("");
        let htmlCode = "<table class='table'>"
                            +"<tr>"
                                +"<td>Username:</td>"
                                +"<td><input type='text' placeholder='username' name='usernameRemovePremium'></td>"
                            +"</tr>"
                            +"<tr>"
                                +"<td colspan='2'><input type='submit' value='Confirm' class='btn btn-primary'></td>"
                            +"</tr>"
                       +"</table>";
        $("#formForRemovePremium").html(htmlCode);
    });
});