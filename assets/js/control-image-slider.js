jQuery(document).ready(function ($) {

    var $slide_box = $(".repeatable"),
        $slide_items = $(".repeat_block");
    $slide_box.sortable({
        axis: "y"
    });
    $slide_box.disableSelection();
    $slide_box.on("sortstop", function (event, ui) {
        console.log(this);
        update_repeatable_list(this);
    });

    $slide_items.find('input[data-name="url"]').on('change', function (e) {
        update_repeatable_list(this);
    });
    $slide_items.find('input[data-name="title"]').on('change', function (e) {
        update_repeatable_list(this);
    });
    $slide_items.find('input[data-name="link"]').on('change', function (e) {
        update_repeatable_list(this);
    });
    $slide_items.find('textarea[data-name="text"]').on('change', function (e) {
        update_repeatable_list(this);
    });

    // update joined value
    function update_repeatable_list(el) {

        // console.log(el);
        var $box = ($(el).hasClass('repeatable')) ? $(el) : $(el).parents('.repeatable'),
            $all_items = $box.find('.repeat_block'),
            val = [];
        // console.log( $box );

        $all_items.each(function () {
            var val_url = $(this).find('input[data-name="url"]').val(),
                val_title = $(this).find('input[data-name="title"]').val(),
                val_link = $(this).find('input[data-name="link"]').val(),
                val_text = $(this).find('textarea[data-name="text"]').val();
            val.push({
                url: (val_url.length > 0) ? val_url : '',
                title: (val_title.length > 0) ? val_title : '',
                link: (val_link.length > 0) ? val_link : '',
                text: (val_text.length > 0) ? val_text : ''
            });
        });
        // console.log( val );
        var encoded = JSON.stringify(val, "", 4);

        $box.siblings('input.repeatable_value').val(encoded).trigger('change');
        // console.log('after = ' + $box.siblings('input.repeatable_value').val());
    }

    // choose images
    $('.slider_upload_image').click(function (e) {
        var l = 'Загрузить',
            s = "Выбрать";

        e.preventDefault();
        var img_url = $(this).prev(),
            image = wp.media({
                title: l,
                multiple: false,
                button: {
                    text: s
                }
            }).open()
                .on('select', function (e) {
                    var uploaded_image = image.state().get('selection').first();
                    var image_url = uploaded_image.toJSON().url;
                    $(img_url).prev().html('<img src="' + image_url + '" alt="" />');
                    $(img_url).val(image_url);
                    // console.log( $(img_url).parents('.repeatable') );
                    update_repeatable_list($(img_url).parents('.repeatable'));
                });
    });

    // add slide
    $('.repeat_block_add').click(function () {

        var $box = $(this).parent().siblings('.repeatable'),
            cloned = $box.find('.repeat_block').eq(0).clone(true);

        // clear fields
        $(cloned).find('input[type=text], input[type=hidden], textarea').each(function () {
            $(this).val('');
        });
        $(cloned).find('.img_prev').html('');
        $(cloned).find('.remove_block').on('click', remove_function);

        // toggle
        $(cloned).find('.toggle_block i').removeClass('dashicons-arrow-down-alt2');
        $(cloned).find('.toggle_block i').addClass('dashicons-arrow-up-alt2');
        $(cloned).find('.repeat-item-col').show();

        $(cloned).appendTo($box);

        update_repeatable_list($box);
        // console.log('ACTION: repeat_block_add');

    });

    // remove slide
    $('.remove_block').bind('click', remove_function);

    function remove_function() {
        var iam = $(this).parents('.repeat_block'), //closest('.repeat_block'),
            $others = $(iam).siblings();

        if ($others.length >= 1) {
            $(this).parent('.repeat_block').remove();
        } else {
            $(iam).find('input[type=text], input[type=hidden] textarea').each(function () {
                $(this).val('');
            });
            $(iam).find('.img_prev').html('');
        }
        update_repeatable_list($others.eq(0));

    }

    $('.toggle_block').on('click', function () {
        $(this).find('i.dashicons').toggleClass('dashicons-arrow-up-alt2');
        $(this).find('i.dashicons').toggleClass('dashicons-arrow-down-alt2');
        $(this).parents('.repeat_block').toggleClass('toggled');
        $(this).parents('.repeat_block').find('.repeat-item-col').toggle();
    });

    // Получаем введенный текст в заголовок

    $('.repeat_block').find('textarea[data-name=title]').bind('change keyup', function () {
        var titleSlide = $($(this).parents().get(2)).children('.repeat_title').text($(this).val());
        console.log(titleSlide);
        if (titleSlide.length <= 0) {
            console.log('empty');
        }
    });

});
