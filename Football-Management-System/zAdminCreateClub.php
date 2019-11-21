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

 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
     $name = mysqli_real_escape_string($conn,$_POST['name']);
     $stadium = mysqli_real_escape_string($conn,$_POST['stadium']);
     $date = mysqli_real_escape_string($conn,$_POST['date']);
     $username = mysqli_real_escape_string($conn,$_POST['username']);
     $password = mysqli_real_escape_string($conn,$_POST['password']);


    $stmt = $conn->prepare("SELECT club_name FROM zclub WHERE club_name=? LIMIT 1");
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->store_result();

       if( !empty($name) && !empty($stadium)
           && !empty($date) && !empty($username) && !empty($password) )
       {

          if($stmt->num_rows == 1){ //To check if the row exists

           $stmt->close();

            ?>

              <script> alert("Please choose unique club name") </script>

             <?php

          }
          else
          {
              // insert specified club into club table
              $sql = "INSERT INTO zclub(club_name,stadium,est_date,admin_username,admin_password)
                      VALUES( ?,?,?,?,?)";

              $stmt=$conn->prepare($sql);;
              $hashed=md5($password);
              $stmt->bind_param("sssss",$name,$stadium,$date,$username,$password);
              $stmt->execute();
              $stmt->close();
          }
       }
       else
       {
          ?>

          <script> alert("Please fill out blank places") </script>

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
    <title>Admin Page</title>

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
                  <button  class ="button1">Add Club</button>
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

        </div>

            <div class="panel-body">
              <form role="form" action="#" method="POST">
                <fieldset>
                  <div class="row">
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="glyphicon glyphicon-user"></i>
                          </span>
                           <strong>Club  Name:     </strong>
                          <input class="form-control" placeholder="Name" name="name" type="text" autofocus>

                        </div>
                      </div>
                      <br><br>
                      <endtime class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="glyphicon glyphicon-lock"></i>
                          </span>
                          <strong>  Stadium:     </strong>
                          <input class="form-control" placeholder="Stadium" name="stadium" type="text" value="">
                        </div>
                      </div>
                      <br><br>
                      <div class="form-group">
                        <div class="input-group">
                          <strong> Establishment Date:     </strong>
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
                          <strong>  admin username:     </strong>
                          <input class="form-control" placeholder="City" name="username" type="text" autofocus>
                      </div>
                      </div>
                      <br><br>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="glyphicon glyphicon-user"></i>
                          </span>
                          <strong>  admin password:     </strong>
                          <input class="form-control" placeholder="City" name="password" type="text" autofocus>
                      </div>
                      </div><br><br>
                      <div class="form-group">
                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Done">
                      </div>
                    </div>
                  </div>
                </fieldset>
              </form>
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
