<?php
	
require("../../config.php");
	//var_dump(5.5);
	
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	
	// MUUTUJAD
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupEmail = "";
	
	// kas e/post oli olemas
	if ( isset ( $_POST["signupEmail"] ) ) {
		
		if ( empty ( $_POST["signupEmail"] ) ) {
			
			// oli email, kuid see oli tühi
			$signupEmailError = "See väli on kohustuslik!";
			
		} else {
			
			// email on õige, salvestan väärtuse muutujasse
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	}
	
	if ( isset ( $_POST["signupPassword"] ) ) {
		
		if ( empty ( $_POST["signupPassword"] ) ) {
			
			// oli password, kuid see oli tühi
			$signupPasswordError = "See väli on kohustuslik!";
			
		} else {
			
			// tean et parool on ja see ei olnud tühi
			// VÄHEMALT 8
			
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";
				
			}
			
		}
		
	}
	
	
 // Kus,tean et Ć¼htegi viga ei olnud ja saan kasutaja andmed salvestada
 if ( empty($signupEmailError) && empty($signupPasswordError) ) {
	 echo "Salvestan...<br>";
	 echo "email ".$signupEmail. "<br>";
	 $password = hash("sha512", $_POST["signupPassword"]);
	 echo "parrol ". $_POST["signupPassword"]."<br>";
	 echo "räsi ".$password. "<br>"; 
	 //echo $serverPassword;
		
		$database = "if16_geithy";
		
		//ühendus
		$mysqli = new mysqli($serverHost,$serverUsername,$serverPassword,$database);
		//käsk
	$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		echo $mysql->error;
		//asendan küsimärgi väärtustega
		//iga muutuja kohta 1 täht, mis tüüpi muutuja on
		// s - string
		// i - integer
		// d - double/float
		$stmt->bind_param("ss", $signupEmail, $password);
		
		if ($stmt->execute()) {
				
			echo "salvestamine õnnestus";
	   } else {
		   echo "ERROR ".$stmt->error;
	   }
	   
	   
		
	}
	
		
 
 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise lehekülg</title>
	</head>
	<body>

		<h1>Logi sisse</h1>
		
		<form method="POST">
			
			<label>E-post</label><br>
			<input name="loginEmail" type="email">
			
			<br><br>
			
			<input name="loginPassword" type="password" placeholder="Parool">
			
			<br><br>
			
			<input type="submit" value="Logi sisse">
			
		</form>
		
		<h1>Loo kasutaja</h1>
		
		<form method="POST">
			
			<label>E-post</label><br>
			<input name="signupEmail" type="email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
			
			<br><br>
			
			<input name="signupPassword" type="password" placeholder="Parool"> <?php echo $signupPasswordError; ?> <input name="signupPassword" type="password" placeholder="Kinnita salasõna"> <?php echo $signupPasswordError; ?>
			
			<br><br>
			<h3>Sugu</h3>
			<input type="radio" name="Sugu" value="Mees"> Mees<br>
			<input type="radio" name="Sugu" value="Naine"> Naine<br>
			<br><br>
			
			<input type="submit" value="Loo kasutaja">
			</form>
		
		
	</body>
</html>