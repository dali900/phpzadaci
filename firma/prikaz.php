<?php
	include "konekcija.php";
	$sql_konekcija = connection();


	# Ucitava zaposlene
	$sql_query_zaposleni  = "SELECT * FROM zaposleni";
	$sql_result_zaposleni = mysqli_query($sql_konekcija, $sql_query_zaposleni);
	
?>
<style type="text/css">
	table, td, th{
		border: 1px solid black; 
		border-collapse: collapse;
		padding: 5px;
	}
</style>

<!DOCTYPE html>
<html>
<head><title>Ispit</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form action="POST" name="forma">
		<fieldset>
			<table>
				<legend>Zaposleni</legend>
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
		</fieldset>
	</form>
	<br>
	<br>
	<a href="6ZadatakXML.php">XML insert</a><br>
	<a href="index.php">Pocetna</a>
</body>
</html>