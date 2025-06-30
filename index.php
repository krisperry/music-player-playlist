<!DOCTYPE html>
<!--
    Music player is a concept dashboard. It is basically a HTML5 music player
    in which the visualization of sound is done using Fusion Charts's LED widget
    
    Widgets used 
        * LED Gauge
        * Bulb Gauge
    
    FusionCharts Version 3.7.1
    For further information about the folder structure of dashboard, please read the README.md file.
-->
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Music Player</title>
    <!-- Include CSS files -->
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <!-- Include layout file for dashboard -->
    <link rel="stylesheet" type="text/css" href="css/layout.css" />

    <!-- Include JS files-->
    <!--[if gt IE 9]><!-->
    <!-- Include FusionChart library file -->
    <script defer type="text/javascript" src="fusioncharts/fusioncharts.js"></script>
    <!-- Include Audio Player -->
    <script defer type="text/javascript" src="js/audioplayer.js"></script>
    <!-- Include theme file for charts -->
    <script defer type="text/javascript" src="js/fusioncharts.theme.music-player.js"></script>
    <!-- Include model file -->
    <script defer type="text/javascript" src="js/data.js"></script>
    <!-- Include controller file -->
    <script defer type="text/javascript" src="js/dashboard.js"></script>
    <!--<![endif]-->

    <!-- For IE9 and less, adding defer attribute in script tag makes the browser losing the order of JS file.-->
    <!--[if lte IE 9]>
    <script type="text/javascript" src="fusioncharts/fusioncharts.js"></script>
    <script type="text/javascript" src="js/audioplayer.js"></script>
    <script type="text/javascript" src="js/fusioncharts.theme.music-player.js"></script>
    <script type="text/javascript" src="js/data.js"></script>
    <script type="text/javascript" src="js/dashboard.js"></script>
    <![endif]-->
</head>

<body>
    <!-- The top level wrapper for markup begins -->
    <div id="wrapper">
        <!-- Container for the dashboard begins -->
        <div id="container">
            <div class="intro-text">
                <p class="dashboard-title">Music Player Equalizer</p>
            </div>
            <!--Player beings -->
            <div id="player">
                <div id="loading">
                    <div id="spinner">
                        <div id="spinner_1" class="spinner-unit">
                        </div>
                        <div id="spinner_2" class="spinner-unit">
                        </div>
                        <div id="spinner_3" class="spinner-unit">
                        </div>
                        <div id="spinner_4" class="spinner-unit">
                        </div>
                        <div id="spinner_5" class="spinner-unit">
                        </div>
                        <div id="spinner_6" class="spinner-unit">
                        </div>
                        <div id="spinner_7" class="spinner-unit">
                        </div>
                        <div id="spinner_8" class="spinner-unit">
                        </div>
                    </div>
                    <span>Loading</span>
                </div>
                <div id="player-content">
                <!-- Playlist begins-->
				<?php 
				/**
				* http://www.experts-exchange.com/questions/28699216/Populate-listbox-with-filenames-on-webserver-in-PhP-HTML.html
				* http://php.net/manual/en/class.recursivedirectoryiterator.php#85805
				* http://php.net/manual/en/class.splfileinfo.php
				*/
				error_reporting(E_ALL);


				/**
				* THE DESIRABLE FILE NAME IS IDENTIFIED HERE
				*/
				$signals = '.mp3';


				/**
				* THE SEARCHABLE DIRECTORY IS IDENTIFIED HERE
				*/
				$path = __DIR__.'/music/';


				// THE OPTION STATEMENTS ARE COLLECTED IN AN ARRAY
				$options = [];

				// COLLECT THE FILE OBJECTS
				$objs = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);

				// ITERATE OVER THE OBJECTS TO FIND THE DESIRABLE FILES
				$rgx = '#' . preg_quote($signals) . '#';
				foreach($objs as $path => $obj)
				{
					$name = $obj->getFileName();
					if (preg_match($rgx, $name))
					{
						$options[]
						= '<li><a href="javascript:void(0)" data-file="'
						. $name
						. '" title="'
						. $name
						. '" class="song-link">'
						. $name
						. '</a>
						</li>';
					}
				}

				// GENERATE THE OPTION STATEMENTS
				$opts = implode(PHP_EOL, $options);
				// CREATE THE HTML USING HEREDOC NOTATION
				$html = <<<EOD
				<div id="playlist">
					<div id="playlist-title">
					<h2>Playlist</h2>
				</div>
				<div id="song-list-container">
					<ul id="song-list">
					$opts
					</ul>
					</div>
				</div>

				EOD;

				// SHOW THE HTML
				echo $html;
				?>
					
					
			<!-- Playlist ends -->
                    
                    <!-- Equalizer begins-->
                    <div id="equalizer">
                        <div id="current-song-title"></div>
                        <div id="chart-holder">
                            <!-- FusionCharts LED gauges will load here -->
                            <div id="equalizer-container-0" class="pull-left"></div>
                            <div id="equalizer-container-1" class="pull-left"></div>
                            <div id="equalizer-container-2" class="pull-left"></div>
                            <div id="equalizer-container-3" class="pull-left"></div>

                            <div id="equalizer-container-4" class="pull-left"></div>
                            <div id="equalizer-container-5" class="pull-left"></div>
                            <div id="equalizer-container-6" class="pull-left"></div>
                            <div id="equalizer-container-7" class="pull-left"></div>
                        </div>
                    </div>
                    <!-- Equalizer ends -->
                    <!-- Controls for the player begins -->
                    <div id="player-controls" class="clearboth">
                        <div id="previous-button" class="pull-left">
                            <div id="prev-bar" class="prev-next-bar pull-left"></div>
                            <div id="previous-triangle"></div>
                        </div>
                        <div id="play-pause-button" class="pull-left">
                            <div id="play-triangle"></div>
                            <div id="pause-bar-container" class="pull-left">
                                <div class="pause-bar pull-left"></div>
                                <div class="pause-bar pull-left"></div>
                            </div>
                        </div>
                        <div id="next-button" class="pull-left">
                            <div id="next-triangle" class="pull-left"></div>
                            <div class="prev-next-bar" id="next-bar"></div>
                        </div>
                        <div id="audio-seeker" class="pull-left">
                            <div id="seeker-timer" class="pull-left"></div>
                            <div id="seeker-round" class="pull-left"></div>
                        </div>
                        <div id="volume-container" class="pull-left">
                            <div id="volume-control-holder" class="pull-left">
                                <input type="range" min="0" max="100" value="100" id="volume-control">
                            </div>
                        </div>
                        <div id="divider" class="pull-left">
                        </div>
                        <div id="shuffle-container" class="pull-left">
                            <span class="pull-left">Shuffle</span>
                            <div id="shuffle-on-container" class="pull-left">
                                <!-- FusionCharts Bulb Gauge will load here -->
                                <div id="shuffle-on" class="shuffle-bulb"></div>
                                <span class="pull-left" id="on-text">ON</span>
                            </div>
                            <!-- FusionCharts Bulb Gauge will load here -->
                            <div id="shuffle-off-container" class="pull-left">
                                <div id="shuffle-off" class="shuffle-bulb"></div>
                                <span class="pull-left" id="off-text">OFF</span>
                            </div>
                        </div>
                    </div>
                    <!-- Controls for the player ends -->
                </div>
            </div>
            <!--Player ends -->
            <div id="no-support-dashboard-detail">
                <p>Since, older browsers do not support HTML5 Audio API, the LED Gauges here are functioning as below:</p>
                <p>Each of the Vertical LED gauges is fed a random number every 250 milliseconds. Both the Bulb gauges are set to static values.The setInterval JavaScript timer function is called every 250 milliseconds, which in turn calls the feedData API call and feeds a random value to the gauge.</p>
                <p>Please update your browser to properly view this dashboard or download this dashboard to learn more.</p>
            </div>
            <div class="footer"><p>This application uses <a href="http://www.fusioncharts.com/download">FusionCharts</a></p></div>
        </div>
        <!-- Container for the dashboard ends -->
    </div>
    <!-- The top level wrapper for markup ends -->

</body>

</html>
