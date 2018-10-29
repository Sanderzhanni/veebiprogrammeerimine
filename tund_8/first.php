<?php
  require("functions.php");
  //kui pole sisse loginud
  
  //kui pole sisselogitud
  if(!isset($_SESSION["userId"])){
	header("Location: index_3.php");
    exit();	
  }
  
  //väljalogimine
  if(isset($_GET["logout"])){
	session_destroy();
	header("Location:  index_3.php");
	exit();
  } 
  
  //Pildi üleslaadimise osa
  
	$target_dir = "../picUploads/";
	//var_dump($_FILES);
	$target_file = "";
	$uploadOk = 1;
	
	
	

	//Kas vajutati submit nuppu
	if(isset($_POST["submitPic"])) {
		//kas faili nimi ka olemas on
		if(!empty($_FILES["fileToUpload"]["name"])){
			
		
		
		//Määrame faili nime
		//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION));
		//ajatempel
		$timeStamp = microtime(1) * 10000;
		//$target_file = $target_dir .basename($_FILES["fileToUpload"]["name"]) ."_" .$timeStamp ."." .$imageFileType; 
		$target_file = $target_dir ."vp_" .$timeStamp ."." .$imageFileType;
		
		
		//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		// Kas on pilt?, pildi suurususe küsimuse kaudu
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File on pilt - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File ei ole pilt.";
			$uploadOk = 0;
		}// kas fail olemas
	if (file_exists($target_file)) {
		echo "Pilt on juba olemas.";
		$uploadOk = 0;
	}// faili suurus
	if ($_FILES["fileToUpload"]["size"] > 2500000) {
		echo "Fail on liiga suur.";
		$uploadOk = 0;
	}// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Lubatud on vaid jpg, png, jpeg ja gif failid.";
		$uploadOk = 0;
	}// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Vabandame, faili ei laetud üles.";
	// ikui kõik korras, laeme üles
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "Fail ". basename( $_FILES["fileToUpload"]["name"]). " on üles laetud.";
		} else {
			echo "Faili üleslaadimisel tekkis viga.";
		}
	}
	}//ega faili nimi tühi pole
	}//Kas on submit nuppu vajutatud
	


	

  
  //Lehe päise laadimine
  $pageTitle = "Fotode üleslaadimine";
  
  require("header.php");
?>


	<p>See leht on valminud <a href="http://www.tlu.ee" target="_blank">TLÜ</a> õppetöö raames ja ei oma mingisugust, mõtestatud või muul moel väärtuslikku sisu.</p>
	<hr>
	
	<li><a href="?logout=1">Logi välja!</a></li>
	<li><a href="main.php">Tagasi pealehele</a></li>
	<hr>
	<h2>Foto üleslaadimine</h2>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
		<label>Vali üleslaetav pilt: </label>
		<input type="file" name="fileToUpload" id="fileToUpload">
		<br>
		<input type="submit" value="Lae pilt üles" name="submitPic">
	</form>
	
	
	
	
  </body>
</html>