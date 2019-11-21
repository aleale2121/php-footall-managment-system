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

/*****This section is for fetching league and club names for filling html***/
$sql = "SELECT stadium FROM zclub" ;
$sql2 = "SELECT club_name FROM zclub";
$sql3 = "SELECT refree_name FROM zrefree";
$result = mysqli_query($conn,$sql2);
$result2 = mysqli_query($conn,$sql);
$result3 = mysqli_query($conn,$sql3);
$result7 = mysqli_query($conn,$sql2);
 if(isset($_POST['search'])){
    $searchtext = $_POST['searchtext'];
    $_SESSION['searchtext'] = $searchtext;
    header("Location: Search.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
   $home_club =  mysqli_real_escape_string($conn,$_POST['home_club']);
   $away_club =  mysqli_real_escape_string($conn,$_POST['away_club']);
   $stadium = mysqli_real_escape_string($conn,$_POST['stadium']);
   $date = mysqli_real_escape_string($conn,$_POST['date']);
   $start_time = mysqli_real_escape_string($conn,$_POST['starttime']);
   $zrefree = mysqli_real_escape_string($conn,$_POST['refree']);
   $sql1="SELECT * FROM zseason ORDER BY id DESC LIMIT 1";
   $query1=mysqli_query($conn, $sql1);
   $value=mysqli_fetch_object($query1);
   $season_id=$value->id;


   if ( $home_club == $away_club )
   {
        ?>
       <script> alert("Please choose different home and away team for creating game ") </script>
        <?php
   }
   else
   { if(!empty($home_club)&&!empty($away_club)&&!empty($stadium)&&!empty($date)&&!empty($start_time)&&!empty($zrefree)&&!empty($season_id)){

      $enddate=$value->end_date;
      $currentDateTime = date('Y-m-d');

      if (($date >= $currentDateTime)&&($date<$enddate)){

            $sql = "INSERT INTO zschedule (season_id,home_team,away_team,stadium, refree,match_date, match_time )
                           VALUES (?,?,?,?,?,?,?) ";

            $stmt=$conn->prepare($sql);
            $stmt->bind_param("issssss",$season_id,$home_club,$away_club,$stadium,$zrefree,$date,$start_time);
            $stmt->execute();
            $stmt->close();
      } else{
        echo "ALEALE";
      }

   }
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
   				  <button >Add new Season</button>
   				  </a>
   				  <a href="zAdminCreateClub.php" target="_self">
   				  <button>Add Club</button>
   				  </a>
   				  <a href="zAdminCreateSchedule.php" target="_self">

   				  <button class ="button1">Add match schedule</button>
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

   				</div>
   				<div class="row">
   				  <div class="col-sm-12 col-md-10  col-md-offset-1 ">

   					<strong>  Home Club:     </strong>

   					<select name= "home_club">

   						<?php

   								 while( $row = mysqli_fetch_array($result,MYSQLI_ASSOC))
   								 {
   								   echo "<option value='".htmlspecialchars($row['club_name'])."''>".htmlspecialchars($row['club_name'])."</option>";
   								 }

   						?>

   					</select>
					<br><br>

   					<strong>  Away Club:     </strong>

   					<select name= "away_club">

   						<?php

   								 while( $row = mysqli_fetch_array($result7,MYSQLI_ASSOC))
   								 {
   								   echo "<option value='".htmlspecialchars($row['club_name'])."''>".htmlspecialchars($row['club_name'])."</option>";
   								 }

   						?>

   					</select>
   					<br><br>
   					<strong>Select   Stadiums:     </strong>

   					<select name= "stadium">

   						<?php

   								 while( $row = mysqli_fetch_array($result2,MYSQLI_ASSOC))
   								 {
   								   echo "<option value='".htmlspecialchars($row['stadium'])."''>".htmlspecialchars($row['stadium'])."</option>";
   								 }

   						?>

   					</select>
   					<br><br>
   					<strong>Select Refree:     </strong>
   					<select name= "refree">

   						<?php

   								 while( $row = mysqli_fetch_array($result3,MYSQLI_ASSOC))
   								 {
   								   echo "<option value='".htmlspecialchars($row['refree_name'])."''>".htmlspecialchars($row['refree_name'])."</option>";
   								 }
   						?>
   					</select>
					<br><br>
   					<div class="form-group">
   					  <div class="input-group">
   						<strong>  Date:     </strong>
   						<form action="/action_page.php">
   						<input type="date" name="date">
   					 </form>
   					</div>
   					</div>
					<br><br>
   					<div class="form-group">
   					  <div class="input-group">
   						<span class="input-group-addon">
   						  <i class="glyphicon glyphicon-user"></i>
   						</span>
   						<strong>  Start Time:     </strong>
   						<input class="form-control" placeholder="Start Time" name="starttime" type="Time" autofocus>
   					</div>
   					</div>
					<br><br>
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
</body>

</html>
