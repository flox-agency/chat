$("#dcBtn").click(function(){
       var message = $("textarea").val();

       var old = $("#contentMessages").html();

       $("#contentMessages").html(old + '<p>' + message + '</p>'); // ajout de message
       $("#contentMessages").scrollTop($("#contentMessages")[0].scrollHeight); //Auto scroll down à chaque ajout de message.

      $("textarea").val(''); //Nettoyage de la textarea
        //
      });
      
      
      
      <textarea rows="3" cols="45"> ici un post</textarea>
      
      
      
      
      <?php # Script 11.3 - ip_geo.php
10   // This page uses a Web service to retrieve a user's geographic location.
11
12   // This function will perform the IP Geolocation request:
13   function show_ip_info($ip) {
14
15      // Identify the URL to connect to:
16      $url = 'http://freegeoip.net/csv/' . $ip;
17
18      // Open the connection:
19      $fp = fopen($url, 'r');
20
21      // Get the data:
22      $read = fgetcsv($fp);
23
24      // Close the "file":
25      fclose($fp);
26
27      // Print whatever about the IP:
28      echo "<p>IP Address: $ip<br>
29      Country: $read[2]<br>
30      City, State: $read[5], $read[3]<br>
31      Latitude: $read[7]<br>
32      Longitude: $read[8]</p>";
33
34   } // End of show_ip_info() function.
35
36   // Get the client's IP address:
37   echo '<h2>Our spies tell us the following information about you</h2>';
38   show_ip_info($_SERVER['REMOTE_ADDR']);
39
40   // Print something about a site:
41   $url = 'www.entropy.ch';
42   echo "<h2>Our spies tell us the following information about the URL $url</h2>";
43   show_ip_info(gethostbyname($url));
44
45   ?>













	<?php
/**
 * GetIpDetails
 * Author : S.MohanKumar
 * IP API from ipinfodb.com & Google Chart API
 **/
$realIp='';
function GetIpDetails($realIp){
//check if you have curl loaded
if(!function_exists("curl_init")) die("cURL extension is not installed");
// create a new cURL resource
$ch = curl_init();
//ipinfodb.com API Key
$ipinfodbApiKey='3cec4c0b6b92a1de5cc47d93ba0bb3be85609a08d150524d51ee9d840d675e33';

// set URL and other appropriate options
$url="http://api.ipinfodb.com/v3/ip-city/?key=".$ipinfodbApiKey."&format=json&ip=".$realIp;
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, false);

// grab URL and pass it to the browser
$ipDetails_json=curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);

return $ipDetails_json;
$obj = json_decode($ipDetails_json);
}

function getRealIpAddress()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    //check ip from share internet
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    //to check ip is pass from proxy
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
return $ip;
}

getRealIpAddress(); // display the real IP address
echo "<br/>";
$openIp=getRealIpAddress($realIp);
$ipDetails_json =GetIpDetails($openIp);
$obj = json_decode($ipDetails_json);
?>
<script type='text/javascript' src='https://www.google.com/jsapi'></script>
  
   <div id='map_canvas' style="width:600px"></div>

  <fieldset>
    <legend><b>Ip Details </b></legend>
<?php
		echo "<b>IPaddress :</b> ".$obj->{'ipAddress'}."<br/>"; // IpAddress
		echo "<b>Country name :</b> ".$obj->{'countryName'}."<br/>"; // countryName
		echo "<b>State name :</b> ".$obj->{'regionName'}."<br/>"; // regionName
		echo "<b>City name :</b> ".$obj->{'cityName'}."<br/>"; // cityName
		
		echo "<b>Time zone :</b> ".$obj->{'timeZone'}."<br/>"; // timeZone
?>
	</fieldset>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
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
	
	
	
	
	//  http://www.hostIP.info nous permettra de recuperer la LAT et la LONG
    // a partir de IP @.  
    $IpLocatorUrl = "http://api.hostip.info/?&position=true&ip=";
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
    	
		echo "HelloWord";
	}

  
  echo
  ( $ipDetails_json) ;
  
  ?>
  