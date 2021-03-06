<?
    require_once "https.php";
    //if (!empty($_SESSION['profile_id'])) {
    //header("Location:  https://users.metropolia.fi/~teemulau/QTie/start.php"); }

?>


<!DOCTYPE html>
<html>
<title>QTie - LQTS Analysis Tool - Graph</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<!-- <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css"> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- AM Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

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
        <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white" style="margin-right: 3%; color: #FF3B38; float: right;">Log Out</a>
    </div>
  </div>

    
<!--burger menu-->
<nav role="navigation">
    <div id="menuToggle">
    <input type="checkbox" />

    <span></span>
    <span></span>
    <span></span>

    <ul id="menu">
        <a href="pies.php"><li>Home</li></a>
        <a href="graph.php"><li>Graph</li></a>
        <a href="profile.php"><li>Profile</li></a>
        <a href="about.php"><li>About</li></a>
        <a href="help.php"><li>Help</li></a>
        <a href="logout.php"><li>Log out</li></a>
    </ul>
  </div>
</nav>
    
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

    <!-- Chart code -->
    <!-- Chart code -->
    <script>
    var chartData = generateChartData();
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "light",
        "marginRight": 80,
        "autoMarginOffset": 20,
        "marginTop": 7,
        "dataProvider": chartData,
        "valueAxes": [{
            "axisAlpha": 0.2,
            "dashLength": 1,
            "position": "left"
        }],
        "mouseWheelZoomEnabled": true,
        "graphs": [{
            "id": "g1",
            "balloonText": "[[value]]",
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "hideBulletsCount": 50,
            "title": "red line",
            "valueField": "visits",
            "useLineColorForBulletBorder": true,
            "balloon":{
                "drop":true
            }
        }],
        "chartScrollbar": {
            "autoGridCount": true,
            "graph": "g1",
            "scrollbarHeight": 40
        },
        "chartCursor": {
           "limitToGraph":"g1"
        },
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true,
            "axisColor": "#DADADA",
            "dashLength": 1,
            "minorGridEnabled": true
        },
        "export": {
            "enabled": true
        }
    });

    chart.addListener("rendered", zoomChart);
    zoomChart();

    // this method is called when chart is first inited as we listen for "rendered" event
    function zoomChart() {
        // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
        chart.zoomToIndexes(chartData.length - 40, chartData.length - 1);
    }


    // generate some random data, quite different range

    // generate some random data, quite different range
    function generateChartData() {
        var chartData = [];
        var firstDate = new Date();
        firstDate.setDate(firstDate.getDate() - 5);
        var visits = 1200;
        for (var i = 0; i < 1000; i++) {
            // we create date objects here. In your data, you can have date strings
            // and then set format of your dates using chart.dataDateFormat property,
            // however when possible, use date objects, as this will speed up chart rendering.
            var newDate = new Date(firstDate);
            newDate.setDate(newDate.getDate() + i);

            visits += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);

            chartData.push({
                date: newDate,
                visits: visits
            });
        }
        return chartData;
    }
    </script>

    <!-- HTML -->
    <div id="chartdiv"></div>

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
<br>
    <p> tää ei toimi </p>

</body>

</html>
