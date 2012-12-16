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
	
	<?php 
    $ip = $_SERVER['REMOTE_ADDR'];
    $ip_data = get_ip_info($ip);
    echo('Hostname ### ' . $ip_data['host'] . '<br/>');
    echo('IP Country ### ' . $ip_data['country'] . '<br/>');
    echo('IP Country Code ### ' . $ip_data['country_code'] . '<br/>');
    echo('IP Continent ### ' . $ip_data['continent'] . '<br/>');
    echo('IP Region ### ' . $ip_data['region'] . '<br/>');
    echo('IP Latitude ### ' . $ip_data['latitude'] . '<br/>');
    echo('IP Longitude ### ' . $ip_data['longitude'] . '<br/>');
    echo('Organization ### ' . $ip_data['organization'] . '<br/>');
    echo('ISP Provider ### ' . $ip_data['isp']);

    function get_ip_info($ip = NULL) 
    { 
       if(empty($ip)) return false; 
       $ch = curl_init(); 
       curl_setopt($ch, CURLOPT_URL, 'http://www.ipaddresslocation.org/ip-address-locator.php'); 
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
       curl_setopt($ch, CURLOPT_POST, true); 
       curl_setopt($ch, CURLOPT_POSTFIELDS, array('ip' => $ip)); 
       $data = curl_exec($ch); 
       curl_close($ch);     
       preg_match_all('/<i>([a-z\s]+)\:<\/i>\s+<b>(.*)<\/b>/im', $data, $matches, PREG_SET_ORDER); 
       if(count($matches) == 0) return false;    
       $return = array(); 
       $format_labels = array(
            'Hostname'          => 'host', 
            'IP Country'        => 'country', 
            'IP Country Code'   => 'country_code', 
            'IP Continent'      => 'continent', 
            'IP Region'         => 'region', 
            'IP Latitude'       => 'latitude', 
            'IP Longitude'      => 'longitude', 
            'Organization'      => 'organization', 
            'ISP Provider'      => 'isp' 
       ); 
       foreach($matches as $info) 
       { 
          if(isset($info[2]) && !is_null($format_labels[$info[1]])) 
          { 
             $return[$format_labels[$info[1]]] = $info[2]; 
          } 
       }
       return (count($return)) ? $return : false; 
    }
?>
	

	
	
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
      
      <textarea rows="3" cols="45" name="messages"> Découvrez notre collection de prêt-à-porter pour homme :
      	 vêtements pour homme et accessoires de mode masculine, 
      	 dans notre boutique en ligne ou l'un de nos 240 magasins</textarea>
      <input type="submit" id="dcBtn" value="Envoyer" />
      </form> 
    </div>
   
  </div>

 
</body>
</html>

