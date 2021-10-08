<?php
	include("db.php"); //Datenbank-Anbindung

//Wenn alles ausgefüllt wurde
if(!empty($_POST['firma']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['comment'])) {
	
	$firma = htmlspecialchars($_POST['firma']);
	$name = htmlspecialchars($_POST['name']);
	$email = htmlspecialchars($_POST['email']);
	$comment = htmlspecialchars($_POST['comment']);

	$duplicate = mysqli_query($verbindung, "SELECT * FROM kontakt WHERE firma='$firma' AND name='$name' AND mail='$email' AND kommentar='$comment'");

	//Daten werden nur hinzugefügt, wenn sie noch nicht in der DB vorhanden sind
	if(mysqli_num_rows($duplicate)>0)
	{
		header("Location: index.php?message=Diese Daten existieren bereits in der Datenbank!");
	}
	else {
		$sql = "INSERT INTO kontakt(id, firma, name, mail, kommentar) VALUES('','$firma','$name','$email','$comment')";
		$execute = mysqli_query($verbindung, $sql);

		header("Location: index.php?message=Die Daten wurden erfolgreich hinzugefügt!");
	}

	mysqli_close($verbindung);
} //Wenn etwas nicht ausgefüllt wurde
elseif(empty($_POST['firma']) || empty($_POST['name']) || empty($_POST['email']) || empty($_POST['comment'])) {
	
	echo "Es wurden nicht alle Felder ausgefüllt!";

	mysqli_close($verbindung);
}
?>