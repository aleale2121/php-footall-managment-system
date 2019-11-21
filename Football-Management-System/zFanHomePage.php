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


  $sql = "SELECT * FROM zfan WHERE username = '".$_SESSION['username']."' LIMIT 1";
      $query = mysqli_query($connection, $sql);
        $value = mysqli_fetch_assoc($query);
        $teamID=$value['favTeamID'];
	$clubQuery = "SELECT * FROM zclub WHERE club_id = '".$teamID."'";
	$query = mysqli_query($connection, $clubQuery);
  $club = mysqli_fetch_object($query);
	// $myImage = '<img  src="images/'.$club->name.'"'.'style="height:200px; width: 280px">';

	$playersQuery = "SELECT * FROM zplayer WHERE club_id ='".$teamID."'";
	$players = mysqli_query($connection, $playersQuery);

	$coachQuery = "SELECT * FROM zcoach WHERE club_id = '".$teamID."'";
	$coach = mysqli_query($connection, $coachQuery)->fetch_object();


  $currentDateTime = date('Y-m-d');
	$clubsQuery = "SELECT home_team,away_team,stadium,refree,match_date,match_time  FROM zschedule
				   WHERE home_team = '".$club->club_name."' OR away_team='".$club->club_name."' AND match_date > '".$currentDateTime."' ORDER BY match_date DESC";
	$clubs = mysqli_query($connection, $clubsQuery);



        if(isset($_POST['search'])){
            $searchtext = $_POST['searchtext'];
            $_SESSION['searchtext'] = $searchtext;
            header("Location: Search.php");
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
<script type="text/javascript"></script>
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
		<div class="headings"> <img src="images/et.jfif"  style="width:150px;height:150px"></div>
		<div  class="headings txt"><p>FOOTBALL MANAGMENT SYSTEM </p></div>
	</div>
<div class="topnav">
  <a href="zFanHomePage.php">Home</a>

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
		 <li><a  id="playerbtn" onclick="getLeagueTable()">League table</a></li>
  		</ul>
    </div>
  <div class="rightcolumn">

    <div id="card">
	   <div class="panel panel-default">
		   <h2><?php echo $club->club_name;?></h2>
		   <div class="inf" >
			 <div>
				<?php
				$displaystring="<table class='players' >"."<tr>"."<th  colspan='2'>".$club->club_name ."</th>"."</tr>"."<tr>"."<td>"."Coach"."</td>"."<td>".$coach->fname." ".$coach->lname."</td>".
				 "</tr>"."<tr>"."<td>"."Club Stadium"."</td>"."<td>".$club->stadium."</td>"."</tr>"."<tr>"."<td>"."Club Establishment Date"."</td>"."<td>".$club->est_date."</td>"."</tr>"."</table>";
				 echo $displaystring;
				?>
			</div><br><br>
			 <div class="mysp">Recent Matches</div>
			 <div >
			   <?php
				 while ($value = mysqli_fetch_object($clubs)){
						 //
						 $displaystring="<table class='recents' >"."<tr>"."<th>".$value->home_team."     vs     ".$value->away_team."</th>"."</tr>"."<tr>"."<td>".$value->match_date."</td>".
						 "</tr>"."<tr>"."<td>".$value->stadium."</td>"."</tr>"."<tr>"."<td>".$value->refree."</td>"."</tr>"."<tr>"."<td>".$value->match_time."</td>"."</tr>"."</table>";
						 echo $displaystring;
				 }
				?>
			</div>
			 <br><br>
			 <div class="mysp">Players</div>
			 <div>
			   <?php
				 $display_string = "<br><table  class='players'>";
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
			 </div>
		   </div>
	   </div>
  </div>


</div>
<div class="separator">
</div>
<?php
   include "footer.php";
 ?>

</body>

</html>
