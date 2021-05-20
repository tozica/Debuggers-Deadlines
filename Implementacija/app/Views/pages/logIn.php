<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Log in to DeadLines</title>
    <link rel = "icon" href = "http://localhost/PSI-projekat/img/justLogo.png"
        type = "image/x-icon"> 
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
    <form id = "form" name="loginform" action="<?= site_url("Guest/loginSubmit") ?>" method="post">
        <div id="header">
            <a href="../index.html"><img src="http://localhost/PSI-projekat/Implementacija/img/logo2.jpg" alt=""></a>
            <h2>Log in</h2>
        </div>
        <div id="buttons">
            <input type='button' value='Continue with Google'>
            <input type='button' value='Continue with Facebook'>
            <input type='button' value='Continue with Apple'>
        </div>
        <!-- <hr> -->
        <table class="myHr">
            <tr>
                <td style="border-bottom: 0.5px solid lightgray; width: 47%">&nbsp;</td>
                <td style="vertical-align:middle;text-align:center" rowspan="2">
                    <p id="or">&nbspOR&nbsp</p>
                </td>
                <td style="border-bottom: .5px solid lightgray; width: 47%">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr></table>
        <div id="email">
            <p class="manual">Username</p>
            <font color="red">
                <?php
                    if(!empty($errors['username'])){
                        echo $errors['username'];
                    }
                 ?>  
            </font>
            <input name="username" class="textForm" type="text" value="">
            <p class="manual">Password</p>
            <font color="red">
                <?php
                    if(!empty($errors['pass'])){
                        echo $errors['pass'];
                    }
                ?> 
            </font>
            <input name="pass" class="textForm" type="password" value="">
            <font color="red">
                <?php
                    if(isset($poruka)){
                        echo "$poruka";
                    }
                ?> 
            </font>
            <input id="logIn" type="submit" value="Log in">
            <div class="forCheck">
                <input id="logged" type="checkbox">
                <label for="logged">Keep me logged in</label>
            </div>
            <a href=""><p class="forCheck">Forgot your password?</p></a>
        </div>

        <hr>
        <div id="footer">
           <p>Don't have account? 
               <?php                           
               echo anchor("Guest/index", "Sign up");
               ?>
            </p>
           <p class="footerSupport">
               <a class="footerSupport" href="">DeadLines support</a>
            </p>
        </div>
    </form>
</body>
</html>