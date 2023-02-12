
$(document).on('click', ".ajouter-en-suivre", function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var id = $(this).attr('data-id');

    $(this).hide();
    $(this).nextAll('.supprimer-de-suivre').show();

    $('#ajouter-en-suivre-' + id).hide();
    $('#supprimer-de-suivre-' + id).show();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data:{'id': id},
        url: url,
        success: function () {
            console.log('Success');
        },
        error: function () {
            alert('erreur');
            $('#supprimer-de-suivre-' + id).hide();
            $('#ajouter-en-suivre-' + id).show();
        }
    });
});

$(document).on('click', ".supprimer-de-suivre", function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var id = $(this).attr('data-id');

    $(this).hide();
    $(this).prev('.ajouter-en-suivre').show();
    $('#supprimer-de-suivre-' + id).hide();
    $('#ajouter-en-suivre-' + id).show();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data:{'id': id},
        url: url,
        success: function () {
            console.log('Success');
        },
        error: function () {
            alert('erreur');
            $('#ajouter-en-suivre-' + id).show();
            $('#supprimer-de-suivre-' + id).hide();
        }
    });
});

