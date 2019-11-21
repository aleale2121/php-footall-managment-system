
function getClubs(){
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var data=JSON.parse(this.responseText);
            var str="<table style='width=100%;'><tr><th>Name</th><th>Stadium</th><th>Establishment Date</th></tr>";
            for (var i = 0; i < data.length; i++) {


                str+="<tr><td>"+data[i].club_name+
                "</td><td>"+data[i].stadium+
                "</td>"+"<td>"+data[i].est_date+"</td></tr>";
            }

            str+="</table>";
            document.getElementById("card").innerHTML = str;
        }
      };
      xmlhttp.open("GET", "zfunctions.php?q=" + "clubs", true);
      xmlhttp.send();
  };
  function getPlayers(){
      $str="<table  class='players' ><tr><th>PLAYER CLUB NAME</th><th>FIRST NAME</th><th>LAST NAME </th><th>MALIA NUMBER </th><th>Birth Date </th></tr>";

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data=JSON.parse(this.responseText);
             var str="<table  class='players' ><tr><th>PLAYER CLUB NAME</th><th>FIRST NAME</th><th>LAST NAME </th><th>MALIA NUMBER </th><th>Birth Date </th></tr>";
             for (var i = 0; i < data.length; i++) {
                 str+="<tr><td>"+data[i].club_name+
                 "</td><td>"+data[i].fname+
                 "</td><td>"+data[i].lname+
                 "</td><td>"+data[i].tshirt_num+
                 "</td><td>"+data[i].Bdate+
                "</td></tr>";
             }

             str+="</table>";
             document.getElementById("card").innerHTML = str;
        }
      };
      xmlhttp.open("GET", "zfunctions.php?q=" + "players", true);
      xmlhttp.send();
  };
  function getMatches(){
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data=JSON.parse(this.responseText);
            var str="<table style='width:100%'><tr><th>HOME TEAM</th><th>AWAY TEAM </th><th>STADIUM </th><th>REFREE </th><th>MATCH DATE </th><th>MATCH TIME </th></tr>";
            for (var i = 0; i < data.length; i++) {
                str+="<tr><td>"+data[i].home_team+
                "</td><td>"+data[i].away_team+
                "</td><td>"+data[i].stadium+
                "</td><td>"+data[i].refree+
                "</td><td>"+data[i].match_date+
                "</td><td>"+data[i].match_time+
               "</td></tr>";
            }
            str+="</table>";
            document.getElementById("card").innerHTML = str;
        }
      };
      xmlhttp.open("GET", "zfunctions.php?q=" + "matches", true);
      xmlhttp.send();
  };
   function getResults(){
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("card").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "zfunctions.php?q=" + "results", true);
      xmlhttp.send();
  };
  function getLeagueTable(){
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                // var data=JSON.parse(this.responseText);

                document.getElementById("card").innerHTML = this.responseText;
      }};
      xmlhttp.open("GET", "zfunctions.php?q=" + "leaguetable", true);
      xmlhttp.send();

  };
