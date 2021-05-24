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
    <link rel="stylesheet" href="http://localhost/PSI-project/styleTasks.css">
    <title>DeadLines</title>
</head>
<body>
    <div class="container-fluid" >
        <div class="row" style="position:sticky; top:0; z-index: 1">
            <div class="col-sm-12 header lightblue column"  >
                
                <nav class ="navbar navbar-expand-sm  ">
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
                           echo $korisnik->getIme()." ";
                           echo $korisnik->getPrezime();
                          
                            ?>
                            
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img src="http://localhost/PSI-project/Implementacija/img/star.png" alt="">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#myModal1">
                                <img src="http://localhost/PSI-project/Implementacija/img/plus.png" alt="">
                            </a>
                            </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img src="http://localhost/PSI-project/Implementacija/img/bell.png" alt="">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img src="http://localhost/PSI-project/Implementacija/img/information.png" alt="">
                            </a>
                        </li>
                        <li class="nav-item" style="padding: 8px; cursor: pointer;">
                            <div class="dropdown">
                                <img class="dropdown-toggle" src="http://localhost/PSI-project/Implementacija/img/user.png" style="width:28px;" alt="" data-toggle="dropdown">
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Theme</a>
                                    <a class="dropdown-item" href="User/showSettings">Settings</a>
                                    <a class="dropdown-item" href="">Upgrade to premium</a>
                                    <a class="dropdown-item" href="<?= site_url("Administrator/logOut") ?>">Log out</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row rowTask" >
            <div class="col-2 column">
                <div class="menu" id="idMenu">
                    <ul class="list">
                        <li id="Sent">
                            <form id="formForSent" method="post" action="<?= site_url("Administrator/allSentInfo") ?>">
                                <img src="http://localhost/PSI-project/Implementacija/img/mail-inbox-app.png" alt="">
                                Sent
                            </form>
                        </li>
                        <li id="InformAll">
                            <img src="http://localhost/PSI-project/Implementacija/img/notifyAll.png" alt="">
                            Inform everyone
                        </li>
                        <li id="InformUser">
                            <img src="http://localhost/PSI-project/Implementacija/img/notifyUser1.png" alt="">
                            Inform user
                        </li>
                        <li id="setPremium">
                            <img src="http://localhost/PSI-project/Implementacija/img/addPremium.png" alt="">
                            Add premium
                        </li>
                        <li id="removePremium">
                            <img src="http://localhost/PSI-project/Implementacija/img/removePremium.png" alt="">
                            Remove premium
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-8 col-sm-offset-2" id="panelAdministation" >
                <?php 
                    if(isset($title)){
                        echo "<h2 id='title'>".$title."</h2>";
                    }
                    
                    if(isset($notifications)){
                        echo "<table class='table'>";
                        foreach($notifications as $value){
                            echo "<tr>";
                                echo "<td>";
                                    if($value->getIdkorisnik()==null){
                                        echo "<p>To all users</p>";
                                    }else{
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
                ?>
                <form id="formForSetPremium" method="post" action="<?= site_url("Administrator/setPremium") ?>">
                    
                </form>
                <form id="formForRemovePremium" method="post" action="<?= site_url("Administrator/removePremium") ?>">
                    
                </form>
            </div>
        </div>
    </div>
</body>

        
