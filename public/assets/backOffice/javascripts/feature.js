$(document).on('click', ".feature", function (e) {
    e.preventDefault();
    var route = $(this).attr('href');
    var dataFeatured = $(this).attr('data-featured');
    if (dataFeatured === '1') {
        $(this).find('.featured').hide();
        $(this).find('.non-featured').show();
        $(this).attr('data-featured', '0')
    }
    else if (dataFeatured === '0') {
        $(this).find('.non-featured').hide();
        $(this).find('.featured').show();
        $(this).attr('data-featured', '1')
    }
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: route,
        beforeSend: function () {
        },
        success: function () {
            console.log('Success');
        },
        error: function (XHR, status, error) {
            console.log(XHR);
            console.log(status);
            console.log(error);
            alert('erreur');
        }
    });
});