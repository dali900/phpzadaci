<?php
	
	include 'connection.php';
	include 'pretragaKorisnika.php';
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Vezba PHP</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<fieldset>
		<fieldset>
			
			<legend>Pretraga korisnika</legend>
			<!--Unos u polja za pretragu-->
			<form action="" method="POST">
				<table>
					<tr>
						<td><label>Ime i prezime<label></td>
						<td><input type="text" name="ime"></td>
					</tr>
					<td><input type="submit" name="submit_korisnik" value="Pretraži"></td>
				</table>
			</form></br>
			<!--Izvršavanje rezultata pretrage-->
			<?php if($sql_result_korisnici != '') : ?>
				REZULTAT:
				
					<table border=1>
						<th>Ime i prezime</th><th>Email</th><th>Sifra</th>
						<?php while($zaposleni = mysqli_fetch_assoc($sql_result_korisnici)) { ?>
						<tr>
							<td><?=$zaposleni['ime'];?></td>
						</tr>
						<?php } ?>
					</table>
				
			<?php endif ?>
			
		</fieldset>
	</fieldset>
</body>
</html>