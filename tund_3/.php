<?php
	$name = "Tundmatu";
	$surname = "inimene";
	
	//var_dump($_POST);
	if (isset($_POST["firstName"])){
		$name = $_POST["firstName"];
	}
	if (isset($_POST["surName"])){
		$surname = $_POST["surName"];
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
		php
		</title>
	</head>
	<body>
		<h1>
			<?php
				echo $name ." " .$surname;
			?>
		</h1>
		<p>
			Siin on minu
				<a href="http://www.tlu.ee" target=_blank">TLÜ</a>
			õppetöö raames valminud veebilehed, need ei hõlma sügavat sisu ja nende kopeerimine ei oma mõtet.</p>
		
		<hr>
		
		<form method = "Post">
			<Label> Eesnimi:</Label>
			<input name = "firstName" type = "text" value = "" >
			<Label> Perekonnanimi:</Label>
			<input name = "surName" type = "text" value = "" >
			<Label> Sünniaasta</Label>
			<input name = "birthYear" type = "number" min = "1924" max = "2011" value= "1998">
			<br>
			<br>
			<input name = "submitUserData" type = "submit" value = "Saada andmed">
		</from>
		
		<?php
			if (isset($_POST["firstName"])){
					echo "<br> <p>Olete elanud järgnevatel aastatel:</p>";
					echo "<ul> \n";
					for ($i = $_POST["birthYear"]; $i <= date("Y"); $i++){
						echo "<li>" .$i ."</li> \n";
					}
					
					echo "</ul> \n";
			}
		?>
		
	</body>
</html>