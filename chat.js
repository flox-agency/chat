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

    var data = new Object;
    data.message = $('#chat_input').val();
    data.visitorId = '83511i528145111l';

    // on poste le message en base de données
    $.post('/dclivechat/messages/send',data, function(data) {
    // et on affiche le message dans la zone contentMessages du LiveCaht
    //$("#contentMessages").append("<p>" +data+"</p>");

    //Auto scroll down à chaque ajout de message.
    //$("#contentMessages").scrollTop($("#contentMessages")[0].scrollHeight); 

  });

  	//Nettoyage de la textarea
  	$("textarea").val('');
    $("textarea").focus();
    $("textarea").css('height','44px');

    return false;
  });

  refreshList();
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

function refreshList () {
  ts = localStorage.getItem('ts');
  cId = localStorage.getItem('cId');

  if(!ts) ts = 0;
  if(!cId)

  var now = new Date(),
  nowTs = Math.round( (now.getTime()/1000)+(now.getTimezoneOffset()*60));

  localStorage.setItem('ts',nowTs);

  var data = new Object();
  data.ts = ts;
  data.visitorId = '83511i528145111l';

  $.ajax({
    url:"\/dclivechat\/messages\/visitorPoll",
    dataType:"html",
    data: data, 
    success : function (data) {
      if( (data!=$('#contentMessages').html()) && ($("#message").is(":hidden"))) {
        $('#message').toggle('fast');
        $('#contentMessages').toggle('fast');
      }
      $("#contentMessages").html(data);
      $("#contentMessages").scrollTop($("#contentMessages")[0].scrollHeight);
      refreshList();
    }
  });
  return false;
}