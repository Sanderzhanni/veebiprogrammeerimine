<?php
 require("functions.php");
	$notice = "";
 if(!isset($_SESSION["userId"])){
	  header("Location: index.php");
	  exit();
  }
  
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: index.php");
	  exit();
  }
  
	$mydescription = "Pole midagi lisatud";
	$mybgcolor = $_SESSION["bgColor"];
	$mytxtcolor = $_SESSION["txtColor"];
	
 if(isset($_POST["submitMessage"])){
	 $notice = SaveChanges($_POST["description"],$_POST["bgcolor"],$_POST["txtcolor"]);
	 $mydescription = $_POST["description"];
	$mybgcolor = $_POST["bgcolor"];
	$mytxtcolor = $_POST["txtcolor"];
 }else {
		$userDatas = loadData();
		if($userDatas != "error") {
			if($userDatas["desc"] != ""){
				$mydescription = $userDatas["desc"];
			}
			$mybgcolor = $userDatas["bgcol"];
			$mytxtcolor = $userDatas["txtcol"];
		}
	}
  


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Valideeritud anonüümsed sõnumid</title>
</head>
<body>
  <h1>Valideeritud sõnumid valideeriate kaupa</h1>
  <p>Siin on minu <a href="http://www.tlu.ee">TLÜ</a> õppetöö raames valminud veebilehed. Need ei oma mingit sügavat sisu ja nende kopeerimine ei oma mõtet.</p>
  <hr>
  <ul>

  </ul>
  <hr>
  <textarea rows="10" cols="80" name="description"><?php echo $mydescription; ?></textarea>
<br>
<label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $mybgcolor; ?>"><br>
<br>
<label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $txtcolor; ?>"><br>
<input name = "submitMessage" type = "submit" value = "Salvesta muudatused">
  <p><a href="main.php">Tagasi</a> avalehele!</p>

</body>
</html>