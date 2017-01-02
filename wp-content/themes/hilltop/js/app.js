(function ($, root, undefined) {
    $(function () {
        'use strict';
        // DOM ready, take it away
        $(document).foundation();
        set_header_title_height();
        $(window).load(function() {
            set_header_title_height();
        });
        $(window).resize(function() {
            set_header_title_height();
        });

        function set_header_title_height() {
            if ($(".logo-image").height() != 0) {
                $(".entry-header").css('height', $(".logo-image").height());
            } else {
                $(".entry-header").css('height', 'auto');
            }
        }

        var image_list = new Array();
        var current_image_index = 0;

        $('.room-thumb-list li a').on('click', function(e) {
            e.preventDefault();
            if (image_list.length == 0) {
                $( '.room-thumb-list li a' ).each(function( index ) {
                    image_list.push({href: $(this).attr('href'), title: $(this).find('img').attr('title') });
                });
            }
            current_image_index = $(this).parent().index();

            show_image(current_image_index);

        });

        function show_image(current_image_index) {
            var link_src = image_list[current_image_index].href;
            var title = image_list[current_image_index].title;

            var image_number = current_image_index + 1;
            var total_image = $( '.room-thumb-list li' ).size();

            $('#gallery-image-modal #modal-image').attr('src', link_src);
            $('#gallery-image-modal #image-description').html(title);
            $('#gallery-image-modal #image-index').html('Image ' + image_number + ' of ' + total_image);

            $('.btn-modal-prev').show();
            $('.btn-modal-next').show();

            if (current_image_index == 0) {
                $('.btn-modal-prev').hide();
            }
            if (current_image_index == (total_image - 1)) {
                $('.btn-modal-next').hide();
            }
            var over = '<div id="loader-overlay"><div id="loading">loading...</div></div>';
            $(over).appendTo('body');
            $("img").one("load", function() {
                $('#loader-overlay').remove();
                $('#gallery-image-modal').foundation('reveal', 'open');
            }).each(function() {
                if(this.complete) $(this).load();
            });
        }
        $(document).on('click', '.btn-modal-prev', function() {
            current_image_index--;
            show_image(current_image_index);
        });
        $(document).on('click', '.btn-modal-next', function() {
             current_image_index++;
            show_image(current_image_index);
        });

        $(document).on('click', '.rates-tab-links li a', function() {
            var is_selected = $(this).parent().attr('class');
            var id = $(this).parent().attr('id');
            if (is_selected != 'selected') {
                $('.rates-tab').hide();
                $('.rates-tab-links li').removeClass();
                $(this).parent().attr('class', 'selected');
                $('#tab-' + id).show();
            }
        });

        $(document).on('click', '.button .bookable', function() {
            if (window.alert("You are being redirected to ResOnline to complete your booking.")) {
                return true;
            } else {
                return false;
            }
        });


    });

})(jQuery, this);
