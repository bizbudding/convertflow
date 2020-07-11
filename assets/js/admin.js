( function( $ ) {
	var data   = typeof convertflowSettings === 'undefined' ? {} : convertflowSettings;
	var form   = $( '.convertflow' );
	var submit = $( '.convertflow button' );
	var inputs = $( '.convertflow input' );

	inputs.on( 'input', function() {
		form.attr( 'data-status', 'pending' );
	} );

	submit.on( 'click', function() {
		var api_key    = $( '.convertflow #api_key' );
		var website_id = $( '.convertflow #website_id' );

		submit.addClass( 'running' );

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
				submit.removeClass( 'running' );
				console.log( response );

				if ( 'status' in response ) {
					if ( true === response.status ) {
						form.attr( 'data-status', 'success' );
					} else {
						form.attr( 'data-status', 'error' );
					}
				}
			},
			error: function( response ) {
				submit.removeClass( 'running' );
				form.attr( 'data-status', 'error' );
				console.log( response );
			}
		} );
	} );
} )( jQuery );
