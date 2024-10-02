<?php

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );

if ( 'dahawellness.com' !== $_SERVER['HTTP_HOST'] ) {
    add_filter(
        'pre_option_upload_path',
        function ( $upload_path ) {
            return '/wp-content/uploads/';
        }
    );

    add_filter(
        'pre_option_upload_url_path',
        function ( $upload_url_path ) {
            return '//dahawellness.com/wp-content/uploads/';
        }
    );
}