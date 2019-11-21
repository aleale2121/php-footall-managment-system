<?php
  session_start();
  $host = "localhost";
  $myUser = "root";
  $myPassword = "";
  $myDB = "football";
  $connection = mysqli_connect($host, $myUser, $myPassword, $myDB);
  if ($_SESSION['loggedIn'] != true){
    header("Location: login.php");
    exit();
  }
  if (isset($_POST['logout'])){
    $_SESSION['loggedIn'] = false;
    header("Location: login.php");
    exit();
  }
  $teamID = $_SESSION['favTeamID'];
    // $CLUBID=$_SESSION['favTeamID'];
    echo $teamID ;

  // $_SESSION['clubid']= $teamID ;
  $clubQuery = "SELECT * FROM zclub WHERE club_id = '".$teamID."'";
  $query = mysqli_query($connection, $clubQuery);
  $club = mysqli_fetch_object($query);


  $playersQuery = "SELECT * FROM zplayer WHERE club_id ='".$teamID."'";
  $players = mysqli_query($connection, $playersQuery);

  $coachQuery = "SELECT fname, lname FROM zcoach WHERE club_id = '".$teamID."'";
  $coach = mysqli_query($connection, $coachQuery)->fetch_object();


  $currentDateTime = date('Y-m-d');
  $clubsQuery = "SELECT *  FROM zschedule
           WHERE home_team = '".$club->club_name."' OR away_team='".$club->club_name."' AND match_date > '".$currentDateTime."' ORDER BY match_date DESC";
  $clubs = mysqli_query($connection, $clubsQuery);



  if(isset($_POST['search'])){
      $searchtext = $_POST['searchtext'];
      $_SESSION['searchtext'] = $searchtext;
      header("Location: Search.php");
  }if( $_SERVER["REQUEST_METHOD"] == "POST" )
   {


        $sql1="SELECT id FROM zseason ORDER BY id DESC LIMIT 1";
        $query1=mysqli_query($connection, $sql1);
        $value=mysqli_fetch_object($query1);
        // $season_id=$value->id;
        if(!empty($_POST['check_list'])) {
            $cnt=0;
            foreach($_POST['check_list'] as $selected) {
              $cnt+=1;


            }
            if($cnt!=11){
              ?>
               <script>alert("please select only 11 players")</script>
              <?php
            }else{
            $finalstr ="";
            foreach($_POST['check_list'] as $selected) {
              $val=trim($selected);
              $finalstr.="-".$val;


            }

            $final=explode("-",$finalstr);
            echo "".$final[11]." ".$final[1]." ".$final[2]." ".$final[3]." ".$final[4]." ".$final[5]." ".$final[6]." ".
              $final[7]." ".$final[8]." ".$final[9]." ".$final[10]."<br>";

            $sql = "INSERT INTO finalplayers (schedule_id,club_name,pl1,pl2,pl3,pl4,pl5,pl6,pl7,pl8,pl9,pl10,pl11) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $value = mysqli_fetch_object($clubs);
            echo $value->schedule_id."   ".$club->club_name."  ".$final[1];
            $stmt=$connection->prepare($sql);
            $al=$value->schedule_id;
            $clnm=$club->club_name;

            $stmt->bind_param("issssssssssss",$al,$clnm,$final[11],$final[1],$final[2],$final[3],$final[4],$final[5],$final[6],$final[7],$final[8],$final[9],$final[10]);
            $stmt->execute();
            $stmt->close();
          }


       }
       else{
           echo "<b>Please Select Atleast One Option.</b>";
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
    <title>Coach Home Page</title>
  <script type="text/javascript" src="zfunctions.js"></script>
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
        <div class="headings"> <img src="images/et.jfi"  style="width:150px;height:150px"></div>
        <div  class="headings txt"><p>FOOTBALL MANAGMENT SYSTEM </p></div>
    </div>

<div class="topnav">
  <a href="#">Home</a>
  <a href="EditProfile.php">Settings</a>

  <form action = "#" method = "POST">
    <input type = "submit" class="logoutbutton" value = "Logout" name = "logout" />
  </form>
  <form action = "#" method = "POST">
        <input type="submit" style="float:right" name="search" value="Search" class = "searchbutton">
        <input type ="text" name = "searchtext" placeholder="Search..." style ="float:right; width: 260px; height:30px; margin-top:8px; margin-right: 1px">
  </form>

</div>

<div class="row">

  <div class="leftcolumn">
       <ul id="sideBarStyle">
         <li><a id="clubbtn" onclick="getClubs()">Clubs</a></li>
         <li><a  id="transferbtn" onclick="getResults()">Match Results</a></li>
         <li><a  id="matchbtn" onclick="getMatches()">Matches</a></li>
         <li><a  id="playerbtn" onclick="getPlayers()">Players</a></li>
       </ul>
  </div>


  <div class="rightcolumn">

    <div class="card" id="card">

      <h2><?php echo $club->club_name;?></h2>


      <div class="inf" style="height:200px; width: 350px">
        <p>
             <!-- Coach:   <?php echo $coach->fname." ".$coach->lname;?>
           <br>Stadium: <?php echo $club->stadium;?>
           <br>Establishment Date:    <?php echo $club->est_date;?>
           <br> -->
           <?php
           $displaystring="<table >"."<tr>"."<th colspan='2'>".$club->club_name ."</th>"."</tr>"."<tr>"."<td>"."Coach"."</td>"."<td>".$coach->fname." ".$coach->lname."</td>".
            "</tr>"."<tr>"."<td>"."Club Stadium"."</td>"."<td>".$club->stadium."</td>"."</tr>"."<tr>"."<td>"."Club Establishment Date"."</td>"."<td>".$club->est_date."</td>"."</tr>"."</table>";
            echo $displaystring;

           ?>
        </p>
        <p>Recent Matches:<br>
      <?php

        while ($value = mysqli_fetch_object($clubs)){

                  //
                $displaystring='<form role="form" action="#" method="POST">';
                $displaystring.="<table >"."<tr>"."<th>".$value->home_team."     vs     ".$value->away_team."</th>"."</tr>"."<tr>"."<td>".$value->match_date."</td>".
                "</tr>"."<tr>"."<td>".$value->stadium."</td>"."</tr>"."<tr>"."<td>".$value->refree."</td>"."</tr>"."<tr>"."<td>".$value->match_time."</td>"."</tr>"."</table>";


                  $finalanounced="SELECT * FROM finalplayers WHERE schedule_id='".$value->schedule_id."' AND club_name='".$club->club_name."' LIMIT 1";

                  $stmt = $connection->prepare($finalanounced);
                  $stmt->execute();
                  $stmt->store_result();

                  if (($stmt->num_rows) == 0){
                     while ($row = mysqli_fetch_assoc($players)){
                        $displaystring .= "<input type=checkbox name=check_list[] value=".$row['fname']." ".$row['tshirt_num'].">".$row['fname']."<br>";

                    }
                  $displaystring.='<input type="submit" class="btn btn-lg btn-primary btn-block" value="Done" name="Done">';

                  }
                  $displaystring.="</form>";
                  echo "$displaystring";
                  $stmt->close();

              }
            ?>
    </p>
        <br>
        <p>Players:


          <?php
            $display_string = "<table>";
            $display_string .= "<tr>";
            $display_string .= "<th>Name</th>";
            $display_string .= "<th>SurName</th>";
            $display_string .= "<th> Malia Number</th>";
            $display_string .= "<th> BirthDate</th>";
            $display_string .= "</tr>";

              while ($row = mysqli_fetch_assoc($players)){
              $display_string .= "<tr>";
              $display_string .= "<td>".$row['fname']."</td>";
              $display_string .= "<td>".$row['lname']."</td>";
              $display_string .= "<td>".$row['tshirt_num']."</td>";
              $display_string .= "<td>".$row['Bdate']."</td>";
              $display_string .= "</tr>";
            }
            $display_string .= "</table>";
            echo $display_string;
            ?>


        </p>


      </div>
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


</body>
</html>
