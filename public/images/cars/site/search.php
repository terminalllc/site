<!DOCTYPE html>
<html lang="en">
    <head>
    <title>Search results</title>
    <meta charset="utf-8">
    <meta name = "format-detection" content = "telephone=no" />
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/superfish.css">
    <link href='//fonts.googleapis.com/css?family=Domine:400,700' rel='stylesheet' type='text/css'>
    <!-- font-awesome font -->
    <link rel="stylesheet" href="font/font-awesome.css" type="text/css" media="screen">
    <!--<![endif]-->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-migrate-1.1.1.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/script.js"></script>
    <script src="js/jquery.equalheights.js"></script>
    <script src="js/superfish.js"></script>
    <script src="js/jquery.mobilemenu.js"></script>
    <script src="js/jquery.ui.totop.js"></script>
    <script src="search/search.js"></script>
    
    <script>
        $(document).ready(function() {
            $().UItoTop({ easingType: 'easeOutQuart' });
        });
    </script>
  <!--[if lt IE 8]>
      <div style='text-align:center'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/upgrade.jpg"border="0"alt=""/></a></div>  
  <![endif]-->
  <!--[if lt IE 9]>
     
    <link rel="stylesheet" href="css/ie.css" >
    <script src="js/html5shiv.js"></script>
  <![endif]-->
</head>
<body>    

<!--==============================header=================================-->
<header>
    <div class="container_12">
        <div class="row">
            <div class="grid_12">
                <h1><a href="index.html">WeatherChannel</a></h1>
                <div class="fright">
                    <div class="clearfix">
                        <ul class="top_menu clearfix">
                            <li><a href="#">Sign In</a>|</li>
                            <li><a href="#">Join</a>|</li>
                            <li><a href="#">Settings</a></li>
                        </ul>
                        <div class="temp clearfix"><a href="#" class="cels">C&deg;</a><a href="#" class="far">F&deg;</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="grid_12">
                <nav class="full-width">
                    <ul class="sf-menu clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="index-1.html">Weather guides</a>
                            <ul>
                                <li><a href="#">Daily Briefing</a></li>
                                <li><a href="#">Marine</a>
                                <li><a href="#">Climate</a>
                                <li><a href="#">Space Weather</a>
                                <li><a href="#">Fire Weather</a>
                                <li><a href="#">Aviation</a>
                                <li><a href="#">Tsunami</a>
                                <li><a href="#">Forecast Models</a>
                                <li><a href="#">Water</a>
                                <li><a href="#">GIS</a>
                                <li><a href="#">Storm Spotters</a>
                                <li><a href="#">Facts and Figures</a>
                           </ul>
                        </li>
                        <li><a href="index-2.html">World weather news</a></li>
                        <li><a href="index-3.html">Weather charts</a></li>
                        <li><a href="index-4.html">Footage</a></li>
                        <li><a href="index-5.html">Contacts</a></li>
                    </ul>
                </nav>
                <div class="search-block">
                    <form id="search1" class="search" action="search.php" method="GET">
                        <label for="s">Enter Location</label>
                        <input id="s" type="text" name="s" value="" >
                        <a onClick="document.getElementById('search1').submit()" class="button1"></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
  <!--==============================content=================================-->
<div class="content">
    <div class="container_12">
        <div class="row">
            <div class="grid_12">
                <h2>Search result:</h2>
                <div id="search-results"></div>
            </div>
        </div>      
    </div>
</div> 
<!--==============================footer=================================-->

<footer>
    <div class="container_12 border-bot">
        <div class="row">
            <div class="grid_2 w1">
                <h6>Local Weather</h6>
                <ul class="list-2">
                    <li><a href="#">My Favorites</a></li>
                    <li><a href="#">History Data</a></li>
                    <li><a href="#">Weather Stations</a></li>
                </ul>
            </div>
            <div class="grid_2 w1">
                <h6>Maps &amp; Radar</h6>
                <ul class="list-2">
                    <li><a href="#">Radar</a></li>
                    <li><a href="#">Satellite</a></li>
                </ul>
            </div>
            <div class="grid_2 w1">
                <h6>Severe Weather</h6>
                <ul class="list-2">
                    <li><a href="#">Tropical &amp; Hurricane</a></li>
                    <li><a href="#">Storm Reports</a></li>
                    <li><a href="#">U.S. Severe Alerts</a></li>
                </ul>
            </div>
            <div class="grid_2 w1">
                <h6>Photos &amp; Videos</h6>
                <ul class="list-2">
                    <li><a href="#">Photo Galleries</a></li>
                    <li><a href="#">World View</a></li>
                    <li><a href="#">Webcams</a></li>
                </ul>
            </div>
            <div class="grid_2 w1">
                <h6>Blogs</h6>
                <ul class="list-2">
                    <li><a href="#">Meteorology Blogs</a></li>
                    <li><a href="#">Member Blogs</a></li>
                </ul>
            </div>
            <div class="grid_2 w1">
                <h6>Climate</h6>
                <ul class="list-2">
                    <li><a href="#">Climate Change</a></li>
                    <li><a href="#">Evidence</a></li>
                    <li><a href="#">Record Extremes</a></li>
                </ul>
            </div>
        </div>
        <div class="row f-last">
            <div class="fleft">
                WeatherChannel © 2013 &nbsp;|&nbsp;  <a class="h-underline" href="index-6.html">Privacy Policy</a> &nbsp;|&nbsp; All Rights Reseved
            </div>
            <div class="fright">
                <div class="list-services">
                    <a href="#" class="soc-1"><i class="icon-twitter-sign"></i>twitter</a>
                    <a href="#" class="soc-2"><i class="icon-facebook-sign"></i>facebook</a>
                    <a href="#" class="soc-3"><i class="icon-google-plus-sign"></i>Google+</a>
                </div>
            </div>
        </div>
    </div>
-</footer>
</body>
</html>