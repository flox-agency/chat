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
	

	
	
	 <script>
    $(document).ready(function() {
      $("#dclive").click (function() {
        $("#container").animate({bottom:0},200);
         $("#contentMessages").scrollTop($("#contentMessages")[0].scrollHeight);
        $("#dclive").hide();
        $("#online").show();
      });

      $("#online").click (function() {
        $("#container").animate({bottom:-451},200);
        $("#online").hide();
        $("#dclive").show();
      });
      
      
    

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
      	   
      	   
      	return false;
     
      });
      
   
      
      
    });
  </script>
  
  
  <?php
  
     // initialisation des  variables:
     
    $lat = 0;
    $long = 0;
    $country = "unknown";
	
	
    // le type de client:
    
    $userAgent  = getenv('HTTP_USER_AGENT');
	
	
	$browser = get_browser(null, true);

    // recuperer Ip:
    
    $ipAddress = getenv('REMOTE_ADDR'); 
	
	
	echo $userAgent;
	echo "<br />";
	echo $ipAddress;
	
	echo "<br />";
	
	print_r($browser);
	
	echo "<br />";
	
	
	//  http://www.hostIP.info nous permettra de recuperer la LAT et la LONG
    // a partir de IP @.  
    $IpLocatorUrl = "http://api.hostip.info/get_html.php?ip=";
   // add the IP address:
    $IpLocatorUrl .= $ipAddress;
	
	
	$ch = curl_init();
    
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
   curl_setopt($ch, CURLOPT_URL,$IpLocatorUrl);
   
   curl_setopt($ch, CURLOPT_HEADER, false);
   
   $ipDetails_json=curl_exec($ch);

   // close cURL resource, and free up system resources
   curl_close($ch);
  
    
   $obj = json_decode($ipDetails_json);
   
    if (preg_match('/FRANCE FR/', $ipDetails_json)) {
    	
		
	}

  
  echo ( $ipDetails_json) ;
  
  ?>
  
	
	
  <div id="container" style="bottom: -451px;">
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
      
      <textarea rows="3" cols="45" name="messages"> Saisir votre requete !!!</textarea>
      <input type="submit" id="dcBtn" value="Envoyer" />
      </form> 
    </div>
   
  </div>

 
</body>
</html>

