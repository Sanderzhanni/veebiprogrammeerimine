<?php
	$name = "Sander";
	$surname = "Hanni";
	$dirToRead = "../../Pics/";
	$allFiles  = array_slice(scandir($dirToRead), 2);
	//var_dump($allFiles);
	
	
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
		Photo
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
		
			
			<?php
				for ($i = 0; $i < count($allFiles); $i ++ ) {
					echo '<img src ="' .$dirToRead .$allFiles[$i] .'" alt = "Pilt"><br>';
				}
			?>
	</body>
</html>