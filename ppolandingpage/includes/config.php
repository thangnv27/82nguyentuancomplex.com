<?php
$basename = basename($_SERVER['PHP_SELF']);
//if (!in_array($basename, array('plugins.php', 'update.php', 'upgrade.php'))) {
//    ob_start();
//    ob_start("ob_gzhandler");
//}
/* ----------------------------------------------------------------------------------- */
# Set default timezone
/* ----------------------------------------------------------------------------------- */
date_default_timezone_set('Asia/Ho_Chi_Minh');
/* ----------------------------------------------------------------------------------- */
# Definition
/* ----------------------------------------------------------------------------------- */
if (!defined('THEME_NAME'))
    define('THEME_NAME', "PPO");

if (!defined('SHORT_NAME'))
    define('SHORT_NAME', "ppo");

if (!defined('THEME_VER'))
    define('THEME_VER', "2.0");

if (!defined('MENU_NAME'))
    define('MENU_NAME', SHORT_NAME . "_settings");
/* ----------------------------------------------------------------------------------- */
# Theme Options
/* ----------------------------------------------------------------------------------- */
$pages = get_pages();
$page_list = array();
foreach ($pages as $page) {
    $page_list[$page->ID] = $page->post_title;
}
$categories = get_categories(array('hide_empty' => 0));
$category_list = array();
foreach ($categories as $category) {
    $category_list[$category->term_id] = $category->name;
}

$options = array(
    'general' => array(
        "name" => "General",
        array("id" => "ppo_opt",
            "std" => "general",
            "type" => "hidden"),
        array("name" => "Site Options",
            "type" => "title",
            "desc" => ""),
        array("type" => "open"),
        array("name" => "Keywords meta",
            "desc" => "Enter the meta keywords for all pages. These are used by search engines to index your pages with more relevance.",
            "id" => "keywords_meta",
            "std" => "",
            "type" => "text"),
        array("name" => "Favicon",
            "desc" => "An icon associated with a particular website, and typically displayed in the address bar of a browser viewing the site. Size: 16x16",
            "id" => "favicon",
            "std" => "",
            "type" => "text",
            "btn" => true),
        array("name" => "Logo",
            "desc" => "",
            "id" => "sitelogo",
            "std" => "",
            "type" => "text",
            "btn" => true),
        array("name" => "Logo for Mobile",
            "desc" => "",
            "id" => "mobilelogo",
            "std" => "",
            "type" => "text",
            "btn" => true),
        array("name" => "Register URL on Mobile",
            "desc" => "Hiển thị ở đầu trang trên màn hình di động",
            "id" => "mob_reg_url",
            "std" => "",
            "type" => "text"),
        array("name" => "Hotline",
            "desc" => "",
            "id" => SHORT_NAME . "_hotline",
            "std" => "",
            "type" => "text"),
        array("name" => "Copyright text",
            "desc" => "",
            "id" => "copyright_text",
            "std" => "",
            "type" => "text"),
        array("type" => "close"),
        
        array("type" => "open"),
        array("name" => "Footer Information",
            "desc" => "",
            "id" => "footer_info",
            "std" => "",
            "type" => "textarea",
            "editor" => array(
                "wyswig" => true,
                "rows" => 10,
            )),
        array("type" => "close"),
        array("type" => "submit"),
    ),
    'theme-options' => array(
        "name" => "Theme Options",
        array("id" => "ppo_opt",
            "std" => "theme-options",
            "type" => "hidden"),
        
//        array("name" => "Tùy chọn khác",
//            "type" => "title",
//            "desc" => "Tìm chỉnh website.",
//        ),
        array("type" => "open"),
        array("name" => "Fixed menu",
            "desc" => "Menu chính của bạn sẽ luôn dính ở phía trên trình duyệt khi cuộn chuột.",
            "id" => SHORT_NAME . "_fixedMenu",
            "std" => '',
            "type" => "checkbox"),
        array("name" => "POPUP Form",
            "desc" => "Kích hoạt hiển thị POPUP form",
            "id" => SHORT_NAME . "_popupFormEnabled",
            "std" => '',
            "type" => "checkbox"),
        array("name" => "POPUP Expired Cookie",
            "desc" => "Ví dụ 24 giờ thì viết vào là: 24",
            "id" => SHORT_NAME . "_popup_expired_cookie",
            "std" => "",
            "type" => "text"),
        array("name" => "POPUP Time Delay",
            "desc" => "Ví dụ 30 giây thì viết vào là: 30",
            "id" => SHORT_NAME . "_popup_time_delay",
            "std" => "",
            "type" => "text"),
        array("name" => "POPUP Form",
            "desc" => "",
            "id" => SHORT_NAME . "_frm_reg",
            "std" => "",
            "type" => "text"),
        array("name" => "Subiz License ID",
            "desc" => "Ví dụ: 22038",
            "id" => SHORT_NAME . "_subizID",
            "std" => "",
            "type" => "text"),
        array("name" => "Zopim Key",
            "desc" => "Ví dụ: 45dRAcMR15dTPbRdXeXEtTLQAKxNDjij",
            "id" => SHORT_NAME . "_zopimKey",
            "std" => "",
            "type" => "text"),
        array("name" => "Google Analytics",
            "desc" => "Google Analytics. Ví dụ: UA-40210538-1",
            "id" => SHORT_NAME . "_gaID",
            "std" => "UA-40210538-1",
            "type" => "text"),
        array("name" => "Header Code",
            "desc" => "Phần này cho phép đặt các mã code vào đầu trang.",
            "id" => SHORT_NAME . "_headerCode",
            "std" => '',
            "type" => "textarea"),
        array("name" => "Footer Code",
            "desc" => "Phần này cho phép đặt các mã code vào cuối trang.",
            "id" => SHORT_NAME . "_footerCode",
            "std" => '',
            "type" => "textarea"),
        array("type" => "close"),
        array("type" => "submit"),
    ),
//    'social-options' => array(
//        "name" => "Socials",
//        array("id" => "ppo_opt",
//            "std" => "social-options",
//            "type" => "hidden"),
//        array("name" => "Theo dõi trên mạng xã hội",
//            "type" => "title",
//            "desc" => ""),
//        array("type" => "open"),
//        array("name" => "Facebook",
//            "desc" => "Nhập URL page của bạn trên facebook.",
//            "id" => SHORT_NAME . "_fbURL",
//            "std" => "",
//            "type" => "text"),
//        array("name" => "Google plus",
//            "desc" => "Nhập URL page của bạn trên Google plus.",
//            "id" => SHORT_NAME . "_googlePlusURL",
//            "std" => "",
//            "type" => "text"),
//        array("name" => "Twitter",
//            "desc" => "Nhập URL page của bạn trên Twitter.",
//            "id" => SHORT_NAME . "_twitterURL",
//            "std" => "",
//            "type" => "text"),
//        array("name" => "Linked In",
//            "desc" => "Nhập URL page của bạn trên Linked In.",
//            "id" => SHORT_NAME . "_linkedInURL",
//            "std" => "",
//            "type" => "text"),
//        array("name" => "Youtube",
//            "desc" => "Nhập URL page của bạn trên Youtube.",
//            "id" => SHORT_NAME . "_youtubeURL",
//            "std" => "",
//            "type" => "text"),
//        array("name" => "Pinterest",
//            "desc" => "Nhập URL page của bạn trên Pinterest.",
//            "id" => SHORT_NAME . "_pinterestURL",
//            "std" => "",
//            "type" => "text"),
//        array("name" => "Instagram",
//            "desc" => "Nhập URL page của bạn trên Instagram.",
//            "id" => SHORT_NAME . "_instagramURL",
//            "std" => "",
//            "type" => "text"),
//        array("type" => "close"),

//        array("name" => "Apps",
//            "type" => "title",
//            "desc" => ""),
//        array("type" => "open"),
//        array("name" => "DISQUS Site Shortname",
//            "desc" => "Nhập site shortname của bạn trên DISQUS để theo dõi và quản lý bình luận.",
//            "id" => SHORT_NAME . "_disqus_shortname",
//            "std" => '',
//            "type" => "text"),
//        array("type" => "close"),
//        array("type" => "submit"),
//    ),
);