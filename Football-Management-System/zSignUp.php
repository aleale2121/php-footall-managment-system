<?php
	session_start();
	$host = "localhost";
  $myUser = "root";
  $myPassword = "";
  $myDB = "football";

	$connection = mysqli_connect($host, $myUser, $myPassword, $myDB);

	$fanID = $_SESSION['id'];
	$sql2 = "SELECT club_name FROM zclub";
    $result = mysqli_query($connection,$sql2);
	if (isset($_POST['cancel'])){
		header("Location: login.php");
	}

	if (isset($_POST['signup'])){
		if (empty($_POST['name']) || empty ($_POST['surname']) || empty ($_POST['username']) || empty ($_POST['password']) || empty ($_POST['favoriteteam'])){
			?>
			<script>alert("Please fill out all the fields");</script>
			<?php
		}
		else{
			$name = $_POST['name'];
			$surname = $_POST['surname'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$favoriteteam = $_POST['favoriteteam'];

			$usernameValidQuery = "SELECT username FROM zfan WHERE username = '".$username."'";
			$usernameValid = mysqli_query($connection, $usernameValidQuery);

			$favTeamQuery = "SELECT club_id FROM zclub WHERE club_name = '".$favoriteteam."'";
			$favTeamID = mysqli_query($connection, $favTeamQuery);
			if (mysqli_num_rows($favTeamID) < 0){
				?>
				<script>alert("Please choose a valid club");</script>
				<?php
			}
			else if (mysqli_num_rows($usernameValid) > 0){
				?>
				<script>alert("The username is taken");</script>
				<?php
			}
			else{

				$favTeamIDD = $favTeamID->fetch_object();

				$sql = "INSERT INTO zfan (name,surname,username,password,favTeamID) VALUES (?,?,?,?,?)";
        $stmt=$connection->prepare($sql);
        $stmt->bind_param("ssssi",$name,$surname,$username,$password,$favTeamIDD->club_id);
        $stmt->execute();
        $stmt->close();
				?>
				<script>alert("Sign UP Successful");</script>
				<?php
				header("Location: login.php");
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Football  Managment Software">
	<meta name="keywords" content="HTML,CSS,XML,JavaScript">
	<meta name="author" content="John Doe">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in Panel - Bootsnipp.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .panel-heading {
    padding: 5px 15px;
}

.panel-footer {
  padding: 1px 15px;
  color: #A0A0A0;
}

.profile-img {
  width: 96px;
  height: 96px;
  margin: 0 auto 10px;
  display: block;
  -moz-border-radius: 50%;
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container" style="margin-top:40px">
       <font size="6">Football Manager System <br></font>
    <div class="row">
      <div class="col-sm-6 col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>  Sign up as Fan</strong>
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
                        <input class="form-control" placeholder="Name" name="name" type="text" autofocus>

                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-user"></i>
                        </span>
                        <input class="form-control" placeholder="Surname" name="surname" type="text" autofocus>
                    </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-user"></i>
                        </span>
                        <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
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
                      <div class="input-group">
                        <select class="form-control"  name= "favoriteteam">

                        <?php

                                 while( $row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                 {
                                   echo "<option value='".htmlspecialchars($row['club_name'])."''>".$row['club_name']."</option>";
                                 }

                        ?>

                    </select>
                    </div>
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign Up" name="signup" >
					  <input type="submit" class="btn btn-lg btn-primary btn-block" value="Cancel" name = "cancel">
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
<script type="text/javascript">

</script>
</body>
</html>
