<?php 
include "db.php";


$sql_query_messages  = "SELECT * FROM messages";
$sql_result_messages  = mysqli_query($sql_konekcija, $sql_query_messages);


$sql_query_users  = "SELECT * FROM users";
$sql_result_users  = mysqli_query($sql_konekcija, $sql_query_users);
$users = mysqli_fetch_all($sql_result_users, MYSQLI_ASSOC); // Svi rezultati iz tabele users

$sql_query_subjects  = "SELECT * FROM subject";
$sql_result_subjects  = mysqli_query($sql_konekcija, $sql_query_subjects);
$subjects = mysqli_fetch_all($sql_result_subjects, MYSQLI_ASSOC); // Svi rezultati iz tabele subject

if (isset($_POST['submit_message'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];

	# Pretraga korisnika u bazi, ukoliko postoji vrsimo UPDATE
	$pronadjen_korisnik = '';
	foreach ($users as $user) {
		if ($user['name'] == $name && $user['email'] == $email) {
			$pronadjen_korisnik = $user;
		}
	}

	if ($pronadjen_korisnik !='') {
		$sql_postojeci_message_query = "SELECT * FROM messages WHERE iduser = ".$pronadjen_korisnik['iduser'];
		$sql_result_postojeci_message  = mysqli_query($sql_konekcija, $sql_postojeci_message_query);
		$postojeci_message = mysqli_fetch_array($sql_result_postojeci_message,MYSQLI_ASSOC); 

		#print_r($postojeci_message);
		$sql_query_upadate_subject = "UPDATE subject SET subject = '$subject' WHERE idsubject = ".$postojeci_message['idsubject'];
		mysqli_query($sql_konekcija, $sql_query_upadate_subject);

		$sql_query_upadate_message = "UPDATE messages SET message = '$message' WHERE idmessage = ".$postojeci_message['idmessage'];
		mysqli_query($sql_konekcija, $sql_query_upadate_message);

		echo "Vasa poruka je AZURIRANA";
	} else {
		$sql_query_insert_users = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
		mysqli_query($sql_konekcija, $sql_query_insert_users);
		$last_id_user = mysqli_insert_id($sql_konekcija); 

		$subject_postoji = false;
		foreach ($subjects as $subject_db) {
			if ($subject_db['subject'] == $subject) {
				$subject_postoji = $subject_db['idsubject'];
			}
		}

		$last_id_subject = $subject_postoji;
		if ($subject_postoji == false) {
			$sql_query_insert_subject = "INSERT INTO subject (subject) VALUES ('$subject')";
			mysqli_query($sql_konekcija, $sql_query_insert_subject);
			$last_id_subject = mysqli_insert_id($sql_konekcija); 
		}
		
		

		$sql_query_insert_message = "INSERT INTO messages (iduser,idsubject,message) VALUES ($last_id_user, $last_id_subject, '$message')";
		mysqli_query($sql_konekcija, $sql_query_insert_message);
		echo "Vasa poruka je SACUVANA";
	}
}

#print_r($users);



 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Send Message</title>
 </head>
 <body>

 	<fieldset>
 		<legend>Send Message</legend>
 		<form method="POST" accept="">
 			Name: <br>
 			<input type="text" name="name"><br>

 			Email: <br>
 			<input type="text" name="email"><br>

 			Subject: <br>
 			<input type="text" name="subject"><br>

 			Message: <br>
 			<textarea name="message" cols="50" rows="4"></textarea><br><br>

 			<button type="submit" name="submit_message">SEND</button>
 		</form>
 	</fieldset>
 	<br><br>
 	<a href="prikaz.php">Prikaz subject-a</a>
 
 </body>
 </html>