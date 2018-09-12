( function( $ ){

	$(document).ready(function() {
		var tableFav = $('#tab-favorites').DataTable({
			columnDefs: [
				{visible: false, targets: "ocultar"},
				{orderable: false, targets: 'no-sort'}
			],
			stateSave: false,
			bProcessing: true,
			displayLength: 5,
			order: [[ 1, "asc" ]],
			lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
		});

	});
})(jQuery);

function removeFavorite(id) {
    var url = pluginUrl.dir+'remove_favorite.php';

	var tableFav = jQuery('#tab-favorites').DataTable(),
		jRow = jQuery('#' + id);

	jQuery.ajax({
	  url: url,
	  method: "GET",
	  data: {imdbID:id},
		beforeSend: function () {
			jRow.addClass('disabled');
			jRow.find('a').addClass('disabled');
		},
		success: function(result){
			jRow.find('a').hide();
			jRow.find('a').parent().append('<span class="label label-success">Removed</span>');

			window.setTimeout(function() {
				tableFav.row('#' + id).remove().draw( false )
			}, 1000);
		},
		error: function(result) {
			jRow.removeClass('disabled');
			jRow.find('a').removeClass('disabled');
			alert("Error to delete");
			return false;
		}
	});
	
	return false;
}
