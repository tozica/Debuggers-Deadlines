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
        <title>Settings</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="http://localhost/PSI-project/menu.js"></script>
        <link rel = "icon" href = "http://localhost/PSI-project/Implementacija/img/justLogo.png" type = "image/x-icon"> 

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://localhost/PSI-project/settingsStyle.css">




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
                        <td><p><?php echo $username; ?></p>
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
                        <td><p><?php echo $name; ?></p></td>
                        <td>
                            <a href="#" id="colapseName">Edit</a>
                            <div id="nameFields" class="botomMargin">
                                <input type="text" id="nameText" name="nameField" placeholder="Enter a new name">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="">Last name:</label></td>
                        <td><p><?php echo $lastname; ?></p></td>
                        <td>
                            <a href="#" id="colapseLastName">Edit</a>
                            <div id="lastNameFields" class="botomMargin">
                                <input type="text" id="lastNameText" name="LastNameField" placeholder="Enter a new last name">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="">Email:</label></td>
                        <td><p><?php echo $mail; ?></p>
                            <font color='red'>
                            <?php
                            if (isset($emailError)) {
                                echo $emailError;
                            }
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
                            echo '<br>' . $newPassword;
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
                <button class="btn btn-primary" type="submit">Confirm</button>
                <hr>

      
            </div>
        </form>
    </body>
</html>

