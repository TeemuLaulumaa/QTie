<?
    require_once "https.php";

    //if (session_status() == PHP_SESSION_NONE) {
    //    header("Location:  https://users.metropolia.fi/~teemulau/QTie/start.php"); }
?>

<!DOCTYPE html>
<html>
<title>QTie - LQTS Analysis Tool - Pies</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<!-- <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css"> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- AMCharts Pie Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<?php include "fetch_sessions.php" ?>
<!-- COMMENTING TO CHECK HOW MY COULD SYNCS -->

<body>

   <!-- Navbar -->
<nav>
  <div class="w3-top">
    <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
      <!-- burgeri pois <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a> -->
      <a href="pies.php" class="w3-bar-item w3-button w3-theme-l1">QTie - Frontpage</a>
      <a href="graph.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Graph</a>
      <a href="profile.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Profile</a>
      <a href="about.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">About</a>
        <a href="help.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Help</a>
        <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white" style="color: #FF3B38; float:right;">Log Out</a>
    </div>
  </div>

  <!-- Sidebar -->
  <nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
    <h4 class="w3-bar-item"><b>Recorded sessions</b></h4>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">11.04.2018 - 09:12</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">10.04.2018 - 22:37</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">10.04.2018 - 14:03</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">09.04.2018 - 22:43</a>
  </nav>

  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

  <!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
  <div class="w3-main" style="margin-left:250px">

    <!-- Chart 1 code. In "litres" there should be variables $length_medium, $length_high and $lenght_low. For now there is static shit.  -->
    <script>
      var chart = AmCharts.makeChart("chartdiv1", {
        "type": "pie",
        "theme": "light",
        "dataProvider": [{
          "qtc": "Medium Qtc",
          "litres":3
        },{
          "qtc": "High Qtc",
          "litres":1
        },{
          "qtc": "Low QTc",
          "litres":6
        },],
        "valueField": "litres",
        "titleField": "qtc",
        "balloon": {
            "fixedPosition": true
        },
        "export": {
          "enabled": true
        }
      });
    </script>

    <!-- Chart 2 code -->
    <script>
      var chart = AmCharts.makeChart("chartdiv2", {
        "type": "pie",
        "theme": "light",
        "dataProvider": [{
          "qtc": "Medium Qtc",
          "litres": 30
        },{
          "qtc": "High Qtc",
          "litres": 120
        },{
          "qtc": "Low QTc",
          "litres": 50
        },],
        "valueField": "litres",
        "titleField": "qtc",
        "balloon": {
            "fixedPosition": true
        },
        "export": {
          "enabled": true
        }
      });
    </script>

    <div id="chartdiv1"></div>
    <div id="chartdiv2"></div>

<?php include_once "db_connection.php" ?>
<div class="container">
    <form action="fetch_sessions.php" method="post">
    <label>Start date: </label>
    <input type="date" name="startdate">
    <label>End date: </label><input type="date" name="enddate">
    <label>Activity: </label><select name="activity">
        <option value="WORK">Work</option>
        <option value="EXERCISE">Exercise</option>
        <option value="REST">Rest</option> </select>
        <br><br>
      <input class="button_black button" type="submit" value="Search" style="width: auto">
        <br>
    </form>
    </div>

    <!-- PIIRAKOIDNE JÄLKEEN FLOAT LOPETETAAN TÄLLÄ https://www.w3schools.com/howto/howto_css_clearfix.asp -->

    <!-- END MAIN -->
  </div>

  <script>
    // Get the Sidebar
    var mySidebar = document.getElementById("mySidebar");

    // Get the DIV with overlay effect
    var overlayBg = document.getElementById("myOverlay");

    // Toggle between showing and hiding the sidebar, and add overlay effect
    function w3_open() {
      if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
      } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
      }
    }

    // Close the sidebar with the close button
    function w3_close() {
      mySidebar.style.display = "none";
      overlayBg.style.display = "none";
    }
  </script>

</body>

</html>
