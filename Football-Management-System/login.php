<?php
	session_start();
	$host = "localhost";
	$myUser = "root";
	$myPassword = "";
	$myDB = "football";
	
	$connection = mysqli_connect($host, $myUser, $myPassword, $myDB);
	$_SESSION['loggedIn'] = false;
	
	if (isset($_POST['login'])){
		if (empty($_POST['loginname']) || empty ($_POST['password'])){
			
		}
		else{
			$username = $_POST['loginname'];
			$password = $_POST['password'];
			
		
		
			$sql = "SELECT * FROM Admin WHERE username = '".$username."' AND password = '".$password."' LIMIT 1";
      $stmt = $connection->prepare($sql);
      $stmt->execute();
      $stmt->store_result();
      if (($stmt->num_rows) == 1){

        $query=mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
        
        $_SESSION['id'] = $row['coach_id'];
        $_SESSION['username'] = $username;
        $_SESSION['type'] = "admin";
        // $_SESSION['favTeamID'] = $row['club_id'];
        $_SESSION['loggedIn'] = true;
          $stmt->close();
        header("Location: zAdminHomePage.php");
      }
			$sql = "SELECT * FROM zCoach WHERE username = '".$username."' AND password = '".$password."' LIMIT 1";
			$stmt = $connection->prepare($sql);
      $stmt->execute();
      $stmt->store_result();
      if (($stmt->num_rows) == 1){

        $query=mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
        
        $_SESSION['id'] = $row['coach_id'];
        $_SESSION['username'] = $username;
        $_SESSION['type'] = "fan";
        $_SESSION['favTeamID'] = $row['club_id'];
        $_SESSION['loggedIn'] = true;
          $stmt->close();
				header("Location: zcoach.php");
			}

			
			$sql = "SELECT * FROM zfan WHERE username = '".$username."' AND  password = '".$password."' LIMIT 1";
			$stmt = $connection->prepare($sql);
			$stmt->execute();
			$stmt->store_result();
			if (($stmt->num_rows) == 1){

				$query=mysqli_query($connection, $sql);
				$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
				
				$_SESSION['id'] = $row['ID'];
				$_SESSION['username'] = $username;
				$_SESSION['type'] = "fan";
				$_SESSION['favTeamID'] = $row['favTeamID'];
				$_SESSION['loggedIn'] = true;
			    $stmt->close();
				header("Location: zFanHomePage.php");
			}
			
		
			$sql = "SELECT * FROM zclub WHERE admin_username = '".$username."' AND admin_password = '".$password."' LIMIT 1";
			$query = mysqli_query($connection, $sql);
			if (mysqli_num_rows($query) == 1){
				$value = mysqli_fetch_object($query);
				$_SESSION['id'] = $value->club_id;
				$_SESSION['username'] = $value->username;
				$_SESSION['type'] = "clubadmin";
				$_SESSION['loggedIn'] = true;
				header("Location: zClubAdminHomePage.php");
			}
			
			else{
                 
?><script type="text/javascript">
 	Swal.fire({
                'title':"error",
                 'text':"hello",
                 'type':"success"

   			});


</script>
			

			<?php

		// body...,,,,,,
	
			}
		}
	}
	else if (isset($_POST['signup'])){
		header("Location: zSignUp.php");
	}
        
    else if (isset($_POST['guest'])){
		header("Location: GuestPage.php");
        $_SESSION['loggedIn'] = true;
        $_SESSION['type'] = "guest";
	}
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Sign in Panel </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .panel-heading {
    padding: 5px 15px;
}/* header */ 
header{
     background: #35424a; 
    height: 125px;
    color: #ffffff;
    padding-top: 30px;
    min-height: 70px;
    /*border-bottom: #e8491d 3px solid;*/
}
header a{
    color:white;
    text-decoration: none;
    /* text-transform: uppercase; */
    font-size: 16px;

}header .icons{
	position: relative;
	left: 1100px;
}


header li{
    float: left;
    display: inline;
    padding: 0 5px 0 20px;
}header #branding{
    float: left;
    font-family:Georgia, Times, 'Times New Roman', serif;
}header#branding h1{
    margin: 0;
}header nav{
    float: right;
    margin-top: 17px;
}header .highlight, header .current a{
    color: #e8491d;
    /* font-weight: bold;  */
}header a:hover{
    color: #cccccc;
}header .container nav ul li .hover{
    display: inline-block;
    position: relative;
}header .container nav ul li .hover::before{
    content: " ";
    position: absolute;
    width: 100%;
    transform: scale(0);
    height: 3px;
    bottom: 0;
    left: 0;
    background-color: rgb(30, 255, 0);
    transform-origin: bottom right;
    transition: transform 0.5s ease-out;
}header .container nav ul li .hover:hover::before{
    transform: scale(1);
    transform-origin: bottom left;
}.main{
	width: 100%;
}

.panel-footer {
  padding: 1px 15px;
  color: #A0A0A0;

}.tt{
	float: right;
	margin-top: 10px;
	margin-left: 10px;
	/*background-color: #abd;*/
}.forAll{
	display: inline-block;
}.forImage{
float: left;
}.log{
	 text-align: center; 
	 font-size: 29px;
	 font-style: italic;
	 font-weight: bolder;
}.tit{
	margin-top:20px;
	font-weight: bold;
    color: blue;
	font-size: 20px;
}

.profile-img {
  width: 96px;
  height: 96px;
  margin: auto;
  display: block;
  -moz-border-radius: 50%;
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
</head>
<body>
        <header>
        <div class="icons">
            <li><a href="http://www.facebook.com" id="fb" class="fa fa-facebook"></a></li>
            <li><a href="http://www.twitter.com" id="twitter" class="fa fa-twitter"></a></li>
            <li><a href="http://www.telegram.com" id="psiphon" class="fa fa-telegram"></a></li>
            <li><a href="http://www.instagram.com" id="insta" class="fa fa-instagram"></a></li>
        </div>
        <div class="container">
            <div id="branding">
                <h1><span style="color: white;" class="highlight">FOOTBALL MANAGEMENT SYSTEM  </h1>
            </div>
        </div>
    </header>
    <div class="container" style="margin-top:40px">
       <div class="row">
       	<div class="forAll">
       		<div class="forImage">
       		<img src="images/vv-hd.jpg" width="768px" height="600px">
       	</div>
       	<h1 style="padding-left: 10px; position: relative; left: 30px;font-size: 20px ;color:white;" class="tit">FOOTBALL MANAGMENT SYSTEM</h1>
      <div class=" tt col-sm-6 col-md-4 col-md-offset-4">
      	  
       	  <div class=" panel panel-default">
          <div class="log panel-heading">
            <strong >Log in</strong>
          </div>
          <div class="panel-body">
            <form role="form" action="#" method="POST">
              <fieldset>
                <div class="row">
                  <div class="center-block">
                    <img class="profile-img"
                      src="images/login.jpg" alt="">
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-user"></i>
                        </span> 
                        <input class="form-control" placeholder="Username" name="loginname" type="text" autofocus>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-lock"></i>
                        </span>
                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="submit" id="first" class="   btn btn-lg btn-primary btn-block" value="Log In" name="login">
					  <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign Up" name="signup">
                    </div>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
         <form role="form" action="#" method="POST">
            <div class="form-group">     
                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Countinue As a guest" name="guest">
            </div>
         </form>
         </div>
       	</div>
       	
      </div>
    </div>
   <?php
   
   include("footer.php");

   ?>
   <script type="text/javascript">
   	
   	$(function(){
   		$('#first').click(function(){
   			Swal.fire({
                'title':"error",
                 'text':"hello",
                 'type':"success"
              

   			});
   		});
   	});
   </script>

</body>
</html>
