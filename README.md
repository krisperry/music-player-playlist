#Music Player with Equalizer
Music player with Equalizer in JavaScript: [Live Demo](http://lalwanivikas.github.io/music-player/)

The music-player folder has the following folder structure:

* index.php
* readme.md
* css (contains css files)
* js (contains js files)
* fusioncharts (contains FusionCharts library files)
* music (contains the audio files)


Widgets used from FusionCharts library for Equalizer(alias in bracket):

* [LED Gauge](http://www.fusioncharts.com/javascript-chart-fiddles/?gauges&gauge=LED--Gauge) (vled)
* [Bulb Gauge](http://www.fusioncharts.com/javascript-chart-fiddles/?gauges&gauge=Bulb--Gauge) (bulb)

##Explanation for JavaScript files:
###audioplayer.js
This file contains code related to audio player and its functionalities.

###dashboard.js
This is the controller file which reads data from from the object inside data.js and prepares the chart object. This file also listens to the events from audio player and acts accordingly.

###data.js
This file contains the input data object for all charts that are to be drawn. This data object is used by the dashboard.js for each chart while rendering it.

###fusioncharts.theme.music-player.js
This is the theme file which is used to define the cosmetic properties of chart such as chart-padding, chart-margin etc.
