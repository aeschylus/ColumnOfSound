
<!DOCTYPE html> 
 
<html lang="en"> 
	<head> 
		<title>Anatomy of a Mashup: Definitive Daft Punk visualised</title> 
 
		<link rel="stylesheet" href="fonts.css" /> 
		<link rel="stylesheet" href="main.css" /> 
		
		<!--[if IE]>
		<script>
			var IE = true;
		</script>
		<![endif]--> 
		<script src="http://code.jquery.com/jquery-1.4.4.min.js"></script> 
		<script src="js/data.js"></script> 
		<script src="js/main.js"></script> 
	</head> 
	<body> 
		<audio id="music" preload="auto" oncanplaythrough="canIndeedPlayThrough();"> 
			<source src="Cameron Adams - Definitive Daft Punk (128k).mp3" /> 
			<source src="Cameron Adams - Definitive Daft Punk.ogg" /> 
		</audio> 
		<nav> 
			<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8VZDPG8T9KVAY" target="_blank">Donate to my hosting costs</a> 
			<a id="learn" href="http://themaninblue.com/writing/perspective/2011/05/12/" target="_blank">Learn more about this mashup</a> 
		</nav> 
		<h1>Anatomy of a Mashup</h1> 
		<p id="loading">Loaded 0% of sound data</p> 
		<div id="buffering"></div> 
		<p id="part1">A mashup is a song created by blending two or more other songs. The more complex a mashup gets, the harder it is to distinguish the parts that are being used to create what you're hearing.</p> 
		<p id="part2">This visualisation of the song "Definitive Daft Punk" by Cameron Adams dissects a mashup in realtime to show you how each of the 23 parts contributes to the greater whole.</p> 
		<p id="bestViewed">Better performance in Chrome or Safari</p> 
		<a id="button" class="hidden" href="#"><span></span></a> 
		<div id="bass" class="eq"></div> 
		<div id="mid" class="eq"></div> 
		<div id="high" class="eq"></div> 
		<div id="timeline"> 
			<div id="playhead"></div> 
			<div id="timeMarker1" class="timeMarker"><span>1:00</span></div> 
			<div id="timeMarker2" class="timeMarker"><span>2:00</span></div> 
			<div id="timeMarker3" class="timeMarker"><span>3:00</span></div> 
			<div id="timeMarker4" class="timeMarker"><span>4:00</span></div> 
			<div id="timeMarker5" class="timeMarker"><span>5:00</span></div> 
			<div id="timeMarker6" class="timeMarker"><span>6:00</span></div> 
		</div> 
		<div id="time"></div> 
	</body> 
</html> 