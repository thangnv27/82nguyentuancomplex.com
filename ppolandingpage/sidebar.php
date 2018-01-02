<div id="sidebar" class="sidebar col-md-4 hidden-sm hidden-xs" style="position: inherit;<?php echo (is_singular('post') or is_page())?'margin-top:15px':''; ?>">
    <?php if ( is_active_sidebar( 'sidebar' ) ) { dynamic_sidebar( 'sidebar' ); } ?>
</div><!-- #sidebar -->