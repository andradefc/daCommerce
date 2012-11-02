/*
 * Dandelion Admin v1.0 - Login JS
 *
 * This file is part of Dandelion Admin, an Admin template build for sale at ThemeForest.
 * For questions, suggestions or support request, please mail me at maimairel@yahoo.com
 *
 * Development Started:
 * March 25, 2012
 */

(function($) {
    $(document).ready(function(e) {

        $('.error').delay(1500).animate({opacity:0}, 500);

        $("#da-login-form").validate({
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                username: 'Campo obrigatório',
                password: 'Campo obrigatório'
            }
        });

        /* Placeholder */
        if($.fn.placeholder) {
            $('[placeholder]').placeholder();
        }
    });
}) (jQuery);