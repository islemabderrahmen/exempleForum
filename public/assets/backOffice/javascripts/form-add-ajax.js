$(document).on('submit', ".form-add-ajax", function (e) {
    e.preventDefault();

    var $form = $('.form-add-ajax');
    var $formInput = $('.form-add-ajax :input');
    var action = $form.attr('action');
    var data = new FormData($form[0]);
    var redirectTo = $form.attr('data-redirect');
    $('.errors-block').html('');
    $formInput.prop("disabled", true);

    $.ajax({
        type: 'post',
        dataType: 'json',
        data: data,
        url: action,
        success: function (response) {
            if (response.result == 0) {
                $('.errors-block').html($(response["view"]));
                $formInput.prop("disabled", false);
                hideLoadingDiv();
                bodyOpacityOff();
                $('html,body').animate({
                    scrollTop: $('.errors-block').offset().top
                }, 1000);
            }
            else {
                window.location.href = redirectTo;
            }
        },
        error: function (XHR, status, error) {
            $formInput.prop("disabled", false);
            hideLoadingDiv();
            bodyOpacityOff();
            $('html,body').animate({
                scrollTop: $('#main').offset().top
            }, 1000);
            alert(error + XHR + status);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});