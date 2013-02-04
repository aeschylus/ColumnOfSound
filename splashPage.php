<?php
////////////////////////////////////////////////////////////////
//
//  1.) receive file input
//  2.) call to sanitize
//  3.) pass to python script 
//  4.) receive python output and structure preview/produce file for download
//  5.) hand over to javascript/refresh page
//
////////////////////////////////////////////////////////////////

if (array_key_exists('upload', $_POST)) {
	define('UPLOAD_DIR', '/Applications/MAMP/htdocs/Datasculptures/Uploads/');
	move_uploaded_file($_FILES['song']['tmp_name'], UPLOAD_DIR.$_FILES['song']['name']);
}
?>
<!DOCTYPE html> 
 
<html lang="en"> 
	<head> 
		<title>Your music: NOW IN STUNNING 3D!</title>
		
		<!--[if IE]>
		<script>
			var IE = true;
		</script>
		<![endif]--> 
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
		<link href="css/juicy.css" rel="stylesheet" type="text/css" media="all" ></link>
				
		<style type="text/css">
			body {
				font-family: 'JUICERegular';
				text-decoration: none;
			}
			
			a {
				line-height:50px;
				margin: none;
			}
			
			a:link, a:visited {
				color:black;
				text-decoration:none;
				font-size: 28px;
			}
			
			a:focus {
				color: #0099ff;
			}
			
			#header {
				position: absolute;
				left:100px;
				right:100px;
				top:10px;
				height: 50px;
				border-top: solid 15px black;
				border-bottom: double 8px black;
			}
			#headerContents {
				height:100%;
				margin-top:3px;
				border-top: solid 4px black;
				width:100%;
			}
			#container {
				margin-top:85px;
				position:absolute;
				left:100px;
				right:100px;
			}
			#songInput {
				display:none;
				float: right;
				height:330px;
				width:330px;
			}
			#uploadPrompt {
				float:right;
				width:346px;
			}
			#uploadBox {
				float:right;
			}
			#uploadBackground {
				border: 8px dashed black;
				height: 380px;
				width: 380px;
				border-radius: 60px;
				-webkit-border-radius: 60px;
				-moz-border-radius: 60px;
				-ms-border-radius: 60px;
				opacity: .3;
				background: url('media/musicNote.png') no-repeat center;
				cursor: pointer;
			}
			.active {
				opacity: 1;
				-moz-box-shadow: inset 0 0 50px black;
				-webkit-box-shadow: inset 0 0 50px black;
				box-shadow: inset 0 0 50px black;
				cursor: pointer;
			}
			#uploadNote {
				position: absolute;
				padding-top: 50px;
				text-align: center;
				font-size: 16pt;
				width:396px;
				height:396px;
				z-index: 1000;
				cursor: pointer;
			}
			.textAccent {
				color:#0099ff;
			}
			#lowerNote {
				width:396px;
				float:right;
			}
			#gallery {
				width:600px;
				overflow: hidden;
			}
		</style>
		
		<script type="text/javascript">
			
			$(function(){
				
				////////////////////////////////////
				//
				//  1. hover
				//	-text faded out, with click here faded in and changed to accent color
				//	-border and background have higher opacity, inner shadow in black
				//  2. selecting file from click
				//	- text changes to "selecting song," still acccent-colored
				//  3. dragging into window
				//	-"Drag and Drop" accent-colored, other text faded out, black inner shadow, increased box opacity, some other attractive quality 
				//  4. dragging into proper area
				//	-inner shadow accent color, "drop" accent-colored, other text faded, border swells
				//  5. uploading/analysing/preparing
				//	-text disappears, inner shadow accent color, "downloading" background .gif
				//  6. ready to show results
				//
				///////////////////////////////////
				
				$("#uploadBox").hover(
					function() {$('#uploadBackground').stop().fadeTo(200, .8).addClass('active');
						$('.clickHereNegative').stop().fadeTo(150,.2);
						$('.clickHere').stop().animate({color: "#0099ff"}, 150);;
					},
					function() {$('#uploadBackground').stop().fadeTo(800, .3).removeClass('active');
						$('.clickHereNegative').stop().fadeTo(300,1);
						$('.clickHere').stop().animate({color: "black"}, 400);
					}
				);
				
				
				$("a").hover(
					     
					function() {$(this).stop().animate({color: "#0099ff"}, 200);},
					function() {$(this).stop().animate({color: "black"}, 800);}
					
				);
			
	var dropbox = document.getElementById("uploadBox")

	// init event handlers
	dropbox.addEventListener("dragenter", dragEnter, false);
	dropbox.addEventListener("dragexit", dragExit, false);
	dropbox.addEventListener("dragover", dragOver, false);
	dropbox.addEventListener("drop", drop, false);
	dropbox.addEventListener('dragleave', dragLeave, false);

	// init the widgets
	//$("#progressbar").progressbar();
			
function dragEnter(evt) {
	evt.stopPropagation();
	evt.preventDefault();
}

function dragExit(evt) {
	evt.stopPropagation();
	evt.preventDefault();
}

function dragOver(evt) {
	evt.stopPropagation();
	evt.preventDefault();
	$('#uploadBackground').addClass('active');
}

function dragLeave(evt) {
      evt.stopPropagation();
      evt.preventDefault();
      $('#uploadBackground').removeClass('active');
}

function drop(evt) {
	evt.stopPropagation();
	evt.preventDefault();

	var files = evt.dataTransfer.files;
	var count = files.length;

	// Only call the handler if 1 or more files was dropped.
	if (count > 0)
		handleFiles(files);
}


function handleFiles(files) {
	var file = files[0];

	document.getElementById("uploadNote").innerHTML = "Processing " + file.name;

	var reader = new FileReader();

	// init the reader event handlers
	reader.onprogress = handleReaderProgress;
	reader.onloadend = handleReaderLoadEnd;

	// begin the read operation
	reader.readAsDataURL(file);
}

function handleReaderProgress(evt) {
	if (evt.lengthComputable) {
		var loaded = (evt.loaded / evt.total);

		//$("#progressbar").progressbar({ value: loaded * 100 });
	}
}

function handleReaderLoadEnd(evt) {
	//$("#progressbar").progressbar({ value: 100 });

	var img = document.getElementById("preview");
	img.src = evt.target.result;
}
			
			});
		</script>
	</head> 
	<body>
		<div id="header">
			
			<div id="headerContents">
				<a href="#">Home</a>
				<a href="#">Projects</a>
				<a href="#">About</a>
				<a href="#">Contact</a>
			</div>
		
		</div>
		
		<div id="container">
		
			<div id="introBox">
			
			<div>
			
			<div id="uploadPrompt">
			
				<div id="uploadBox">
			
					<span id="uploadNote"><h1 class="clickHereNegative">Drag and Drop</h1><h2 class="clickHereNegative">-OR-<h2><h1 class="clickHere">Click Here</h1></span>
					
					<div id="uploadBackground">
						
						<form id="songInput" action="" method="post" enctype="multipart/form-data" name="uploadImage">
							<input type="file" name="song"></input>
							<input id="upload" type="submit" name="upload" value="upload"></input>
						</form>
						
					</div>
				
				</div>
			
				<span id="lowerNote"><h3>to turn your favourite song into a sculpture!</h3></span>
			
			</div>
			
			<div id="gallery">
				<pre>
					<?php if (array_key_exists('upload', $_POST)) {
						print_r($_FILES);
					}
					?>
				</pre>
			</div>

			</div>
			
			<div id="userFeed">
				<?php?>
			</div>
		
		</div>
		
		<div id="footer"></div>
		
	</body> 
</html> 