
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
    <link rel="stylesheet" href="http://localhost/PSI-projekat/Implementacija/img/style.css">

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
                                    <a class="dropdown-item" href="User/showSettings">Settings</a>
                                    <a class="dropdown-item" href="#">Theme</a>
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
                               
                                Projects
                                <a data-target="#myModal" data-toggle="modal">
                                    <img class="create" id="hoverImgProject" src="http://localhost/PSI-projekat/Implementacija/img/plus.png" alt="" >
                                </a>

                            </div>
                            <div class="panelProject" style="display: none;">
                                <ul class="list">
                                    <?php
                                        foreach ($projects as $project){
                                            if($project->getArhiviran() == 0){
                                                echo"<li class='liElem'><p>".$project->getIme()."</p></li>";
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="flipArchived">
                                Archived
                                <img class="create" id="hoverImgArchived" src="http://localhost/PSI-projekat/Implementacija/img/plus.png" alt="" >

                            </div>
                            <div class="panelArchived" style="display: none;">
                                <ul class="list">
                                    <?php
                                        foreach ($projects as $project){
                                            if($project->getArhiviran() == 1){
                                                echo"<li class='liElem'><p>".$project->getIme()."</p></li>";
                                            }
                                        }
                                    ?>
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
        <!--Modal for adding a new project-->
        <div class="modals">
        <form name="addProjectForm" action="<?= site_url("User/addProject") ?>" method="post" id="projectForm">
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
                    <button class="btn btn-default" type="button" data-dismiss="modal" id="closeModalCreate">Close</button>
                  <button class="btn btn-primary" type="submit" id="createProjectBtn">Create</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          <input type="hidden" id="valuerForRadio" name="hiddenForType">
          </form>
          <!--Modal for 3 dots. More option for project-->
          <form name="moreOptinsForm" action="<?= site_url("User/changeProject") ?>" method="post" id="moreOptionsId">
            <div tabindex="-1" class="modal fade" id="moreOptionModal" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="titleMoreOption"></h4>
                  </div>
                  <div class="modal-body addProjectModal">
                      <div class="modalForm">
                          <label for="newName">New name</label>
                          <input type="text" id="newName" name="renameField">
                      </div>
                      <div id="pickOption">
                          <div id="Rename">
                              <input type="radio" name="options" id="renameRadio">
                              <label for="renameRadio">Rename</label>
                          </div>
                          <div id="Archive">
                              <input type="radio" name="options" id="archiveRadio">
                              <label for="archiveRadio">Archive</label>
                          </div>
                          <div id="Delete">
                              <input type="radio" name="options" id="deleteRadio">
                              <label for="deleteRadio">Delete</label>
                          </div>
                      </div>
                      <input type="hidden" name="resultRadio" id="radioHidden">
                      <input type="hidden" name="nameHidden" id="fornamehidden">
                  </div>
                  <div class="modal-footer">
                      <button class="btn btn-default" type="button" data-dismiss="modal" id="">Close</button>
                      <button class="btn btn-primary" type="submit" id="confirmProjectChange">Confirm</button>               
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </form>
            
            <!--Modal for more options in archived section-->
            <form name="moreOptinsFormArchived" action="<?= site_url("User/changeProjectArchived") ?>" method="post" id="moreOptionsArchivedId">
            <div tabindex="-1" class="modal fade" id="moreOptionArchivedModal" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel2">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="titleMoreArchivedOption"></h4>
                  </div>
                  <div class="modal-body addProjectModal">
                      <div class="modalForm">
                          <label for="newNameArchived">New name</label>
                          <input type="text" id="newNameArchived" name="renameFieldArchived">
                      </div>
                      <div id="pickOption">
                          <div id="Rename">
                              <input type="radio" name="optionsArchived" id="renameRadioArchived">
                              <label for="renameRadioArchived">Rename</label>
                          </div>
                          <div id="Archive">
                              <input type="radio" name="optionsArchived" id="archiveRadioArchived">
                              <label for="archiveRadioArchived">Unarchive</label>
                          </div>
                          <div id="Delete">
                              <input type="radio" name="optionsArchived" id="deleteRadioArchived">
                              <label for="deleteRadioArchived">Delete</label>
                          </div>
                      </div>
                      <input type="hidden" name="resultRadioArchived" id="radioHiddenArchived">
                      <input type="hidden" name="nameHiddenArchived" id="fornamehiddenArchived">
                  </div>
                  <div class="modal-footer">
                      <button class="btn btn-default" type="button" data-dismiss="modal" id="">Close</button>
                      <button class="btn btn-primary" type="submit" id="confirmProjectChangeArchived">Confirm</button>               
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </form>
            
            <!--Modal for settings-->
            <form name="formForSetting" action="<?= site_url("User/settingsChange") ?>" method="post" id="modalSettings">
            <div tabindex="-1" class="modal fade" id="settingsModal" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel3">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="titleSettings">Settings</h4>
                  </div>
                  <div class="modal-body">
                      <div class="usernameSettings">
                          <label for="usernameSettings">Username:</label>
                          <p><?php echo $username;  ?></p><br>
                          <a href="#" id="colapseUsername">Edit</a>
                      </div>
                      <div id="userNameFields" class="botomMargin">
                          <input type="text" id="userNameText" name="userNameField" placeholder="Enter a new username">
                      </div>
                      <div class="usernameSettings nameSettings">
                          <label for="">Name:</label>
                          <p><?php echo $name;  ?></p><br>
                          <a href="#" id="colapseName">Edit</a>
                      </div>
                      <div id="nameFields" class="botomMargin">
                          <input type="text" id="nameText" name="nameField" placeholder="Enter a new name">
                      </div>
                      <div class="usernameSettings lastNameSettings">
                          <label for="">Last name:</label>
                          <p><?php echo $lastname;  ?></p><br>
                          <a href="#" id="colapseLastName">Edit</a>
                      </div>
                      <div id="lastNameFields" class="botomMargin">
                          <input type="text" id="lastNameText" name="LastNameField" placeholder="Enter a new last name">
                      </div>
                      <div class="usernameSettings emailSettings">
                          <label for="">Email:</label>
                          <p><?php echo $mail;  ?></p><br>
                          <a href="#" id="colapseEmail">Edit</a>
                      </div>
                      <div id="emailFields" class="botomMargin">
                          <input type="text" id="emailText" name="emailField" placeholder="Enter a new e-mail">
                      </div>
                      <div class="usernameSettings passSettings">
                          <label for="">Password:</label>
                          <a href="#" id="colapsePass">Change password</a>
                      </div>
                      <div id="passFields" class="botomMargin">
                          <input type="password" id="passText" name="passField" placeholder="Enter a new password">
                      </div>
                      

                  </div>
                  <div class="modal-footer">
                      <button class="btn btn-default" type="button" data-dismiss="modal" id="">Close</button>
                      <button class="btn btn-primary" type="submit" id="">Confirm</button>               
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </form>
      </div>
    </div>
</body>
</html>