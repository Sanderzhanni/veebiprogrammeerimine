<?php
	//echo "Siin on minu esimene PHP";
	$name = "Sander";
	$surname = "Hanni";
	$todayDate = date("d");
	$todayMonth = date("m");
	$todayYear = date("Y");
	$weekDayNow = date("N");
	$weekDayNamesET = ["esmaspäev", "Teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	$monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	//var_dump  ($weekDayNamesET);
	//echo $weekDayNamesET[0];
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

	//Loosime juhusliku pildi
	$picNum = mt_rand(2, 43);//random
	//echo $picNum;'
	$picURL = "http://www.cs.tlu.ee/~rinde/media/fotod/TLU_600x400/tlu_";
	$picEXT = ".jpg";
	$picFileName = $picURL .$picNum .$picEXT;
	//echo $picFileName;
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
		<a href="../../../~gertpak/veebiprogrammeerimine/tund_3" target=_blank">siit</a>
		.</p>
		
		<?php
			echo "<p>Täna on ".$weekDayNamesET[$weekDayNow - 1].". " .$todayDate .". ".$monthNamesET[$todayMonth - 1] .". " .$todayYear .".</p> \n";
			echo "<p>Lehe avamise hetkel oli kell: ".date("H:i") .". Käes on " .$partOfDay .".</p> \n";
		
	
		?>
		<!--<img src=
			"http://greeny.cs.tlu.ee/~rinde/veebiprogrammeerimine2018s/tlu_terra_600x400_1.jpg" 
			alt=
			"TLÜ Terra õppehoone">-->
			<img src=
				"../../../~rinde/veebiprogrammeerimine2018s/tlu_terra_600x400_1.jpg" 
				alt=
				"TLÜ Terra õppehoone">
		<p>
		</p>
		<img src =
			"<?php echo $picFileName; ?>"
			alt = 
			"Juhuslik pilt Tallinna ülikoolist">
	</body>
</html>