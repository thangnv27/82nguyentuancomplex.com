<?php get_header(); ?>

<section id="main">
    <div class="container">
        <div class="page">
            <div class="row">
                <div class="col-md-8">
                    <?php
                    if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); }
                    
                    // Start the Loop.
                    while (have_posts()) : the_post();

                        // Include the page content template.
                        get_template_part('content', 'page');

                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) {
                            comments_template();
                        }
                    endwhile;
                    ?>
                </div>

                <?php get_sidebar() ?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template/before-footer'); ?>
<?php get_footer(); ?>