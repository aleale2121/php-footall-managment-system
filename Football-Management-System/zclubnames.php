<?php
	$host = "localhost";
  	$myUser = "root";
  	$myPassword = "";
  	$myDB = "football";
	$connection = mysqli_connect($host, $myUser, $myPassword, $myDB);
	$countriesQuery = "SELECT DISTINCT club_name FROM zclub";
	$countries = mysqli_query($connection, $countriesQuery);

	$display_string = "";
	// Insert a new row in the table for each person returned
	while($row = mysqli_fetch_assoc($countries)){
		$display_string .= "<input type=checkbox name=check_list[] value=".$row['club_name'].">".$row['club_name']."<br>";
	
	
	}
	echo $display_string ;
?>