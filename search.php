<?php get_header(); ?>

    <div class="container">
        <div class="page-content">
            <header>
                <h1>Search Results</h1>
            </header>
            <div id="main">
                <?php if ( have_posts() ) :
                    while ( have_posts() ) : the_post(); ?>
                        <div class="entry">
                            <h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
                        </div>
                    <?php endwhile; ?>
                <?php endif;?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>