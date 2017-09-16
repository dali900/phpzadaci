<?php 
include "konekcija.php";
include "pretragaZaposlenih.php";

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
			<form action="pretragaFirme.php" method="POST">
				Naziv: <input type="text" name="naziv">
				<input type="submit" name="submit_firme" value="Pretrazi">
			</form>
		</fieldset>
	</fieldset>
	</form>
</body>
</html>