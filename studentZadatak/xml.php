<?php 
# Ucitava konekciju sa bazom
include "db.php";

function printr($data){
		echo "<pre>";
		print_r($data);
		echo "<pre>";
	}

# Ucitava ispite
$sql_query_ispiti = "SELECT * FROM ispiti";
$sql_result_ispiti = mysqli_query($sql_konekcija, $sql_query_ispiti) OR die(mysqli_error($sql_konekcija));

$xml = new DOMDocument();
$xml->formatOutput=true;
$xml_ipsiti = $xml->createElement("Ispiti");
$xml->appendChild($xml_ipsiti);

while ($ispit = mysqli_fetch_assoc($sql_result_ispiti)) {
	$xml_ipit = $xml->createElement("Ispit");
	$xml_ipsiti->appendChild($xml_ipit);

		$xml_naziv = $xml->createElement("naziv", $ispit['naziv']);
		$xml_ipit->appendChild($xml_naziv);

		$xml_profesor = $xml->createElement("profesor", $ispit['profesor']);
		$xml_ipit->appendChild($xml_profesor);
}

# Prikazuje XML u istom fajlu
echo "<xmp>".$xml->saveXML()."</xmp>";
# Cuva XML u novi fajl
$xml->save("xml_ipsiti.xml");




 ?>

  <!-- Linka za unos -->
 <a href="unos.php">Unos</a>
<br>
  <!-- Linka za xml -->
 <a href="xml.php">XML</a>