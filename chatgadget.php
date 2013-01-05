<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="contentMessages-Type" contentMessages="text/html; charset=utf-8" />
  <title>DCLiveChat</title>
  <meta name="author" contentMessages="Jeffart-Ced" />
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
  <link href="http://fonts.googleapis.com/css?family=Merienda+One" rel="stylesheet" type="text/css" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script type="text/javascript" src="chat.js"></script>
  <!-- Date: 2012-12-15 -->
</head>
<body>
  <div style="bottom: 0px;" onClick="$('textarea').focus();">
    <div id="title">
      <a id="dclive" href="#">DC Live Chat</a>
      <a id="online" href="#">Connecté</a>
    </div>
    <div id="chatcontent">
      <!-- Display -->
      
      <div id="contentMessages">
        
      </div>
       <script>
    
    function update_parent() {
        parent.postMessage('-350', '*');
    }
     function update_parent2() {
        parent.postMessage('0', '*');
    }
    </script>
      
      <!-- Post -->
      <div class="">
        <div id="message">
          <form id="userArea">
            <textarea rows="3" cols="45" name="message" id="chat_input" onkeydown="javascript: return checkChatboxInputKey(event,this);"></textarea>
          </form> 
        </div>
      </div>
    </div>
  </div>
</body>
</html>

