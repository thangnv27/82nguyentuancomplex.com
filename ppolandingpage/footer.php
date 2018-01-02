<?php
$hotline = get_option(SHORT_NAME . "_hotline");
$user_avatar = get_template_directory_uri() . '/images/tu-van.png';
?>
<section id="footer">
    <div class="container">
        <div class="footer-widgets">
            <div class="row">
                <div class="col-sm-6">
                    <div class="widget">
                        <h3 class="widget-title"><?php _e('Thông tin liên hệ', SHORT_NAME) ?></h3>
                        <div class="widget-content"><?php echo wpautop(stripslashes_deep(get_option('footer_info'))) ?></div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <?php if ( is_active_sidebar( 'footer2' ) ) { dynamic_sidebar( 'footer2' ); } ?>
                </div>
                <div class="col-sm-3">
                    <?php if ( is_active_sidebar( 'footer3' ) ) { dynamic_sidebar( 'footer3' ); } ?>
                </div>
            </div>
        </div>
        <div class="copyright">
            <?php
            $copyright = get_option('copyright_text');
            if(!empty($copyright)):
            ?>
            <span>Copyright &copy; <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo $copyright; ?>"><?php echo $copyright; ?></a>. All rights reserved. </span>
            <a href="http://ppo.vn" title="Thiết kế web chuyên nghiệp" target="_blank"><?php _e('Thiết kế web bởi PPO.VN', SHORT_NAME) ?></a>
            <?php else: ?>
            <span>Copyright &COPY; <a href="http://ppo.vn" title="Thiết kế website">PPO.VN</a>. All rights reserved.</span>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if(get_option(SHORT_NAME . "_popupFormEnabled")): ?>
<div id="myModal" class="modal fade" role="dialog">
    <div class="clickableclose"></div>
    <div class="modal-dialog wide">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="close-modal">×</button>
                <h4 class="modal-title"><?php _e('Đăng ký tư vấn miễn phí', SHORT_NAME) ?></h4>
            </div>
            <div class="modal-body">
                <div row>
                    <div class="col-sm-4">
                        <img alt="Tư vấn miễn phí" src="<?php echo $user_avatar; ?>" />
                    </div>
                    <div class="col-sm-8">
                        <?php echo do_shortcode(stripslashes_deep(get_option(SHORT_NAME . "_frm_reg"))) ?>
                    </div>
                    <div class="hotline">Hoặc gọi <strong><a class="rf_hotline" href="tel:<?php echo $hotline ?>"><?php echo $hotline ?></a></strong> để được tư vấn trực tiếp</div>
                </div>
            </div>
            <div class="modal-footer">
                <span data-dismiss="modal"><a href="javascript:void(0)"><?php _e('Đóng', SHORT_NAME) ?></a></span>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div id="scroll-to-top"></div>
<?php wp_footer(); ?>
<div id="fb-root"></div>
<script>
Modernizr.load({
    load: [
        '<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css',
//        '<?php echo get_template_directory_uri(); ?>/css/owl.carousel.min.css',
        '<?php echo get_template_directory_uri(); ?>/css/animate.min.css',
        '<?php echo get_template_directory_uri(); ?>/css/addquicktag.min.css',
        '<?php echo get_template_directory_uri(); ?>/css/wp-default.min.css',
        '<?php echo get_template_directory_uri(); ?>/css/common.min.css',
//        'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js',  
//        '<?php echo get_template_directory_uri(); ?>/js/jquery.min.js',
//        '<?php echo get_template_directory_uri(); ?>/js/jquery-migrate.min.js',
        '<?php echo get_template_directory_uri(); ?>/js/jquery-ui.min.js',
        '<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js',
//        '<?php echo get_template_directory_uri(); ?>/js/owl.carousel.min.js',
        '<?php echo get_template_directory_uri(); ?>/js/jquery-scrolltofixed-min.js',
        '<?php echo get_template_directory_uri(); ?>/js/app.min.js'
//        '<?php echo get_template_directory_uri(); ?>/js/disable-copy.js'
//        '<?php echo includes_url('js/wp-embed.min.js'); ?>'
    ]
});
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
</body>
</html>