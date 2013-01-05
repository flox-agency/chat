<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="contentMessages-Type" contentMessages="text/html; charset=utf-8" />
  <title>DCLiveChat</title>
  <meta name="author" contentMessages="Jeffart-Ced" />
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
 
  <!-- Date: 2012-12-15 -->
</head>
<body>
  
  <div> Hello User</div>

  <?php
  
     // initialisation des  variables:
     
    $lat = 0;
    $long = 0;
    $country = "unknown";
  
  
    // le type de client:
    
    $userAgent  = getenv('HTTP_USER_AGENT');
  
  

    // recuperer Ip:
    
    $ipAddress = getenv('REMOTE_ADDR'); 
  
  
  echo $userAgent;
  echo "<br />";
  echo $ipAddress;
  
  
  
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
  
  <script>
    window.addEventListener('message', receiver, false);
   
   
    function receiver(e) {
       
        var myStyle = document.getElementById('container').style;
      
        myStyle.position= "fixed";
        myStyle.bottom= e.data+"px";
    }
    
    </script>
  
  
  
  <div id="container" style="bottom: 0px;" onClick="$('textarea').focus();">
    <iframe src="http://ilikeweb.fr/chatapp/chatgadget.php"></iframe>
  </div>
</body>
</html>

