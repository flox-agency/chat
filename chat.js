$(document).ready(function() {
  //minimisation de la fenêtre de chat
  $('#contentMessages').hide();
  $('#message').hide();

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