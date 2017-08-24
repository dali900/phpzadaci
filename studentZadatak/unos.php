<?php 
# Ucitava konekciju sa bazom
include "db.php";

# Ucitava studente
$sql_query_studenti = "SELECT id,ime FROM studenti";
$sql_result_studenti = mysqli_query($sql_konekcija, $sql_query_studenti);

# Ucitava ispite
$sql_query_ispiti = "SELECT id,naziv FROM ispiti";
$sql_result_ispiti = mysqli_query($sql_konekcija, $sql_query_ispiti);

# Proverava da li je prosledjen input (okidac) 'polozen_ispit'
if(isset($_POST['polozen_ispit'])){
	$student_id = $_POST['student_id'];	# combobox student_id
	$ispit = $_POST['ispit'];			# combobox ispit
	$ocena = $_POST['ocena'];			# input ocena

	# Upis polozenog ispita
	$sql_query_upis = "INSERT INTO polozeni_ispiti (student_id,ispit_id,ocena) VALUES ($student_id, $ispit, $ocena)"; # Obratiti paznju na redosled colona u tabeli sa redosledom upisa u query
	$sql_insert_status = mysqli_query($sql_konekcija, $sql_query_upis);

	# Poruka za uspesno sacuvane podatke (nije obavezno)
	if ($sql_insert_status == true) {
		echo "Polozen ispit dodat!";
	} else echo mysqli_error($sql_konekcija);
}

?>


 <form action="" method="POST">

 	<!-- Combobox studenti -->
 	<select name="student_id" >
 		<!-- selected-Selektujemo prvu optciju kao naslov combobox-a, hidden-uklanjamo 'STUDENT' iz liste opcija -->
 		<option selected hidden value="">STUDENT</option>
 		<!-- Pocetak while petlje -->
 		<?php while($student = mysqli_fetch_assoc($sql_result_studenti)) { ?> 
 			<option value="<?php echo $student['id'];?>">	
 				<?php echo $student['ime'];?>
 			</option>
 		<?php } ?> <!-- Kraj while petlje -->
 	</select>

 	<!-- Combobox ispiti -->
 	<select name="ispit">
 		<option selected hidden value="">ISPIT</option>
 		<?php while($ispit = mysqli_fetch_assoc($sql_result_ispiti)) { ?> 
 			<option value="<?php echo $ispit['id'];?>">
 				<?php echo $ispit['naziv'];?>
 			</option>
 		<?php } ?> 
 	</select>

 	<!-- Ocena polozenog ispita -->
 	<input type="text" name="ocena" placeholder="Ocena" >

 	<!-- Okidac za slanje unetih podataka -->
 	<input type="submit" name="polozen_ispit" value="SACUVAJ">

 </form>

 <!-- Linka za pretragu -->
 <a href="pretraga.php">Pretraga</a>
<br>
  <!-- Linka za xml -->
 <a href="xml.php">XML</a>