<?php get_header(); ?>
            <div class="container">
                <div class="row" id="main-content-wrap">
                    <div id="primary-block" class="col-sm-9">
                        <?php if ( have_posts() ) :
                            while ( have_posts() ) : the_post(); ?>
                                <?php $featured_postid = get_the_ID();
                                      $categories = get_the_category(); ?>
                                <section id="banner">
                                    <?php $badgeChecker = get_field('badge_tester');
                                    $badgeImage = get_field('badge_image_upload');
                                    $badgeLink = get_field('badge_image_link');?>
                                    <?php if($badgeChecker == true) { ?>
                                        <a href="<?php  echo get_tag_link($badgeLink); ?>"><img src="<?php echo $badgeImage?>" class="img-responsive" alt="Banner Image"></a>
                                    <?php } ?>
                                    <figure>
                                        <?php if ( has_post_thumbnail() ) {
                                            $image_id = get_post_thumbnail_id();
                                            $image_url = wp_get_attachment_image_src($image_id,'featured', true);?>
                                            <img class="img-responsive" src="<?php echo $image_url[0]; ?>" alt="<?php the_title();?>">
                                        <?php } else { ?>
                                            <img class="img-responsive" src="http://placehold.it/850x300?text=GSAblog Evergreen Image" alt="Alt Image">
                                        <?php } ?>
                                    </figure>
                                    <aside>
                                        <?php
                                        $posttags = get_the_tags();
                                        if ($posttags) {
                                            foreach($posttags as $tag) {
                                                if($tag->slug == 'marketplace-monday' || $tag->slug == 'tech-tuesday' || $tag->slug == 'green-day-wednesday' || $tag->slug == 'throwback-thursday' || $tag->slug == 'fact-friday' || $tag->slug == 'gsa-feature' ) {
                                                    echo '<a href="' . get_site_url() . '/tag/' . $tag->slug . '"><img class="img-responsive" src="' . get_bloginfo('template_url') . '/images/day-' . $tag->slug . '-small.jpg"></a>';
                                                }
                                            }
                                        }
                                        ?>
                                    </aside>
                                    <article>
                                        <header class="post-header">
                                            <div>
                                                <h3><?php the_title();?></h3>
                                                <?php $tagLine = get_field('tagline_text');
                                                if($tagLine) {
                                                    echo '<h4>'.$tagLine.'</h4>';
                                                } ?>
                                            </div>
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
                                        <div>
                                            <?php the_content();?>
                                            <footer>
                                                <small>Post filed in:
                                                    <?php foreach($posttags as $tag) {
                                                        $tag_link = get_tag_link( $tag->term_id ); ?>
                                                        <a href="<?php echo $tag_link ?>" title="<?php echo $tag->name ?> Tag"> <?php echo $tag->name ?></a> |
                                                    <?php } ?>
                                                </small>
                                                <?php get_template_part('partials/addthis'); ?>
                                            </footer>
                                        </div>
                                    </article>
                                </section>
                            <?php endwhile;
                        endif; ?>
                    </div>
                    <?php get_sidebar(); ?>
                </div>
            </div>

<?php get_footer(); ?>