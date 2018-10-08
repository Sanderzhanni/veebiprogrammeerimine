<?php
require("../../../config.php");
//echo $GLOBALS["serverHost"];
//echo $GLOBALS["serverUsername"];
//echo $GLOBALS["serverPassword"];
$database = "if18_sander_ha_1";

//alustan session_cache_expire
session_start();

function readmsgforvalidation($editId){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT message FROM vpamsg3 WHERE id = ?");
	$stmt->bind_param("i", $editId);
	$stmt->bind_result($msg);
	$stmt->execute();
	if($stmt->fetch()){
		$notice = $msg;
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
  }

function readallunvalidatedmessages(){
	$notice = "<ul> \n";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT id, message FROM vpamsg3 WHERE valid IS NULL ORDER BY id DESC");
	echo $mysqli->error;
	$stmt->bind_result($id, $msg);
	$stmt->execute();
	
	while($stmt->fetch()){
		$notice .= "<li>" .$msg .'<br><a href="validatemessage.php?id=' .$id .'">Valideeri</a>' ."</li> \n";
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
  }

function signin($email, $password){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT id, firstname, lastname, password FROM vpusers WHERE email=?");
	echo $mysqli->error;
	$stmt->bind_param("s", $email);
	$stmt->bind_result($idFromDb, $firstnameFromDb, $lastnameFromDb, $passwordFromDb);
	if($stmt->execute()){
		//kui õnnestus
		if($stmt->fetch()){
			//olemas kasutaja
			if(password_verify($password, $passwordFromDb)){
				//kui salasõna klapib
				$notice = "Logisite sisse";
				//määran sessiooni muutujad
				$_SESSION["userId"] = $idFromDb;
				$_SESSION["userFirstName"] = $firstnameFromDb;
				$_SESSION["userLastName"] = $lastnameFromDb;
				$_SESSION["userEmail"] = $email;
				//liigume edasi
				$stmt->close();
				$mysqli->close();
				header("Location: main.php");
				exit();
			} else {
				$notice = "Vale salasõna";
			}
		} else {
			$notice = "Kasutajat (" .$email .") ei leitud";
		}
	} else {
		$notice = "Sisselogimisel tekkis tehniline viga" .$stmt->error;
	}
	
	$stmt->close();
	$mysqli->close();
	return $notice;
}//Sisselogimine lõppeb

function signup($name,$surname,$birthDate, $gender, $email, $password){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT id FROM vpusers WHERE email=?");
    echo $mysqli->error;
    $stmt->bind_param("s",$email);
    $stmt->execute();
    if ($stmt->fetch()) {
			$notice = "Sellise kasutajatunnusega (" .$email .") kasutaja on juba olemas! Uut kasutajat ei salvestatud!";
    } else {
		$stmt->close();
		$stmt = $mysqli->prepare("INSERT INTO vpusers (firstname, lastname, birthDate, gender, email, password) VALUES(?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		//Krüpteerin parooli, kasutades juhuslikku soolamistfraasi (salting string)
		$options = [
			"cost" => 12,
			"salt" => substr(sha1(rand()), 0, 22)];
			$pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
			$stmt->bind_param("sssiss", $name,$surname,$birthDate, $gender, $email, $pwdhash);
			if($stmt -> execute()){
				$notice = " ok";
			} else{
				$notice = "error" .$stmt->error;
			}
		}
			$stmt->close();
			$mysqli->close();
			return $notice;
}


function test_input($data) {
    //echo "koristan!\n";
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
return $data;}


function saveAMsg($msg){
	//echo "Töötab!";
	$notice = ""; // Teade, mis antakse salvestamise kohta!
	//ühendus serveriga
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	//SQL päring
	$stmt = $mysqli->prepare("INSERT INTO vpamsg3 (message) VALUES(?)");
	echo $mysqli->error;
	$stmt->bind_param("s", $msg);//s - string, i - integer, d - decimal
	if ($stmt->execute()){
		$notice = 'Sõnum: "' .$msg .'" on salvestatud!';
	}	else {
			$notice = "Sõnumi salvestamisel tekkis tõrge: " .$stmt->error;
		}
	$stmt->close();
	$mysqli->close();
	return $notice;
}

function readallmessages(){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT message FROM vpamsg3");
	echo $mysqli->error;
	$stmt->bind_result($msg);
	$stmt->execute();
	while($stmt->fetch()){
		$notice .= "<p>" .$msg ."</p> \n";
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
  }
  
  
  
  
  function saveCatData($catName, $catTail, $catColour){
	$notice = ""; 
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("INSERT INTO uusKiisu (nimi, saba, värvus) VALUES(?, ?, ?)");
	echo $mysqli->error;
	$stmt->bind_param("sis", $catName, $catTail, $catColour);//s - string, i - integer, d - decimal
	if ($stmt->execute()){
		$notice = 'Kiisu "'. $catName .'" on Lisatud. (värv: '. $catColour .', saba pikkus: '. $catTail .' sentimeetrit.)';
			$notice = "Sõnumi salvestamisel tekkis tõrge: " .$stmt->error;
		}
	else { 
		$notice = "Tehnis tehniline tõrge sõnumi salvestamisel". $stmt->error; 
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
	
	function PresentCatData(){
	$tabel = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT nimi, saba, värvus FROM uusKiisu");
	echo $mysqli->error;
	$stmt->bind_result($presentCatName, $presentCatTail, $presentCatColour);
	$stmt->execute();
	while($stmt->fetch()){
		$tabel .= "<p>Nimi:   " .$presentCatName .", värvus:   ". $presentCatTail ." ja saba pikkus(cm):   ". $presentCatColour ."</p> \n";
	}
	$stmt->close();
	$mysqli->close();
	return $tabel;
  }
}
?>