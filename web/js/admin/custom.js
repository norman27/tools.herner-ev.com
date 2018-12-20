(function($) {
    // activate buttons
    $('.js-activate').on('click', function(event) {
        event.preventDefault();
        var $currentButton = $(this);
        $.ajax({url: $(this).attr('href'), success: function(result) {
            if (result == 1) {
                $('.js-activate').each(function() {
                    $(this).find('button').removeClass('btn-default');
                    $(this).find('button').addClass('btn-success');
                });
                $currentButton.find('button').addClass('btn-default');
                $currentButton.find('button').removeClass('btn-success');
            }
        }});
    });

    // add symfony forms field help text
    $('.js-data-help').each(function() {
        var outerDiv = $(this).parent();
        outerDiv.append($(this).data('help'));
    });

    // addable form lists
    $('.js-addable-list').each(function() {
        var label = $(this).parent().parent().find('label').html();
        $(this).parent().append('<a href="#" class="js-form-list-add btn btn-info"><i class="fa fa-plus"></i> ' + label + '</a>');
    });
    $('.js-form-list-add').click(function(e) {
        e.preventDefault();

        var list = $(this).parent().find('div').first(),
            lastLabel = parseInt(list.find('.control-label:last').html())+1,
            newWidget = list.data('prototype');

        if (isNaN(lastLabel)) {
            lastLabel = 0;
        }

        // replace the "__name__" used in the id and name of the prototype with a number that's unique to your goals
        newWidget = newWidget.replace(/__name__/g, lastLabel);

        var newLi = $('<div></div>').html(newWidget);
        newLi.appendTo(list);
    });

    // effect selection simplified
    $('.js-modal-link').on('click', function(e) {
        e.preventDefault();
        $('#myModal').modal({
            remote: $(this).attr('href')
        })
    });
    $('#myModal').on('shown.bs.modal', function (e) {
        $('.js-rpc-post').on('click', function(e) {
            e.preventDefault();
            var data = {},
                addDataInput = $(this).parent().find('input:first');

            if (addDataInput.length === 1) {
                data = {data: addDataInput.val()}
            }

            $.ajax({
                url: $(this).attr('href'),
                data: data
            });
        })
    });

    // remove flash messages
    window.setTimeout(function() {
        $('.js-flash').each(function() {
            $(this).fadeOut(2000, function() {
                $(this).hide();
            })
        });
    }, 2000);
})(jQuery);
