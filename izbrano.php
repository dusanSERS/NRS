<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Izbrana vsebina</title>
		<link rel="stylesheet" type="text/css" href="css/stil2.css">
	</head>
	<body>
		<div id="izbrano-div" >
			<?php
			
				//error_reporting(0);  // ne javljaj napak me delovanjem!!!! - OBVEZNO VKLOPI TO MOŽNOST
				
				require_once 'config.php';

				// Create connection
				try
				{
					$conn = new mysqli($servername, $username, $password, $dbname);
					echo "povezan";
				}
				catch(Exception $e)
				{
					die("Povezava z bazo neuspešna! Konatktirajte nadrejene!" );	
				}
				
				
				// Check connection
				if ($conn->connect_error) 
				{
					die("Povezava z bazo neuspešna! Konatktirajte nadrejene!" );
				}
				
				
				
				// preveri, če so vsi podatki vpisani
				if ( $_SERVER["REQUEST_METHOD"] == "POST" && 	
						empty($_POST["ime"]) != true &&
						empty($_POST["priimek"]) != true &&
						empty($_POST["email"]) != true &&
						empty($_POST["telefon"]) != true )
				{
					// preveri vhodne podatke
					$ime   		= test_input( $_POST["ime"] );
					$priimek 	= test_input( $_POST["priimek"]);
					$razred 	= test_input( $_POST["razred"]);
					$email   	= test_input( $_POST["email"] );
					$telefon 	= test_input( $_POST["telefon"]);
					$izbira1 	= test_input( $_POST["izbira1"]);
					$izbira2 	= test_input( $_POST["izbira2"]);
					$izbira3 	= test_input( $_POST["izbira3"]);
					$izbira4 	= test_input( $_POST["izbira4"]);
					//$datum_oddaje =  date("Y-m-d H:i:s,mm");		//čas sedaj datum na serverju (na linux debian ne deluje)
					$datum_oddaje =  date("Y-m-d");
					
					// prepare and bind
					$stmt = $conn->prepare("INSERT INTO izbira
					(ime, priimek, razred, email, telefon, datum_oddaje, izbira1, izbira2, izbira3, izbira4) VALUES	
					(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					
					$r = $stmt->bind_param("ssssssssss", $ime, $priimek, $razred, $email, $telefon, $datum_oddaje, $izbira1, $izbira2, $izbira3, $izbira4);

					if( $stmt->execute() )
					{
						echo "<p style='color:White'>Uspešen vnos v podatkovno bazo!</p>";

						echo "ime:" 	. $ime  . "<br>";
						echo "priimek:" . $priimek  . "<br>";
						echo "razred:" 	. $razred  . "<br>";
						echo "email:" 	. $email  . "<br>";
						echo "telefon:" . $telefon. "<br>";	
						echo "datum oddaje: " . $datum_oddaje . "<br>";
						echo "izbira1:" . $izbira1. "<br>";
						echo "izbira2:" . $izbira2. "<br>";	
						echo "izbira3:" . $izbira3. "<br>";	
						echo "izbira4:" . $izbira4. "<br>";
					}
					else
					{
						echo "<p style='color:red'>Vnos v podatkovno bazo NI uspel!</p>";
						
						$stmt = $conn->prepare("SELECT * FROM izbira WHERE email = ?");
						$stmt->bind_param("s", $email);
						
						$stmt->execute();
						$result = $stmt->get_result();
						
						// če rezultat ni prazen, pomeni da ste že vnesli podatke v PB
						if (!empty($result))
						{
							$row = $result->fetch_array(MYSQLI_NUM);
							echo "<p>" . $row[0] . ", v podatkovno bazo si že vnesel/vnesla sledeče podatke:</p>";
							echo "ime:" 	. $row[0] . "<br>";
							echo "priimek:" . $row[1] . "<br>";
							echo "razred:" 	. $row[2]  . "<br>";
							echo "email:" 	. $row[3]  . "<br>";
							echo "telefon:" . $row[4]. "<br>";	
							echo "datum oddaje: " . $row[5] . "<br>";
							echo "izbira1:" . $row[6]. "<br>";
							echo "izbira2:" . $row[7]. "<br>";	
							echo "izbira3:" . $row[8]. "<br>";	
							echo "izbira4:" . $row[9]. "<br>";
							
							
							echo '	<form action="izbris.php" method="post" >';
							echo '		<input style="display:none" name="koga" value="' . $row[3] . '">';
							echo '		<input id="konec" type="submit" value="Izbriši" />';
							echo '	</form>';
							
							
						}
						
					}
					
					$stmt->close();
					$conn->close();
					
				}
				else
				{	
					echo "Napaka pri vnosu podatkov v podatkovno bazo!<br> Preveri, če si vstavil vse podatke! ";
					
				}
					
				
				
				
				function test_input($data) 
				{
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				}
				
				
			?>
			
			
		</div>
	</body>
</html>
