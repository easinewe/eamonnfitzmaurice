<?php include('db_connect.php'); ?>

<!Doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="$1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">

<title>Concentration</title>

<style>
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video { margin: 0; padding: 0; border: 0; font-size: 100%; vertical-align: baseline;}
article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section { display: block;}
body {line-height: 1;}
ol, ul {list-style: none;}
blockquote, q {quotes: none;}
blockquote:before, blockquote:after, q:before, q:after { content: ''; content: none; }
table { border-collapse: collapse; border-spacing: 0; }
.clearfix:after { visibility: hidden; display: block; content: ""; clear: both; height: 0;}
.clear:before, .clear:after {content:""; display:block;}
.clear:after {clear:both;}
.clear {zoom:1;}
:focus {outline:none;}
.hidden {display: none;}
	
	
	body{
		font-family: 'Bitter', serif;
		font-size: 10px;
		color: black;
	}
	body:after{
		content:"";
		position:fixed; /* stretch a fixed position to the whole screen */
		top:0;
		height:100vh; /* fix for mobile browser address bar appearing disappearing */
		left:0;
		right:0;
		z-index:-2; /* needed to keep in the background */
		/*background-image: url(images/eamonn-fitzmaurice.jpg);*/
		background: white; /* Old browsers */
		background-position: center bottom;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	body:before{
		content:"";
		position:fixed; /* stretch a fixed position to the whole screen */
		top:0;
		height:100vh; /* fix for mobile browser address bar appearing disappearing */
		left:0;
		right:0;
		z-index:-1; /* needed to keep in the background */
		background-color: rgba(255, 0, 0, 0.0);
		transition: background-color .5s ease-in;
	}

	h1{
		text-align: center;
		font-size: 3em;
		padding: 6vh 0vh 3vh 0vh;
	}	
	h3{
		text-align: center;
		font-size: 1.5em;
	}
	
	form{
		position: fixed;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		z-index: 9990;
	}	

	.slidecontainer {
		width: 100%;
	}

	.slider {
		-webkit-appearance: none;
		width: 100%;
		height: 100vh;
		outline: none;
		-webkit-transition: .2s;
		transition: opacity .2s;
	}

	.slider::-webkit-slider-thumb {
		-webkit-appearance: none;
		appearance: none;
		width: 3vw;
		height: 100vh;
		cursor: pointer;
	}


	/*Chrome*/
	@media screen and (-webkit-min-device-pixel-ratio:0) {
		input[type='range'] {
		  overflow: hidden;
		  width: 100vw;
		  -webkit-appearance: none;
		  background-color: rgba(255, 255, 255, 0.0);
		}

		input[type='range']::-webkit-slider-thumb {
		  width: 3vw;
		  -webkit-appearance: none;
		  height: 100vh;
		  cursor: ew-resize;
		  background: rgba(255, 0, 0, 0.5);
		  box-shadow: -90vw 0 0 90vw rgba(255,0,0,0.2);
		}

	}
	/** FF*/
	input[type="range"]::-moz-range-progress {
	  background-color: gray; 
	}
	input[type="range"]::-moz-range-track {  
	  background-color: #9a905d;
	}

	button[type=submit] {
		position: fixed;
		bottom: 5vh;
		right: 5vh;
		z-index: 9999;
		display: block;
		padding: 1em 2em;
		font-size: 2em;
		text-align: center;
		font-family: 'Bitter', serif;
		text-transform: uppercase;
		text-align: center;
		font-weight: normal;
		color: rgb(255, 255, 255);
		background-color: black;
		border-top-left-radius: 0px;
		border-top-right-radius: 0px;
		border-bottom-right-radius: 0px;
		border-bottom-left-radius: 0px;
		outline: none;
		border: none;
		cursor: pointer;
		transition: all .25s linear;
	}
	button[type=submit]:hover{
		padding: 1.5em 2.5em;
		background-color: red;
	}
	#result{
		position: fixed;
		top: 20vh;
		bottom: 20vh;
		left: 0;
		right: 0;
		text-align: center;
		font-size: 60vh;
		line-height: 60vh;
	}
@media screen and (max-width: 900px) {
	h1{
		font-size: 2em;
	}	
	h3{
		font-size: 1em;
	}
	#result{
		font-size: 640vh;
	}

}
	
</style>


</head>
<body>

 <?php

  if(isset($_POST['save']))
{
    $sql = "INSERT INTO levels (amount, date)
    VALUES ('".$_POST["slide_value"]."', now() )";

    $result = mysqli_query($conn,$sql);
	//echo $_POST["slide_value"];
}

?>

<h1>Daily Concentration Level</h1>
<h3><?php echo date('l, F jS, Y '); ?></h3>

<form id="rangeform" action="concentrate.php" method="post"> 
<input type="range" orient="vertical" min="1" max="100" value="50" name="slide_value" class="slider" id="myRange">
<button type="submit" name="save">Submit</button>

</form>

<div id="result">50</div>

</body>
</html>

<script>
var myRange = document.getElementById("myRange"),
    res = document.getElementById("result");

myRange.addEventListener("input", function() {
    res.innerHTML = myRange.value;
}, false); 

</script>	
