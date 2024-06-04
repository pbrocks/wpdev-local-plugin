<?php

add_filter(
	'pre_option_upload_path',
	function ( $upload_path ) {
		return '/wp-content/uploads/';
	}
);

add_filter(
	'pre_option_upload_url_path',
	function ( $upload_url_path ) {
		return '//evolutionaryhumandesign.com/wp-content/uploads/';
	}
);
