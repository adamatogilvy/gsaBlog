<?php

//----------------------------//
    // ENQUEUE SCRIPTS
//----------------------------//
    add_action( 'wp_enqueue_scripts', 'load_javascript_files' );
    function load_javascript_files() {
        wp_deregister_script( 'jquery' );
        // first register
        wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery-2.1.1.min.js',false, '2.1.1', null);
        wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2.min.js',false, '2.6.2', null);
        wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.0', true);
        wp_register_script( 'app', get_template_directory_uri().'/js/app.js',array('jquery'), '1',null );
        wp_register_script( 'headerHover', get_template_directory_uri().'/js/jquery.hoverIntent.minified.js',false, null,null );
        wp_register_script( 'gsaHeader', get_template_directory_uri().'/js/gsa-header.js',array('jquery'), '1',null );
        wp_register_script( 'addThis', 'http://s7.addthis.com/js/250/addthis_widget.js#pubid=gsagov',false, null ,null );
		wp_register_script( 'masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', false, null, null);
        // then enqueue
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'headerHover' );
        wp_enqueue_script( 'gsaHeader' );
        wp_enqueue_script( 'modernizr' );
        wp_enqueue_script( 'bootstrap' );
		wp_enqueue_script( 'masonry' );
        wp_enqueue_script( 'addThis' );
        wp_enqueue_script( 'app' );
    }

//----------------------------//
    // CUSTOM SHORTCODE
//----------------------------//
    function some_random_code($atts){
        $a = shortcode_atts( array(
            'title' => 'My Title',
            'foo' => 123,
        ), $atts );
        return "foo = {$a['foo']}";
    }
    add_shortcode( 'test_shortcode', 'some_random_code' );

//----------------------------//
    // MENUS
//----------------------------//
    if ( function_exists( 'register_nav_menus' ) ) {
        register_nav_menus( array(
            'primary_nav' => 'GSA.gov navigation displayed at the top of any page',
            'tag_nav' => 'Tag Navigation'
        ) );
    }
    class My_Walker_Nav_Menu extends Walker_Nav_Menu {
        function start_lvl(&$output, $depth) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
        }
    }

//----------------------------//
// Register Sidebar and Widgetize
//----------------------------//
    function arphabet_widgets_init() {

        register_sidebar( array(
            'name'          => 'Sitewide Sidebar',
            'id'            => 'sitewide_sidebar',
            'before_widget' => '<div class="sidebar-bucket">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>',
        ) );
    }
    add_action( 'widgets_init', 'arphabet_widgets_init' );
    add_filter( 'widget_posts_args', 'exclude_posts_wpse_103570');
    // exclude current post from recent posts widget
    function exclude_posts_wpse_103570( $args ){
        global $post;
        $args['post__not_in'] = array( $post->ID );
        return $args;
}
///----------------------------//
// Custom Excerpt lengths
//----------------------------//
    function custom_excerpt($new_length = 20) {
        add_filter('excerpt_length', function () use ($new_length) {
            return $new_length;
        }, 999);

        add_filter('excerpt_more', function () {
            global $post;
            return '...<br><small><a class="moretag" href="'. get_permalink($post->ID) . '"> Read more</a></small>';
        });

        $output = get_the_excerpt();
        $output = apply_filters('wptexturize', $output);
        $output = apply_filters('convert_chars', $output);
        $output = '<p>' . $output . '</p>';
        echo $output;
    }

//----------------------------//
// ACF Options Page
//----------------------------//
    add_filter('acf/options_page/settings', 'my_options_page_settings');
    function my_options_page_settings($options) {
        $options['title'] = _('Theme Options');
        $options['pages'] = array(
            _('Featured Block')
        );
        return $options;
    }

///----------------------------//
// Thumbnail Support
//----------------------------//
    if ( function_exists( 'add_theme_support' ) ) {
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 410, 9999 );
        add_image_size( 'featured', 850, 9999 );
    }

//----------------------------//
// PAGINATION
//----------------------------//
    function wpbeginner_numeric_posts_nav() {
        if( is_singular() )
            return;
        global $wp_query;

        /** Stop execution if there's only 1 page */
        if( $wp_query->max_num_pages <= 1 )
            return;

        $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
        $max   = intval( $wp_query->max_num_pages );

        /**	Add current page to the array */
        if ( $paged >= 1 )
            $links[] = $paged;

        /**	Add the pages around the current page to the array */
        if ( $paged >= 3 ) {
            $links[] = $paged - 1;
            $links[] = $paged - 2;
        }

        if ( ( $paged + 2 ) <= $max ) {
            $links[] = $paged + 2;
            $links[] = $paged + 1;
        }

        echo '<ul class="pagination">' . "\n";

        /**	Previous Post Link */
        if ( get_previous_posts_link() )
            printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

        /**	Link to first page, plus ellipses if necessary */
        if ( ! in_array( 1, $links ) ) {
            $class = 1 == $paged ? ' class="active"' : '';

            printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

            if ( ! in_array( 2, $links ) ) {
                echo '<li><a href="#" onclick="event.preventDefault();">…</a></li>';
            }
        }

        /**	Link to current page, plus 2 pages in either direction if necessary */
        sort( $links );
        foreach ( (array) $links as $link ) {
            $class = $paged == $link ? ' class="active"' : '';
            printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
        }

        /**	Link to last page, plus ellipses if necessary */
        if ( ! in_array( $max, $links ) ) {
            if ( ! in_array( $max - 1, $links ) )
                echo '<li><a href="#" onclick="event.preventDefault();">…</a></li>' . "\n";

            $class = $paged == $max ? ' class="active"' : '';
            printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
        }

        /**	Next Post Link */
        if ( get_next_posts_link() )
            printf( '<li>%s</li>' . "\n", get_next_posts_link() );

        echo '</ul>' . "\n";

    }

