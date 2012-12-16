<?php
  
       include 'config.php';
		
		// Execution d'une  requete :
 		$db->query('SELECT * FROM messages');
		
		// on recupere le resultat de  $db->query('SELECT * FROM messages') et on charge dans la variable data
		$data = $db->Get();
		
	    // on affiche chaque message contenu dans data (nb : data est un Array)
		foreach ($data as $key => $value) {
			echo "<p>".   $value['message']. "<br />" ."</p>";
		}
  
