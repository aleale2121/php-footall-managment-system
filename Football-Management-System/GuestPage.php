<?
session_start();
$_SESSION['type'] == 'guest';

?>

<html>
<head>

<meta charset="UTF-8">
<meta name="description" content="Football  Managment Software">
<meta name="keywords" content="HTML,CSS,XML,JavaScript">
<meta name="author" content="John Doe">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Guest Page</title>
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
        <div class="headings"> <img src="images/cr7.jpg"  style="width:150px;height:150px"></div>
        <div  class="headings txt"><p>FOOTBALL MANAGMENT SYSTEM </p></div>
    </div>

<div class="topnav">
  <a href="#">Home </a>
  <a href="zSignUp.php" style="float:middle">Sign up</a>

  <a href="#" style="float:right">Search</a>

  <input type ="text" placeholder="Search..." style ="float:right">

</div>

<div class="row" >
  <div class ="rightcolumn">
  <h2>Funny Football</h2>
     <div id="card">
         <div class="panel panel-default">
        </div>
    </div>
    <br><br>
    <?php
   include("animatedImage.php");

    ?>
</div>
</div>

<div >
    <script type="text/javascript"> getClubs()</script>;
</div>

  <div class="leftcolumn">
       <ul id="sideBarStyle">
           <li><a id="clubbtn" onclick="getClubs()">Clubs</a></li>
          <li><a  id="transferbtn" onclick="getResults()">Match Results</a></li>
          <li><a  id="matchbtn" onclick="getMatches()">Matches</a></li>
         <li><a  id="playerbtn" onclick="getPlayers()">Players</a></li>
       </ul>


  </div>
  <div class="separator">
  </div>
  <?php
     include "footer.php";
   ?>


</body>
</html>
