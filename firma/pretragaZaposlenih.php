<?php 
# Vise nije potrebno zato sto fajl index.php vec ukljucuje konekcija.php zajedno sa ovim fajlom
// include "konekcija.php"; 

$sql_konekcija = connection();

# Ukoliko je prosledjena pretraga ovde se cuvaju rezultati
$sql_result_zaposleni = '';

# Prvoera da li je prosledjen submit button Pretrazi sa name=submit_zaposleni
# i konstrukcija WHERE klauzule
if(isset($_POST['submit_zaposleni'])){

	$WHERE = '';
	$szaposleni  = $_POST['szaposleni'];	# input szaposleni
	$ime 		 = $_POST['ime']; 			# input ime 
	$radno_mesto = $_POST['radno_mesto'];	# input radno_mesto
	$plata_min 	 = $_POST['plata_min'];		# input plata_min
	$plata_max 	 = $_POST['plata_max'];		# input plata_max

	# Konstrukcija WHERE klauzule - ukoliko je neko od polja za pretragu prazno
	$WHERE = "WHERE 1 ";
	if ($szaposleni != "") {
		$WHERE.="AND szaposleni=$szaposleni ";
	}
	if ($ime != "") {
		$WHERE.="AND ime='$ime' ";
	}
	if ($radno_mesto != "") {
		$WHERE.="AND radno_mesto='$radno_mesto' ";
	}
	if ($plata_min != "") {
		$WHERE.="AND plata >= $plata_min ";
	}
	if ($plata_max != "") {
		$WHERE.="AND plata <= $plata_max ";
	}

	# Ucitava zaposlene
	$sql_query_zaposleni  = "SELECT * FROM zaposleni $WHERE";
	$sql_result_zaposleni = mysqli_query($sql_konekcija, $sql_query_zaposleni) 
	# Ukoliko dodje do neke greske u SQL
	OR die(mysqli_error($sql_konekcija));
	
}


 ?>