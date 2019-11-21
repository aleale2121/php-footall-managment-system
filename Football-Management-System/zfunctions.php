<?php
		session_start();
		$host = "localhost";
  	    $myUser = "root";
  	    $myPassword = "";
  	    $myDB = "football";
		$conn = mysqli_connect($host, $myUser, $myPassword, $myDB);
		$json=array();
		$method = $_REQUEST["q"];
       $val=explode("-",$method );
		if(sizeof($val)>1){
			switch ($val[0]) {
				case 'clubplayers':
					$sql="SELECT * FROM zplayer WHERE club_id='".$val[1]."'";
					$stmt=$conn->prepare($sql);
					$stmt->execute();
					$result=$stmt->get_result();
					$str="<table  class='players'><tr><th>FIRST NAME</th><th>LAST NAME </th><th>MALIA NUMBER </th><th>Birth Date </th></tr>";
					while($row=$result->fetch_assoc()){
							$sql1="SELECT * FROM zclub WHERE club_id='".$row['club_id']."'";
								$stmt1=$conn->prepare($sql1);
							$stmt1->execute();
							$result1=$stmt1->get_result();
							$row2=$result1->fetch_assoc();
							$str.="<tr><td>".$row['fname']."</td>"."<td>".$row['lname']."</td>"."<td>".$row['tshirt_num']."</td>"."<td>".$row['Bdate']."</td>"."</tr>";
					}
					$str.="</table>";
					echo $str;
					break;
				case 'clubmatches':
					$sql="SELECT * FROM zclub WHERE club_id='".$val[1]."'";
					$stmt=$conn->prepare($sql);
					$stmt->execute();
					$result=$stmt->get_result();
					 $currentDateTime = date('Y-m-d');
					 $row=$result->fetch_assoc();
					 $clubname=$row['club_name'];
			         $sql = "SELECT home_team,away_team,stadium,refree,match_date,match_time  FROM zschedule
						   WHERE  match_date > '".$currentDateTime."' AND (home_team='".$clubname."' OR away_team='".$clubname."') ORDER BY match_date DESC";
					$stmt=$conn->prepare($sql);
					$stmt->execute();
					$result=$stmt->get_result();
					$str="<table style='float:left; margin:2px;'><tr><th>HOME TEAM</th><th>AWAY TEAM </th><th>STADIUM </th><th>REFREE </th><th>MATCH DATE </th><th>MATCH TIME </th></tr>";
					while($row=$result->fetch_assoc()){
						$str.="<tr><td>". $row['home_team']."</td>"."<td>".$row['away_team']."</td>"."<td>".$row['stadium']."</td>"."<td>".$row['refree']."</td>"."<td>".$row['match_date']."</td>"."<td>".$row['match_time']."</td>"."</tr>";
					}
					$str.="</table>";
					echo $str;
					break;
				case 'clubresults':
					// echo $val[1];
				    $str="";
					$sql="SELECT * FROM zclub WHERE club_id='".$val[1]."'";
					$stmt=$conn->prepare($sql);
					$stmt->execute();
					$result=$stmt->get_result();
					$currentDateTime = date('Y-m-d');
					 $row=$result->fetch_assoc();
					 $clubname=$row['club_name'];
					 // echo $clubname;
			         $sql = "SELECT *  FROM zschedule
						   WHERE  match_date < '".$currentDateTime."' AND (home_team='".$clubname."' OR away_team='".$clubname."') ORDER BY match_date DESC LIMIT 12";
					$stmt=$conn->prepare($sql);
					$stmt->execute();
					$result=$stmt->get_result();

					// $str="<table class='.tablesc'><tr><th>HOME TEAM</th><th>AWAY TEAM </th><th>STADIUM </th><th>REFREE </th><th>MATCH DATE </th><th>MATCH TIME </th></tr>";
					while($row=$result->fetch_assoc()){


						$sql="SELECT * FROM zmatch_detail WHERE match_id='". $row['schedule_id']."'";
						$stmt=$conn->prepare($sql);
						$stmt->execute();
						$result=$stmt->get_result();


						while($row=$result->fetch_assoc()){
							// array_push($json, $row);
							$str="";
							$sql1="SELECT * FROM zschedule WHERE schedule_id='".$row['match_id']."'";
						    $stmt1=$conn->prepare($sql1);
							$stmt1->execute();
							$result1=$stmt1->get_result();
							$row2=$result1->fetch_assoc();
							$clb1=$row2['home_team'];
							$clb2=$row2['away_team'];
							$str.="<table class='recents'><tr><th colspan=4>".$clb1."          VS      ".$clb2." </td></tr>";

							$str.="<tr>"."<td>SCORE</td>"."<td>".$row['home_score']."</td>"."<td>".$row['away_score']."</td>"."</tr>";
							$str.="<tr>"."<td>POSSETION</td>"."<td>".$row['home_pos']."</td>"."<td>".$row['away_pos']."</td>"."</tr>";
							$str.="<tr>"."<td>ATTEMPT</td>"."<td>".$row['home_attempt']."</td>"."<td>".$row['away_attempt']."</td>"."</tr>";
							$str.="<tr>"."<td>ON TARGET</td>"."<td>".$row['home_target']."</td>"."<td>".$row['away_target']."</td>"."</tr>";
							$str.="</table><br>";
 							echo ($str);
						}

					}
					// $str.="</table>";
					// echo $str;
					break;
				default:
					break;
			}





		}else {
			switch ($method) {
		    	case 'clubs':
			    		$sql="SELECT * FROM zclub";
							$stmt=$conn->prepare($sql);
							$stmt->execute();
							$result=$stmt->get_result();
							$str="<table  style='width:100%;'><tr><th>Name</th><th>Stadium</th><th>Establishment Date</th></tr>";
							$json=array();
							while($row=$result->fetch_assoc()){
								// $str.="<tr><td>". $row['club_name']."</td>"."<td>".$row['stadium']."</td>"."<td>".$row['est_date']."</td></tr>";
								array_push($json,$row);
							}
							// $str.="</table>";
							echo json_encode($json);
				    	break;

		    	case 'players':
		    	        	$sql="SELECT * FROM zplayer INNER JOIN zclub ON zplayer.club_id=zclub.club_id";
							$stmt=$conn->prepare($sql);
							$stmt->execute();
							$result=$stmt->get_result();

							$json=array();
							while($row=$result->fetch_assoc()){

								array_push($json,$row);
							}

							echo json_encode($json);

		    		  break;
		    	case 'matches':
		    		    $currentDateTime = date('Y-m-d');
			            $sql = "SELECT home_team,away_team,stadium,refree,match_date,match_time  FROM zschedule
						WHERE  match_date > '".$currentDateTime."' ORDER BY match_date DESC";
						$stmt=$conn->prepare($sql);
						$stmt->execute();
						$result=$stmt->get_result();
						$json=array();
						while($row=$result->fetch_assoc()){

							array_push($json,$row);
						}

						echo json_encode($json);

		    		 break;
		    	case 'results':
		    		   $sql="SELECT * FROM zmatch_detail LIMIT 12";
						$stmt=$conn->prepare($sql);
						$stmt->execute();
						$result=$stmt->get_result();

						$str="";
						while($row=$result->fetch_assoc()){
							// array_push($json, $row);
							$sql1="SELECT * FROM zschedule WHERE schedule_id='".$row['match_id']."'";
						    $stmt1=$conn->prepare($sql1);
							$stmt1->execute();
							$result1=$stmt1->get_result();
							$row2=$result1->fetch_assoc();
							$clb1=$row2['home_team'];
							$clb2=$row2['away_team'];
							$str.="<table style='float:left; margin:10px;width:30%;'><tr><th colspan=4>".$clb1."          VS      ".$clb2." </td></tr>";

							$str.="<tr>"."<td>".$row['home_score']."</td>"."<td>SCORE</td>"."<td>".$row['away_score']."</td>"."</tr>";
							$str.="<tr>"."<td>".$row['home_pos']."</td>"."<td>POSSETION</td>"."<td>".$row['away_pos']."</td>"."</tr>";
							$str.="<tr>"."<td>".$row['home_attempt']."</td>"."<td>ATTEMPT</td>"."<td>".$row['away_attempt']."</td>"."</tr>";
							$str.="<tr>"."<td>".$row['home_target']."</td>"."<td>ON TARGET</td>"."<td>".$row['away_target']."</td>"."</tr>";
							$str.="</table>";

						}
						echo ($str);
			    		break;
                case 'leaguetable':


					  $sql="SELECT MAX(season_id) as maxi FROM zclub_info";
					  $stmt=$conn->prepare($sql);
					  $stmt->execute();
					  $result1=$stmt->get_result();
					  $row=$result1->fetch_assoc();
					  $id=$row['maxi'];
				       $sql = "SELECT *  FROM  zclub_info WHERE season_id='".$id."' ORDER BY club_point DESC ,goaldifference DESC";
					   $stmt=$conn->prepare($sql);
					   $stmt->execute();
					   $result=$stmt->get_result();
					    $str2="<table style='width:100%;' ><tr><th>CLUB NAME </th><th>PLAYED </th><th>WIN</th><th>LOSE </th><th>DRAW </th><th>GS </th><th>GM </th><th>GD </th><th>POINT </th></tr>";


					   while ($row=$result->fetch_assoc()) {
						   $str2.="<tr><td>".$row['club_name'].
						  "</td><td>".$row['played'].
						  "</td><td>".$row['win'].
						  "</td><td>".$row['lose'].
						  "</td><td>".$row['draw'].
						  "</td><td>".$row['goalscore'].
						  "</td><td>".$row['goalon'].
						  "</td><td>".$row['goaldifference'].
						  "</td><td>".$row['club_point'].
						  "</td></tr>";
					   }
					   $str2.="</table><br>";
                       echo $str2;;
				    break;
		    	default:
		    		break;
	    }

		}



?>
