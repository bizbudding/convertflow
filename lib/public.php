<?php

namespace ConvertFlow\Plugin;

add_action( 'wp', function () {
	s( authenticate_api_credentials() );
} );
