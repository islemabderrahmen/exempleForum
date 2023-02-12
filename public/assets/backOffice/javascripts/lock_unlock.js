$(document).on('click', ".activate-deactivate", function (e) {
    e.preventDefault();
    var route = $(this).attr('href');
    var dataActive = $(this).attr('data-active');
    var $spinner = $(this).nextAll('.fa-spinner');
    var $self = $(this);
    $self.hide();
    $spinner.show();

    $.ajax({
        type: 'POST',
        url: route,
        beforeSend: function () {

        },
        success: function () {
            $spinner.hide();
            if (dataActive === '1') {
                $self.find('.icon-unlocked').hide();
                $self.find('.icon-locked').show();
                $self.attr('data-active', '0');
            }
            else if (dataActive === '0') {
                $self.find('.icon-locked').hide();
                $self.find('.icon-unlocked').show();
                $self.attr('data-active', '1');
            }
            $self.show();
            console.log('Success');
        },
        error: function (XHR, status, error) {
            $spinner.hide();
            $self.show();
            console.log(XHR);
            console.log(status);
            console.log(error);
            alert('erreur');
        }
    });
});
