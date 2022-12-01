function sh_ChangeUrl(page, url) {
      if (typeof (history.pushState) != "undefined") {
          var obj = { Page: page, Url: url };
          history.pushState(obj, obj.Page, obj.Url);
      } else {
          alert("Browser does not support HTML5.");
      }
  }
function sh_load_url(URL, FrameId, to='html'){
	if(FrameId=="alert"){ alert(URL); } else {
		$.ajax({
			url:URL,
			method:"POST",
			data:{},

			success:function(data)
			{
				if(to=="html"){ 
					$(FrameId).html(data); 
					if(FrameId=="#sh-Modal-Ajax"){ 
						//$("#sh-Modal-Ajax").modal("show");
						const sh_Modal_Ajax = new bootstrap.Modal(document.getElementById('sh-Modal-Ajax'), {
							backdrop: true
						})
    					sh_Modal_Ajax.show();
					}
				}
				if(to=="val"){ 
					$(FrameId).val(data);
					//alert("ahgf");
					
				}
				//alert(data);
				return data;
				//var return_n = "200 OK";
			}
		});
		//if(FrameId=="#sh-Modal-Ajax"){ $("#sh-Modal-Ajax").modal("show"); }
		

	} // Line if
	//return return_n;
}
function sh_PasswordGen(length){
	var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	var pass = "";
	for (var x = 0; x < length; x++) {
		var i = Math.floor(Math.random() * chars.length);
		pass += chars.charAt(i);
	}
	return pass;
}
function sh_copyToClipboard(element) {
	var $temp = $("<input>");
	$("body").append($temp);
	$temp.val($(element).text()).select();
	document.execCommand("copy");
	$temp.remove();
}

function sh_copyToClipboard_v2(element) {
	var copyText = document.getElementById(element);
	copyText.select();
	copyText.setSelectionRange(0, 99999)
	document.execCommand("copy");
  }


function sh_Modal_Sidebar(){
	var content = $("#sh-Sidebar").html();
	$("#sh-Modal-Ajax").html(content);
	$("#sh-Modal-Ajax").modal("toggle");
	//$("#sh-Modal-Sidebar").modal("toggle");
	$("#sh-Modal-Ajax").css({"z-index": "1029", "margin-top": "54px"});
	document.querySelector(".modal-backdrop").style.zIndex = 1028;
}

function sh_NotificationBS4(Text, Options = {delayTime: "3000"}){
	
	if(Options["delayTime"]==undefined){ Options['delayTime']='3000'; } 
	if(Options["closeIcon"]==undefined){ Options['closeIcon']=true; } 

	var UniqID=Date.now();

	if(Options.playSound){ sh_playSound(Options.playSound); } 
	//alert(Options.delayTime);
	var toastNot='<div id="sh-NotificationID' + UniqID + '" class="toast ml-auto ' + Options.cssClass + ' " style="width:300px;" role="alert" '; // Start Notification
		if(Options.delayTime>0){ 
			var toastNot=toastNot + 'data-delay="' + Options.delayTime + '" data-autohide="true" '; } // Automatic Hide
		else { 
			var toastNot=toastNot + 'data-delay="30000" data-autohide="false" '; 
			if(Options["headerTitle"]=="undefined"){  Options['headerTitle']='Notofication';   }
		} // Auto Hide or Not
		var toastNot=toastNot + '>'; 
    if(Options.headerTitle){ // Header
		var toastNot=toastNot + '<div class="toast-header"><strong class="mr-auto text-primary">' + Options.headerTitle + '</strong>';
		if(Options.headerTime){ var toastNot=toastNot + '<small class="text-muted">' + Options.headerTime + '</small>'; }
		if(Options.closeIcon==true){ var toastNot=toastNot + '<button type="button"  class="ml-2 mb-1 close" onclick="sh_Notification_remove(\'#sh-NotificationID' + UniqID + '\')"><span aria-hidden="true">×</span></button>'; }
		var toastNot=toastNot + '</div>';
	} // Header
    var toastNot=toastNot + '<div class="toast-body">' + Text + '</div>';
    var toastNot=toastNot + '</>';

    $("#sh-Notification").prepend(toastNot);
    $('.toast').toast('show');
	if(Options.delayTime>0){ setTimeout(function(){ $("#sh-NotificationID" + UniqID).remove(); }, Options.delayTime); }
	
	
}

function sh_Notification_remove(NotficationID){
	$(NotficationID).remove();
}

function sh_playSound(sound){
	var myAudio = new Audio('audio/sounds/' + sound + '.mp3');
	myAudio.play();
}
