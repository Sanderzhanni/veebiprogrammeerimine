<?php
	require ("functions.php");
	
	$name = "";
	$surname = "";
	$birthMonth = null;
	$birthYear = null;
	$birthDay = null;
	$birthDate = null;
	$email = "";
	$gender = "";
	$monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	
	//Muutujad võimalike veateadetega
	
	$nameError = "";
	$surnameError = "";
	$birthMonthError = "";
	$birthYearError= "";
	$birthDayError = "";
	$genderError= "";
	$emailError = "";
	$passwordError = "";
	
	
	//Kui on uue kasutaja loomise nuppu vajutatud
	if (isset($_POST["submitUserData"])){
	
	if (isset($_POST["firstName"]) and !empty($_POST["firstName"])){
		//$name = $_POST["firstName"];
		$name = test_input($_POST["firstName"]);
	} else {
		$nameError = " Palun sisesta eesnimi!";
	}
	
	if (isset($_POST["surName"]) and !empty($_POST["surName"])){
		//$surname = $_POST["surName"];
		$surname = test_input($_POST["surName"]);
	} else {
		$surnameError = " Palun sisesta perekonnanimi!";	
	}
	
	if (isset($_POST["gender"])){
		$gender = intval($_POST["gender"]);
	} else {
		$genderError = " Palun märgi sugu!";
	}
	
	//Kontrollime sünniaega
	
	if (isset($_POST["birthDay"])){
		$birthDay = $_POST["birthDay"];
	} 
	
	if (isset($_POST["birthMonth"])){
		$birthMonth = $_POST["birthMonth"];
	} 
	
	if (isset($_POST["birthYear"])){
		$birthYear = $_POST["birthYear"];
	} 
	
	//Kontrollin kuupäeva õigsust
	
	if (isset($_POST["birthDay"]) and isset($_POST["birthMonth"]) and isset($_POST["birthYear"])){
		//Checkdate (päev, kuu, aasta)
		if(checkdate(intval($_POST["birthMonth"]), intval($_POST["birthDay"]), intval($_POST["birthYear"]))){
			$birthDate = date_create($_POST["birthMonth"] ."/" .$_POST["birthDay"] ."/" .$_POST["birthYear"]);
			$birthDate = date_format($birthDate, "Y-m-d");
			echo $birthDate;
		} else {
			$birthYearError = "Kuupäev on vigane";
		}
			
	}
	
	if (isset($_POST["email"]) and !empty($_POST["surName"])){
		$email = $_POST["email"];
	} else {
		$emailError = " Palun sisesta email!";
	}
	
	if (empty($nameError) and empty($surnameError) and empty($birthMonthError) and empty($birthYearError) and empty($birthDayError) and empty($genderError) and empty($emailError) and empty($passwordError)){
		$notice = signup($name,$surname,$birthDate, $email, $gender, $_POST["password"]);
		echo $notice;
	
	}
	
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>
			Katselise veebi uue kasutaja loomine
		</title>
	</head>
	<body>
		<h1>
			Loo endale kasutajakonto
		</h1>
		<p>
			Siin on minu
				<a href="http://www.tlu.ee" target=_blank">TLÜ</a>
			õppetöö raames valminud veebilehed, need ei hõlma sügavat sisu ja nende kopeerimine ei oma mõtet.</p>
		
		<hr>
		
	
		
		<form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<Label> Eesnimi:</Label><br>
			<input name = "firstName" type = "text" value = "<?php echo $name; ?>" ><span><?php echo $nameError;
			?></span><br>
			<Label> Perekonnanimi:</Label><br>
			<input name = "surName" type = "text" value = "<?php echo $surname; ?>" ><span><?php echo $surnameError;
			?></span><br>
			<br>
			
			<input type="radio" name = "gender" value = "2"<?php if ($gender == "2"){echo " checked";}?>>
			<Label>Naine</Label>
			
			<input type="radio" name = "gender" value = "1"
			<?php
				if ($gender == "1"){
				echo " checked";
				}
			?>>
			<Label>Mees  </Label><span><br><br><?php echo  $genderError;
			?></span><br>
			<br>
			<br>
			
			 <label>Sünnipäev: </label>
				  <?php
					echo '<select name="birthDay">' ."\n";
					echo '<option value = "" selected disabled>Päev</option>' ."\n";
					for ($i = 1; $i < 32; $i ++){
						echo '<option value="' .$i .'"';
						if ($i == $birthDay){
							echo " selected ";
						}
						echo ">" .$i ."</option> \n";
					}
					echo "</select> \n";
				  ?>
			 
			<Label> Sünnikuu: </Label>
				<?php
				echo '<select name="birthMonth">' ."\n";
				echo '<option value = "" selected disabled>Kuu</option>' ."\n";
				for ($i = 1; $i < 13; $i ++){
					echo '<option value="' .$i .'"';
					if ($i == $birthMonth){
						echo " selected ";
					}
					echo ">" .$monthNamesET[$i - 1] ."</option> \n";
				}
				echo "</select> \n";
				?>
				<label>Sünniaasta: </label>
			  <?php
				echo '<select name="birthYear">' ."\n";
				echo '<option value = "" selected disabled>Aasta</option>' ."\n";
				for ($i = date("Y") - 15; $i >= date("Y") - 100; $i --){
					echo '<option value="' .$i .'"';
					if ($i == $birthYear){
						echo " selected ";
					}
					echo ">" .$i ."</option> \n";
				}
				echo "</select> \n";
			  ?>
			  <br>
			  <br>
			  <Label>E-mail (Kasutajatunnus):</Label><br>
			  <input type = "email" value="<?php echo $email; ?>" name = "email"><?php echo $emailError;
			?></span><br>
				<br>
				
				<Label>Salasõna:</Label><br>
			<input name = "password" type = "text" value = "" ><span><?php echo $passwordError;
			?></span><br>
				<br>
				<input name = "submitUserData" type = "submit" value = "Loo kasutaja">
			</form>
		
		
		
		
	</body>
</html>