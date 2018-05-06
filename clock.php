<!DOCTYPE html>
<html>
<body>
	<?php
		date_default_timezone_set('Europe/Moscow');
		$d = getdate(); 
		$hour=$d[hours];
		$min=$d[minutes];
		$sec=$d[seconds];
		$ungleH=($hour * 30) + ($min / 2);
		$ungleM= ($min * 6);
		$ungleS=($sec * 6);
	echo <<<EOD
	<svg viewBox="0 0 400 400" width="400" height="400">
		<circle cx="200" cy="200" r="120" stroke="black" stroke-width="15" fill="rgb(255, 255, 224)" />
		<circle cx="200" cy="200" r="8" fill="rgb(0, 0, 0)"/>
		 <line id = "hour" x1="200" y1="200" x2="200" y2="150" style="stroke:rgb(0,0,0);stroke-width:8" transform="rotate({$ungleH},200,200)" />
		 <line id = "min" x1="200" y1="200" x2="200" y2="120" style="stroke:rgb(0,0,0);stroke-width:4" transform="rotate({$ungleM},200,200)"/>
		 <line id = "sec" x1="200" y1="200" x2="200" y2="120" style="stroke:rgb(255,0,0);stroke-width:2" transform="rotate({$ungleS},200,200)"/>
		 <line x1="200" y1="90" x2="200" y2="118" style="stroke:rgb(0,0,0);stroke-width:6" />
		 <line x1="200" y1="310" x2="200" y2="282" style="stroke:rgb(0,0,0);stroke-width:6" />
		 <line x1="90" y1="200" x2="118" y2="200" style="stroke:rgb(0,0,0);stroke-width:6" />
		 <line x1="310" y1="200" x2="282" y2="200" style="stroke:rgb(0,0,0);stroke-width:6" />
		 <line x1="200" y1="90" x2="200" y2="110" style="stroke:rgb(0,0,0);stroke-width:4" transform="rotate(30,200,200)"/>
		<line x1="200" y1="90" x2="200" y2="110" style="stroke:rgb(0,0,0);stroke-width:4" transform="rotate(60,200,200)"/>
		<line x1="200" y1="90" x2="200" y2="110" style="stroke:rgb(0,0,0);stroke-width:4" transform="rotate(120,200,200)"/>
		<line x1="200" y1="90" x2="200" y2="110" style="stroke:rgb(0,0,0);stroke-width:4" transform="rotate(150,200,200)"/>
		<line x1="200" y1="90" x2="200" y2="110" style="stroke:rgb(0,0,0);stroke-width:4" transform="rotate(210,200,200)"/>
		<line x1="200" y1="90" x2="200" y2="110" style="stroke:rgb(0,0,0);stroke-width:4" transform="rotate(240,200,200)"/>
		<line x1="200" y1="90" x2="200" y2="110" style="stroke:rgb(0,0,0);stroke-width:4" transform="rotate(300,200,200)"/>
		<line x1="200" y1="90" x2="200" y2="110" style="stroke:rgb(0,0,0);stroke-width:4" transform="rotate(330,200,200)"/>
		<circle cx="200" cy="200" r="5" fill="rgb(255, 0, 0)"/>
	</svg>
EOD;
	?>
</body>
</html>