<?php 
$sql_konekcija = connection();

# Ukoliko je prosledjena pretraga ovde se cuvaju rezultati
$sql_result_firme = '';

# Prvoera da li je prosledjen submit button Pretrazi sa name=submit_firme
# i konstrukcija WHERE klauzule
if(isset($_POST['submit_firme'])){

	$WHERE = '';
	$naziv  = $_POST['naziv'];	# input szaposleni

	# Konstrukcija WHERE klauzule - ukoliko je neko od polja za pretragu prazno
	$WHERE = "WHERE 1 ";
	if ($naziv != "") {
		$WHERE.="AND naziv='$naziv' ";
	};

	# Ucitava firme
	$sql_query_frime  = "SELECT * FROM firma $WHERE ";
	$sql_result_firme = mysqli_query($sql_konekcija, $sql_query_frime) 
	# Ukoliko dodje do neke greske u SQL
	OR die(mysqli_error($sql_konekcija));

	# Ucivanje rezultata pretrage u niz
	$firme = mysqli_fetch_all($sql_result_firme, MYSQLI_ASSOC);

	# Resetujemo WHERE klauzulu i pretrazujemo zaposlene za svaku pronadjenu firmu
	$WHERE = 'WHERE ';
	foreach ($firme as $firma) {
		$WHERE.=" fz.sfirme = ".$firma['sfirme']." OR";
	}
	# Secemo poslednji OR kako ne bi doslo do MySQL greske
	$WHERE = rtrim($WHERE, " OR");
	#echo "$WHERE";
	$sql_query_frime_zaposleni = "SELECT * FROM firma_zaposleni fz 
							 LEFT JOIN zaposleni z ON fz.szaposleni = z.szaposleni 
							 $WHERE ";

	$sql_result_firme_zaposleni = mysqli_query($sql_konekcija, $sql_query_frime_zaposleni) OR die(mysqli_error($sql_konekcija));
	
	$firme_zaposleni = mysqli_fetch_all($sql_result_firme_zaposleni, MYSQLI_ASSOC);
	#printr($firme_zaposleni);
	
}


 ?>