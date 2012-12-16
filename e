$("#dcBtn").click(function(){
       var message = $("textarea").val();

       var old = $("#contentMessages").html();

       $("#contentMessages").html(old + '<p>' + message + '</p>'); // ajout de message
       $("#contentMessages").scrollTop($("#contentMessages")[0].scrollHeight); //Auto scroll down à chaque ajout de message.

      $("textarea").val(''); //Nettoyage de la textarea
        //
      });
      
      
      
      <textarea rows="3" cols="45"> ici un post</textarea>