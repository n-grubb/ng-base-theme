<?php
/**
 * Set Up theme support and functionality
 *
 * @return void
 */
function ng_setup()
{
     // Add our own editor style
    add_editor_style();
    add_theme_support('title-tag');

    // Post Formats
    //add_theme_support( 'post-formats', array('gallery', 'image', 'video', 'audio') );

    // Theme Images
    add_theme_support( 'post-thumbnails' );
    //add_image_size( 'page-header', 1600, 396, true ); // true hard crops, false proportional

    // HTML5 Support
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
}
add_action( 'after_setup_theme', 'ng_setup' );



/**
 * Register functionality, initilize plugin functionality
 *
 * @return void
 */
function ng_init()
{
    // Register Menu
    register_nav_menus(array(
         'top_menu'  => 'Navigation items above header tools & search.'
        ,'main_menu' => 'Navigation items for the main menu.'
    ));
}
add_action( 'init', 'ng_init' );


/**
 *  Register sidebars and widgets
 *
 *  @return  void
 */
function ng_widget_init()
{
    // Sidebar
    register_sidebar(array(
      'name' => __( 'Main Sidebar Widgets' ),
      'id' => 'sidebar',
      'description' => __( 'Widgets for the default sidebar' ),
      'before_title' => '<h3>',
      'after_title' => '</h3>',
      'before_widget' => '<div class="widget %2$s" id="%1$s" >',
      'after_widget'  => '</div>'
    ));
}
add_action( 'widgets_init', 'ng_widget_init' );


/**
 * Add "Styles" drop-down
 *
 * @param  array $buttons current buttons to be setup
 * @return array
 */
function ng_mce_editor_buttons( $buttons )
{
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'ng_mce_editor_buttons' );


/**
 * Add styles/classes to the "Styles" drop-down
 *
 * @param  array $settings settings array for tiny mce
 * @return  void
 */
function ng_mce_before_init( $settings )
{
    $style_formats = array(
        array(
            'title' => 'Block List',
            'selector' => 'ul',
            'classes' => 'two-column'
        )
        ,array(
            'title' => 'Button',
            'selector' => 'a',
            'classes' => 'button'
        )
        ,array(
            'title' => 'Push',
            'selector' => 'p,ul,ol,a',
            'classes' => '.push'
        )
        ,array(
            'title' => 'Push Top',
            'selector' => 'p,ul,ol,a',
            'classes' => '.push--top'
        )
        ,array(
            'title' => 'Push Right',
            'selector' => 'p,ul,ol,a',
            'classes' => '.push--right'
        )
        ,array(
            'title' => 'Push Bottom',
            'selector' => 'p,ul,ol,a',
            'classes' => '.push--bottom'
        )
        ,array(
            'title' => 'Push Left',
            'selector' => 'p,ul,ol,a',
            'classes' => '.push--left'
        )
        ,array(
            'title' => 'Push Ends',
            'selector' => 'p,ul,ol,a',
            'classes' => '.push--ends'
        )
        ,array(
            'title' => 'Push Sides',
            'selector' => 'p,ul,ol,a',
            'classes' => '.push--sides'
        )
        ,array(
            'title' => 'Flush',
            'selector' => 'p,ul,ol,a',
            'classes' => '.flush'
        )
        ,array(
            'title' => 'Flush Top',
            'selector' => 'p,ul,ol,a',
            'classes' => '.flush--top'
        )
        ,array(
            'title' => 'Flush Right',
            'selector' => 'p,ul,ol,a',
            'classes' => '.flush--right'
        )
        ,array(
            'title' => 'Flush Bottom',
            'selector' => 'p,ul,ol,a',
            'classes' => '.flush--bottom'
        )
        ,array(
            'title' => 'Flush Left',
            'selector' => 'p,ul,ol,a',
            'classes' => '.flush--left'
        )
        ,array(
            'title' => 'Flush Ends',
            'selector' => 'p,ul,ol,a',
            'classes' => '.flush--ends'
        )
        ,array(
            'title' => 'Flush Sides',
            'selector' => 'p,ul,ol,a',
            'classes' => '.flush--sides'
        )
        ,array(
            'title' => 'Button',
            'selector' => 'a,input,button',
            'classes' => '.button'
        )

        /* Examples for adding styles
        array(
            'title' => 'Call Out Text',
            'selector' => 'p',
            'classes' => 'callout'
        )
        ,array(
            'title' => 'Warning Box',
            'block' => 'div',
            'classes' => 'warning box',
            'wrapper' => true
        )
        ,array(
            'title' => 'Red Uppercase Text',
            'inline' => 'span',
            'styles' => array(
                'color' => '#ff0000',
                'fontWeight' => 'bold',
                'textTransform' => 'uppercase'
            )
        )
        */
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;
}
add_filter( 'tiny_mce_before_init', 'ng_mce_before_init' );


