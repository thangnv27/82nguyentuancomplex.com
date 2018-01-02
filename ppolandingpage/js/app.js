(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

var viewport_width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
var viewport_height = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
var TFunc = {
    setCookie: function (name, value, expires, path, domain, secure) {
        var today = new Date();
        today.setTime(today.getTime());
        var expires_date = new Date(today.getTime() + (expires));
        document.cookie = name + "=" + escape(value) + ((expires) ? ";expires=" + expires_date.toGMTString() : "") + ((path) ? ";path=" + path : "") + ((domain) ? ";domain=" + domain : "") + ((secure) ? ";secure" : "");
    },
    getCookie: function (name) {
        /*var re=new RegExp(Name+"=[^;]+", "i");             if (document.cookie.match(re))                  return decodeURIComponent(document.cookie.match(re)[0].split("=")[1]);              return null;*/
        var start = document.cookie.indexOf(name + "=");
        var len = start + name.length + 1;
        if ((!start) && (name != document.cookie.substring(0, name.length))) {
            return null;
        }
        if (start == -1) return null;
        var end = document.cookie.indexOf(";", len);
        if (end == -1) end = document.cookie.length;
        return unescape(document.cookie.substring(len, end));
    },
    deleteCookie: function (name, path, domain) {
        if (this.getCookie(name))
            document.cookie = name + "=" + ((path) ? ";path=" + path : "") + ((domain) ? ";domain=" + domain : "") + ";expires=Mon, 11-November-1989 00:00:01 GMT";
    },
    addEvent: function (obj, eventName, func) {
        if (obj.attachEvent) {
            obj.attachEvent("on" + eventName, func);
        }
        else if (obj.addEventListener) {
            obj.addEventListener(eventName, func, true);
        }
        else {
            obj["on" + eventName] = func;
        }
    }
};
var PPOFixed = {
    mainMenu:function(){
        var msie6 = jQuery.browser == 'msie' && jQuery.browser.version < 7;
        if (!msie6) {
            var top = 10;
//            var top = jQuery('.desktop-header').offset().top - parseFloat(jQuery('.desktop-header').css('margin-top').replace(/auto/, 0));
            jQuery(window).scroll(function(event){
                if (jQuery(this).scrollTop() >= top){
                    var wpadminbar_height = 0;
                    if(jQuery(this).width() > 583){
                        wpadminbar_height = jQuery('#wpadminbar').outerHeight(true);
                    }
                    jQuery('.top-nav').css({
                        'top':wpadminbar_height - 1
                    }).addClass('fixed');
                } else {
                    jQuery('.top-nav').css({
                        'top':0
                    }).removeClass('fixed');
                }
            });
        }
    },
    columns: function (col) {
        var summaries = $(col);
        summaries.each(function (i) {
            var summary = $(summaries[i]);
            var next = summaries[i + 1];
            var margin_top = $('#wpadminbar').outerHeight(true);
            if(is_fixed_menu){
                margin_top += $(".top-nav").outerHeight(true);
            }

            summary.scrollToFixed({
                marginTop: margin_top,
                limit: function () {
                    var limit = 0;
                    if (next) {
                        limit = $(next).offset().top - $(this).outerHeight(true) - 10;
                    } else {
                        if($("#before_footer").length > 0){
                            limit = $('#before_footer').offset().top - $(this).outerHeight(true) - 10;
                        } else {
                            limit = $('#footer').offset().top - $(this).outerHeight(true) - 10;
                        }
                    }
                    return limit;
                },
                zIndex: 998
            });
        });
    }
};
function getChromeVersion() {
    var raw = navigator.userAgent.match(/Chrom(e|ium)\/([0-9]+)\./);
    return raw ? parseInt(raw[2], 10) : false;
}
function getFirefoxVersion() {
    var raw = navigator.userAgent.match(/Firefox\/([0-9]+)/);
    return raw ? parseInt(raw[1], 10) : false;
}
function ReplaceAll(Source, stringToFind, stringToReplace) {
    var temp = Source;
    var index = temp.indexOf(stringToFind);
    while (index != -1) {
        temp = temp.replace(stringToFind, stringToReplace);
        index = temp.indexOf(stringToFind);
    }
    return temp;
}
function scrollToElement(id) {
    jQuery('body,html').animate({
        scrollTop: jQuery(id).offset().top - 10
    }, 800);
}
jQuery(document).ready(function ($) {
    if(is_fixed_menu){
        PPOFixed.mainMenu();
    }
    if(viewport_width > 991 && jQuery("#sidebar").height() < jQuery("#sidebar").prev().height()){
        PPOFixed.columns(jQuery("#sidebar .widget").get(jQuery("#sidebar .widget").length - 1));
    }

    // Popup subscribe
    if(popup_form_enabled && TFunc.getCookie('t-popup') !== '1'){
        setTimeout(function (){
            jQuery("#myModal").modal();
            TFunc.setCookie('t-popup', 1, 60 * 60 * 1000 * popup_expired_cookie, '/', '', ''); // 1 hour
        }, popup_time_delay * 1000); // seconds
    }
    
    jQuery(".menu-search .icon-search").click(function () {
        if (jQuery(".menu-search .search-tooltip").is(":hidden")) {
            jQuery(".menu-search .search-tooltip").addClass('bounceIn animated').show();
            jQuery(".menu-search .search-tooltip input[name=s]").focus();
            setTimeout(function () {
                jQuery(".menu-search .search-tooltip").removeClass('bounceIn animated');
            }, 1000);
        } else {
            jQuery(".menu-search .search-tooltip").hide();
        }
    });

    // Scroll to element - desktop
    jQuery(".main-menu > .nav > li > a, .btn-reg, .header-buttons a").click(function (){
        var _href = jQuery(this).attr('href');
        if(_href.lastIndexOf("#") !== -1){
            var _id = _href.split("#");
            if(jQuery('.desktop-header').hasClass('fixed')){
                jQuery('body,html').animate({
                    scrollTop: jQuery("#" + _id[1]).offset().top - jQuery('.desktop-header').height() - jQuery("#wpadminbar").outerHeight(true)
                }, 400);
            } else {
                jQuery('body,html').animate({
                    scrollTop: jQuery("#" + _id[1]).offset().top - (jQuery('.desktop-header').height() * 2) - jQuery("#wpadminbar").outerHeight(true)
                }, 400);
            }
            return false;
        }
    });
    // Scroll to element - mobile
    jQuery(".st-menu > .nav > li > a").click(function (){
        var _href = jQuery(this).attr('href');
        if(_href.lastIndexOf("#") !== -1){
            var _id = _href.split("#");
            jQuery('body,html').animate({
                scrollTop: jQuery("#" + _id[1]).offset().top - jQuery('.mobile-header').height()
            }, 400);
            jQuery('button.left-menu').trigger('click');
            return false;
        }
    });
    
    jQuery(document).mouseup(function (e) {
        if (viewport_width < 992) {
            var container = jQuery(".st-container");
            if (container.find('.mobile-header').hasClass('mobile-clicked')) {
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    jQuery('button.left-menu').trigger('click');
                }
            }
        }
        
        var menu_search = jQuery(".menu-search .search-tooltip");
        if (!menu_search.is(e.target) && menu_search.has(e.target).length === 0) {
            menu_search.hide();
        }
    });
    
    if(window.location.hash.length > 0){
        if(viewport_width > 991){
            jQuery('body,html').animate({
                scrollTop: jQuery(window.location.hash).offset().top - (jQuery('.desktop-header').height()*2) - jQuery("#wpadminbar").outerHeight(true)
            }, 400);
        } else {
            jQuery('body,html').animate({
                scrollTop: jQuery(window.location.hash).offset().top - (jQuery('.mobile-header').height()*2)
            }, 400);
        }
        window.history.pushState("", document.title, window.location.pathname);
    }

    jQuery("#scroll-to-top").click(function () {
        jQuery('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });

    // Expand/Collapse mobile menu
    jQuery(".st-menu .nav li.menu-item-has-children > ul.sub-menu").hide();
    jQuery(".st-menu .nav li.menu-item-has-children.current-menu-item > ul.sub-menu").show();
    jQuery(".st-menu .nav li.menu-item-has-children.current-menu-parent > ul.sub-menu").show();
    jQuery(".st-menu .nav > li.menu-item-has-children").addClass('dropdown');
    jQuery(".st-menu .nav > li.menu-item-has-children.current-menu-item").removeClass('dropdown');
    jQuery(".st-menu .nav > li.menu-item-has-children.current-menu-parent").removeClass('dropdown');
    jQuery(".st-menu .nav > li.menu-item-has-children > a").after('<span class="arrow"></span>');
    jQuery(".st-menu .nav > li.menu-item-has-children").find('span.arrow').click(function () {
        if (!jQuery(this).parent().hasClass('dropdown')) {
            jQuery(this).parent().addClass('dropdown');
            jQuery(this).next().slideUp();
        } else {
            jQuery(this).parent().removeClass('dropdown');
            jQuery(this).next().slideDown();
        }
    });

    // Menu mobile
    jQuery('button.left-menu').click(function () {
        var effect = jQuery(this).attr('data-effect');
        if (jQuery(this).parent().parent().hasClass('mobile-clicked')) {
            jQuery('.st-menu').animate({
                width: 0
            }).css({
                display: 'none',
                transform: 'translate(0px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
            jQuery(this).parent().parent().addClass('mobile-unclicked').removeClass('mobile-clicked').css({
                transform: 'translate(0px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
            jQuery(this).parent().parent().parent().removeClass('st-menu-open ' + effect);
            jQuery("#ppo-overlay").hide();
        } else {
            jQuery(this).parent().parent().parent().addClass('st-menu-open ' + effect);
            jQuery('.st-menu').animate({
                width: 200
            }).css({
                display: 'block',
                transform: 'translate(200px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
            jQuery(this).parent().parent().addClass('mobile-clicked').removeClass('mobile-unclicked').css({
                transform: 'translate(200px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
            jQuery("#ppo-overlay").show();
        }
    });
    jQuery("#ppo-overlay").click(function (){
        if (jQuery(".st-container").find('.mobile-header').hasClass('mobile-clicked')) {
            jQuery('button.left-menu').trigger('click');
        }
    });
    jQuery("#search").focusin(function () {
        jQuery(this).prev().hide();
    });
    jQuery("#search").focusout(function () {
        jQuery(this).prev().show();
    });
    jQuery('button.right-menu').click(function () {
        window.location = mob_reg_url;
    });
    
    // Images Carousel fullwidth
    if ($(".wpb_images_carousel").hasClass('fullwidth')) {
        $(".wpb_images_carousel.fullwidth").parent().parent().css({
            'padding-left': '0px',
            'padding-right': '0px'
        });
        $(".wpb_images_carousel.fullwidth").parent().parent().parent().css({
            width: '100%',
            'max-width': '100%',
            'padding-left': '0px',
            'padding-right': '0px'
        });
        $(".wpb_images_carousel.fullwidth .vc_item img").each(function () {
            if ($(this).width() < $(window).width()) {
                $(this).css({
                    width: '100%'
                });
            }
        });
    }
});