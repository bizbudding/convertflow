( function( $ ) {
	var data          = typeof convertflow === 'undefined' ? {} : convertflow;
	var submit_button = $( '.convertflow #submit_button' );

	submit_button.on( 'click', function() {
		var api_key       = $( '.convertflow #api_key' );
		var website_id    = $( '.convertflow #website_id' );

		$( this ).addClass( 'running' );

		$.ajax( {
			type: 'POST',
			dataType: 'json',
			url: data.ajax_url,
			data: {
				action: data.action,
				nonce: data.nonce,
				api_key: api_key.val(),
				website_id: website_id.val()
			},
			success: function( response ) {
				submit_button.removeClass( 'running' );
				console.log( response );
			},
			error: function( response ) {
				submit_button.removeClass( 'running' );
				console.log( response );
			}
		} );
	} );

} )( jQuery );
