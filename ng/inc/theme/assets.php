<?php

/**
 * Register and enqueue theme styles
 *
 * @return void
 */
function ng_styles()
{
    global $wp_styles;

    $dev = ( (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) || !is_dir(ABSPATH . 'dist') );
    $version = $dev ? filemtime(get_template_directory() . '/assets/css/main.css') : filemtime(ABSPATH . 'dist/main.min.css');

    // Add Normalize.css
    wp_register_style(
        'normalize'
        ,$dev ? get_template_directory_uri() . '/assets/css/normalize.css' : site_url() . '/dist/normalize.min.css'
        ,array()
        ,$version
    );

    // Add Base Stylesheet File
    wp_register_style(
        'site_base'
        ,$dev ? get_template_directory_uri() . '/assets/css/base.css' : site_url() . '/dist/base.min.css'
        ,array('normalize')
        ,$version
    );

    // Add Main Stylesheet File
    wp_register_style(
        'site_main'
        ,$dev ? get_template_directory_uri() . '/assets/css/main.css' : site_url() . '/dist/main.min.css'
        ,array('normalize', 'site_base')
        ,$version
    );

    // Add IE Stylesheet File
    wp_register_style(
        'site_ie'
        ,$dev ? get_template_directory_uri() . '/assets/css/ie.css' : site_url() . '/dist/ie.min.css'
        ,array()
        ,$version
    );
    $wp_styles->add_data( 'site_ie', 'conditional', 'IE' );


    if( ! is_admin() )
    {
        wp_enqueue_style( 'site_main' );
        wp_enqueue_style( 'site_ie' );
    }
}
add_action( 'wp_enqueue_scripts', 'ng_styles' );


/**
 * Register and enqueue theme scripts
 *
 * @return void
 */
function ng_scripts()
{
    $dev = ( (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) || !is_dir(ABSPATH . 'dist') );
    $version = $dev ? filemtime(get_template_directory() . '/assets/js/main.js') : filemtime(ABSPATH . 'dist/main.min.js');

    // Add Modernizr js File
    wp_register_script(
        'modernizr'
        ,get_template_directory_uri() . '/assets/js/vendor/modernizr.min.js'
        ,false
        ,'2.8.2'
    );

    // Add Plugins js File
    wp_register_script(
        'site_plugins'
        ,$dev ? get_template_directory_uri() . '/assets/js/plugins.js' : site_url() . '/dist/plugins.min.js'
        ,array('jquery')
        ,$version
        ,true
    );

    // Add Global js File
    wp_register_script(
        'site_main'
        ,$dev ? get_template_directory_uri() . '/assets/js/main.js' : site_url() . '/dist/main.min.js'
        ,array('jquery', 'site_plugins')
        ,$version
        ,true
    );

    if( ! is_admin() )
    {
        wp_enqueue_script(  'modernizr' );
        wp_enqueue_script(  'site_main' );
        wp_localize_script( 'site_main', 'NG', array('ajaxurl' => admin_url( 'admin-ajax.php' ), 'siteurl' => site_url() ) );
    }
}
add_action( 'wp_enqueue_scripts', 'ng_scripts' );
