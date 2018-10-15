<?php
	//echo "Siin on minu esimene PHP";
	$name = "Sander";
	$surname = "Hanni";
	$todayDate = date("d.m.Y");
	$hourNow = date("H");
	//echo $hourNow;
	$partOfDay = "";
	
	if ($hourNow < 8) {
		$partOfDay = "Varajane hommik";
	}
	if ($hourNow >= 8 and $hourNow < 16) {
		$partOfDay = "kooliaeg";
	}
	if ($hourNow >= 16) {
		$partOfDay = "Vaba aeg";
	}


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>
			<?php
				echo $name;
				echo " ";
				echo $surname;
			?>
		veebiprogrammeerimine
		</title>
	</head>
	<body>
		<h1>
			<?php
				echo $name ." " .$surname;
			?>
		</h1>
		<p>Siin on minu
			<a href="http://www.tlu.ee" target=_blank">TLÜ</a>
		õppetöö raames valminud veebilehed, need ei hõlma sügavat sisu ja nende kopeerimine ei oma mõtet.</p>
		
		<p>Minu kaasüliõpilase veebi leiate 
		<a href="../../~gertpak" target=_blank">siit</a>
		.</p>
		<?php
			echo "<p>Tänane kuupäev on: " .$todayDate ."</p> \n";
			echo "<p>Lehe avamise hetkel oli kell: ".date("H:i") .". Käes on " .$partOfDay .".</p> \n";
		
		?>
		<!--<img src=
			"http://greeny.cs.tlu.ee/~rinde/veebiprogrammeerimine2018s/tlu_terra_600x400_1.jpg" 
			alt=
			"TLÜ Terra õppehoone">-->
			<img src=
				"../../~rinde/veebiprogrammeerimine2018s/tlu_terra_600x400_1.jpg" 
				alt=
				"TLÜ Terra õppehoone">
		<p> 
		</p>
			<img src=
				"https://img.memecdn.com/html_o_207686.webp" 
				alt=
				"meme.html">
		
	</body>
</html>