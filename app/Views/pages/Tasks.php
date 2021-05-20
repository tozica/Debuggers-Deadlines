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
                            <input type="search" name="searchBox" placeholder="Search"  id="searchBox">
                        </li>  
                    </ul>    
                </nav>
                <nav class ="navbar navbar-expand-sm">
                    <ul class="navbar-nav" id="right">
                        <li class="nav-item">
                            <?php
                           echo $korisnik->getIme();
                           echo $korisnik->getPrezime();
                          
                            ?>
                            
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img src="http://localhost/PSI-project/Implementacija/img/star.png" alt="">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
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
        <div class="row rowTask" >
            <div class="col-2 column">
                <div class="menu" id="idMenu">
                    <ul class="list">
                        <li id="Inbox">
                            <img src="http://localhost/PSI-project/Implementacija/img/mail-inbox-app.png" alt="">
                            <a href="#">Inbox</a>
                        </li>
                        <li id="Today">
                            <img src="http://localhost/PSI-project/Implementacija/img/today.png" alt="">
                            <a href="#">Today</a>
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
                                <img class="create" id="hoverImgProject" src="http://localhost/PSI-project/Implementacija/img/plusBlack.png" alt="" >
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
                                <img class="create" id="hoverImgArchived" src="http://localhost/PSI-project/Implementacija/img/plusBlack.png" alt="" >
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
                                <img class="create" id="hoverImgLabels" src="http://localhost/PSI-project/Implementacija/img/plusBlack.png" alt="">
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
            <div class="col-sm-8 col-sm-offset-2" id="tasks1" >
                <div id="tasks" class="tasks" >
             
                    <h2 id="title">Inbox</h2>
                    <hr>
                   
                    
                    <?php
                   $count=0;
                   
                   foreach ($tasks as $value) {
                       $alarmFlag = false;
                       if($value->getPrioritet()!=-1){
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
                           
                              echo"<div class='round' >";
                              echo "<div class='taskTitle' id='".$value->getIdtask()."'>";
                              echo"<input  type='checkbox' style='margin-right:20px' id='checkbox".$count."' />";
                              echo"<label class='circle' style='margin-right:20px' for='checkbox".$count."'></label>";
                             
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
</body>
</html>