<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes() ?>><!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(' '); ?><?php if(wp_title(' ', false)) { echo ' &raquo; '; } ?><?php bloginfo('name'); ?></title>
    <link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/images/favicon.ico">
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php include('partials/primary-navigation.php'); ?>
<?php include('partials/breadcrumb.php'); ?>

    <div class="container">
        <!-- LOGO / SEARCH / SOCIAL -->
        <header id="gsablog-navigation">
            <div class="row">
                <div id="stay-connected" class="col-sm-3 text-center hidden-sm hidden-xs">
                    <strong>STAY CONNECTED</strong>
                    <ul class="list-unstyled list-inline social-row">
                        <li class="facebook-icon"><a href="#" title="Facebook"></a></li>
                        <li class="twitter-icon"><a href="#" title="Twitter"></a></li>
                        <li class="youtube-icon"><a href="#" title="Youtube"></a></li>
                        <li class="instagram-icon"><a href="#" title="Instagram"></a></li>
                        <li class="pintrest-icon"><a href="#" title="Pintrest"></a></li>
                        <li class="email-icon"><a href="#" title="Email"></a></li>
                    </ul>
                </div>
                <div id="logo" class="col-sm-6 hidden-sm hidden-xs">
                    <a href="<?php echo get_home_url(); ?>"><img src="<?php bloginfo('template_url') ?>/images/gsa-logo-blog.jpg" class="img-responsive"></a>
                </div>
                <form class="form-inline col-sm-3 text-right" method="get" role="search" action="<?php echo home_url( '/' ); ?>">
                    <div class="form-group">
                        <label class="sr-only" for="search-field">Search</label>
                        <input type="text" class="form-control" name="s" id="search-field" placeholder="Search">
                        <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </form>
            </div>
        </header>
        <!-- TAG NAVIGATION -->
        <nav id="tag-nav">
            <h4 id="tag-menu-toggle" class="visible-sm visible-xs">Select a Category <span class="pull-right glyphicon glyphicon-chevron-down"></span></h4>
            <?php
            $tagNavArgs = array(
                'theme_location'  => 'tag_nav',
                'container'       => false,
                'menu_class'      => 'menu',
                'echo'            => true,
                'items_wrap'      => '<ul class="list-inline list-unstyled">%3$s</ul>',
                'depth'           => 1
            );
            ?>
            <?php wp_nav_menu( $tagNavArgs ); ?>
        </nav>
    </div>
