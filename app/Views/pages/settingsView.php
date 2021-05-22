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
    <link rel = "icon" href = "http://localhost/PSI-project/Implementacija/img/justLogo.png"
        type = "image/x-icon"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/
bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body{
    background-color: rgb(231, 229, 229);
}

#form{
    width: 50%;
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
.usernameSettings{
    display: flex;
    justify-content: flex-start;
    margin-bottom: 5px;    
}
.usernameSettings a{
    margin-right: 5px;
}
.usernameSettings p{
    color: gray;
    margin-right: 15px;
}
.usernameSettings label{
    margin-right: 100px;
    color: gray;
}
.nameSettings p{
    margin-left: 27px;
}
.botomMargin{
    margin-bottom: 10px;
}
#userNameFields, #nameFields, #lastNameFields, #passFields, #emailFields{
    display: none;
    flex-direction: column;
    justify-content: space-between;
}
.emailSettings p{
    margin-left: 30px;
}
#colapsePass{
    padding-bottom: 3px;
    
}
.tmpP{
/*    padding-top: 8px;
    padding-left: 80px;*/
}
.forTable{
    display: flex;
    justify-content: center;
}
table label{
    color: graytext;
}
table p{
    padding-top: 6px;
    padding-right: 10px;
    margin-right: 5px;
}
table td{
    margin-right: 5px
}

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="http://localhost/PSI-project/menu.js"></script>

</head>
<body>
    <form id="form" name="signUpForm" action="settingsChange" method="post">
        <div id="header">
            <a href=""><img src="http://localhost/PSI-project/Implementacija/img/logo2" alt=""></a>
            <h2>Settings</h2>
        </div>
        <div class="forTable">
        <table  cellpadding="10">
                <tr>
                    <td> <label for="usernameSettings">Username:</label></td>
                    <td><p><?php echo $username;  ?></p>
                         <font color='red'>
                        <?php 
                          echo $newUserName;
                        ?></font>
                    </td>
                    <td>
                        <a href="#" id="colapseUsername">Edit</a>
                        <div id="userNameFields" class="botomMargin">
                            <input type="text" id="userNameText" name="userNameField" placeholder="Enter a new username">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><label for="">Name:</label></td>
                    <td><p><?php echo $name;  ?></p></td>
                    <td>
                        <a href="#" id="colapseName">Edit</a>
                        <div id="nameFields" class="botomMargin">
                            <input type="text" id="nameText" name="nameField" placeholder="Enter a new name">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><label for="">Last name:</label></td>
                    <td><p><?php echo $lastname;  ?></p></td>
                    <td>
                        <a href="#" id="colapseLastName">Edit</a>
                        <div id="lastNameFields" class="botomMargin">
                            <input type="text" id="lastNameText" name="LastNameField" placeholder="Enter a new last name">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><label for="">Email:</label></td>
                    <td><p><?php echo $mail;  ?></p>
                         <font color='red'>
                        <?php
                        ?></font>
                    </td>
                    <td>
                        <a href="#" id="colapseEmail">Edit</a>
                        <div id="emailFields" class="botomMargin">
                            <input type="text" id="emailText" name="emailField" placeholder="Enter a new e-mail">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><label for="">Password:</label>
                         <font color='red'>
                        <?php 
                            echo '<br>'.$newPassword;
                        ?></font>
                    </td>
                    <td>
                        <a href="#" id="colapsePass"><p class="tmpP">Change password</p></a>
                    <div id="passFields" class="botomMargin">
                        <input type="password" id="passText" name="passField" placeholder="Enter a new password">
                        
                    </div>
                    </td>
                    <td></td>
                </tr>

            
        </table>

        </div>
            <hr>
            
        <div id="footer">
            <button class="btn btn-primary" type="submit" id="">Confirm</button>
            <hr>
                
           <p class="footerSupport">
               <a class="footerSupport" href="">DeadLines support</a>
            </p>
        </div>
    </form>
</body>
</html>

