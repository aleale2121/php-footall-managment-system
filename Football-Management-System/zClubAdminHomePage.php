
<?php
   include('config.php');
   session_start();
   if (($_SESSION['loggedIn'] != true) and ($_SESSION['type']!="clubadmin")){
    header("Location: login.php");
    exit();
   }
  if (isset($_POST['logout'])){
    $_SESSION['loggedIn'] = false;
    header("Location: login.php");
    exit();
  }

    $CLUBID=$_SESSION['id'];
    // echo $CLUBID;
    if(isset($_POST['search'])){
    $searchtext = $_POST['searchtext'];
    $_SESSION['searchtext'] = $searchtext;
    header("Location: Search.php");
    }

    $sql2="SELECT * FROM zplayer WHERE club_id='".$CLUBID."'";
   if( $_SERVER["REQUEST_METHOD"] == "POST" )
   {
      $club_id=mysqli_real_escape_string($conn,$_SESSION['id']);
      $name = mysqli_real_escape_string($conn,$_POST['name']);
      $lname = mysqli_real_escape_string($conn,$_POST['lname']);
      $malia= mysqli_real_escape_string($conn,$_POST['tnum']);
      $bdate = mysqli_real_escape_string($conn,$_POST['bdate']);


      if(!empty($name) && !empty($lname) )
      {

        $sql = "INSERT INTO zplayer (club_id,fname,lname,tshirt_num,Bdate) VALUES (?,?,?,?,?)";
        $stmt=$conn->prepare($sql);;
        $stmt->bind_param("issis",$club_id,$name,$lname,$malia,$bdate);
        $stmt->execute();
        $stmt->close();
        }else{
          ?>
          <script>alert("please fill all the feilds")</script>
          <?php

        }}
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <meta name="description" content="Football  Managment Software">
  <meta name="keywords" content="HTML,CSS,XML,JavaScript">
  <meta name="author" content="John Doe">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Club Admin</title>
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
<div id="main">
  <div class="topnav">
   <a href="zClubAdminHomePage.php">Home </a>

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
  <h2>Club Admin Home Page</h2>
       <div id="card">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="btn-group">
              <a href="zClubAdminHomePage.php" target="_self">

              <button>Add player</button>
              </a>
              <a href="zClubAdminCoachAddPage.php" target="_self">
              <button>Add Coach</button>
             </a>
            </div>
          </div>
          <div class="panel-body">
            <form role="form" action="#" method="POST">
              <fieldset>
                <div class="row">
                </div>
                <div class="row">
                  <div  class="col-sm-12 col-md-10  col-md-offset-1 ">
                      <div class="form-group">
                        <div class="input-group">
                           <strong>Player Name:    </strong>
                           <input type="text" name="name"><br><br>
                           </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                           <strong>Player Last Name:    </strong>
                           <input type="text" name="lname"><br><br>
                           </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                           <strong>Player Malia Number:    </strong>
                           <input type="number" name="tnum"><br><br>
                           </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                           <strong>Player Birth Date:    </strong>
                           <input type="date" name="bdate"><br><br>
                           </div>
                      </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-lg btn-primary btn-block" value="Done" name="Done"><br><br>
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
         <li><a  id="matchbtn" onclick="getClubResults()">Matche Results</a></li>
         <li><a  id="transferbtn" onclick="getClubMatches()">Match </a></li>
         <li><a  id="playerbtn" onclick="getClubPlayers()">Players</a></li>
         <li><a  id="playerbtn" onclick="getLeagueTable()">League table</a></li>
    </ul>
  </div>


</div>
<div class="separator">
</div>
<?php
   include "footer.php";
 ?>




  <script type="text/javascript">
    function getClubPlayers(){
      var x="clubplayers";
      x+="-";

      var clbid=<?php echo $CLUBID;   ?>;
      x+=clbid;
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("card").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "zfunctions.php?q=" + x, true);
      xmlhttp.send();
  };
  function getClubMatches(){
      var x="clubmatches";
      x+="-";

      var clbid=<?php echo $CLUBID;   ?>;
      x+=clbid;
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("card").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "zfunctions.php?q=" + x, true);
      xmlhttp.send();
  };function getClubResults(){
      var x="clubresults";
      x+="-";

      var clbid=<?php echo $CLUBID;   ?>;
      x+=clbid;
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("card").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "zfunctions.php?q=" + x, true);
      xmlhttp.send();
  };

  </script>

</body>

</html>
