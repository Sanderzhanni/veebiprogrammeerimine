<?php
 
	require ("functions.php");
	$notice = null;
	//$tabel = PresentCatData();

	if (isset($_POST["submitMessage"])) {
		if (!empty($_POST["catName"]) and !empty($_POST["catTail"])){
			$notice = "Sõnum olemas!";
			$notice = saveCatData($_POST["catName"], $_POST["catTail"], $_POST["catColour"]);
		} else  {
			$notice = "Palun täitke lahtrid";
		}
			
		
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Kiisud</title>
</head>
<body>
  <h1>Kiisud</h1>
  <p>Siin on minu <a href="http://www.tlu.ee">TLÜ</a> õppetöö raames valminud veebilehed. Need ei oma mingit sügavat sisu ja nende kopeerimine ei oma mõtet.</p>
  <hr>
  <form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<Label> Kiisu nimi:</Label>
			<input name = "catName" type = "text" value = "" >
			<Label> Saba pikkus cm: </Label>
			<input name = "catTail" type = "number" min = "0" max = "70" value= "">
			<Label> Kiisu värv:</Label>
			<select name="catColour">
				  <option value="1">Must</option>
				  <option value="2">Valge</option>
				  <option value="3">Pruun</option>
				  <option value="4">Kollanne</option>
				  <option value="5">Oranz</option>
				  <option value="6">Ilma karvata</option>
				</select>
			<br>
			<br>
			
			<input name = "submitMessage" type = "submit" value = "Saada andmed">
		</form>
			
			
				
		  <p>
		  <?php
			echo $notice;
		  ?>
		  </p>
		  
		  <br>
		  
		  <p>
		  <?php
			echo $tabel;
		  ?>
		  </p>


</body>
</html>







