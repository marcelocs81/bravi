( function( $ ){
	$( document ).ready(function() {
		$('#search-movie').on('submit', function(evt){
			evt.preventDefault();
			
			var sUrl, sMovie;
			
			sMovie = $('#search-movie').find('input').val();
			
			sUrl = apiUrl + '&type=movie&s=' + sMovie ;
			
			movies(sUrl);
		});

		function movies(sUrl) {
			var oData, output;
			var $movies = $('#movies');
			$movies.hide();

			$.ajax(sUrl, {
				beforeSend: function() {
					$movies.html('<div class="alert alert-info">Loading</div>');
					$movies.show();
				},
				complete: function(p_oXHR, p_sStatus){
					oData = $.parseJSON(p_oXHR.responseText);
					
					var qtd = Object.keys(oData.Search).length;
					
					if (oData.Response === "False") {
						output='<div class="alert alert-danger">Movie not Found!</div>';
					} else {
						output = '<ul class="none">';
						$.each(oData.Search, function(index, movie) {
							output += `
							<li id="${movie.imdbID}" class="row well">
								<div class="col-md-3 text-center">
								  <img src="${movie.Poster}" class="movie-poster">
								</div>
								<div class="col-md-9">
								  <h3>${movie.Title}</h3>
								  <p>${movie.Year}</p>
								  <a onclick="addFavorite('${movie.imdbID}')" class="btn btn-primary favorite">Mark as Favorite</a>
								</div>
							  </li>
							`;
						});
						output += '</ul>';
					}

					$movies.html(output);
					$movies.append('<div class="qtd-total">Total Movies: '+qtd+'</div>');
					$movies.show();
				},
				error: function(jqXHR, exception) {
					if (jqXHR.status === 0) {
						alert('Not connect.\n Verify Network.');
					} else if (jqXHR.status == 404) {
						alert('Requested page not found. [404]');
					} else if (jqXHR.status == 500) {
						alert('Internal Server Error [500].');
					} else if (exception === 'parsererror') {
						alert('Requested JSON parse failed.');
					} else if (exception === 'timeout') {
						alert('Time out error.');
					} else if (exception === 'abort') {
						alert('Ajax request aborted.');
					} else {
						alert(jqXHR.responseText);
					}
					return false;
				}
			});
		}
	});
})(jQuery);


function addFavorite(id) {
	var url = pluginUrl.dir+'add_favorite.php',
		jBtn = jQuery('#' + id).find('a');

	jQuery.ajax({
		url: url,
		method: "GET",
		data: {imdbID:id},
		beforeSend: function () {
			jBtn.addClass('disabled');
		},
		success: function(result){

			jBtn.removeClass('btn-primary');
			jBtn.addClass('btn-success');
			jBtn.text('Added to favorites');

		},
		error: function(result) {
			alert("Error to insert");
			jBtn.removeClass('disabled');
		}
	});

	return false;
}
