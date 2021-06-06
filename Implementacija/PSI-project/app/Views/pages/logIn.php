<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Log in to DeadLines</title>
        <link rel = "icon" href = "http://localhost/PSI-project/images/justLogo.png"
              type = "image/x-icon"> 
        <link rel="stylesheet" href="http://localhost/PSI-project/signUpStyle.css">

    </head>
    <body>
        <form id = "form" name="loginform" action="<?= site_url("Guest/loginSubmit") ?>" method="post">
            <div id="header">
                <a href="<?= site_url('Guest')?>"><img src="http://localhost/PSI-project/Implementacija/img/logo2.jpg" alt=""></a>
                <h2>Log in</h2>
            </div>

            <div id="email">
                <p class="manual">Username</p>
                <font color="red">
                <?php
                if (!empty($errors['username'])) {
                    echo $errors['username'];
                }
                ?>  
                </font>
                <input name="username" class="textForm" type="text" value="">
                <p class="manual">Password</p>

                <input name="pass" class="textForm" type="password" value="">
                <font color="red">
                <?php
                if (isset($poruka)) {
                    echo "$poruka";
                }
                ?> 
                </font>
                <input id="logIn" type="submit" value="Log in">
            </div>

            <hr>
            <div id="footer">
                <p>Don't have account? 
                    <?php
                    echo anchor("Guest/signUp", "Sign up");
                    ?>
                </p>
                <p class="footerSupport">
                    <a class="footerSupport" href="<?= site_url('Guest')?>">DeadLines</a>
                </p>
            </div>
        </form>
    </body>
</html>