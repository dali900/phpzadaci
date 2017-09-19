<?php 
include "db.php";

$sql_query_subjects  = "SELECT * FROM subject";
$sql_result_subjects  = mysqli_query($sql_konekcija, $sql_query_subjects);
$subjects = mysqli_fetch_all($sql_result_subjects, MYSQLI_ASSOC); // Svi rezultati iz tabele subject

$postojeci_message = '';

if (isset($_POST['submit_prikaz'])) {
	$subject = $_POST['subject']; //id subject-a

	$sql_postojeci_message_query = "SELECT * FROM `messages` m
									LEFT JOIN users u ON m.iduser = u.iduser
									WHERE idsubject = ".$subject; 
	$sql_result_postojeci_message  = mysqli_query($sql_konekcija, $sql_postojeci_message_query);
	$postojeci_message = mysqli_fetch_all($sql_result_postojeci_message,MYSQLI_ASSOC);

}


 ?>


  <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Prikaz poruka</title>
 	<style type="text/css">
 		table, th, td {
		    border: 1px solid black;
		    border-collapse: collapse;.
		    padding: 5px;
		}
 	</style>
 </head>
 <body>

 	<fieldset>
 		<legend>Prikaz poruka</legend>
 		<form method="POST" accept="">
 			Subject: <br>
 			<select name="subject">
 				<option></option>
 				<?php foreach ($subjects as $subject) { ?>
 					<option value="<?=$subject['idsubject'] ;?>"><?=$subject['subject'] ;?></option>
 				<?php } ?>
 			</select>

 			<button type="submit" name="submit_prikaz">PRIKAZ</button>
 		</form>
 		<?php if ($postojeci_message !=''): ?>
 			REZULTATI: <br>
 			<table >
 				<th>User</th><th>Email</th><th>Poruka</th>
 				<?php foreach ($postojeci_message as $message) { ?>
 				<tr>
 					<td><?=$message['name'];?></td>
 					<td><?=$message['email'];?></td>
 					<td><?=$message['message'];?></td>
 				</tr>
 				<?php } ?>
 			</table>
 		<?php endif ?>
 	</fieldset>
 	<br><br>
 	<a href="send.php">Send Message</a>
 
 </body>
 </html>