<?php 
include "konekcija.php";
include "pretragaZaposlenih.php";
include "pretragaFirme.php";

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Ispit</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		.my_table * {
			border: 1px solid black; 
			border-collapse: collapse;
			padding: 5px;
		
		}
		.bold_klasa {
			font-weight: bold;
		}
</style>
</head>
<body>
	<fieldset>
		<fieldset>
			<legend>Zaposleni</legend>
			<!-- Forma za pretragu zaposlenih -->
			<form action="" method="POST">
				<table>
					<tr>
						<td><label>Sifra zaposlenog:</label></td>
						<td><input type="text" name="szaposleni"></td>
					</tr>
					<tr>
						<td><label>Ime:</label></td>
						<td><input type="text" name="ime"></td>
					</tr>
					<tr>
						<td><label>Radno mesto:</label></td>
						<td><input type="text" name="radno_mesto"></td>
					</tr>
					<tr>
						<td><label>Plata MIN:</label></td>
						<td><input type="text" name="plata_min"></td>
					</tr>
					<tr>
						<td><label>Plata MAX:</label></td>
						<td><input type="text" name="plata_max"></td>
						<td><input type="submit" name="submit_zaposleni" value="Pretrazi"></td>
					</tr>
				</table>
			</form><br>
			<!-- Rezultati pretrage -->
			<?php if ($sql_result_zaposleni != ''): ?>
				REZULTAT:
				<div class="my_table">
					<table>
						<th>Sifra</th><th>Ime</th><th>Radno mesto</th><th>Plata</th>
						<?php while($zaposleni = mysqli_fetch_assoc($sql_result_zaposleni)) { ?>
						<tr>
							<td><?=$zaposleni['szaposleni'];?></td>
							<td><?=$zaposleni['ime'];?></td>
							<td><?=$zaposleni['radno_mesto'];?></td>
							<td><?=$zaposleni['plata'];?></td>
						</tr>
						<?php } ?>
					</table>
				</div>
			<?php endif ?>
			
		</fieldset>

		<fieldset>
			<legend>Firme</legend>
			<form action="" method="POST">
				Naziv: <input type="text" name="naziv">
				<input type="submit" name="submit_firme" value="Pretrazi">
			</form>
			<!-- Rezultat pretrage -->
			<?php if ($sql_result_firme != ''): ?>
				REZULTAT:
				<div class="my_table">
					<table>
						<th>Sifra</th><th>Naziv</th><th>Kapital</th><th>Zaposleni</th>
						<?php foreach($firme as $firma) { ?>
						<tr>
							<td><?=$firma['sfirme'];?></td>
							<td><?=$firma['naziv'];?></td>
							<td><?=$firma['kapital'];?></td>
							<td>
								<!-- Rezultati zaposlenih trazene firme -->
								<table>
									<th>Sifra</th><th>Ime</th><th>Radno mesto</th><th>Plata</th>
									<?php foreach($firme_zaposleni as $zap) { ?>
									<!-- Ukoliko je direktor bice boldovan --> 
									<tr class="<?php if ($firma['sdirektora'] == $zap['szaposleni']){ 
													echo 'bold_klasa'; } ?>">									
										<td><?=$zap['szaposleni'];?></td>
										<td><?=$zap['ime'];?></td>
										<td><?=$zap['radno_mesto'];?></td>
										<td><?=$zap['plata'];?></td>
									</tr>
									<?php } ?> <!-- Kraj iteracije rezultata zaposlenih odredjene firme -->
								</table>
							</td>
						</tr>
						<?php } ?> <!-- Kraj iteracije rezultata trazene firme -->
					</table>
				</div>
			<?php endif ?><!--  Kraj if-a za rezltate -->
		</fieldset>
	</fieldset>
	</form>

	<br>
	<br>

	<a href="prikaz.php">Prikaz svih zaposlenih</a><br>
	<a href="6ZadatakXML.php">XML insert</a>
</body>
</html>