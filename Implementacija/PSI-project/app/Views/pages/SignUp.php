<?php

namespace App\Controllers;

namespace App\Models;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Sign up!</title>
        <link rel = "icon" href = "http://localhost/PSI-project/Implementacija/justLogo.png"
              type = "image/x-icon"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/
              bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://localhost/PSI-project/signUpStyle.css">
    </head>
    <body>
        <form id="form" name="signUpForm" action="<?= site_url("Guest/signUpSubmit") ?>" method="post">
            <div id="header">
                <a href="<?= site_url('Guest')?>"><img src="http://localhost/PSI-project/Implementacija/img/logo2" alt=""></a>
                <h2>Sign up</h2>
            </div>

            <div id="email">
                <font color='red'>
                    <?php
                    if (isset($errorEmail))
                        echo $errorEmail;
                    ?></font>
  
                <p class="manual">Name</p>
                <font color='red'>
                    <?php
                    if (!empty($errors['name']))
                        echo $errors['name'];
                    ?></font>
                    <input class="textForm" type="text"  name="name" required="required">
                <p class="manual">Surname</p>
                <font color='red'>
                <?php
                if (!empty($errors['surname']))
                    echo $errors['surname'];
                ?></font>
                <input class="textForm" type="text" name="surname" required="required"> 
                <p class="manual">Email</p>
                <font color='red'>
                <?php
                if (!empty($errors['email']))
                    echo $errors['email'];
                ?></font>
                <input class="textForm" type="text" name="email" required="required">
                <p class="manual">Username</p>
                <font color='red'>
                <?php
                if (!empty($errors['username']))
                    echo $errors['username'];
                ?></font>
                <?php if (isset($poruka)) echo "<font color='red'>$poruka</font><br>"; ?>
                <input class="textForm" type="text" name="username" required="required">
                <p class="manual">Password</p>
                <font color='red'>
                <?php
                if (!empty($errors['password']))
                    echo $errors['password'];
                ?></font>
                <input class="textForm" type="password" name="password" required="required">
                <p id="condition">Your password must be at least 8 characters long. Avoid common words or patterns.</p>
                <input id="logIn" type="Submit" value="Sign up">

               
            </div>
            <hr>
            <div id="footer">
                <p>Already signed up? 
                <?php
                echo anchor("Guest/logIn", "Go to Login");
                ?>
                </p>
                <p class="footerSupport">
                    <a class="footerSupport" href="<?= site_url('Guest')?>">DeadLines</a>
                </p>
            </div>
        </form>
    </body>
</html>