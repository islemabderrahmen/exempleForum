// for searching data
$(document).on('submit', "#search-form", function (e) {
    e.preventDefault();

    var $form = $('#search-form');
    var type = $form.attr('method');
    var data = $form.serialize();
    var url = $form.attr('action') + '?' + data;

    $.ajax({
        url: url,
        type: type,
        data: data,
        dataType: 'html',
        success: function (html) {
            $form.find("button[type='submit']").prop("disabled", false);
            hideLoadingDiv();
            bodyOpacityOff();
            $('#main').replaceWith(
                $(html).find('#main')
            );
            var state = {data: $('#load-ajax').html()};
            window.history.pushState(state, "Title", url);

        },
        error: function (XHR, status, error) {
            $form.find("button[type='submit']").prop("disabled", false);
            hideLoadingDiv();
            bodyOpacityOff();
            alert(error);
        }
    });

    $('html,body').animate({
        scrollTop: $('#main').offset().top
    }, 1000);
});

