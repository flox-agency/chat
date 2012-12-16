<?php

    // inclusion des fichiers necessaire a l'envoi d'un post
    include 'config.php';
	
	// recuperation du message posté lors de l'envoi de du formulaire	
    $message = $_POST['messages'];	

    // requette permettant d'envoyer le message a la base de données 
    $db->Query("INSERT INTO messages(message) VALUES('$message')")	;
	
	// grace a cette echo on pourra affiche le message 	
    echo $message;
	
	
	