<!----------------------------
                        //       WEEK IN REVIEW      //
                        ----------------------------->
<?php
$category_id = $categories[0]->cat_ID;
$foursquare_args = array(
    'posts_per_page' => 2,
    'order' => 'DESC',
    'post_status' => 'publish',
    'post__not_in' => array($featured_postid),
    'cat' => $category_id
);?>
<?php $the_foursquare = new WP_Query( $foursquare_args );
if ( have_posts() ) : ?>
    <section id="day-blocks">
        <div class="row">
            <?php while ( $the_foursquare->have_posts() ) : $the_foursquare->the_post(); ?>
                <article class="block col-sm-6">
                    <figure>
                        <?php if ( has_post_thumbnail() ) {
                            the_post_thumbnail( 'post-thumbnail', $imgAttr );
                        } else { ?>
                            <img class="img-responsive" src="http://placehold.it/500x250?text=GSA Evergreen Image" alt="Alt Image">
                        <?php } ?>
                    </figure>
                    <aside>
                        <?php
                        $category = get_the_category();
                        if($category[0]){
                            echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
                        }
                        ?>
                    </aside>
                    <time><small><?php the_date();?></small></time>
                    <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <?php custom_excerpt(20, ' [...]') ?>
                </article>
            <?php endwhile;?>
        </div>
    </section>
<?php endif;
wp_reset_postdata();?>


<!-- Day of Week Graphic -->
<?php if($disableDayOfWeek[0] == 'yes') { ?>
    <aside class="day-banner" style="background-image:url(<?php bloginfo('template_url') ?>/images/day-gsa-featured-small.jpg)">
    </aside>
<?php } elseif ($tagSlug != false && $disableDayOfWeek[0] != 'yes') { ?>
    <aside class="day-banner" style="background-image: url(<?php bloginfo('template_url') ?>/images/day-<?php echo $tagSlug;?>-small.jpg)">
    </aside>
<?php } ?>