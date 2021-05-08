
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deadlines</title>
    <link rel="stylesheet" href="http://localhost/PSI-projekat/Implementacija/style.css">
    <link rel = "icon" href = "http://localhost/PSI-projekat/Implementacija/justLogo.png"
    type = "image/x-icon"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/
    bootstrap/4.3.1/css/bootstrap.min.css">
  


</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div id="header">
                    <img src="http://localhost/PSI-projekat/Implementacija/img/logo2.png" alt="">
                    <ul>
                        <li>Features</li>
                        <li>About us</li>
                        <li><?php echo anchor('Guest/signUp', 'Sign Up') ?></li>
                        <li><?php echo anchor('Guest/logIn', 'Log In') ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="body0 col-lg-12 col-md-12 col-sm-12">
                <div class="body1 col-lg-6 col-md-12 col-sm-6">
                    <div class="inBody1">
                        <h1>Stay Organized</h1>
                        <h1>Stay Creative</h1>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita quasi repellat quae accusamus officia corporis illum, numquam voluptatem repudiandae voluptate ea accusantium. Incidunt tempore magnam culpa earum nam rerum accusamus doloremque obcaecati velit adipisci error consequatur dolorum, quas eaque ducimus, quaerat recusandae! Dolor reiciendis optio nobis voluptates voluptatum repellat quasi.</p>
                        <a href="SignUp/sign_up.html"><input type="button" id="GetStarted" value="Get Started-It's free"></a>
                    </div>
        
                </div>
                <div class="body2 col-lg-6 col-md-12 col-sm-6">
                    <img class="col-lg-6 col-md-12 col-sm-6" src="http://localhost/PSI-projekat/Implementacija/img/workingdesk.png" alt="">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="body3 col-lg-12 col-md-12 col-sm-12">
                <div class="body2 col-lg-6 col-md-6 col-sm-12">
                    <img id="satic" src="http://localhost/PSI-projekat/Implementacija/img/clock2.2.png" alt="">
                </div>
                <div class="body1 col-lg-6 col-md-12 col-sm-12">
                    <h1 id="latino">Reminder</h1>
                    <div class="inBody1">
                        
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iure, culpa incidunt, corporis maxime ad minus minima ea omnis aliquid, nemo error dolor id esse libero illum ipsum unde cumque expedita animi rerum! Architecto facilis aperiam quas ex maiores sed doloremque, tempore ducimus voluptas quo ratione commodi nulla vel harum fuga, eligendi laboriosam optio rerum illum est sequi. Illum et dolores sint, accusamus perspiciatis laudantium. Eveniet illo laborum culpa reiciendis, dignissimos asperiores ad doloribus maiores debitis.</p>
                        
                    </div>
        
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="otherFeatures col-lg-12 col-md-12 col-sm-12">
                <div class="flexColumn col-lg-4 col-md-4 col-sm-4">
                    <img src="http://localhost/PSI-projekat/Implementacija/img/icons8-microsoft-project-150.png" alt="">
                    <div class="text">
                        <h1>Organize your Projects</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum libero repudiandae doloribus quos rem eum maxime dicta deleniti atque minima vero quasi, culpa praesentium voluptas exercitationem ipsam tempora tempore. Dolore aspernatur, ex cumque necessitatibus et a quas! Consequuntur obcaecati aliquam, labore maxime in vitae excepturi dicta, ab facere repellendus facilis.
                        </p>
                    </div>
                </div>
                <div class="flexColumn col-lg-4 col-md-4 col-sm-4">
                    <img src="http://localhost/PSI-projekat/Implementacija/img/icons8-notification-100.png" alt="">
                    <div class="text">
                        <h1>Always be notified</h1>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque dolor quod sequi earum facere magnam, iusto eius necessitatibus laboriosam mollitia beatae! Voluptatum, odit excepturi quo minima optio vel odio laboriosam tempora omnis? Non corrupti dolorem dolores sit ullam error doloremque, deserunt, dignissimos exercitationem hic harum ipsa labore modi libero velit.
                        </p>
                    </div>
                </div>
                <div class="flexColumn col-lg-4 col-md-4 col-sm-4">
                    <img src="http://localhost/PSI-projekat/Implementacija/img/icons8-winrar-150.png" alt="">
                    <div class="text">
                        <h1>Archive your Projects</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime ea doloremque illo incidunt exercitationem vel, ipsa earum nesciunt iure! Laboriosam quia cupiditate repellendus asperiores perferendis laborum libero impedit fugit obcaecati sit quisquam cumque, fuga quos sapiente quis illo ab excepturi dolorem, dolore sequi? Cum obcaecati sapiente id tempora laudantium pariatur?
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-lg-12">
            <div id="Footer">
                <div id="footerP">
                   <p >Life shouldn't be chaos. Keep it all together with DeadLines.</p>
                </div>
                <hr>
                <div id="footerC">
                    <p id="Copyright">© 2021 Debuggers Team</p>
                </div>
            </div>
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

