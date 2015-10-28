<?php get_header(); ?>
<div class="container">
    <div class="row" id="main-content-wrap">
        <div id="primary-block" class="col-sm-9">
            <?php  $i = 1; ?>
            <?php if ( have_posts() ) : ?>

                <?php if ( is_tag() ) { // IF TAGS
                    $tag       = get_queried_object();
                    $tag_title = $tag->name;
                    $tag_slug  = $tag->slug;
                    $dayTags = array('marketplace-monday', 'tech-tuesday','green-day-wednesday','throwback-thursday','fact-friday','gsa-feature');?>

                    <?php if ( in_array($tag_slug, $dayTags ) )  { ?>
                        <header class="archive-title">
                            <img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/day-<?php echo $tag_slug;?>-large.jpg">
                        </header>
                    <?php } else if (z_taxonomy_image_url($tag->term_id)) { ?>
                        <header class="archive-title">
							<!-- nope -->
                            <img class="img-responsive" src="<?php echo z_taxonomy_image_url($tag->term_id); ?>" alt="Badge">
                        </header>
                    <?php } else {?>
                        <header class="archive-title">
                            <h2><?php echo $tag_title?></h2>
                        </header>
                    <?php } ?>
                <?php } ?>

                <?php if ( is_category() ) { // IF CATEGORIES?>
                    <?php $categories = get_the_category(); ?>
                    <header class="archive-title">
                        <h2><?php echo $categories[0]->name?></h2>
                    </header>
                <?php } ?>

                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="block row <?php echo ($i%2 == 0 ? 'grayBG' : false); ?>">
                        <figure class="col-sm-4 mt-5">
                            <?php if (has_post_thumbnail( $post->ID ) ) { ?>
                                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail', true ); ?>
                                <img class="img-responsive" src="<?php echo $image[0];?> " alt="<?php the_title();?>">
                            <?php } else { ?>
                                <img class="img-responsive" src="http://placehold.it/850x300?text=GSAblog Evergreen Image" alt="Alt Image">
                            <?php } ?>
                        </figure>
                        <article class="col-sm-8">
                            <div class="post-header">
                                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <?php $tagLine = get_field('tagline_text');
                                if($tagLine) {
                                    echo '<h4>'.$tagLine.'</h4>';
                                } ?>
                                <time datetime="<?php the_date('Y/m/d');?>" pubdate="pubdate"><?php echo get_the_date('F j, Y') ;?></time> |
                                <span class="byline">
                                    <?php $cf_author = get_post_meta($post->ID, 'AuthorName');
                                    $cf_position = get_post_meta($post->ID, 'AuthorTitle');
                                    $author = get_field('post_author_checker');
                                    $registeredUser = get_field('post_author_registered_user');
                                    $nonRegistered = get_field('post_author_name');
                                    $jobTitle = get_field('post_author_job_title');
                                    if($cf_author[0]){ // first see if the legacy custom field for Author was used
                                        echo $cf_author[0];
                                    } else {
                                        switch ($author) {
                                            case 'logged_in_user':
                                                the_author();
                                                break;
                                            case 'wp_registered_user':
                                                echo $registeredUser['user_firstname'] . ' ' . $registeredUser['user_lastname'] ;
                                                break;
                                            case 'other':
                                                echo $nonRegistered;
                                                break;
                                        }
                                    }
                                    if($cf_position[0] && !$jobTitle) { // then see if the legacy custom field for Position was used
                                        echo ', '.$cf_position[0];
                                    } elseif($jobTitle) {
                                        echo ', '.$jobTitle;
                                    }
                                    ?>
                                </span>
                            </div>
                            <?php custom_excerpt(40, ' [...]') ?>
                        </article>
                    </article>
                    <?php $i++; ?>
                <?php endwhile; ?>
                <nav class="navigation" id="pagination-nav">
                    <?php wpbeginner_numeric_posts_nav(); ?>
                </nav>
            <?php endif; ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>