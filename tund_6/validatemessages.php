<?php
 require("functions.php");

 if(!isset($_SESSION["userId"])){
	  header("Location: index.php");
	  exit();
  }
  
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: index.php");
	  exit();
  }
  $mybgcolor = $_SESSION["bgColor"];
  $mytxtcolor = $_SESSION["txtColor"];
  $messagesbyuser = readallvalidatedmessagesbyuser();
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
  <p><a href="main.php">Tagasi</a> avalehele!</p>
	 <p><?php echo $messagesbyuser; ?></p>

</body>
</html>