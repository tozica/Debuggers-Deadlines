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
                            <div class="dropdown">
                                <img class="dropdown-toggle" src="http://localhost/PSI-project/Implementacija/img/bell.png" style="width:28px;" alt="" data-toggle="dropdown">
                                <div class="dropdown-menu dropdown-menu-right">
                                    <?php 
                                       if(isset($notifications)){
                                           foreach($notifications as $value){
                                               echo "<a class='dropdown-item notices' name='".$value->getIdobavestenja()."' data-toggle='modal' data-target='#notificationModal'>".$value->getNaslov()."</a>";
                                               echo "<input type='hidden' id='notificationModal".$value->getIdobavestenja()."' value='".$value->getSadrzaj()."'>";
                                           }
                                       }
                                    ?>
                                </div>
                            </div>
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
                                    <a class="dropdown-item" href="User/logOut">Log out</a>
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
                        <li id="Inbox">
                            <form id="formForInbox" method="post" action="User/inbox">
                            <img src="http://localhost/PSI-project/Implementacija/img/mail-inbox-app.png" alt="">
                                 Inbox
                            </form>
                        </li>
                        <li id="Today">
                            <form id="formForToday" method="post" action="User/today">
                            <img src="http://localhost/PSI-project/Implementacija/img/today.png" alt="">
                             Today
                            </form>
                        </li>
                        <li id="Upcoming">
                            <img src="http://localhost/PSI-project/Implementacija/img/calendar.png" alt="">
                            <a href="#">Upcoming</a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <div class="flipProject">
                                Projects
                                <a data-target="#myModal" data-toggle="modal">
                                <img class="create" id="hoverImgProject" src="http://localhost/PSI-project/Implementacija/img/plus.png" alt="" >
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
                                <img class="create" id="hoverImgLabels" src="http://localhost/PSI-project/Implementacija/img/plusBlack.png" alt="">
                            </div>
                            <div class="panelLabels" style="display: none;">
                                <ul class="list">
                                     <?php
                                            $labelUnique = [];
                                            $existsLabel = false;
                                            foreach ($labels as $label) {
                                                foreach ($labelUnique as $unique){
                                                    if($label->getIdlabela()->getIme() ==  $unique->getIdlabela()->getIme()){
                                                        $existsLabel = true;
                                                        break;
                                                    }
                                                }
                                                if($existsLabel == false) {
                                                    echo "<form action='User/label' method='post'>";
                                                    echo "<input name='labelaTask' class='idlabela' type='hidden' value='".$label->getIdlabela()->getIme()."'>";
                                                    echo "<li class='liElem labelForm' name='".$label->getIdlabela()->getIdlabela()."'><p>".$label->getIdlabela()->getIme()."</p></li>";
                                                    echo "</form>";
                                                    array_push($labelUnique,$label);    
                                                }
                                                $existsLabel = false;
                                            }
                                            
                                        ?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-8 col-sm-offset-2" id="tasks1" >
                <div id="tasks" class="tasks" >
                    <div id="head">
             <?php if($flag==0)
                    echo "<h2 id='title'>Inbox</h2>";
                 else if($flag==1)
                     echo "<h2 id='title'>Search results for '".$search."'</h2>";
                 else if($flag==2)
                     echo "<h2 id='title'>Today</h2>";
                 else if($flag==3)
                     echo "<h2 id='title'>Label  '".$labela."'</h2>";
                 echo "<div class='dropdown' style='margin-right:7px'>";
                 echo"<img src='http://localhost/PSI-project/Implementacija/img/icons8-up-down-arrow-26.png' class='dropdown-toggle'data-toggle='dropdown' style=' height:24px; width:24px; margin-top:8px;'>";
                                      echo"  <div class='dropdown-menu sort'>";
                    echo "<a href='User/SortAlphabeticalA' class='dropdown-item' value='1'>Alphabetical Ascending</a>";
                    echo "<a href='User/SortAlphabeticalD' class='dropdown-item' value='2'>Alphabetical Descending</a>";
                    echo "<a href='User/SortPriorityA' class='dropdown-item' value='3'>Priority Ascending</a>";
                    echo "<a href='User/SortPriorityD' class='dropdown-item' value='4'>Priority Descending</a>";
                    echo "<a href='User/DateAdded' class='dropdown-item' value='4'>Date Added</a>";
                    echo" </div>";
                    echo" </div>";
                echo "</div>";
                   echo  "<hr style='margin-top:0;'>";
                   
              ?>      
                    <?php
                   $count=0;
                   foreach ($tasks as $value) {
                       $alarmFlag = false;
                       if($value->getPrioritet()!=-1 && $value->getVidljivost()==1){
                           $show=false;
                           try{
                               
                           $id=$value->getIdtask();
                           foreach ($alarms as $alarm){
                            if($alarm->getIdtask()->getIdtask()==$id){
                               $alarmFlag=true;
                               break;
                           }
                           }
                           }catch(\Exception $e){
       
                               echo $e;
                           }
                          // if($show==true){
                           
                              echo"<div class='round' >";
                              echo "<div class='taskTitle' id='".$value->getIdtask()."'>";
                              echo"<input  type='checkbox' style='margin-right:20px' id='checkbox".$count."' />";
                              if($value->getPrioritet()==0)
                              echo"<label class='circle' style=' border: 2px solid #ccc; margin-right:20px' for='checkbox".$count."'></label>";
                              if($value->getPrioritet()==1)
                              echo"<label class='circle' style=' border: 2px solid lightblue; margin-right:20px' for='checkbox".$count."'></label>";
                              if($value->getPrioritet()==2)
                              echo"<label class='circle' style='  border: 2px solid blue; margin-right:20px' for='checkbox".$count."'></label>";
                              if($value->getPrioritet()==3)
                              echo"<label class='circle' style=' border: 2px solid yellow; margin-right:20px' for='checkbox".$count."'></label>";
                              if($value->getPrioritet()==4)
                              echo"<label class='circle' style='  border: 2px solid orange;margin-right:20px' for='checkbox".$count."'></label>";
                              if($value->getPrioritet()==5)
                              echo"<label class='circle' style=' border: 2px solid red;margin-right:20px' for='checkbox".$count."'></label>";
                             
                              echo "<p class='text' style='width:450px; margin:0'>";
                              echo $value->getSadrzaj();
                              echo"</p>";
                              echo "</div>";
                             
                              echo"<form method='post' action='User/editTask' style='display:none' class='".$value->getIdtask()."'>";
                              echo"<table class='table'>";
                              echo"<tr id='firstRow' >";
                              echo"<td colspan='2'>";
                              echo"<input class='newName' placeholder='New Task name'style='width:100%; outline:none; border:none' type='text' name='newName'>";
                              echo"</td>";
                              echo"</tr>";
                              echo"<tr id='secondRow'>";
                              echo"<td style='padding-top:12px'>";
                              echo"<input type='date' class='Schedule' placeholder='Schedule'>";
                               echo"</td>";
                                echo"<td  style='display:flex; flex-direction:row; justify-content:flex-end'>";
                              echo "<div class='dropdown' style='margin-right:7px'>
                                        <button type='button' class='btn btn-outline-secondary dropdown-toggle' data-toggle='dropdown'>P</button>
                                        <div class='dropdown-menu newPriority'>
                                            <a href='#' class='dropdown-item' value='1'>Priority 1</a>
                                            <a href='#' class='dropdown-item' value='2'>Priority 2</a>
                                            <a href='#' class='dropdown-item' value='3'>Priority 3</a>
                                            <a href='#' class='dropdown-item' value='4'>Priority 4</a>
                                            <a href='#' class='dropdown-item' value='5'>Priority 5</a>
                                        </div>
                                    </div>";
                              
                                
                              echo"<img class='flag' name='".$value->getIdtask()."' style='height:24px; margin-top:7px; margin-right:7px'src='http://localhost/PSI-project/Implementacija/img/icons8-flag-2-24.png' alt=''>";
                              if($alarmFlag==true){
                                  echo "<img class='newAlarm' name='".$value->getIdtask()."' style='height:24px; margin-top:7px; margin-right:7px' src='http://localhost/PSI-project/Implementacija/img/alarm-clock-blue.png' alt=''>";
                              }
                              else{
                                echo "<img class='newAlarm' name='".$value->getIdtask()."' style='height:24px; margin-top:7px; margin-right:7px' src='http://localhost/PSI-project/Implementacija/img/alarm-clock.png' alt=''>";
                              }
                               echo"</td>";
                               echo"<tr>";
                                echo"<td>";
                                 echo"<input type='hidden'  name='newPriority'>";
                                 echo"<input type='hidden'  name='alarmChange'>";
                                echo"<input type='hidden' value='".$value->getIdtask()."' name='id'>";
                                echo"<input type='submit' class='btn btn-secondary' style='margin-right:10px' value='Change'>";
                                echo"<input type='button' class='btn btn-outline-secondary' value='Cancel'>";
                                 echo"</td>";
                                 
                                    echo"<td style='float:right'>";
                   //           echo "<div id='newLabel".$value->getIdtask()."' style='display:none'>";
                              echo"<input type='text' id='newLabel".$value->getIdtask()."' style='display:none'  name='newLabel' >";
                   //           echo "</div>";
                               echo"</td>";
                               echo"</tr>";
                               echo"</table>";
                              echo"</form>";
                              echo"<hr>";
                              echo"</div>";
                              $count++;
                           }
                             
                      // }
                        $alarmFlag = false;
                         }

                     ?>    
              
                   
                    <!--</ul>-->
<!--                    <div style="z-index : 1">-->
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal1">+ Add new Task</button> 
                    <form class="modalForm" name="newTask" action="User/newTask" method="post">
                        <div class="modal fade" id="myModal1">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                        <div class="modal-header">
                                            <h4 class="modal-title">Add new task</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="surrounding">
                                                <div id="txtarea">
                                                <input name="taskName" type="text" id="txarea" placeholder="Task name">
                                                </div>
                                                <div id="moreoptions">
                                                    <div id="surr10">
                                                        <div id="slicice">
                                                            <img class="alarm" src="http://localhost/PSI-project/Implementacija/img/alarm-clock.png" alt="">
                                                            <img class="labela" src="http://localhost/PSI-project/Implementacija/img/icons8-flag-2-24.png" alt="">
                                                        </div>
                                                        <!-- <img src="img/icons8-price-tag-24.png" alt=""> -->
                                                        <div class="dropdown">
                                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">P</button>
                                                            <div class="dropdown-menu priority">
                                                                <a href="#" class="dropdown-item" value="1">Priority 1</a>
                                                                <a href="#" class="dropdown-item" value="2">Priority 2</a>
                                                                <a href="#" class="dropdown-item" value="3">Priority 3</a>
                                                                <a href="#" class="dropdown-item" value="4">Priority 4</a>
                                                                <a href="#" class="dropdown-item" value="5">Priority 5</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if($flag==0){}
                                                    else if($flag==1){
                                                        echo "<input type='hidden' name='method' value='search'>";
                                                        echo "<input type='hidden' name='labelName'>";
                                                    }
                                                    else if($flag==2){
                                                        echo "<input type='hidden' name='method' value='today'>";
                                                        echo "<input type='hidden' name='labelName'>";
                                                    } else if($flag==3){
                                                        echo "<input type='hidden' name='method' value='label'>";
                                                        echo "<input type='hidden' name='labelName' value='".$labela."'>";
                                                    }
?>
                                                    <input type="hidden" name="alarm" id="alarmSlika">
                                                    <input type="hidden" name="priority">
                                                    <input name="date" type="date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                           <input class ="labelaModal" type='text' style='display:none'  name='labelaModal'>
                                           <input class="modalSubmit" type="submit" class="btn btn-primary" value="Add">
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                        </div>
                                </div>
                            </div>
                        </div> 
                        
                    </form>
<!--                    </div>-->

                </div>
            </div>    
                

        </div>
    </div>
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
                                <img src="http://localhost/PSI-project/Implementacija/img/listView.PNG" alt="">
                                <div class="radioForProject">
                                    <input type="radio" name="listBoard" id="list1">
                                    <label for="list1">List</label>
                                </div>
                            </div>
                            <div class="boardView">
                                <img src="http://localhost/PSI-project/Implementacija/img/boardView.PNG" alt="">
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
                      <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
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
                      <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
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
                      <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                      <button class="btn btn-primary" type="submit" id="">Confirm</button>               
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </form>
         <div class="modal fade" id="notificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal header-->
                        <div id="noticeModalTitle" class="modal-header ">
                            
                        </div>
                        <div id="noticeModalBody" class="modal-body">
                            
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-primary" data-dismiss="modal" value="Confirm">
                        </div>
                    </div>
                </div>
            </div>   
      </div>
        
    <form action="User" method="post" id="formForDelete"></form>
</body>
</html>