
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Drawing on web with Canvas and Jquery</title>
	<link rel="shortcut icon" href="favicon.ico">  
    <link rel="icon" type="image/ico" href="favicon.ico">
    <meta name="author" content="Dharmveer Motyar">
    <meta name="keywords" content="JQuery, HTML5,Draw on web, Drawing on web, Motyar">
    <meta name="description" content="How to freehand draw on web with Canvas and JQuery">

<style>
*{
	margin:0;
	-webkit-user-select: none;
	font-family: Georgia, sans-serif;
}
canvas{
	cursor: crosshair;
	border:black solid 1px;
 }

a{
	font-size:20px;
	text-decoration:none;
	background:#4CA64C;
	color:#fff;
	padding:5px;
 }

#clr div{
	cursor:pointer;
	cursor:hand;
	width:20px;
	height:20px;
	float:left;
}
img{
 height:100px;
 width:100px;
 border:1px red solid;
 margin-left:2px;
 background:none;
}

body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote,th,td{margin:0;padding:0}
#nav li{list-style:none}
#nav{height:16px;margin-bottom:0px;
font-family: Cambria, 'Hoefler Text', Utopia, 'Liberation Serif', 'Nimbus Roman No9 L Regular', Times, 'Times New Roman', serif;
}#nav
ul{float:right}
#nav
li{float:left;width:60px;text-align:center;border-left:1px solid #fff}
#nav
li a{display:block;color:#fff;font-size:85%;text-decoration:none;text-transform:uppercase;font-weight:normal;line-height:16px}
#nav li.selected a{background-color:#000}
#nav li a:hover{background-color:#333}


</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript" ></script>

<script type="text/javascript" >
//set drawmode false

$(document).ready(function() {

		var draw= false;
		var x, y = '';

		var canvas = document.getElementById("can");
		var ctx = canvas.getContext("2d");
		ctx.strokeStyle = 'red';

		ctx.lineWidth = 15;
		ctx.lineCap = "round";


		//set it true on mousedown
		$("#can").mousedown(function(e){draw=true;
		            ctx.beginPath();
					ctx.moveTo(e.pageX,e.pageY-16);
					ctx.lineTo(e.pageX+0.1,e.pageY-16+0.1);
					ctx.stroke();
					});
		//reset it on mouseup
		$("#can").mouseup(function(){draw=false;});

		$("#can").mousemove(function(e) {
			if(draw==true){
					
					ctx.beginPath();
					ctx.moveTo(e.pageX,e.pageY-16);
					ctx.lineTo(e.pageX+1,e.pageY-16+1);
					ctx.stroke();
			}	

		});
        
		//code for color pallete
		$("#clr > div").click(
		function(){
				ctx.strokeStyle = $(this).css("background-color");
		});
        
        //Eraser
		$("#eraser").click(function(){
		ctx.strokeStyle = '#fff';
		});

		//Code for save the image
		$("#save").click(function(){ 
			$("#result").html('<br /><br /><img src='+canvas.toDataURL()+' /><br /><a href="#" id="get">&nbsp;Download</a>');
			$("#data").val(canvas.toDataURL());
			$("#get").click(function(){
					$("#frm").trigger('submit');
	       });
		});
        
		//Clear 
		$("#clear").click(function(){
				 ctx.fillStyle = "#fff";
				 ctx.fillRect(0, 0, canvas.width, canvas.height);
				 ctx.strokeStyle = 'red';
				 ctx.fillStyle = "red";
			}
			);
	   
	   
});


</script>
</head>
<body>
<div id='nav'>
					<ul>
						<!-- <li>
							<a href='http://lifeclrz.blogspot.com'>Life</a>
						</li> -->
						<li>
							<a href='http://motyar.blogspot.com/2010/04/drawing-on-web-with-canvas-and-jquery.html'>Blog</a>

						</li>
						<li >
							<a href='http://motyar.com'>About</a>
						</li>
						<li>
							<a href='http://000labs.com'>WORK</a>
						</li>
					</ul>

				</div>

<canvas id="can" width="298" height="300" >
</canvas>
<div id="clr">
<div style="background-color:black;"> </div>
<div style="background-color:red;"> </div>
<div style="background-color:green;"> </div>
<div style="background-color:orange;"> </div>
<div style="background-color:brown;"> </div>
<div style="background-color:#d2232a;"> </div>
<div style="background-color:#fcb017;"> </div>
<div style="background-color:#fff460;"> </div>
<div style="background-color:#9ecc3b;"> </div>
<div style="background-color:#fcb017;"> </div>
<div style="background-color:#fff460;"> </div>
<div style="background-color:#F43059;"> </div>
<div style="background-color:#82B82C;"> </div>
<div style="background-color:#0099FF;"> </div>
<div style="background-color:#ff00ff;"> </div>
</div><br /><br />

<a href="#" id="clear" >Clear</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a id="save" href="#">Save</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a id="eraser" href="#">Eraser</a>
<span id="result" ><br /><br /></span> 
<form action="" method="post" id="frm"/>
<input type="hidden" name="data" id="data" />
</form>
</body>
</html>