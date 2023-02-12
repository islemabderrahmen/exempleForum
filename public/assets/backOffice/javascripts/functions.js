//don't use $(document).ready(function () here

// add opacity to body
function bodyOpacityOn() {
    $('body').addClass('opacityOn');
}

// remove opacity from body
function bodyOpacityOff() {
    $('body').removeClass('opacityOn');
}

// show loading image
function showLoadingDiv() {
    $("#divLoading").show();
}

// hide loading image
function hideLoadingDiv() {
    $("#divLoading").hide();
}

// onclick disable button submit
$(document).on('submit', "form", function () {
    $(this).find("button[type='submit']").prop('disabled', true);
});

// display loading image
$(document).on('submit', ".with-loading", function () {
    bodyOpacityOn();
    showLoadingDiv();
});

// onClick on link has class with-loading
$(document).on('click', "a.with-loading, td.with-loading", function () {
    bodyOpacityOn();
    showLoadingDiv();
});


// reset form
$(document).on('click', "#reset", function () {
    // $(this).closest('form').trigger("reset");
    $('.form-radio').removeClass('active').end();
    $('input[type=radio]').prop('checked', function () {
        $("input[type=radio][checked='checked']").parent().addClass('active');
        return this.getAttribute('checked') == 'checked';
    });
});

// redirect to other page
$('#redirectSelect').change(function () {
    // set the window's location advert to the value of the option the user has selected
    window.location = $(this).val();
});

$(document).on('click', "#logout", function (e) {
    e.preventDefault();
    var route = $(this).attr('href');

    bootbox.dialog({
        title: '<i class="fa fa-exclamation-triangle" style="color: brown"></i> Confirmation',
        message: 'Etez-vous sûre de deconnecter ?',
        className: 'my-class',
        buttons: {
            cancel: {
                className: 'btn btn-default',
                label: 'Annuler'
            },
            success: {
                className: 'btn btn-danger with-loader',
                label: '<i class="fa fa-power-off"></i> Déconnexion',
                callback: function () {
                    window.location.href = route;
                }
            }
        }
    });
});

