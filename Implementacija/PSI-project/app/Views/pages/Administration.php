<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="http://localhost/PSI-project/menu.js"></script>
        <?php
        if ($theme == "light") {
            echo "<link rel='stylesheet' class='themeCSS' href='http://localhost/PSI-project/styleTasks.css'>";
        } else {
            echo "<link rel='stylesheet' class='themeCSS' href='http://localhost/PSI-project/styleDark.css'>";
        }
        ?>
        <title>DeadLines</title>
    </head>
    <body>
        <div class="container-fluid" >
            <div class="row" style="position:sticky; top:0; z-index: 1">
                <div class="col-sm-12 header lightblue column" >

                    <nav class ="navbar navbar-expand-sm">
                        <a class="navbar-brand" href="#">
                            <img src="http://localhost/PSI-project/Implementacija/img/whilelogo1.png" id="logo" alt="">
                        </a>
                        <ul class="navbar-nav" id="firstNav">
                            <li class="nav-item" id="slika">
                                <img  src="http://localhost/PSI-project/Implementacija/img/menu.png" style="width:45px; margin-top:6px; cursor:pointer;" alt="" >
                            </li>
                            <li class="nav-item">
                                <form id="formForSearch" method="post" action="User/search"> 
                                    <input type="search" name="searchBox" placeholder="Search"  id="searchBox">
                                    <input type='hidden' name="search" id="hide">
                                </form>
                            </li>  
                        </ul>    
                    </nav>
                    <nav class ="navbar navbar-expand-sm">
                        <ul class="navbar-nav" id="right">
                            <li class="nav-item" style="color:white; padding-top:10px; font-family: Georgia, 'Times New Roman', Times, serif, Helvetica, sans-serif;">
                                <?php
                                echo $korisnik->getIme() . " ";
                                echo $korisnik->getPrezime();
                                ?>

                            </li>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <img class="dropdown-toggle" src="http://localhost/PSI-project/Implementacija/img/bell.png" style="width:28px; padding-top:8px" alt="" data-toggle="dropdown">
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <?php
                                        if (isset($premiumRequests)) {
                                            foreach ($premiumRequests as $value) {
                                                echo "<a class='dropdown-item noticesAdministrator' name='" . $value->getIdobavestenja() . "' data-toggle='modal' data-target='#notificationModal'>" . $value->getNaslov() . "</a>";
                                                echo "<input type='hidden' id='notificationModal" . $value->getIdobavestenja() . "' value='" . $value->getSadrzaj() . "'>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item" style="padding: 8px; cursor: pointer;">
                                <div class="dropdown">
                                    <img class="dropdown-toggle" src="http://localhost/PSI-project/Implementacija/img/user.png" style="width:28px;" alt="" data-toggle="dropdown">
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form id="formForTheme" action="<?= site_url("Administrator/changeTheme") ?>" method="post">
                                            <p class="dropdown-item" id="theme" style="padding:4 4 24 24; margin: 0;cursor: pointer">Theme</p>
                                            <input type="hidden" id="themeHidden" name="changeTheme" value="<?php echo $theme ?>">
                                        </form>
                                        <a class="dropdown-item" href="<?= site_url("User/showSettings") ?>">Settings</a>
                                        <form id="formForPremiums" action="<?= site_url("Administrator/seeAllPremiumUsers") ?>" method="post">
                                            <p class="dropdown-item" id="seeAllPremiums" style="padding:4 4 24 24; margin: 0; cursor: pointer">See All Premiums</p>
                                        </form>
                                        <a class="dropdown-item" href="<?= site_url("Administrator/logOut") ?>">Log out</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="row rowTask">
                <div class="col-2 column">
                    <div class="menu" id="idMenu">
                        <ul class="list">
                            <li id="Sent">
                                <form id="formForSent" class="flexMenu"  method="post" action="<?= site_url("Administrator/allSentInfo") ?>">
                                    <div id="inboxImage">
                                        &nbsp;
                                    </div>
                                    Sent
                                </form>
                            </li>
                            <li id="InformAll" class="flexMenu">
                                <div id="notifyAllImage">
                                    &nbsp;
                                </div>
                                Inform everyone
                            </li>
                            <li id="InformUser" class="flexMenu">
                                <div id="notifyUserImage">
                                    &nbsp;
                                </div>
                                Inform user
                            </li>
                            <li id="setPremium" class="flexMenu">
                                <div id="addPremiumImage">
                                    &nbsp;
                                </div>
                                Add premium
                            </li>
                            <li id="removePremium" class="flexMenu">
                                <div id="removePremiumImage">
                                    &nbsp;
                                </div>
                                Remove premium
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 col-sm-offset-2" id="panelAdministation" >

                    <div id="sentMessages">
                        <?php
                        if (isset($title)) {
                            echo "<h2 id='title'>" . $title . "</h2>";
                        }

                        if (isset($notifications)) {
                            if($title == "All premium users"){
                                echo "<table class='table'>";
                                foreach ($notifications as $value) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $value->getIdkorisnikPremium()->getKorisnickoime();
                                    echo "</td>";
                                    echo "<td>";
                                    echo $value->getDatumisteka()->format("h:i Y-m-d");;
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }else{
                                echo "<table class='table'>";
                                foreach ($notifications as $value) {
                                    echo "<tr>";
                                    echo "<td>";
                                    if ($value->getIdkorisnik() == null) {
                                        echo "<p>To all users</p>";
                                    } else {
                                        echo $value->getIdkorisnik()->getKorisnickoime();
                                    }
                                    echo "</td>";
                                    echo "<td>";
                                    echo $value->getNaslov();
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                        }
                        ?>
                        
                    </div>
                    
                    <form id="formForSendToAllUsers" method="post" action="<?= site_url("Administrator/sendToAllUsers") ?>">

                    </form>
                    <form id="formForSendToUser" method="post" action="<?= site_url("Administrator/sendToUser") ?>">

                    </form>
                    <form id="formForSetPremium" method="post" action="<?= site_url("Administrator/setPremium") ?>">

                    </form>
                    <form id="formForRemovePremium" method="post" action="<?= site_url("Administrator/removePremium") ?>">

                    </form>
                </div>
            </div>
            <div class="modal fade" id="notificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal header-->
                        <div id="noticeModalTitle" class="modal-header ">

                        </div>
                        <div id="noticeModalBody" class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <form id="formForPremiumUser" method="post" action="<?= site_url("Administrator/confirmPremium") ?>">
                                
                            </form>
                            <form id="formForPremiumUserDecline" method="post" action="<?= site_url("Administrator/declinePremium") ?>">
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <?php 
            if(isset($errorMessage)){
                echo "<script>alert('".$errorMessage."')</script>";
            }
        ?>
    </body>


