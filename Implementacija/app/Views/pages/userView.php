
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
    <script src="http://localhost/PSI-projekat/menu.js"></script>
    <link rel="stylesheet" href="http://localhost/PSI-projekat/style.css">

    <title>DeadLines</title>
</head>
<body>
    <div class="container-fluid" >
        <div class="row" >
            <div class="col header lightblue column" >
                <nav class ="navbar navbar-expand-sm  ">
                    <a class="navbar-brand" href="#">
                        <img src="http://localhost/PSI-projekat/Implementacija/img/whilelogo.png" id="logo" alt="">
                    </a>
                    <ul class="navbar-nav" id="firstNav">
                        <li class="nav-item" id="slika">
                                <img  src="http://localhost/PSI-projekat/Implementacija/img/menu.png" style="width:45px; margin-top:6px; cursor:pointer;" alt="" >
                        </li>
                        <li class="nav-item">
                            <input type="search" name="searchBox" placeholder="Search"  id="searchBox">
                        </li>  
                    </ul>    
                </nav>
                <nav class ="navbar navbar-expand-sm">
                    <ul class="navbar-nav" id="right">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img src="http://localhost/PSI-projekat/Implementacija/img/star.png" alt="">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img src="http://localhost/PSI-projekat/Implementacija/img/plus.png" alt="">
                            </a>
                            </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img src="http://localhost/PSI-projekat/Implementacija/img/bell.png" alt="">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img src="http://localhost/PSI-projekat/Implementacija/img/information.png" alt="">
                            </a>
                        </li>
                        <li class="nav-item" style="padding: 8px; cursor: pointer;">
                            <div class="dropdown">
                                <img class="dropdown-toggle" src="http://localhost/PSI-projekat/Implementacija/img/user.png" style="width:28px;" alt="" data-toggle="dropdown">
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Theme</a>
                                    <a class="dropdown-item" href="">Settings</a>
                                    <a class="dropdown-item" href="">Upgrade to premium</a>
                                    <a class="dropdown-item" href="">Log out</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row" >
            <div class="col-2 column">
                <div class="menu" id="idMenu">
                    <ul class="list">
                        <li id="Inbox">
                            <img src="http://localhost/PSI-projekat/Implementacija/img/mail-inbox-app.png" alt="">
                            <a href="#">Inbox</a>
                        </li>
                        <li id="Today">
                            <img src="http://localhost/PSI-projekat/Implementacija/img/today.png" alt="">
                            <a href="#">Today</a>
                        </li>
                        <li id="Upcoming">
                            <img src="http://localhost/PSI-projekat/Implementacija/img/calendar.png" alt="">
                            <a href="#">Upcoming</a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <div class="flipProject">
                                <form name="addProjectForm" action="<?= site_url("User/addProject") ?>" method="post">
                                Projects
                                <a data-target="#myModal" data-toggle="modal">
                                    <img class="create" id="hoverImgProject" src="http://localhost/PSI-projekat/Implementacija/img/plus.png" alt="" >
                                  </a>
                                  <!-- Modal for adding new project-->
                                  <div tabindex="-1" class="modal fade" id="myModal" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title" id="myModalLabel">Add project</h4>
                                        </div>
                                        <div class="modal-body addProjectModal">
                                            <div class="modalForm">
                                                <label for="">Name</label>
                                                <input type="text" id="nameOfProject" name="nameOfProject">
                                                <label for="">Team leader</label>
                                                <input type="text" name="teamleader">
                                            </div>
                                            <div class="pickTypeOfProject">
                                                <label for="">View</label>
                                                <div class="imgsProjectView">
                                                    <div class="listView">
                                                        <img src="http://localhost/PSI-projekat/Implementacija/img/listView.PNG" alt="">
                                                        <div class="radioForProject">
                                                            <input type="radio" name="listBoard" id="list1">
                                                            <label for="list1">List</label>
                                                        </div>
                                                    </div>
                                                    <div class="boardView">
                                                        <img src="http://localhost/PSI-projekat/Implementacija/img/boardView.PNG" alt="">
                                                        <div class="radioForProject">
                                                            <input type="radio" name="listBoard" id="board1">
                                                            <label for="board1">Board</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                          <button class="btn btn-primary" type="submit" id="createProjectBtn">Create</button>
                                        </div>
                                      </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                  </div><!-- /.modal -->
                                </form>
                            </div>
                            <div class="panelProject" style="display: none;">
                                <ul class="list">
                                    <?php
                                        foreach ($projects as $project){
                                            echo"<li class='liElem'>".$project->getIme()."</li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="flipArchived">
                                Archived
                            </div>
                            <div class="panelArchived" style="display: none;">
                                <ul class="list">
                                    <li>ProjectOne</li>
                                    <li>ProjectTwo</li>
                                    <li>ProjectThree</li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="flipLabels">
                                Labels
                                <img class="create" id="hoverImgLabels" src="http://localhost/PSI-projekat/Implementacija/img/plusBlack.png" alt="">
                            </div>
                            <div class="panelLabels" style="display: none;">
                                <ul class="list">
                                    <li>LabelOne</li>
                                    <li>LabelTwo</li>
                                    <li>LabelThree</li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>