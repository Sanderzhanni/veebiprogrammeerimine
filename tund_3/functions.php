<?php
require("../../../config.php");
//echo $GLOBALS["serverHost"];
//echo $GLOBALS["serverUsername"];
//echo $GLOBALS["serverPassword"];
$database = "if18_sander_ha_1";

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
?>