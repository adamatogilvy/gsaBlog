<?php
$navigationArgs = array(
    'theme_location'  => 'primary_nav',
    'container'       => false,
    'menu_class'      => 'menu',
    'echo'            => true,
    'fallback_cb'     => 'wp_page_menu',
    'items_wrap'      => '<ul class="nav navbar-nav" id="main-nav">%3$s</ul>',
    'depth'           => 2,
    'walker'          => new My_Walker_Nav_Menu()
);

?>


    <div id="skip" class="text-center"><a href="#content">Skip to Main Content</a></div>
    <header id="inner-main-navigation" class="navbar-fixed-top hidden-xs">
        <nav class="navbar navbar-default container " role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="http://gsa.gov/"><img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/nav-logo.jpg"></a>
            </div>
            <?php wp_nav_menu( $navigationArgs ); ?>
            <?php get_search_form( true ); ?>
        </nav>
    </header>
