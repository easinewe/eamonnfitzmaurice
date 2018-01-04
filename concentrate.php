<?php include('db_config.php'); ?>

<!Doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="$1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Concentration</title>

<style>
.slidecontainer {
    width: 100%;
}

.slider {
    -webkit-appearance: none;
    width: 100%;
    height: 125px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider:hover {
    opacity: 1;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 125px;
    height: 125px;
    background: #4CAF50;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 125px;
    height: 125px;
    background: #4CAF50;
    cursor: pointer;
}
	
	/*Chrome*/
@media screen and (-webkit-min-device-pixel-ratio:0) {
    input[type='range'] {
      overflow: hidden;
      width: 90vw;
      -webkit-appearance: none;
    }
    
    input[type='range']::-webkit-slider-runnable-track {
      height: 125px;
      -webkit-appearance: none;
      color: #13bba4;
      margin-top: -1px;
    }
    
    input[type='range']::-webkit-slider-thumb {
      width: 80px;
      -webkit-appearance: none;
      height: 125px;
      cursor: ew-resize;
      background: rgba(0,0,0,0.25);
      box-shadow: -90vw 0 0 90vw #43e5f7;
    }

}
/** FF*/
input[type="range"]::-moz-range-progress {
  background-color: #43e5f7; 
}
input[type="range"]::-moz-range-track {  
  background-color: #9a905d;
}
/* IE*/
input[type="range"]::-ms-fill-lower {
  background-color: #43e5f7; 
}
input[type="range"]::-ms-fill-upper {  
  background-color: #9a905d;
}
/*input[type=range][orient=vertical] {
    writing-mode: bt-lr;
    -webkit-appearance: slider-vertical; 
    width: 50vw;
    height: 100vh;
    padding: 0 5px;
}*/	

button[type="submit"]{
	margin: 20px;
	display: block;
	text-align: center;
	margin: 0px auto;
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

<h1>How was Today's Level of Concentration</h1>

<form action="concentrate.php" method="post"> 

<p>Concentration Level</p>
<input type="range" orient="vertical" min="1" max="100" value="50" name="slide_value" class="slider" id="myRange">



<button type="submit" name="save">save</button>

</form>

</body>
</html>