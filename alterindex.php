<!DOCTYPE html> 
 
<html lang="en"> 
	<head> 
		<title>Your music: NOW IN STUNNING 3D!</title> 
 
		<link rel="stylesheet" href="fonts.css" /> 
		<link rel="stylesheet" href="altermain.css" />
		
		<!--[if IE]>
		<script>
			var IE = true;
		</script>
		<![endif]--> 
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script> 
		<script src="js/data.js"></script>
		<script type="text/javascript">

$(function() {
		//Slow incorporation of animation script
var WIDTH = 0;
var HEIGHT = 0;
var FPS = 40;
var BG_COLOR = '#000000';
var COLORS = ['#0099ff', '#00ccff', '#00ffcc', '#00ff66', '#19aa19', '#7fe533', '#b9f724', '#ffff00', '#ffcc00', '#ff6600', '#ff0000', '#e5337f', '#ff00cc', '#e500ff', '#9900ff', '#6633cc', '#1d45b6'];
var c = null;
var drawQueue = [];
var drawTimeout = null;
var FF3 = false;
var canPlayThrough = false;
var slices = [];
var sclicesArray = [];
var image = null;	


$(init);

function init() {
	
	$('#loading').text('Yes, things are initing.');
	
	if (window.navigator.userAgent.match(/Firefox\/./)) {
		var version = parseInt(window.navigator.userAgent.match(/Firefox\/(.)/)[1]);
		
		if (version < 4) {
			FF3 = true;
			alert('If you are going to view this site in Firefox, it is recommended that you use the latest version (Firefox 4). You can still try it out with your current version, though it might be a little sluggish and out of sync...')
		}
	}
	
	var canvasCheck = document.createElement('canvas');
	
	if (typeof canvasCheck.getContext == 'undefined') {
		$('#loading').remove();
		$('<p id="noCanvas"><strong>!</strong>We\'re sorry to say that this site requires a browser with the latest HTML5 technology (Chrome 11, Safari 5, Firefox 4, or Internet Explorer 9). If you\'d really like to see it (and you really should) you should download one of those and try again.</p>').appendTo('body');
	}
	else {
		loadSoundData();
	}

}

function loadSoundData() {
	$.getScript('js/data_da_funk.js', loadSoundDataCallback);
	$.getScript('js/data_aerodynamic.js', loadSoundDataCallback);
	$.getScript('js/data_too_long.js', loadSoundDataCallback);
	$.getScript('js/data_oh_yeah.js', loadSoundDataCallback);
	$.getScript('js/data_steam_machine.js', loadSoundDataCallback);
	$.getScript('js/data_television_rules_the_nation.js', loadSoundDataCallback);
	$.getScript('js/data_tron_legacy.js', loadSoundDataCallback);
	$.getScript('js/data_alive.js', loadSoundDataCallback);
	$.getScript('js/data_burnin.js', loadSoundDataCallback);
	$.getScript('js/data_around_the_world.js', loadSoundDataCallback);
	$.getScript('js/data_voyager.js', loadSoundDataCallback);
	$.getScript('js/data_crescendolls.js', loadSoundDataCallback);
	$.getScript('js/data_mothership_reconnection.js', loadSoundDataCallback);
	$.getScript('js/data_digital_love.js', loadSoundDataCallback);
	$.getScript('js/data_harder_better_faster.js', loadSoundDataCallback);
	$.getScript('js/data_human_after_all.js', loadSoundDataCallback);
	$.getScript('js/data_face_to_face.js', loadSoundDataCallback);
	$.getScript('js/data_short_circuit.js', loadSoundDataCallback);
	$.getScript('js/data_daftendirekt.js', loadSoundDataCallback);
	$.getScript('js/data_da_funk2.js', loadSoundDataCallback);
	$.getScript('js/data_revolution_909.js', loadSoundDataCallback);
	$.getScript('js/data_technologic.js', loadSoundDataCallback);
	$.getScript('js/data_chord_memory.js', loadSoundDataCallback);
	$.getScript('js/data_one_more_time.js', loadSoundDataCallback);
	$.getScript('js/data_aerodynamic2.js', loadSoundDataCallback);
}

function loadSoundDataCallback() {
	var defined = 0;
	for (var i = 0; i < data.length; i++) {
		if (typeof data[i] != 'undefined') {
			defined++;
		}
	}
	
	if (defined == 25) {
		$('#loading').text('Loaded 100% of sound data');
		
		soundDataLoaded();
	}
	else {
		$('#loading').text('Loaded ' + Math.round(defined / 25 * 100) + '% of sound data');
	}
}

function soundDataLoaded() {
	
	$('#timeline')
		.click(function(event) {
			initCanvas((event.clientX - 30) / $('#timeline').width() * 410);
			
			return false;
		});

	checkSoundFileLoaded();
	
	$('#loading').animate({marginTop: 70, opacity: 0}, 600, function() {
		$(this).remove();
	});
	
	//stop propagation?
}

function checkSoundFileLoaded() {
	var music = document.getElementById('music');

	// Needed to kick IE 9 into realising that the audio has been downloaded, in conjunction with the oncanplaythrough handler in the HTML #mysteriousmysteriesoftheinternet
	try {
		music.buffered.end(0);
	}
	catch (error) {
	}

	if (canPlayThrough || music.readyState >= 4 || (FF3 && music.readyState >= 3)) {
		if ($('#button').hasClass('hidden')) {
			soundFileLoaded();
		}
	}
	
	else {
		setTimeout(checkSoundFileLoaded, 1000);
	}
}

function canIndeedPlayThrough() {
	canPlayThrough = true;
}

function soundFileLoaded() {
		
	$('#button').click(function() {
		var music = document.getElementById('music');
		
		//$('h1, #part1, #part2, #bestViewed, #buffering').animate({opacity: 0}, 700, function(){$(this).remove();});
		
		if (music.paused) {
			playMusic();
		}
		
		else {
			pauseMusic();
		}
	}).removeClass('hidden');
	
	$(window).resize(function() {
		if ($('canvas').length > 0) {
			var music = document.getElementById('music');
			
			$('canvas').remove();
			
			initCanvas(music.currentTime);
		}
	});
	
}

function playMusic() {
	
	if ($('canvas').length == 0) {
		initCanvas();
	}

	var music = document.getElementById('music');
	
	if (music.currentTime == 0 && $('#bass').length > 0) {
		$('#bass')
			.css('display', 'block')
			.animate({opacity: 1}, 500)
		
		setTimeout(function() {
			$('#mid')
				.css('display', 'block')
				.animate({opacity: 1}, 500)
		}, 1000);
		
		setTimeout(function() {
			$('#high')
				.css('display', 'block')
				.animate({opacity: 1}, 500, function() {
					setTimeout(function() {
						$('.eq').animate({opacity: 0}, 2000, function() {
							$(this).remove();
						});
					}, 1500);
				})
		}, 2000);
		
		setTimeout(function() {
			music.play();
		}, 2000);
	}
	
	//previously in else block
	else {
		music.play();
	}

	$('#button').addClass('playing');

}

function pauseMusic() {
	var music = document.getElementById('music');
	
	music.pause();

	$('#button').removeClass('playing');
}

function initSlices() {

	//copy of "initCanvas()"

	startTime = 0;
	
	$('canvas').remove();
	slices = [];
	slicesArray = [];
	
	HEIGHT = 300;
	WIDTH = HEIGHT;

	var canvas = document.createElement('canvas');
	canvas.width = WIDTH;
	canvas.height = HEIGHT;
	c = canvas.getContext('2d');

	for (var i = 0; i < data.length; i++) {
		
		slices.push(new Ring(data[i].timecode.slice(0), i));
	}
	
	var music = document.getElementById('music');
	music.currentTime = startTime;
	
	//copy of "draw()"
	//for (var i = 0; i < data.length; i++) {
		
		var image = c.toDataUrl();
		slicesArray.push(image);
		
		c.clearRect(0, 0, WIDTH, HEIGHT);
	
		for (var i = slices.length - 1; i >= 0; i--) {
		
			slices[i].draw();
		}
	
	//}
	
}

function initCanvas(startTime) {
	if (startTime == null) {
		startTime = 0;
	}
	
	$('canvas').remove();
	drawQueue = [];
	
	if (drawTimeout != null) {
		clearTimeout(drawTimeout);
	}
	
	HEIGHT = 300;
	WIDTH = HEIGHT;

	var canvas = $('<canvas id="mainCan"></canvas>');
	canvas.get(0).width = WIDTH;
	canvas.get(0).height = HEIGHT;
	canvas.appendTo('#leftPanel');
	c = canvas.get(0).getContext('2d');
	
	for (var i = 0; i < data.length; i++) {
		
		drawQueue.push(new Ring(data[i].timecode.slice(0), i));
	}
	
	var music = document.getElementById('music');
	music.currentTime = startTime;
	draw();
}

function draw() {
	var image = c.canvas.toDataURL();
	var image = $('<img src="'+image+'" width="50" height="50" class="sliceImg"/>');
	image.appendTo('#slicesPane');
	
	c.clearRect(0, 0, WIDTH, HEIGHT);
	
	for (var i = drawQueue.length - 1; i >= 0; i--) {
		
		drawQueue[i].draw();
	}
	
	var music = document.getElementById('music');
	var time = $('#time');
	var minutes = Math.floor(music.currentTime / 60);
	var seconds = Math.floor(music.currentTime % 60);
	
	if (seconds < 10) {
		seconds = '0' + seconds;
	}

	if (music.currentTime > 410) {
		pauseMusic();
		
		$('canvas').remove();
		
		music.currentTime = 0;
	}
	
	time.html(minutes + ':' + seconds);
	
	$('#playShadow').css('width', music.currentTime / 410 * 100 + '%');

	drawTimeout = setTimeout(draw, 1000 / FPS);
}

function Ring(data, order) {

	var originalOrder = order;
	var prevPoints = [];
	var radius = 0;
	setRadius();
	var radiusTimer = null;
	var circumference = 0;
	var color = COLORS[order % (COLORS.length - 1)];
	var INIT_TIME = 2000;
	var ending = false;
	
	
	function changeOrder(newOrder) {
		order = newOrder;
		
		if (radiusTimer != null) {
			clearTimeout(radiusTimer);
		}
		
		setRadius();
	}
	
	function setRadius() {
		var MIN_RADIUS = 50;
		var RING_SIZE = Math.min(WIDTH, HEIGHT) / 28;
		
		var targetRadius = (order + 1) * RING_SIZE + MIN_RADIUS;
		
		if (radius == 0 || Math.round(radius) == targetRadius) {
			radius = targetRadius;
		}
		// Don't resize the very last songs
		else if ((originalOrder != 22 && originalOrder != 23 && originalOrder != 24) || document.getElementById('music').currentTime < 396) {
			radius += (targetRadius - radius) / 30;
			
			setTimeout(setRadius, 1000/FPS);
		}
	}
	
	function draw() {
		
		var VALUE_MULTIPLIER = Math.min(WIDTH, HEIGHT) / 20000;
		var RING_THICKNESS = 1.4;
		var CX = WIDTH/2;
		var CY = HEIGHT/2;
		var MAX_MOVE = 0.6;
		var BEZIER_WIDTH = radius * 0.05;
		
		var music = document.getElementById('music');
		var now = music.currentTime * 1000 + 60;
		
		if (data[data.length - 1].t > now) {
			for (var i = 0; i < data.length; i++) {
				if (data[i].t > now) {
					break;
				}
			}
		}
		else {
			ending = true;
		}
		
		if (ending) {
			var allZeros = true;
			
			// Outer shape
			c.fillStyle = '#7f7f7f';
			c.globalCompositeOperation = 'source-over';
			c.beginPath();
	
				
			for (var j = 0; j < prevPoints.length; j++) {
				if (prevPoints[j].amp > 0) {
					allZeros = false;
				}
	
	
				
				var angle = Math.PI*2 / prevPoints.length * j + Math.PI/2;
				var newAmp = prevPoints[j].amp - MAX_MOVE;
			
				var x = CX + Math.cos(angle) * (radius + RING_THICKNESS / 2 + newAmp);
				var y = CY + Math.sin(angle) * (radius + RING_THICKNESS / 2 + newAmp);
				
				prevPoints[j] = {x: x, y: y, amp: newAmp};
	
				if (j == 0) {
					c.moveTo(x, y);
				}
				else {
					var prevAngle = Math.PI*2 / prevPoints.length * (j - 1) + Math.PI/2;
					var cp1x = prevPoints[j - 1].x + Math.cos(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp1y = prevPoints[j - 1].y + Math.sin(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp2x = x + Math.cos(angle - Math.PI / 2) * BEZIER_WIDTH;
					var cp2y = y + Math.sin(angle - Math.PI / 2) * BEZIER_WIDTH;
					c.bezierCurveTo(cp1x, cp1y, cp2x, cp2y, x, y);
				}
				
				if (j == prevPoints.length - 1) {
					var prevAngle = angle;
					var angle = Math.PI/2;
					var cp1x = x + Math.cos(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp1y = y + Math.sin(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp2x = prevPoints[0].x + Math.cos(angle - Math.PI / 2) * BEZIER_WIDTH;
					var cp2y = prevPoints[0].y + Math.sin(angle - Math.PI / 2) * BEZIER_WIDTH;
					c.bezierCurveTo(cp1x, cp1y, cp2x, cp2y, prevPoints[0].x, prevPoints[0].y);
				}
			}
			
			if (allZeros && originalOrder != 24) {
				drawQueue.splice(order, 1);
				
				for (var j = order; j < drawQueue.length; j++) {
					drawQueue[j].changeOrder(j);
				}
			}
			else if (originalOrder == 24) {
				$('canvas').animate({opacity: 0}, 5000);
			}
			
			c.closePath();
			c.fill();
	
			// Inner shape
			c.fillStyle = BG_COLOR;
			c.globalCompositeOperation = 'xor';
			c.beginPath();
			
			for (var j = 0; j < prevPoints.length; j++) {
				var angle = Math.PI*2 / prevPoints.length * j + Math.PI/2;
				var newAmp = prevPoints[j].amp;
				
				var x = CX + Math.cos(angle) * (radius - RING_THICKNESS / 3 * 5 - newAmp);
				var y = CY + Math.sin(angle) * (radius - RING_THICKNESS / 3 * 5 - newAmp);
				
				prevPoints[j] = {x: x, y: y, amp: Math.max(0, newAmp)};
	
				if (j == 0) {
					c.moveTo(x, y);
				}
				else {
					var prevAngle = Math.PI*2 / prevPoints.length * (j - 1) + Math.PI/2;
					var cp1x = prevPoints[j - 1].x + Math.cos(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp1y = prevPoints[j - 1].y + Math.sin(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp2x = x + Math.cos(angle - Math.PI / 2) * BEZIER_WIDTH;
					var cp2y = y + Math.sin(angle - Math.PI / 2) * BEZIER_WIDTH;
					c.bezierCurveTo(cp1x, cp1y, cp2x, cp2y, x, y);
				}
	
				if (j == prevPoints.length - 1) {
					var prevAngle = angle;
					var angle = Math.PI/2;
					var cp1x = x + Math.cos(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp1y = y + Math.sin(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp2x = prevPoints[0].x + Math.cos(angle - Math.PI / 2) * BEZIER_WIDTH;
					var cp2y = prevPoints[0].y + Math.sin(angle - Math.PI / 2) * BEZIER_WIDTH;
					c.bezierCurveTo(cp1x, cp1y, cp2x, cp2y, prevPoints[0].x, prevPoints[0].y);
				}
			}
			
			c.closePath();
			c.fill();
		}
		// Animate the initialisation line, INIT_TIME milliseconds before sound starts
		else if (i == 0 && data[0].t < now + INIT_TIME) {
			circumference = 1 - (data[0].t - now) / INIT_TIME;
			circumference = Math.min(1, circumference);
			// Draw line
			c.strokeStyle = color;
			c.lineWidth = RING_THICKNESS;
			c.globalCompositeOperation = 'source-over';
			c.beginPath();
			c.arc(CX, CY, radius - RING_THICKNESS/2, Math.PI/2 * circumference, Math.PI*2 * circumference + Math.PI/2 * circumference, false);
			c.stroke();
		}
		else if (i > 0) {
			
			var points = data[i - 1].p;
	
			// Outer shape
			c.fillStyle = color;
			c.globalCompositeOperation = 'source-over';
			c.beginPath();
			
			for (var j = 0; j < points.length; j++) {
				var angle = Math.PI*2 / points.length * j + Math.PI/2;
				var newAmp = points[j] * VALUE_MULTIPLIER;
				
				// If new movement is greater than MAX_MOVE, throttle it
				if (prevPoints[j] != null && prevPoints[j].amp > newAmp + MAX_MOVE) {
					newAmp = prevPoints[j].amp - MAX_MOVE;
				}
			
				var x = CX + Math.cos(angle) * (radius + newAmp);
				var y = CY + Math.sin(angle) * (radius + newAmp);
				
				prevPoints[j] = {x: x, y: y, amp: newAmp};
	
				if (j == 0) {
					c.moveTo(x, y);
				}
				
				else {
					var prevAngle = Math.PI*2 / points.length * (j - 1) + Math.PI/2;
					var cp1x = prevPoints[j - 1].x + Math.cos(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp1y = prevPoints[j - 1].y + Math.sin(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp2x = x + Math.cos(angle - Math.PI / 2) * BEZIER_WIDTH;
					var cp2y = y + Math.sin(angle - Math.PI / 2) * BEZIER_WIDTH;
					c.bezierCurveTo(cp1x, cp1y, cp2x, cp2y, x, y);
				}
				
				if (j == points.length - 1) {
					var prevAngle = angle;
					var angle = Math.PI/2;
					var cp1x = x + Math.cos(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp1y = y + Math.sin(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp2x = prevPoints[0].x + Math.cos(angle - Math.PI / 2) * BEZIER_WIDTH;
					var cp2y = prevPoints[0].y + Math.sin(angle - Math.PI / 2) * BEZIER_WIDTH;
					c.bezierCurveTo(cp1x, cp1y, cp2x, cp2y, prevPoints[0].x, prevPoints[0].y);
				}
			}
			
			c.closePath();
			c.fill();

			// Inner shape
			c.fillStyle = BG_COLOR;
			c.globalCompositeOperation = 'xor';
			c.beginPath();
			
			for (var j = 0; j < points.length; j++) {
				var angle = Math.PI*2 / points.length * j + Math.PI/2;
				var newAmp = prevPoints[j].amp;
				
				var x = CX + Math.cos(angle) * (radius - RING_THICKNESS - newAmp);
				var y = CY + Math.sin(angle) * (radius - RING_THICKNESS - newAmp);
				
				prevPoints[j] = {x: x, y: y, amp: newAmp};
	
				if (j == 0) {
					c.moveTo(x, y);
				}
				else {
					var prevAngle = Math.PI*2 / points.length * (j - 1) + Math.PI/2;
					var cp1x = prevPoints[j - 1].x + Math.cos(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp1y = prevPoints[j - 1].y + Math.sin(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp2x = x + Math.cos(angle - Math.PI / 2) * BEZIER_WIDTH;
					var cp2y = y + Math.sin(angle - Math.PI / 2) * BEZIER_WIDTH;
					c.bezierCurveTo(cp1x, cp1y, cp2x, cp2y, x, y);
				}
	
				if (j == points.length - 1) {
					var prevAngle = angle;
					var angle = Math.PI/2;
					var cp1x = x + Math.cos(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp1y = y + Math.sin(prevAngle + Math.PI / 2) * BEZIER_WIDTH;
					var cp2x = prevPoints[0].x + Math.cos(angle - Math.PI / 2) * BEZIER_WIDTH;
					var cp2y = prevPoints[0].y + Math.sin(angle - Math.PI / 2) * BEZIER_WIDTH;
					c.bezierCurveTo(cp1x, cp1y, cp2x, cp2y, prevPoints[0].x, prevPoints[0].y);
				}
			}
			
			c.closePath();
			c.fill();
			data.splice(0, i - 1);
		}
		
		// Sample has ended, remove ring
		if (data.length == 1) {
			ending = true;
		}

	}

	return {
		changeOrder: changeOrder,
		draw: draw,
	}

}

});
		</script>
	</head> 
	<body>
		<audio id="music" preload="auto" oncanplaythrough="canIndeedPlayThrough();"> 
			<source src="Cameron Adams - Definitive Daft Punk (128k).mp3" /> 
			<source src="Cameron Adams - Definitive Daft Punk.ogg" /> 
		</audio>
		
		<div id="container">
	
			<div id="leftPanel">
				<a id="button" class="hidden" href="#"><span></span></a>
				<div id="bass" class="eq"></div> 
				<div id="mid" class="eq"></div> 
				<div id="high" class="eq"></div>				
			</div>
			
			<div id="slicesPane">
				<div id="sliceMask"></div>
				<p id="loading">Loaded 0% of sound data</p>
			</div>
		
		</div>
		<div id="timelineFooter">
		<div id="timeline"> 
			<div id="playShadow"></div> 
		</div> 	
		</div>
	</body> 
</html> 