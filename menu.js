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

    $('.panelProject').on('mouseenter','.liElem', function(event){
        event.preventDefault();
        console.log(event.currentTarget);
        event.stopPropagation();
        let tmpHtml = $('<a data-target="#moreOptionModal" data-toggle="modal"></a>');
        tmpHtml.append($("<img>").attr("src", "http://localhost/PSI-projekat/Implementacija/img/moreOptions.png")
        .addClass("moreOptionsImg"))
        $(event.target).append(tmpHtml);
    });
    $('.panelArchived').on('mouseenter','.liElem', function(event){
        event.preventDefault();
        console.log(event.currentTarget);
        event.stopPropagation();
        let tmpHtml = $('<a data-target="#moreOptionArchivedModal" data-toggle="modal"></a>');
        tmpHtml.append($("<img>").attr("src", "http://localhost/PSI-projekat/Implementacija/img/moreOptions.png")
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
    
});
