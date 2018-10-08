<?php
	require ("functions.php");
	$notice = null;

	if (isset($_POST["submitMessage"])) {
		if ($_POST["message"] != "Kirjuta siia oma sõnum ..." and !empty($_POST["message"])){
			$notice = "Sõnum olemas!";
			$notice = saveAMsg($_POST["message"]);
		} else  {
			$notice = "Palun kirjutage sõnum";
		}
			
		
	}
?>

<!DOCTYPE html>
<html>
	<head>
			<meta charset="utf-8">
		<title>
			sõnumi lisamine
		</title>
	</head>
	<body>
		<h1>
			sõnumi lisamine
		</h1>
		<p>
			Siin on minu
				<a href="http://www.tlu.ee" target=_blank">TLÜ</a>
			õppetöö raames valminud veebilehed, need ei hõlma sügavat sisu ja nende kopeerimine ei oma mõtet.
		</p>
		<hr>
	
		<form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<Label>Sõnum (max 256 märki):</Label>
			<br>
			<textarea rows = "4" cols = "64" name = "message">Kirjuta siia oma sõnum ...</textarea>
			<br>
			<input name = "submitMessage" type = "submit" value = "Salvesta sõnum">
		</form>
		<br>
		<p>
		<?php
			echo $notice;
		?>
		</p>
		<a href="index.php">Tagasi</a>
	</body>
</html>