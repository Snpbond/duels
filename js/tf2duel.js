//TF2 Duel Jquery file

$(document).ready(function searchPlayer($){
	$('#searchPlayers').autocomplete({
		source:'searchplayer.php', 
		minLength:2,
		select: function(event, ui) {
			$('#popupModal').reveal();playerInfo(ui.item.value,'#popupModal','#spinnertop');
			$('#searchPlayers').val("");
			return false;
		}
	});
});

function editSite(value,action,id){
		$.post("jq-proxy_edit.php",
		{
				site_id:id,
				site_data:value,
				action:action
		},
				function(data,status){
						if(data){
								if(data == 'Deleted'){
										$('#tr'+id).hide('fast');
								}else{
										if(action == 'addSite'){
												addRow('viewtickets',value,id,data);
										}else{
												document.getElementById('tr'+id).style.backgroundColor=data;
								}       }
						}
		});
};

function top100(id,spinner){
	$.get('top100.php', function(data) {
	  $(id).html(data);
	  $(spinner).hide();
	});
}

function duelInfo(duelid,id,spinner){
	$.post('duelinfo.php',{id: duelid}, function(data) {
	  $(id).html(data);
	  $(spinner).hide();
	});
}

function playerInfo(steamid,id,spinner){
	$.post('playerinfo.php',{id: steamid}, function(data) {
	  $(id).html(data);
	  $(spinner).hide();
	});
}

function updatePlayer(id){
	$.get('updateplayer.php',{id: id}, function(data) {
	  document.getElementById(id).innerHTML = data;
	});
}
