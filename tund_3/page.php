<?php
	$name = "Tundmatu";
	$surname = "inimene";
	$fullName = $name ." " .$surname;
	$birthMonth = date("m");
	$monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	
	//var_dump($_POST);
	if (isset($_POST["firstName"])){
		//$name = $_POST["firstName"];
		$name = test_input($_POST["firstName"]);
	}
	if (isset($_POST["surName"])){
		//$surname = $_POST["surName"];
		$surname = test_input($_POST["surName"]);
	}
	
	function test_input($data) {
	echo "koristan! \n";
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
}

	function fullName() {
		$GLOBALS["fullName"] = $GLOBALS["name"] . " " .$GLOBALS["surname"];
		//echo $fullName;
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
		
	
		
		<form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<Label> Eesnimi:</Label>
			<input name = "firstName" type = "text" value = "" >
			<Label> Perekonnanimi:</Label>
			<input name = "surName" type = "text" value = "" >
			<Label> Sünniaasta: </Label>
			<input name = "birthYear" type = "number" min = "1924" max = "2011" value= "1998">
			<Label> Sünnikuu: </Label>
				<?php
				echo '<select name="birthMonth">' ."\n";
				for ($i = 1; $i < 13; $i ++){
					echo '<option value="' .$i .'"';
					if ($i == $birthMonth){
						echo " selected ";
					}
					echo ">" .$monthNamesET[$i - 1] ."</option> \n";
				}
				echo "</select> \n";
				?>
				<br>
				<br>
				<input name = "submitUserData" type = "submit" value = "Saada andmed">
			</form>
		
		
		<?php
			if (isset($_POST["firstName"])){
				fullName();
					echo "<br> <p>" .$fullName .". Olete elanud järgnevatel aastatel:</p>";
					echo "<ul> \n";
					for ($i = $_POST["birthYear"]; $i <= date("Y"); $i++){
						echo "<li>" .$i ."</li> \n";
					}
					
					echo "</ul> \n";
			}
		?>
		
	</body>
</html>