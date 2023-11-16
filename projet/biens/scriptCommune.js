// autocompletion
function autocompletCommune() {
	var min_length = 1; // nombre de caractère avant lancement recherch 
	var keyword = $('#commune').val();  // commune fait référence au champ de recherche puis lancement de la recherche grace ajax_refresh
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'ajax_refreshCommune.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#commune_list').show();
				$('#commune_list').html(data);
			}
		});
	} else {
		$('#commune_list').hide();
	}
}

// Lors du choix dans la liste
function set_item_commune(item) {
	// change input value
	$('#commune').val(item);
	$('#commune2').val(item);
	// hide proposition list
	$('#commune_list').hide();
}
