$(document).ready(function () {

    $(document).on('click', ".remove-item", function (e) {
        e.preventDefault();
        var $blockToHide = $(this).closest('.item-block');
        var route = $(this).attr('href');

        bootbox.dialog({
            title: '<i class="fa fa-exclamation-triangle" style="color: brown"></i> Confirmation',
            message: 'Etez-vous sûre de supprimer ceci ?',
            className: 'my-class',
            buttons: {
                cancel: {
                    className: 'btn btn-default',
                    label: 'Fermer'
                },
                success: {
                    className: 'fa fa-trash-o btn btn-danger',
                    label: ' Supprimer',
                    callback: function () {
                        $blockToHide.fadeOut('slow');
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: route,
                            success: function () {
                                console.log('Success');
                            },
                            error: function (XHR, status, error) {
                                $blockToHide.show();
                                console.log(XHR);
                                console.log(status);
                                console.log(error);
                                alert('erreur pendant la suppression');
                            }
                        });
                    }
                }
            }
        });
    });

});