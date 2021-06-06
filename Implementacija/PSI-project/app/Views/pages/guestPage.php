<!-- Radio: Jovanovic Svetozar -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/PSI-project/style.css">
    <title>DeadLines</title>
    <link rel = "icon" href = "http://localhost/PSI-project/Implementacija/img/justLogo.png"
        type = "image/x-icon"> 
</head>
<body>
    <div id="header">
        <img src="http://localhost/PSI-project/Implementacija/img/logo2.png" alt="">
        <ul>
            <a href="#features"><li>Features</li></a>
<!--            <li style="cursor:pointer">About us</li>-->
            <a href="<?= site_url("Guest/logIn")?>"><li>Log in</li></a>
            <a href="<?= site_url("Guest/signUp")?>"><li>Sign up</li></a>
        </ul>
    </div>
    <div class="body0">
        <div class="body1">
            <div class="inBody1">
                <h1>Stay Organized</h1>
                <h1>Stay Creative</h1>
                <p>Regain clarity and calmness by getting all those tasks out of your head and onto your to-do list. Keep your brain off, but your notification on and leave us to think for you.</p>
                <a href="<?= site_url("Guest/signUp")?>"><input type="button" id="GetStarted" value="Get Started-It's free"></a>
            </div>

        </div>
        <div class="body2">
            <img src="http://localhost/PSI-project/Implementacija/img/workingdesk.png" alt="">
        </div>
    </div>

    <div class="body3">
        <div class="body2" id="features">
            <img id="satic" src="http://localhost/PSI-project/Implementacija/img/clock2.2.png" alt="">
        </div>
        <div class="body1">
            <h1 id="latino">Reminder</h1>
            <div class="inBody1">
                
                <p>As the deadline approaches, we will inform you about the activities you need to do. That way you won’t be able to miss any task you planned to do and your plans will always be honored. We will inform you in a timely manner by e-mail.</p>
                
            </div>

        </div>
        
    </div>
    <div  class="otherFeatures">
        <div class="flexColumn" style="padding-top: 20px ">
            <img src="http://localhost/PSI-project/Implementacija/img/icons8-microsoft-project-150.png" alt="">
            <div class="text">
                <h1>Organize your Projects</h1>
                <p>With this application you will be able to better organize your projects. You can create tasks and assign them to different projects so you will have a better insight into the execution of your projects and if you have more they will be easier to handle.
                </p>
            </div>
        </div>
        <div class="flexColumn">
            <img src="http://localhost/PSI-project/Implementacija/img/icons8-notification-100.png" style="width : 150px;height: 150px;" alt="">
            <div class="text">
                <h1>Always be notified</h1>
                <p>We will always inform you about the activities on your account, so you don't miss anything. Not only about the tasks, but also about the upcoming updates and information about the new premium features.
                </p>
            </div>
        </div>
        <div class="flexColumn" style="padding-top: 30px ">
            <img src="http://localhost/PSI-project/Implementacija/img/icons8-winrar-150.png" style="" alt="">
            <div class="text">
                <h1>Archive your Projects</h1>
                <p>Once your project is complete you have the option to archive it. This way you will be able to see the schedule of activities on projects that you have already completed, which can help you build new projects later.
                </p>
            </div>
        </div>
    </div>
    <div id="Footer">
        <div id="footerP">
           <p >Life shouldn't be chaos. Keep it all together with DeadLines.</p>
        </div>
        <hr>
        <div id="footerC">
            <p id="Copyright">© 2021 Debuggers Team</p>
        </div>
    </div>
    <script>
        window.onscroll = function() {myFunction()};

        // Get the navbar
        var navbar = document.getElementById("header");

        // Get the offset position of the navbar
        var sticky = navbar.offsetTop;

        // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>
</body>
</html>



