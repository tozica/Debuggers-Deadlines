<?php namespace App\Controllers;
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
    <link rel = "icon" href = "http://localhost/PSI-projekat/Implementacija/justLogo.png"
        type = "image/x-icon"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/
bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body{
    background-color: rgb(231, 229, 229);
}

#form{
    width: 30%;
    height: 60%;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 0;
    margin-top: 3%;
    background-color: white;
    border:1px solid lightgray;
    border-radius: 10px;
    padding: 0;

}

#header{
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    
}

#header h2{
    padding-left: 20px;
    padding-top: 0;
}

#header img{
    width: 30%;
    padding-top: 15px;
    padding-left: 20px;
    padding-bottom: 0;
}

#buttons input{
    background-color: white;
    border-radius: 5px;
    border-color: lightgray;
    border-style: solid;
    border-width: 0.5px;
    margin-bottom: 10px;
    height: 40px;
}

#buttons{
    display: flex;
    flex-direction: column;
    padding: 20px;
    padding-top: 0;
    margin: auto;
}

hr{
    border: 0.5px thin lightgray;
    margin-top: 0;
    margin-left: 15px;
    margin-right: 15px;
}

#or{
    color: gray;
}

.myHr{
    padding-right: 15px;
    padding-left: 15px;
}

.manual{
    font-weight: bold;
    font-size: 14px;
    font-family: 'Times New Roman', Times, serif;
}

#email{
    display: flex;
    flex-direction: column;
    padding: 20px;
    padding-top: 0;
    margin: auto;
}

#email a{
    text-decoration: none;
}

#email a:hover{
    text-decoration: underline;
}

#logIn{
    width: 100%;
    margin-top: 10px;
    border-radius: 5px;
    background-color: rgb(0, 60, 140);
    color: white;
    height: 35px;
    font-weight: bold;
    
}

#logIn:hover{
    background-color: rgb(0, 60, 255);
}

.textForm{
    border: 0.5px solid lightgray;
    height: 30px;
    border-radius: 5px;

}

#email p{
    margin-bottom: 5px;
}

.forCheck input{
    padding: 0;
    margin: 0;
    margin-top: 5px;
}

.forCheck p{
    padding: 0;
    margin: 0;
}

.forCheck{
    margin-top: 10px;
    font-size: 13px;
    color: gray;
}

#footer{
    display: flex;
    flex-direction: column;
    padding: 20px;
    padding-top: 0;
    margin: auto;
}

#pSign{
    color: darkslateblue;
    text-decoration: none;
    margin-top: 10px;
    padding-bottom: 0;
}


#footer p{
    text-align: center;
    font-size: 14px;

}

#footer a:hover{
    text-decoration: underline;
}

.footerSupport{
    color: gray;
    margin: 0;
    text-decoration: none;
}

#buttons input:hover{
    background-color: rgb(216, 243, 252);
}

#condition{
    font-size: 14px;
    color: gray;
    margin-top: 5px;
}
    </style>
</head>
<body>
    <form id="form" name="signUpForm" action="<?= site_url("Guest/signUpSubmit") ?>" method="post">
        <div id="header">
            <a href="SignUp.php"><img src="http://localhost/PSI-projekat/Implementacija/img/logo2" alt=""></a>
            <h2>Sign up</h2>
        </div>
         
        <div id="email">
            <p class="manual">Name</p>
            <font color='red'>
            <?php if(!empty($errors['name'])) 
                echo $errors['name'];
            ?></font>
            <input class="textForm" type="text" value="" name="name">
            <p class="manual">Surname</p>
            <font color='red'>
            <?php if(!empty($errors['surname'])) 
                echo $errors['surname'];
            ?></font>
            <input class="textForm" type="text" value="" name="surname">
            <p class="manual">Email</p>
            <font color='red'>
            <?php if(!empty($errors['email'])) 
                echo $errors['email'];
            ?></font>
            <input class="textForm" type="text" value="" name="email">
            <p class="manual">Username</p>
            <font color='red'>
            <?php if(!empty($errors['username'])) 
                echo $errors['username'];
            ?></font>
             <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br>"; ?>
            <input class="textForm" type="text" value="" name="username">
            <p class="manual">Password</p>
            <font color='red'>
            <?php if(!empty($errors['password'])) 
                echo $errors['password'];
            ?></font>
            <input class="textForm" type="password" value="" name="password">
            <p id="condition">Your password must be at least 8 characters long. Avoid common words or patterns.</p>
            <a href="../app/app.html"><input id="logIn" type="Submit" value="Sign up"></a>
            
            <div class="forCheck">
                <input id="logged" type="checkbox">
                <label for="logged">Keep me logged in</label>
            </div>
        </div>
        <hr>
        <div id="footer">
           <p>Already signed up? 
               <a id="pSign" href="log_in.php">Go to login </a>
            </p>
           <p class="footerSupport">
               <a class="footerSupport" href="">DeadLines support</a>
            </p>
        </div>
    </form>
</body>
</html>