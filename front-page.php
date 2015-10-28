<?php get_header(); ?>

    <?php
        date_default_timezone_set("America/New_York");
        $dayofweek = date('w');
        switch ($dayofweek) {
            case 1:
                $tagSlug = 'marketplace-monday';
                break;
            case 2:
                $tagSlug = 'tech-tuesday';
                break;
            case 3:
                $tagSlug = 'green-day-wednesday';
                break;
            case 4:
                $tagSlug = 'throwback-thursday';
                break;
            case 5:
                $tagSlug = 'fact-friday';
                break;
            default;
                $tagSlug = false;
        }

        // Featured Block Options
        $disableDayOfWeek = get_field('disable_toggle','option');
        $post_object = get_field('custom_post','option');
        $bannerToggle = get_field('banner_toggle','option');
        $customBannerImage = get_field('custom_banner_upload','option');
        //check if day of week functionality has been disabled
        if($disableDayOfWeek[0] == 'yes') {
            $featuredBlock_args = array(
                'posts_per_page' => 1,
                'p' => $post_object->ID
            );
        } else {
            $featuredBlock_args = array(
                'posts_per_page' => 1,
                'tag' => $tagSlug,
                'order' => 'DESC',
                'post_status' => 'publish'
            );
        }

        $imgAttr = array(
            'class' => "img-responsive"
        );
    ?>

    <div class="container">
        <div class="row" id="main-content-wrap">
            <div id="primary-block" class="col-sm-9">
                <?php $the_query = new WP_Query( $featuredBlock_args );
                if ( have_posts() ) : ?>
                    <section id="banner">
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post();?>
                            <?php $featured_postid = get_the_ID();
                            $badgeChecker = get_field('badge_tester');
                            $badgeImage = get_field('badge_image_upload');
                            $badgeLink = get_field('badge_image_link');?>
                            <?php if($badgeChecker == true) { ?>
                                <a href="<?php  echo get_tag_link($badgeLink); ?>"><img src="<?php echo $badgeImage?>" class="img-responsive" alt="Banner Image"></a>
                            <?php } ?>
                            <figure>
                                <?php if ( has_post_thumbnail() ) {
                                    $image_id = get_post_thumbnail_id();
                                    $image_url = wp_get_attachment_image_src($image_id,'featured', true);?>
                                    <a href="<?php the_permalink();?>"><img class="img-responsive" src="<?php echo $image_url[0]; ?>" alt="<?php the_title();?>"></a>
                                <?php } else { ?>
                                <a href="<?php the_permalink();?>"><img class="img-responsive" src="http://placehold.it/850x300?text=GSAblog Evergreen Image" alt="Alt Image"></a>
                                <?php } ?>
                            </figure>
                            <article>
                                <header class="post-header">
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
                                </header>
                                <article>
                                    <?php custom_excerpt(40, ' [...]') ?>
                                    <footer>
                                        <?php get_template_part('partials/addthis'); ?>
                                    </footer>
                                </article>
                            </article>
                        <?php endwhile;?>
                    </section>
                <?php endif;
                wp_reset_postdata();?>
                    <!----------------------------
                    //       WEEK IN REVIEW      //
                    ----------------------------->
                    <section id="day-blocks">
                        <header>
                            <h2>Latest News</h2>
                        </header>
                        <div class="row" id="foursquare-container">
                            <?php $dayTags = array('marketplace-monday', 'tech-tuesday','green-day-wednesday','throwback-thursday','fact-friday','gsa-feature');
                            foreach ($dayTags as $dayTag) {
                                $foursquare_args = array(
                                    'posts_per_page' => 1,
                                    'tag' => $dayTag,
                                    'order' => 'DESC',
                                    'post_status' => 'publish',
                                    'post__not_in' => array($featured_postid)
                                );?>
                                <?php $the_foursquare = new WP_Query( $foursquare_args );
                                if ( have_posts() ) : ?>
                                <?php while ( $the_foursquare->have_posts() ) : $the_foursquare->the_post(); ?>
                                    <article class="block col-xs-6 col-sm-4">
                                        <figure>
                                            <?php if ( has_post_thumbnail() ) {?>
                                                <a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'post-thumbnail', $imgAttr );?></a>
                                            <?php } else { ?>
                                                <a href="<?php the_permalink();?>"><img class="img-responsive" src="http://placehold.it/500x250?text=GSA Evergreen Image" alt="Alt Image"></a>
                                            <?php } ?>
                                        </figure>
                                        <aside>
                                            <?php
                                            $posttags = get_the_tags();
                                            if ($posttags) {
                                                foreach($posttags as $tag) {
                                                    if($tag->slug == 'marketplace-monday' || $tag->slug == 'tech-tuesday' || $tag->slug == 'green-day-wednesday' || $tag->slug == 'throwback-thursday' || $tag->slug == 'fact-friday' || $tag->slug == 'gsa-feature' ) {
                                                        echo '<a href="' . get_site_url() . '/tag/' . $tag->slug . '"><img class="img-responsive" src="' . get_bloginfo('template_url') . '/images/day-' . $tag->slug . '.jpg"></a>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </aside>
                                        <h3 style="margin-bottom: 5px;"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                        <time datetime="<?php the_date('Y/m/d');?>" pubdate="pubdate"><?php echo get_the_date('F j, Y') ;?></time>
                                    </article>
                                <?php endwhile;?>
                                <?php endif;
                                wp_reset_postdata();?>
                            <?php } // end foreach loop ?>
                        </div>
                    </section>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>




<?php get_footer(); ?>
