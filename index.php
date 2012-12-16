<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="contentMessages-Type" contentMessages="text/html; charset=utf-8" />
  <title>DCLiveChat</title>
  <meta name="author" contentMessages="Jeffart-Ced" />
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
  <link href="http://fonts.googleapis.com/css?family=Merienda+One" rel="stylesheet" type="text/css" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <!-- Date: 2012-12-15 -->
</head>
<body>
	
	<div> Hello User</div>
	
	<?php # Script 11.3 - ip_geo.php
	
	// This page uses a Web service to retrieve a user's geographic location.

	// This function will perform the IP Geolocation request:
	function show_ip_info($ip) {
		// Identify the URL to connect to:
		$url = '#';
		//http://www.ipaddresslocation.org/ip-address-locator.php
		$curl = curl_init($url);
		
		 // Open the connection:
		// $fp = fopen($url, 'r');
		 
		
		// Allow for redirects:
      // $d =  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		
		var_dump($curl) ;
		
		//echo  $d;
		 
		// Execute the transaction:
        $r = curl_exec($curl);

   // Close the connection:
   curl_close($curl);

  // Print the results:
   print_r($r);
		 
		 // Print whatever about the IP:
		 echo "<p>IP Address: $ip<br>
		 Country: $read[2]<br>
		 City, State: $read[5], $read[3]<br>";
	
	} // End of show_ip_info() function.
	
	
	?>
	
	<?php
	echo '<h2> Ip information </h2>';
	
	
    show_ip_info($_SERVER ['REMOTE_ADDR']);
	
	

	?>
	
	
	 <script>
    $(document).ready(function() {
      $("#dclive").click (function() {
        $('#contentMessages').toggle('fast');
        $('#message').toggle('fast');
        $("#contentMessages").scrollTop($("#contentMessages")[0].scrollHeight);
        $("#dclive").hide();
        $("#online").show();
      });

      $("#online").click (function() {
        $('#contentMessages').toggle('fast');
        $('#message').toggle('fast');
        $("#online").hide();
        $("#dclive").show();
      });

      $("textarea").val('');
      
      
    

      // Chargement des messages de la base de données
      $("#contentMessages").load('ajaxLoad.php');
      
      // des que l'utilisateur click sur le bouton 
      $("#userArea").submit(function() {
        // on poste le message en base de données
        $.post('ajaxPost.php',$('#userArea').serialize(), function(data) {
        // et on affiche le message dans la zone contentMessages du LiveCaht
        $("#contentMessages").append("<p>" +data+"</p>");
    
        //Auto scroll down à chaque ajout de message.
      	$("#contentMessages").scrollTop($("#contentMessages")[0].scrollHeight); 
      	   	   
      	});
      	   
      	//Nettoyage de la textarea
      	$("textarea").val('');
        $("textarea").focus();
        $("textarea").css('height','44px');

        return false;
      });
    });

    function checkChatboxInputKey (event,chatboxtextarea) {
      //Si la touche appuyée est "Entrée"
      if(event.keyCode == 13 && event.shiftKey == 0) {
         $("#userArea").submit();
         return false;
      }

      //Sinon on ajuste la taille de la texte area
      var adjustedHeight = chatboxtextarea.clientHeight;
      var maxHeight = 94;

      if (maxHeight > adjustedHeight) {
        adjustedHeight = Math.max(chatboxtextarea.scrollHeight, adjustedHeight);
        if (maxHeight)
          adjustedHeight = Math.min(maxHeight, adjustedHeight);
        if (adjustedHeight > chatboxtextarea.clientHeight)
          $(chatboxtextarea).css('height',adjustedHeight+8 +'px');
      } else {
        $(chatboxtextarea).css('overflow','auto');
      }

    };
  </script>
	
	
  <div id="container" style="bottom: 0px;" onClick="$('textarea').focus();">
    <div id="title">
      <a id="dclive" href="#">DC Live Chat</a>
      <a id="online" href="#">Connecté</a>
    </div>
    
    <!-- Display -->
    
    <div id="contentMessages">
      
    </div>
    
    
    <!-- Post -->
    
    <div id="message">
    	<form id="userArea">
      
      <textarea rows="3" cols="45" name="messages" onkeydown="javascript: return checkChatboxInputKey(event,this);"></textarea>
      <input type="submit" id="dcBtn" value="Envoyer" />
      </form> 
    </div>
   
  </div>

 
</body>
</html>

