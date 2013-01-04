$(document).ready(function() {
  try {
    var tracker = dcTracker;
    tracker.setUrl(window.location);
    tracker.trackPageView();
  } catch( err ) { console.log(err);}
  
  initChat(tracker);
  refreshList(tracker);
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

function refreshList (tracker) {
  ts = localStorage.getItem('ts');
  cId = localStorage.getItem('cId');

  if(!ts) ts = 0;
  if(!cId)

  var now = new Date(),
  nowTs = Math.round( (now.getTime()/1000)+(now.getTimezoneOffset()*60));

  localStorage.setItem('ts',nowTs);

  var data = new Object();
  data.ts = ts;
  data.visitorId = tracker.visitorInfo.visitorId;


  $.ajax({
    url:"\/dclivechat\/messages\/visitorPoll",
    dataType:"html",
    data: data, 
    success : function (data) {
      if( (data!=$('#contentMessages').html()) && ($("#container",window.parent.document).hasClass('hide'))) {
        $("#container",window.parent.document).css({ bottom :'0px'});
        $("#container",window.parent.document).removeClass('hide');
        $("#dclive").hide();
        $("#online").show();
      }
      $("#contentMessages").html(data);
      $("#contentMessages").scrollTop($("#contentMessages")[0].scrollHeight);
      refreshList(tracker);
    }
  });
  return false;
}

function initChat(tracker) {
  
  //minimisation de la fenêtre de chat
  //$('#contentMessages').hide();
  $("#container",window.parent.document).css({bottom :'-350px'});
  $("#container",window.parent.document).addClass('hide');
  $("#online").hide();
  $("#dclive").show();

  $("#dclive").click (function() {
    $("#container",window.parent.document).css({ bottom :'0px'});
    $("#container",window.parent.document).removeClass('hide');
    $("#contentMessages").scrollTop($("#contentMessages")[0].scrollHeight);
    $("#dclive").hide();
    $("#online").show();
  });

  $("#online").click (function() {
    $("#container",window.parent.document).css({bottom :'-350px'});
    $("#container",window.parent.document).addClass('hide');
    $("#online").hide();
    $("#dclive").show();
  });

  $("textarea").val('');

  var data = new Object();
  data.ts = 0;
  data.visitorId = tracker.visitorInfo.visitorId;
  $.ajax({
    url:"\/dclivechat\/messages\/visitorPoll",
    dataType:"html",
    data: data, 
    success : function (data) {
      $("#contentMessages").html(data);
      $("#contentMessages").scrollTop($("#contentMessages")[0].scrollHeight);
      refreshList(tracker);
    }
  });
  
  // des que l'utilisateur click sur le bouton 
  $("#userArea").submit(function() {

    var data = new Object;
    data.message = $('#chat_input').val();
    data.visitorId = tracker.visitorInfo.visitorId;

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

}

var dcTracker = {

  url : '',
  localtime : new Date(),
  visitorInfo : null,

  setUrl: function (data) {
    this.url = data;
  },

  /**
  *Fonction de formatage de la date.Prend un objet date et le formate sous la forme yyyy-mm-dd H:i:s
  */
  formatDate : function (date){
    //Formatage du jour
    var d = date.getDate();
    if ( d < 10 ) d = '0' + d;

    //Formatage du mois
    var m = date.getMonth()+1;
    if ( m < 10 ) m = '0' + m;

    //Formatage de l'année
    var Y = date.getFullYear();

    //Formatage de l'heure
    var H = date.getHours();
    if ( H < 10 ) H = '0'+H;

    //Formatage des minutes
    var i = date.getMinutes();
    if ( i < 10 ) i = '0'+i;

    //Formatage des secondes
    var s = date.getSeconds();
    if ( s < 10 ) s = '0'+ s;

    return Y+'-'+m+'-'+d+' '+H+':'+i+':'+s;
  },

  loadVisitorInfo : function (){
    var now = new Date (),
    nowTs = Math.round(now.getTime() / 1000);

    this.visitorInfo = JSON.parse(localStorage.getItem('visitorInfo'));

    if(!this.visitorInfo) {

      this.visitorInfo = new Object();

      this.visitorInfo.visitorId = genVisitorId();
      this.visitorInfo.actionCount = 0;
      this.visitorInfo.user_agent = navigator.userAgent;
      this.visitorInfo.hostname = this.url.hostname;
      this.visitorInfo.platform = navigator.platform;
      this.visitorInfo.browser = navigator.appCodeName;
      
    } else {
      if (((this.localtime.getTime() - this.visitorInfo.actionTs)/1000) > 120) {
        this.visitorInfo.actionCount = 0;
      }     
    }
  },

  getRequestData: function() {

    var data = new Object();
    
    this.loadVisitorInfo();

    data.url = this.url.href;
    data.localtime = this.formatDate(this.localtime);
    data.visitorId = this.visitorInfo.visitorId;
    data.actionTs = this.localtime.getTime(); 
    data.actionCount = this.visitorInfo.actionCount+1;
    data.user_agent = this.visitorInfo.user_agent;
    data.hostname = this.visitorInfo.hostname;
    data.platform = this.visitorInfo.platform;
    data.browser = this.visitorInfo.browser;

    localStorage.setItem('visitorInfo',JSON.stringify(data));

    return data;
  },

  trackPageView : function () {
    
    $.post('/dclivechat/visits/add.json',
      this.getRequestData(),
      function(data) {
        console.log(data);
      },
      'jsonp'
    );
  }
};


/**
*Fonction de génération d'un ID pour le visiteur.
*/
function genVisitorId () {
  var d = new Date().getTime();
  var y = new Date().getFullYear();
  var r = (d + Math.random()*12)%10 |0;
  var s =Math.floor(Math.random()*(y*(Math.random()*12)));
  var t = String.fromCharCode(r+97);
  var u =Math.floor(((Math.random()*1000)*d)/(d/1000));
  var f = (d + Math.random()*16)%10 |0;
  var z = Math.floor(Math.random() * 26);
  var g = String.fromCharCode(z+97);
  var components = [r,s,t,u,f,z,g];
  var dc_uuid = components.join("");
  return dc_uuid;
}
