<?php get_header(); ?>
            <div class="container">
                <div class="row" id="main-content-wrap">
                    <div id="primary-block" class="col-sm-9">
                        <?php if ( have_posts() ) :
                            while ( have_posts() ) : the_post(); ?>
                                <h1><?php the_title(); ?></h1>                                        
                                    <article>
                                        <?php the_content(); ?>
                                    </article>
                            <?php endwhile;
                        endif; ?>
                    </div>
                    <?php get_sidebar(); ?>
                </div>
            </div>

<?php get_footer(); ?>