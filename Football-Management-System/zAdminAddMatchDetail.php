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

$sql = "SELECT * FROM zschedule" ;
$result = mysqli_query($conn,$sql);
 if(isset($_POST['search'])){
    $searchtext = $_POST['searchtext'];
    $_SESSION['searchtext'] = $searchtext;
    header("Location: Search.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
   $ll=$_POST['match'];
   $sch=explode("-",$ll);
   $scheduleid=$sch[2];
   $poss1=$_POST['poss'];
   $poss2=100-$poss1;
   $home_score =  mysqli_real_escape_string($conn,$_POST['score1']);
   $home_poss =  mysqli_real_escape_string($conn,$poss1);
   $home_attempt =  mysqli_real_escape_string($conn,$_POST['attempt1']);
   $home_target =  mysqli_real_escape_string($conn,$_POST['target1']);

   $away_score =  mysqli_real_escape_string($conn,$_POST['score2']);
   $away_poss =  mysqli_real_escape_string($conn,$poss2);
   $away_attempt =  mysqli_real_escape_string($conn,$_POST['attempt2']);
   $away_target =  mysqli_real_escape_string($conn,$_POST['target2']);




   if ( $scheduleid=="ale" )
   {
        ?>
       <script> alert(" please ale ") </script>
        <?php
   }
   else
   {


            $sql = "INSERT INTO zmatch_detail (match_id,home_score,home_pos,home_attempt, home_target,
            away_score,away_pos,away_attempt,away_target)
                           VALUES (?,?,?,?,?,?,?,?,?) ";

            $stmt=$conn->prepare($sql);
            $stmt->bind_param("iiiiiiiii",$scheduleid,$home_score,$poss1,$home_attempt,$home_target
              ,$away_score,$poss2,$away_attempt,$away_target);
            $stmt->execute();
            $stmt->close();

            $sql = "SELECT season_id FROM zschedule WHERE schedule_id=$scheduleid LIMIT 1";
            $result7 = mysqli_query($conn,$sql);
            $row7 = mysqli_fetch_array($result7,MYSQLI_ASSOC);
            $seasonid=$row7['season_id'];
            $club1=$sch[0];
            $club2=$sch[1];


            $sql1 = "SELECT *  FROM zclub_info WHERE season_id='$seasonid' AND club_name='$club1'";
            $result1 = mysqli_query($conn,$sql1);
            $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
            $played=$row1['played']+1;$win=$row1['win'];$lose=$row1['lose'];$draw=$row1['draw'];$goal=$row1['goalscore'];$goalon=$row1['goalon'];

            $sql2 = "SELECT *  FROM zclub_info WHERE season_id='$seasonid' AND club_name='$club2'";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
            $played2=$row2['played']+1;
            $win2=$row2['win'];$lose2=$row2['lose'];$draw2=$row2['draw'];$goal2=$row2['goalscore'];$goalon2=$row2['goalon'];

            $number=1;
            if ($home_score > $away_score) {

                $win=$win+$number;
                $goal=$goal+$home_score;
                $goalon=$goalon+$away_score;
                $goaldifference=$goal-$goalon;
                $point=3*$win+$draw;

                $stmt = $conn->prepare("UPDATE zclub_info SET played=?, win = ?,lose = ?, draw = ?,goalscore = ?,  goalon = ? ,goaldifference = ? ,club_point=? WHERE season_id=? AND club_name=?");
                $stmt->bind_param('iiiiiiiiis' ,$played,$win,$lose,$draw,$goal,$goalon,$goaldifference,$point,$seasonid,$club1);
                $stmt->execute();
                $stmt->close();

                $lose2=$lose2+$number;
                $goal2=$goal2+$away_score;
                $goalon2=$goalon2+$home_score;
                $goaldifference2=$goal2-$goalon2;
                $point2=3*$win2+$draw2;
                $stmt = $conn->prepare("UPDATE zclub_info SET played=?, win = ?,lose = ?, draw = ?,goalscore = ?,  goalon = ? ,goaldifference = ? ,club_point=? WHERE season_id=? AND club_name=?");
                $stmt->bind_param('iiiiiiiiis' ,$played2,$win2,$lose2,$draw2,$goal2,$goalon2,$goaldifference2,$point2,$seasonid,$club2);
                $stmt->execute();
                $stmt->close();
            }elseif ($home_score < $away_score) {

                $win2=$win2+$number;
                $goal2=$goal2+$away_score;
                $goalon2=$goalon2+$home_score;
                $goaldifference2=$goal2-$goalon2;
                $point2=3*$win2+$draw2;
                $stmt = $conn->prepare("UPDATE zclub_info SET played=?, win = ?,lose = ?, draw = ?,goalscore = ?,  goalon = ? ,goaldifference = ? ,club_point=? WHERE season_id=? AND club_name=?");
                $stmt->bind_param('iiiiiiiiis' ,$played2,$win2,$lose2,$draw2,$goal2,$goalon2,$goaldifference2,$point2,$seasonid,$club2);
                $stmt->execute();
                $stmt->close();

                $lose=$lose+$number;
                $goal=$goal+$home_score;
                $goalon=$goalon+$away_score;
                $goaldifference=$goal-$goalon;
                $point=3*$win+$draw;
                $stmt = $conn->prepare("UPDATE zclub_info SET played=?, win = ?,lose = ?, draw = ?,goalscore = ?,  goalon = ?  ,goaldifference = ? ,club_point=?
                WHERE season_id=? AND club_name=?");
                $stmt->bind_param('iiiiiiiiis' ,$played,$win,$lose,$draw,$goal,$goalon,$goaldifference,$point,$seasonid,$club1);
                $stmt->execute();
                $stmt->close();
            }else{
                $draw2=$draw2+$number;
                $goal2=$goal2+$away_score;
                $goalon2=$goalon2+$home_score;
                $goaldifference2=$goal2-$goalon2;
                $point2=3*$win2+$draw2;
                $stmt = $conn->prepare("UPDATE zclub_info SET played=?, win = ?,lose = ?, draw = ?,goalscore = ?,  goalon = ? ,goaldifference = ? ,club_point=? WHERE season_id=? AND club_name=?");
                $stmt->bind_param('iiiiiiiiis' ,$played2,$win2,$lose2,$draw2,$goal2,$goalon2,$goaldifference2,$point2,$seasonid,$club2);
                $stmt->execute();
                $stmt->close();


                $draw=$draw+$number;
                $goal=$goal+$home_score;
                $goalon=$goalon+$away_score;
                $goaldifference=$goal-$goalon;
                $point=3*$win+$draw;
                $stmt = $conn->prepare("UPDATE zclub_info SET played=?, win = ?,lose = ?, draw = ?,goalscore = ?,  goalon = ?  ,goaldifference = ? ,club_point=?
                WHERE season_id=? AND club_name=?");
                $stmt->bind_param('iiiiiiiiis' ,$played,$win,$lose,$draw,$goal,$goalon,$goaldifference,$point,$seasonid,$club1);
                $stmt->execute();
                $stmt->close();
            }
   // }
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
    <title>Fan Home Page</title>

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
                     <button>Add new Season</button>
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
                       <button  class ="button1">Add Match Detail</button>
                     </a>
             </div>
             </div>
             <div class="panel-body">
               <form role="form" action="#" method="POST">
                 <fieldset>
                   <div class="row">

                   </div>
                   <div class="row">
                     <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                       <strong> Select The Schedule   </strong><br><br>
                       <select name= "match">
                           <?php

                                    while( $row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                    { $team1=htmlspecialchars($row['home_team']);
                                      $team2=htmlspecialchars($row['away_team']);
                                      $id=htmlspecialchars($row['schedule_id']);
                                      $teamd=$team1."-".$team2."-".$id;
                                      $teamale=$team1." vs ".$team2;
                                      echo "<option value='".$teamd."''>".$teamale."</option>";
                                    }

                           ?>

                       </select><br> <br>
                       <div class="form-group">
                         <div class="input-group">
                           <span class="input-group-addon">
                             <i class="glyphicon glyphicon-user"></i>
                           </span>
                           <strong>  Home Team Results:     </strong><br>

                           <input class="form-control" placeholder="Home Team Score" type="number" name="score1"  autofocus>  <br><br>
                           <input class="form-control slider" id="myRange" min="1" max="100" type="range" name="poss"autofocus>
                           <p>Home Team Possession <span id="demo"></span></p><br>
                           <input class="form-control" placeholder="Home Team Attempt" type="number" name="attempt1"  autofocus>  <br><br>
                           <input class="form-control" placeholder="Home Team On Target" type="number" name="target1"    autofocus>  <br><br>

                       </div>
                       </div>
                       <div class="form-group">
                         <div class="input-group">
                           <span class="input-group-addon">
                             <i class="glyphicon glyphicon-user"></i>
                           </span>
                           <strong>  Away Team Results:     </strong>
                           <input class="form-control" placeholder="Away Team Score" type="number" name="score2"  autofocus>  <br><br>
                           <input class="form-control" placeholder="Away Team Attempt" type="number" name="attempt2"  autofocus>  <br><br>
                           <input class="form-control" placeholder="Away Team On Target" type="number" name="target2"    autofocus>  <br><br>
                       </div>
                       </div>
                       <div class="form-group">
                         <input type="submit" class="btn btn-lg btn-primary btn-block" value="Add">
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
  <script>
    var slider = document.getElementById("myRange");
    var output = document.getElementById("demo");
    output.innerHTML = slider.value;

    slider.oninput = function() {
      output.innerHTML = this.value;
    }
</script>
</body>

</html>
