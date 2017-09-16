<?php 
# Vise nije potrebno zato sto fajl index.php vec ukljucuje konekcija.php zajedno sa ovim fajlom
// include "konekcija.php"; 

$sql_konekcija = connection();

# Inicijalizacija potrebnih promenljivih
# Kreiranje praznog niza za cuvanje prosledjenih kriterijuma pretrage
$FILTER = array();
# Ukoliko je prosledjena pretraga ovde se cuvaju rezultati
$sql_result_zaposleni = '';

# Prvoera da li je prosledjen submit button Pretrazi sa name=zaposleni
# i konstrukcija WHERE klauzule
if (isset($_POST['submit_zaposleni'])) {
	# Iteracija za svako input polje $kljuc-naziv inputa(name), $input-vrednost inputa (value)
	foreach ($_POST as $kljuc => $input) {
		if ($input != '' && $input != 'Pretrazi') {
			# Svaki element FILTER niza dobija kljuc sa nazivom odgovarajuceg inputa 
			# NAPOMENA: izjednaciti nazive kolona u bazi sa nazivima u input
			if ($kljuc == 'plata_min') {
				$FILTER['plata'] = " > $input";
			}
			$FILTER[$kljuc]  = $input;
		}
	}
	# Prikaz filtera
	//printr($FILTER);

	$WHERE = 'WHERE 1 AND ';
	foreach ($FILTER as $kljuc => $vrednost) {
		$WHERE .= "$kljuc = '$vrednost' AND ";
	}
	$WHERE = rtrim($WHERE, "AND ");
	echo "$WHERE";

	# Ucitava zaposlene
	$sql_query_zaposleni  = "SELECT * FROM zaposleni $WHERE";
	$sql_result_zaposleni = mysqli_query($sql_konekcija, $sql_query_zaposleni) OR die(mysqli_error($sql_konekcija));
}

# Drugi nacin konstrukcije WHERE klauzule
/*if(isset($_POST['submit_zaposleni'])){

	$WHERE = '';
	$szaposleni  = $_POST['szaposleni'];	# input szaposleni
	$ime 		 = $_POST['ime']; 			# input ime 
	$radno_mesto = $_POST['radno_mesto'];	# input radno_mesto
	$plata 		 = $_POST['plata'];			# input plata

	# Konstrukcija WHERE klauzule - ukoliko je neko od polja za pretragu prazno
	$WHERE = "WHERE 1 ";
	if ($szaposleni != "") {
		$WHERE.="AND szaposleni='$szaposleni' ";
	}
	if ($ime != "") {
		$WHERE.="AND ime='$ime' ";
	}
	if ($radno_mesto != "") {
		$WHERE.="AND radno_mesto='$radno_mesto' ";
	}
	if ($plata != "") {
		$WHERE.="AND plata='$plata' ";
	}

	# Ucitava zaposlene
	$sql_query_zaposleni  = "SELECT * FROM zaposleni $WHERE";
	$sql_result_zaposleni = mysqli_query($sql_konekcija, $sql_query_zaposleni) 
	# Ukoliko dodje do neke greske u SQL
	OR die(mysqli_error($sql_konekcija));
	
}*/


 ?>