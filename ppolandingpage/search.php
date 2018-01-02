<?php get_header(); ?>

<!--BREADCRUMB-->
<div id="breadcrumbs" class="mb15">
    <div class="container">
        <div class="pull-left">
            <h1 class="page-title"><?php _e('Kết quả tìm kiếm', SHORT_NAME) ?></h1>
        </div>
        <div class="pull-right">
            <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div class="breadcrumbs">','</div>'); } ?>
        </div>
    </div>
</div>
<!--/BREADCRUMB-->

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="archive-content">
                    <?php
                    if(have_posts()):
                        while (have_posts()) : the_post();
                            get_template_part('content', get_post_format());
                        endwhile;
                    else:
                    ?>
                    <div class="col-sm-12">
                        <p><?php _e('Không có bài viết nào được tìm thấy. Bạn vui lòng thử với từ khóa khác!', SHORT_NAME) ?></p>
                        <?php get_search_form(); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <?php getpagenavi();?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_template_part('template/before-footer'); ?>
<?php get_footer(); ?>