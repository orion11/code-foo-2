<!-- Liquid layout is typically used to try to support a variety of screen sizes & resolutions. When fixed width and table layout sites were the norm, most computer monitors were similar sizes. Once large and 16/9 aspect ratio monitors began to enter the market, fixed with sites would have too much whitespace in the margins when viewed full screen. Liquid layout aims to fix that. Lately many sites have been adopting responsive design sites to further improve on issues which were found in purely liquid layouts. -->


<!DOCTYPE html>
<html>
<head>
	<title>C-Foo 2012 Submission</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-1680.css" title="wide" >
	<script src="script/dynamiclayout.js" type="text/javascript"></script>
	<link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
	<script src="http://vjs.zencdn.net/c/video.js"></script>
</head>
<body>
	<div class="wrapper">
		
		<div class="group g-1">
			<div class="content c-1">
				<h1>Ryan Nabat's <img id="cf-img" src="img/cf-gb.jpg"> Submission</h1>
				<a class="nav" href="www.github.com/orion11"><img src="img/github_logo.png" height="50px"></a><a class="nav" href="mailto:ryan.nabat@gmail.com">ryan.nabat@gmail.com</a>
			</div>
			<div id="vid" class="content c-2">
				<video id="my_video" class="video-js vjs-default-skin" controls
				  preload="auto" poster=""
				  data-setup="{}">
				  <source src="intro.mp4" type='video/mp4'>
				</video>
			</div>
		</div>
		<div class="group g-2">
			<div class="content c-3">
				<h3>Find the perfect license plate pattern for your population!</h3>
				<form method="post" action="">
					<fieldset>
						<label>
							Population : 
							<input name="pop" type="text">
						</label>
					</fieldset>
					<fieldset>
						<input class="large" type="submit" name="plates" value="Procure the Perfect Plate Permutation!">
					</fieldset>
				</form>
					<?php
					if ( isset($_POST['plates'])) {	
						require_once('php/license-plate.php');
						$ans = plate_pattern($pop);
						echo '<div class="ans-box"><p>';
						echo $ans;
						echo '</p></div>';
						echo '<script type="text/javascript">
							setTimeout("window.scroll(0,630)",800);
							</script>';
					}
				?>

			</div>
			<div id="bus-section" class="content c-4">
				<h3>How many ping pong balls does it take to fill a school bus?</h3>
				<p class="note">* Default dimentions are based on the Thomas Saf-T-Liner school bus.</p>
					<h5>Ball Dimensions:</h5>
				<form method="post" action="">
					<fieldset>
						<label>
							Radius(mm) :
							<input name="radius" type="text">
						</label>
					</fieldset>
					<h5>Bus Dimensions:</h5>
					<fieldset>
						<label>
							Length(mm) :
							<input name="length" type="text">
						</label>
						<label>
							Width (mm) : 
							<input name="width" type="text">
						</label>
						<label>
							Height(mm) :
							<input name="height" type="text">
						</label>
					</fieldset>
					<fieldset>
						<input type="reset" value="Clear">
						<input class="medium" type="submit" name="bus" value="Fill 'em UP!">
					</fieldset>
				</form>
				<a href="bus-explanation.pdf" target="_blank"><span id="triangle">&#9662; For a detailed explanation, take a look at this PDF.</span></a>

				<?php
					if ( isset($_POST['bus'])) {	
						require_once('php/schoolbus.php');
						list($cubic, $hcp) = fillBus($radius, $dimx, $dimy, $dimz);
						echo '<div class="ans-box"><p>';
						echo 'The bus will contain between <span class="val">'.$cubic.'</span> and <span class="val">'.$hcp.'</span> ping pong balls.';
						echo '</p></div>';
						echo '<script type="text/javascript">
							setTimeout("window.scroll(0,2000)",800);
							</script>';
					}
				?>

			</div>
		</div>
	</div>

	<?php
		if(isset($_POST['radius'])){$radius=$_POST['radius'];}else{$radius='20';}
		if(isset($_POST['length'])){$dimx=$_POST['length'];}else{$dimx='12192';}
		if(isset($_POST['width'])){$dimy=$_POST['width'];}else{$dimy='2438.4';}
		if(isset($_POST['height'])){$dimz=$_POST['height'];}else{$dimz='1981.2';}
		if(isset($_POST['pop'])){$pop=$_POST['pop'];}else{$pop='';}

		echo '<script type="text/javascript">
		document.getElementsByName("radius")[0].value="'.$radius.'";
		document.getElementsByName("length")[0].value="'.$dimx.'";
		document.getElementsByName("width")[0].value="'.$dimy.'";
		document.getElementsByName("height")[0].value="'.$dimz.'";
		document.getElementsByName("pop")[0].value="'.$pop.'";
		</script>';
	?>
</body>
</html>