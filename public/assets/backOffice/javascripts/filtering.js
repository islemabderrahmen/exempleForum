// for filtering data

$(document).ready(function () {
    var currentUrl = window.location.href;
    var hostName = window.location.hostname;

    $('#filtering-data li a').each(function(){
        var $this = $(this);
        //var fullUrl = 'http://' + hostName + $this.attr('href');
        var direction = $this.attr('direction');
        $this.attr('href', function(i,a){
            return a.replace( /(direction=)[a-z]+/ig, 'direction=' + direction );
        });
        // if the current path is like this link, make it active
        /* if(fullUrl === currentUrl ){
             $this.addClass('disabled filtering-active');
         }*/
    });

});

$(document).on('click', ".disabled", function (e) {
    e.preventDefault();
    return false;
});

$(document).on('click', ".filtering-data", function (e) {
    e.preventDefault();
    $(this).closest('ul').find('.disabled').removeClass('disabled filtering-active').addClass('with-loading').removeAttr('style');

    var url = $(this).find('a').attr('href');
    var text = $(this).find('a').text();
    $(this).find('a').addClass('disabled filtering-active').removeClass('with-loading').css({ 'color': "white" });
    $('#filtering-button').text(text);

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html',
        success: function (html) {
            hideLoadingDiv();
            bodyOpacityOff();
            $('#load-ajax').replaceWith(
                $(html).find('#load-ajax')
            );
            var state = {data: $('#load-ajax').html()};
            window.history.pushState(state, "Title", url);

        },
        error: function (XHR, status, error) {
            hideLoadingDiv();
            bodyOpacityOff();
            alert(error);
        }
    });

});

