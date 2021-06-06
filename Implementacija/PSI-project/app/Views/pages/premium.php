<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <?php 
    if($theme == "light"){
        echo "<link rel='stylesheet' class='themeCSS' href='http://localhost/PSI-project/stylePremium.css'>";
    }else{
        echo "<link rel='stylesheet' class='themeCSS' href='http://localhost/PSI-project/styleDarkPremium.css'>";
    }
    ?>
    <title>Subscribe to premium account</title>
    <link rel = "icon" href = "http://localhost/PSI-project/Implementacija/img/justLogo.png"
          
          
    type = "image/x-icon"> 
    <script src="http://localhost/PSI-project/menu.js"></script>
</head>
<body>
    <div id="allcontent">
        <div class="header lightblue column"> 
        <nav class ="navbar navbar-expand-sm  ">
            <a class="navbar-brand" href="<?= site_url("User") ?>">
                        <img src="http://localhost/PSI-project/Implementacija/img/whilelogo1.png" id="logo" alt="">
                    </a>   
                </nav>
        <nav class ="navbar navbar-expand-sm">
            <ul class="navbar-nav" id="right">
                        <li class="nav-item" style="padding: 8px; cursor: pointer;">
                            <div class="dropdown">
                                <img class="dropdown-toggle" src="http://localhost/PSI-project/Implementacija/img/user.png" style="width:28px;" alt="" data-toggle="dropdown">
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" id="user">
                                        <?php
                                       echo $name." ";
                                       echo $lastname;
                                       
                                        ?>
                                    </a>
                                    <a class="dropdown-item" id="product"  > 
                                        Productivity
                                          <div class='progress mx-auto' data-value='<?php echo $progress ?>'>
                                          <span class="progress-left">
                                                        <span class="progress-bar border-primary"></span>
                                          </span>
                                          <span class="progress-right">
                                                        <span class="progress-bar border-primary"></span>
                                          </span>
                                          <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                            <div class="h2 font-weight-bold"><?php echo $progress ?><sup class="small">%</sup></div>
                                          </div>
                                        </div>
                                        <?php
                                        if($progress=="100")
                                            echo "All done for Today"
                                        ?>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form id="formForTheme" action="<?= site_url("User/changeTheme") ?>" method="post">
                                        <p class="dropdown-item" id="theme" style="padding:4 4 24 24; margin: 0;">Theme</p>
                                        <input type="hidden" id="themeHidden" name="changeTheme" value="<?php echo $theme ?>">
                                    </form>
                                    <a class="dropdown-item" href="<?= site_url("User/showSettings") ?>">Settings</a>
                                    <a class="dropdown-item" href="<?= site_url("User/premium") ?>">Upgrade to premium</a>
                                    <a class="dropdown-item" href="<?= site_url("User/logOut") ?>">Log out</a>
                                </div>
                            </div>
                        </li>
            </ul>
        </nav>
            </div>
        <div id="surrounded">
            <form method="post" action="<?= site_url("User/informAdministrator")?>" name="formForPremium">
                <div id="textboxes" style="margin-right: 10px;">
                    <input type="text" placeholder="Holder of the card" name="firstAndLastName" style="width: 100%" required="required">
                    <input type="text" placeholder="Card number" name="cardNumber" style="width: 100%" required="required">
                </div>
                <div id="mmyy">
                    <input type="text" placeholder="MM" name="month" required="required">
                    <p>/</p>
                    <input type="text" placeholder="YY" name="year" required="required">
                    <input type="text" placeholder="CVC" name="cvc" required="required">
                </div>
                <div id="visa">
                    <div >
                        <input class="btn btn-primary" type="submit" value="Confirm">
                    </div>
                    <img src="http://localhost/PSI-project/Implementacija/img/icons8-visa-128.png" alt="">
                    <div>
                       <a href="go"><input class="btn" type="button" value="Cancel"></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>