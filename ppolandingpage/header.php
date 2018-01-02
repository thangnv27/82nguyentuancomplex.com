<?php 
//include_once 'libs/bbit-compress.php';

$mob_reg_url = get_option("mob_reg_url");
$hotline = get_option(SHORT_NAME . "_hotline");
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="Cache-control" content="no-store; no-cache"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta name="author" content="PPO.VN" />
    <meta name="geo.region" content="VN" />
    <meta name="geo.position" content="14.058324;108.277199" />
    <meta name="ICBM" content="14.058324, 108.277199" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <?php if(is_home() or is_front_page()): ?>
    <meta name="keywords" content="<?php echo get_option('keywords_meta') ?>" />
    <?php endif; ?>
    <link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />        
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        var siteUrl = "<?php bloginfo('siteurl'); ?>";
        var themeUrl = "<?php bloginfo('stylesheet_directory'); ?>";
        var is_home = <?php echo (is_home() or is_front_page()) ? 'true' : 'false'; ?>;
        var is_mobile = <?php echo wp_is_mobile() ? 'true' : 'false'; ?>;
        var is_user_logged_in = <?php echo is_user_logged_in() ? 'true' : 'false'; ?>;
        var is_fixed_menu = <?php echo (get_option(SHORT_NAME . "_fixedMenu")) ? 'true' : 'false'; ?>;
        var no_image_src = themeUrl + "/images/no_image.png";
        var mob_reg_url = '<?php echo $mob_reg_url ?>';
        var ajaxurl = '<?php echo admin_url('admin-ajax.php') ?>';
        var hotline = '<?php echo $hotline; ?>';
        var popup_form_enabled = <?php echo (get_option(SHORT_NAME . "_popupFormEnabled")) ? 'true' : 'false'; ?>;
        var popup_expired_cookie = <?php echo intval(get_option(SHORT_NAME . "_popup_expired_cookie")) ?>; // hours
        var popup_time_delay = <?php echo intval(get_option(SHORT_NAME . "_popup_time_delay")) ?>; // seconds
    </script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="ajax_loading" style="display: none;z-index: 9999999" class="ajax-loading-block-window">
        <div class="loading-image"></div>
    </div>
    <!--Alert Message-->
    <div id="nNote" class="nNote" style="display: none;"></div>
    <!--END: Alert Message-->
    
    <div id="ppo-overlay" style="display: none"></div>
    
    <!--MOBILE HEADER-->
    <div id="st-container" class="st-container">
        <div class="mobile-header clearfix mobile-unclicked" style="transform: translate(0px, 0px);">
            <div id="st-trigger-effects">
                <button data-effect="st-effect-4" class="left-menu">
                    <div class="menu-icon">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </div>
                    <span><i class="fa fa-bars" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="title">
                <?php
                if(get_option('mobilelogo')){
                ?>
                    <a title="<?php bloginfo("name"); ?>" href="<?php echo home_url(); ?>">
                        <img src="<?php echo get_option("mobilelogo"); ?>" alt="iRe" />
                    </a>
                <?php
                } else {
                ?>
                    <p class="proxima"><a title="<?php bloginfo("name"); ?>" href="<?php echo home_url(); ?>">iRe</a></p>
                <?php }?>
            </div>
            <div id="st-trigger-effects">
                <button data-effect="st-effect-5" class="right-menu">
                    <i class="fa fa-pencil" aria-hidden="true"></i> <?php _e('Đăng ký', SHORT_NAME) ?>
                </button>
            </div>
        </div>
        
        <nav id="menu-4" class="st-menu st-effect-4">
            <form method="get" action="<?php echo home_url(); ?>" id="search_mini_form">
                <div class="form-search">
                    <div class="searchcontainer"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        <input type="text" maxlength="128" class="input-text" value="" name="s" id="search" />
                    </div>
                </div>
            </form>
            
            <?php
            wp_nav_menu(array(
                'container' => '',
                'theme_location' => 'primary',
                'menu_class' => 'nav',
                'menu_id' => '',
            ));
            ?>
        </nav>
    </div>
    <!--/MOBILE HEADER-->
    
    <!--DESKTOP HEADER-->
    <div class="desktop-header">
        <div class="top-head">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="header_logo" itemtype="http://schema.org/Organization" itemscope="itemscope">
                            <a rel="home" title="<?php bloginfo("name"); ?>" href="<?php echo home_url(); ?>" itemprop="url">
                                <img src="<?php echo get_option("sitelogo"); ?>" alt="<?php bloginfo("name"); ?>" itemprop="logo" />
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="header-buttons">
                            <?php if ( is_active_sidebar( 'sidebar_header_buttons' ) ) { dynamic_sidebar( 'sidebar_header_buttons' ); } ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="top-nav">
            <div class="container">
                <div class="main-menu">
                    <?php
                    wp_nav_menu(array(
                        'container' => '',
                        'theme_location' => 'primary',
                        'menu_class' => 'nav',
                        'menu_id' => '',
                    ));
                    ?>
                    <div class="menu-search">
                        <span class="icon-search glyphicon glyphicon-search" aria-hidden="true"></span>
                        <div class="search-tooltip">
                            <div class="inner_tooltip">
                                <form action="<?php bloginfo('url') ?>" id="searchform" method="get">
                                    <div>
                                        <input type="text" name="s" value="" placeholder="<?php _e('Tìm kiếm', SHORT_NAME) ?>" />
                                        <button type="submit" class="btn">
                                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <span class="arrow-wrap"><span class="arrow"></span></span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!--/DESKTOP HEADER-->