<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">

	<title>Eamonn Fitzmaurice - Data</title>
	<link rel='stylesheet' type='text/css' media='all' href="style.css?version=2" />
	<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
</head>

<body>
<?php
	include('functions.php');
	$tweets = returnTweet();
	//var_dump($tweets);
	
	//combining tweets from duplicate days
	$daily_tweets = array();
	foreach($tweets as $tweet){
		$pub_date = $tweet["created_at"];
		$date = date("m/d/y", strtotime($pub_date));
		$tweet_text = $tweet['text'];
		$tweet_id = $tweet["id"];

		if(!$daily_tweets[$date]){
			$daily_tweets[$date]['date'] = $date;
			$daily_tweets[$date]['amount'] = $tweet_text;
		}else if($daily_tweets[$date]){
			$daily_tweets[$date]['amount'] = $daily_tweets[$date]['amount'] + $tweet_text;
			$daily_tweets[$date]['duplicate'] = 'yes'; 
		}
	}
	
	//creating an indexed array
	$daily_tweets_2 = array();
	$i = 0;
	foreach($daily_tweets as $dt){
		$daily_tweets_2[$i]['date'] = $dt['date'];
		$daily_tweets_2[$i]['amount'] = $dt['amount'];
		$daily_tweets_2['total'] = $daily_tweets_2['total'] + $dt['amount'];
		$i++;
	}
	
	//var_dump($daily_tweets_2['total']);
?>

		<header id="topBar">
			<span class="title_text">
			<h1 onclick="showGoalStatement();">Daily Goals</h1>
			</span>
		</header>
		
		<div id="goals_info">
			<p>Recording my personal goals daily through <a href="#">Twitter</a> and visualizing them here.</p>
			<div class="exit" onclick="showGoalStatement();">
				<span></span>
				<span></span>
			</div>
		</div>
		
	
	<ul id="tweet_list">	
		<?php
			$i = 0;
			$tw = 0;
			$current_day = date('m/d/y');
			$new_day = $current_day;
			$weekend = ( date('w', strtotime($new_day)) == 6 || date('w', strtotime($new_day)) == 0)?'weekend':'';
			
			$days_visible = 100;
			
			$date = $daily_tweets_2[$tw]['date'];
			$tweet_text = $daily_tweets_2[$tw]['amount'];
			$qty = $tweet_text*0.75;

			$first_record = '09/09/17';
			$avg;
		
			//create daily calendar of past year
			while( ($i <= $days_visible) ){
					if($date === $new_day){
						//total has been recorded for that date
							echo '<li class="'.$weekend.'">';
							echo '<span class="goal" data-goal="'.$i.'"></span>';
							echo '<span class="dot" data-amount="'.$qty.'"></span>';
							echo '<span class="total">'.$tweet_text.'</span>';
							echo '<span class="wknd">'.$weekend.'</span>';
							echo '<span class="date">'.$new_day.'</span>';
							echo '</li>';
						$tw++;
						$date = $daily_tweets_2[$tw]['date'];
						$tweet_text = $daily_tweets_2[$tw]['amount'];
						$qty = $tweet_text*0.75;
					}else if($date === $first_record){
						break;
					}else{
						//no total recorded
							echo '<li class="'.$weekend.'">';
							echo '<span class="goal" data-goal="0"></span>';
							echo '<span class="dot nada" data-amount="50"></span>';
							echo '<span class="total">0</span>';
							echo '<span class="wknd">'.$weekend.'</span>';
							echo '<span class="date">'.$new_day.'</span>';
							echo '</li>';
					}

				$i++;
				$new_day = new DateTime($current_day. '- '.$i.' day');
				$new_day = $new_day->format('m/d/y');
				$weekend = ( date('w', strtotime($new_day)) == 6 || date('w', strtotime($new_day)) == 0)?'weekend':'';
				$avg = $daily_tweets_2['total'] / $i;
			}

		?>
	</ul>

<footer>
	<h3><a href="mailto:eamonnfitzmaurice@gmail.com">Contact Me</a></h3>
</footer>

</body>
</html>

<script>
	
var tweetList = document.getElementById('tweet_list'),
	dots = (tweetList)? tweetList.getElementsByClassName('dot'):'',
	goals = (tweetList)? tweetList.getElementsByClassName('goal'):'',
	header = document.getElementById('topBar'),
	window_height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight,
	goalsTrigger = document.getElementById('goalsTrigger');


	//change size of dots
	function growDots(){
			for (var i = 0; i < dots.length; i++) {
			if( checkVisible(dots[i]) ){
				var amount = dots[i].getAttribute('data-amount');
				dots[i].style.width = amount + 'px';
				dots[i].style.height = amount + 'px';
				//dots[i].style.borderRadius = (amount/2) + 'px';
				dots[i].style.marginLeft = ( (amount/2) * -1 ) + 'px';
				dots[i].style.marginTop = ( (amount/2) * -1 ) + 'px';
			}
		}
	}	

	
	//change size of goals
	function growGoals(){
			for (var i = 0; i < goals.length; i++) {
			if( checkVisible(goals[i]) ){
				var goal = goals[i].getAttribute('data-goal');
				goals[i].style.width = goal + 'px';
				goals[i].style.height = goal + 'px';
				goals[i].style.marginLeft = ( (goal/2) * -1 ) + 'px';
				goals[i].style.marginTop = ( (goal/2) * -1 ) + 'px';
			}
		}
	}	

	
	//check if element on screen
	function checkVisible(elm) {
	  var rect = elm.getBoundingClientRect();
	  var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
	  return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
	} 
	
	
	function divideScreen(){
		var window_height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight,
			window_sections = 	window_height/1,
			scrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
		
			var bg = Math.round(scrollTop/window_sections),
				bg = (bg % 12);
		
			document.body.style.backgroundImage = 'url(images/bg_'+bg+'.jpg)';
			console.log(bg);

	}
	
	function raiseHeader(){
	 		header_position = (header.getBoundingClientRect() ),
			header_height = header.offsetHeight,
			scrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;

			console.log(header_height);
			console.log(window_height);
		
		
			if( header_height <= scrollTop ){
				document.body.classList.add('scrolled');
				//document.body.style.backgroundColor = '#eee7e4';
			}else{
				document.body.classList.remove('scrolled');
				//document.body.style.backgroundColor = 'pink';
			}


	}
	
	function showGoalStatement(){
		event.preventDefault();
		if( document.body.classList.contains('show_goals') ){
			document.body.classList.remove('show_goals');
		}else{
			document.body.classList.add('show_goals');
		}
	}

	
	window.onscroll = function() {
		growDots();
		growGoals();
		raiseHeader();
		//divideScreen();
	};

	
//on load

growDots();
	
</script>	
