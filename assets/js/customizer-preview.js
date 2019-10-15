/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function ($) {

    /*    // Site title and description.
        wp.customize('blogname', function (value) {
            value.bind(function (to) {
                $('.site-title a').text(to);
            });
        });
        wp.customize('blogdescription', function (value) {
            value.bind(function (to) {
                $('.site-description').text(to);
            });
        });*/

    /*    // Header text color.
        wp.customize('header_textcolor', function (value) {
            value.bind(function (to) {
                if ('blank' === to) {
                    $('.site-title a, .site-description').css({
                        'clip': 'rect(1px, 1px, 1px, 1px)',
                        'position': 'absolute'
                    });
                } else {
                    $('.site-title a, .site-description').css({
                        'clip': 'auto',
                        'position': 'relative'
                    });
                    $('.site-title a, .site-description').css({
                        'color': to
                    });
                }
            });
        });*/
    /*wp.customize('img.header-banner', function (value) {
        console.log( value );
        value.bind(function (to) {
            console.log( to );
            $('.header-banner img').attr('src', to);
            var $link = $('.header-banner img');
            to.length == 0 ? $($link).hide() : $($link).show();
        });
    });*/
    wp.customize('facebook_link', function (value) {
        value.bind(function (to) {
            //console.log( to );
            $('.social-links a.fb-link').attr('href', to);
            var $link = $('.social-links .fb-link');
            to.length == 0 ? $($link).hide() : $($link).show();
        });
    });

})(jQuery);