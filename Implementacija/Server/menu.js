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
             if($("#tip").val()!=2){
            $("#premiumModal").modal("show");
            return;
        };
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
        if($("#tip").val()!=2){
            $("#premiumModal").modal("show");
            return;
        };
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
              if($("#tip").val()!=2){
            $("#premiumModal").modal("show");
            return;
        };
        let id=$(this).attr("name");
        let key="newLabel"+id;
        $("#"+"newLabel"+id).slideToggle("slow");
    })
    
    $(".newAlarm").click(function(){
              if($("#tip").val()!=2){
            $("#premiumModal").modal("show");
            return;
        };
        let id=$(this).attr("name");
        let key="alaramTime"+id;
        $("#"+"alaramTime"+id).slideToggle("slow");
    })
    
    $(".labela").click(function(){
         if($("#tip").val()!=2){
            $("#premiumModal").modal("show");
            return;
        };
        $(".labelaModal").slideToggle("slow");
    })
    
    $(".alarm").click(function(){
         if($("#tip").val()!=2){
            $("#premiumModal").modal("show");
            return;
        };
        $(".alaramTime").slideToggle("slow");
    })
    
    $(".modalForm").focusout(function(){
        $(".labelaModal").hide();
        $(".alaramTime").hide();
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
        $("#formForSendToUser").html("");
        $("#formForSetPremium").html("");
        $("#formForRemovePremium").html("");
        $("#formForSendToAllUsers").html("");
        
        $("#formForSent").submit();
    })
    
    $("#InformAll").click(function(){
        let htmlString = "<table class='table'>"
                +"<tr>"
                    +"<td><h2 class='title'>Send to all</h2></td>"
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
        $("#formForSendToUser").html("");
        $("#formForSetPremium").html("");
        $("#formForRemovePremium").html("");
        $("#sentMessages").html("");
        $("#formForSendToAllUsers").html(htmlString);
    });
    
    $("#InformUser").click(function(){
        let htmlString = "<table class='table'>"
                +"<tr>"
                    +"<td colspan='2'><h2 class='title'>Send to user</h2></td>"
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
            +"</table>";
        $("#formForSendToAllUsers").html("");
        $("#formForSetPremium").html("");
        $("#sentMessages").html("");
        $("#formForRemovePremium").html("");
        $("#formForSendToUser").html(htmlString);
    });
    
    $(".notices").click(function(){
       let notificationId = $(this).attr("name");
       let title = $(this).text();
       let key = "notificationModal"+notificationId;
       let content = $("#"+key).val();
       $("#noticeModalTitle").html("<h2 class='modal-title'>"+title+"</h2>");
       $("#noticeModalBody").html("<p>"+content+"</p>");
    });
    
    $(".noticesAdministrator").click(function(){
       let notificationId = $(this).attr("name");
       let title = $(this).text();
       let key = "notificationModal"+notificationId;
       let content = $("#"+key).val();
       let tmp = "";
       
       let monthArr = /Month: [0-9]+/.exec(content);
       tmp = monthArr[0].split(" ");
       let month = tmp[tmp.length-1];
       
       let yearArr = /Year: [0-9]+/.exec(content);
       tmp = yearArr[0].split(" ");
       let year = tmp[tmp.length-1];
       
       let usernameArr = /Username: .*$/.exec(content);
       tmp = usernameArr[0].split(" ");
       let username = tmp[tmp.length-1];
       
       let cvcArr = /CVC: [0-9]+/.exec(content);
       tmp = cvcArr[0].split(" ");
       let cvc = tmp[tmp.length-1];
       
       let cardNumberArr = /Card number: [0-9]+/.exec(content);
       tmp = cardNumberArr[0].split(" ");
       let cardNumber = tmp[tmp.length-1];
       
       let dateOfExpirationCard = year+"-"+month+"-01";
    
       $("#noticeModalTitle").html("<h2 class='modal-title'>"+title+"</h2>");
       $("#noticeModalBody").html("<p>"+content+"</p>");
       $("#formForPremiumUser").append("<input type='hidden' name='usernamePremium' value="+username+">");
       $("#formForPremiumUser").append("<input type='hidden' name='cardNumber' value="+cardNumber+">");
       $("#formForPremiumUser").append("<input type='hidden' name='cvc' value="+cvc+">");
       $("#formForPremiumUser").append("<input type='hidden' name='cardExpiration' value="+dateOfExpirationCard+">");
    });
    
    $("#setPremium").click(function(){
        let htmlCode = "<table class='table'>"
                            +"<tr>"
                                +"<td colspan='2'><h2 class='title'>Set premium</h2></td>"
                            +"</tr>"
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
                       +"</table>";
        $("#formForSendToAllUsers").html("");
        $("#formForSendToUser").html("");
        $("#formForRemovePremium").html("");
        $("#sentMessages").html("");
        $("#formForSetPremium").html(htmlCode);
    });
    
    $("#removePremium").click(function(){
        let htmlCode = "<table class='table'>"
                            +"<tr>"
                                +"<td colspan='2'><h2 class='title'>Remove premium</h2></td>"
                            +"</tr>"
                            +"<tr>"
                                +"<td>Username:</td>"
                                +"<td><input type='text' placeholder='username' name='usernameRemovePremium'></td>"
                            +"</tr>"
                            +"<tr>"
                                +"<td colspan='2'><input type='submit' value='Confirm' class='btn btn-primary'></td>"
                            +"</tr>"
                       +"</table>";
        $("#formForSendToAllUsers").html("");
        $("#formForSendToUser").html("");
        $("#formForSetPremium").html("");
        $("#sentMessages").html("");
        $("#formForRemovePremium").html(htmlCode);
    });
    $('.clikProject').dblclick(function(){
        let choice = $(this).parent().parent().attr("class");
        if(choice === "panelProject"){
            $('#nameForProjectView').val($(this).find("p").text());
            $('#formForProject').submit();
        }
        else{
           
            $('#nameForProjectViewArchived').val($(this).find("p").text());
            $('#formForProjectArchived').submit();
        }
    })
//    $('#InboxProject').click(function () {
//        $('#backToInbox').submit();
//    })
  $(".progress").each(function() {

    var value = $(this).attr('data-value');
    var left = $(this).find('.progress-left .progress-bar');
    var right = $(this).find('.progress-right .progress-bar');

    if (value > 0) {
      if (value <= 50) {
        right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
      } else {
        right.css('transform', 'rotate(180deg)')
        left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
      }
    }

  })

  function percentageToDegrees(percentage) {

    return percentage / 100 * 360

  }
  $(".day").click(function(){
      
      $id=$(this).attr("name");
      $('#'+$id).submit();
  })
   $("#theme").click(function(){
        if($("#tip").val()==1){
            $("#premiumModal").modal("show");
            return;
        };
        let theme = $("#themeHidden").val() 
        if(theme === "light"){
            $("#themeHidden").val("dark");
        }else{
            $("#themeHidden").val("light");
        }
        $("#formForTheme").submit();
    });
    
     $('.radiosFromSection').click(function () {  
       let tmp = $(this).attr('id');
       if(tmp =='addSection'){
            $('#sectionOptionRadio').val('add');
       }else{
           $('#sectionOptionRadio').val('delete');
       }
    })
});