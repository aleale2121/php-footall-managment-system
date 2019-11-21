

<?php
   include('config.php');
   session_start();

   if ($_SESSION['loggedIn'] != true){
    header("Location: login.php");
    exit();
  }
  if (isset($_POST['logout'])){
    $_SESSION['loggedIn'] = false;
    header("Location: login.php");
    exit();
  }


    if(isset($_POST['search'])){
    $searchtext = $_POST['searchtext'];
    $_SESSION['searchtext'] = $searchtext;
    header("Location: Search.php");
    }
   if( $_SERVER["REQUEST_METHOD"] == "POST" )
   {
      $start_date = mysqli_real_escape_string($conn,$_POST['start_date']);
      $end_date = mysqli_real_escape_string($conn,$_POST['end_date']);
      if(!empty($start_date) && !empty($end_date))
      {

        $sql = "INSERT INTO zseason (Start_date,end_date) VALUES (?, ?)";
        $stmt=$conn->prepare($sql);;
        $stmt->bind_param("ss",$start_date,$end_date);
        $stmt->execute();
        $stmt->close();
        $sql1="SELECT id FROM zseason ORDER BY id DESC LIMIT 1";
        $query1=mysqli_query($conn, $sql1);
        $value=mysqli_fetch_object($query1);
        $season_id=$value->id;
        if(!empty($_POST['check_list'])) {

            foreach($_POST['check_list'] as $selected) {
              $val=trim($selected);
              // $sql2 = "SELECT club_id FROM zclub WHERE club_name ='$val'";
              // $query2=mysqli_query($conn, $sql2);
              // $value1=mysqli_fetch_assoc($query2);
              // $cl_id=$value1['club_id'];
              $sql = "INSERT INTO zclub_info (season_id,club_name,played,win,lose,draw,goalscore,goalon) VALUES (?,?,?,?,?,?,?,?)";
              $stmt=$conn->prepare($sql);
              $a=0;
              $stmt->bind_param("isiiiiii",$season_id,$val,$a,$a,$a,$a,$a,$a);
              $stmt->execute();
              $stmt->close();

            }
       }
       else{
           echo "<b>Please Select Atleast One Option.</b>";
       }

        }
      else{
          ?>
          <script>alert("There Wass An Error Please Fill All Fields")</script>
          <?php

    }
  }
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Football  Managment Software">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="John Doe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
 <script type="text/javascript" src="zfunctions.js">var CID =<?php echo  $CLUBID; ?>;</script>
  <script type="text/javascript"> </script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <style>
  .recents{
  	float: left;
  	display: inline-block;
  	margin: 2px;

  }
  .players{
  	width: 100%;
  	margin-top: 5px;

  }
  .mysp{
  	width: 100%;
  	clear: both;

  }

  </style>
</head>
<body>

    <div class="header">
        <div class="headings"> <img src="images/et.jfif"  style="width:150px;height:150px"></div>
        <div  class="headings txt"><p>FOOTBALL MANAGMENT SYSTEM </p></div>
    </div>

<div class="topnav">
  <a href="zAdminHomePage.php">Home </a>

  <form action = "#" method = "POST">
    <input type = "submit" class="logoutbutton" value = "Logout" name = "logout" />
  </form>

 <form action = "#" method = "POST">
        <input type="submit" style="float:right" name="search" value="Search" class = "searchbutton">
        <input type ="text" name = "searchtext" placeholder="Search..." style ="float:right; width: 260px; height:30px; margin-top:8px; margin-right: 1px">
  </form>


</div>

<div class="row">
  <div class ="rightcolumn">
  <h2>Admin Page</h2>
        <div id="card">
            <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="btn-group">

                      <a href="zAdminHomePage.php" target="_self">
                      <button class ="button1">Add new Season</button>
                      </a>
                      <a href="zAdminCreateClub.php" target="_self">
                      <button>Add Club</button>
                      </a>
                      <a href="zAdminCreateSchedule.php" target="_self">

                      <button>Add match schedule</button>
                      </a>
                      <a href="zAdminCreateRefree.php" target="_self">

                        <button>Add Refree</button>
                         </a>
                      <a href="zAdminAddMatchDetail.php" target="_self">
                        <button>Add Match Detail</button>
                      </a>
                    </div>
                  </div>

              <div class="panel-body">
                <form role="form" action="#" method="POST">
                  <fieldset>

                    <div class="row">
                      <div class="col-sm-12 col-md-10  col-md-offset-1 ">


                          <div class="form-group">
                            <div class="input-group">
                               <strong>  Start Date:     </strong>

                               <input type="date" name="start_date">


                               </div>
                          </div>
                        <br><br>
                        <div class="form-group">
                          <div class="input-group">
                            <strong> End Date:</strong>

                            <input type="date" name="end_date">


                          </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                          <strong> Choose Clubs:</strong>
                          <div class="input-group" id="Clubs">



                          </div>
                          <br><br>
                        </div>
                        <br><br>
                        <div class="form-group">

                          <input type="submit" class="btn btn-lg btn-primary btn-block" value="Done" name="Done">
                        </div>


                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>

        </div>


      </div>

</div>

  <div class="leftcolumn">



    <ul id="sideBarStyle">
     <li><a id="clubbtn" onclick="getClubs()">Clubs</a></li>
     <li><a  id="transferbtn" onclick="getResults()">Match Results</a></li>
     <li><a  id="matchbtn" onclick="getMatches()">Matches</a></li>
     <li><a  id="playerbtn" onclick="getPlayers()">Players</a></li>
     <li><a  id="playerbtn" onclick="getLeagueTable()">League table</a></li>
    </ul>
  </div>
  <div class="separator">
  </div>
  <?php
     include "footer.php";
   ?>

</body>
<script >

    var xhr;
     if (window.XMLHttpRequest) { // Mozilla, Safari, ...
        xhr = new XMLHttpRequest();
    } else if (window.ActiveXObject) { // IE 8 and older
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("GET", "zclubnames.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(null);
    xhr.onreadystatechange = display_data;
    function display_data() {
       if (xhr.readyState == 4) {
          if (xhr.status == 200) {
           //alert(xhr.responseText);
        document.getElementById("Clubs").innerHTML = xhr.responseText;
          } else {
            alert('There was a problem with the request.');
          }
         }
      }


  </script>
</html>
