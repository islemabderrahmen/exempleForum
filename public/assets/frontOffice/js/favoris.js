
$(document).on('click', ".ajouter-en-favoris", function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var id = $(this).attr('data-id');

    $(this).hide();
    $(this).nextAll('.supprimer-de-favoris').show();

    $('#ajouter-en-favoris-' + id).hide();
    $('#supprimer-de-favoris-' + id).show();
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
            $('#supprimer-de-favoris-' + id).hide();
            $('#ajouter-en-favoris-' + id).show();
        }
    });
});

$(document).on('click', ".supprimer-de-favoris", function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var id = $(this).attr('data-id');

    $(this).hide();
    $(this).prev('.ajouter-en-favoris').show();
    $('#supprimer-de-favoris-' + id).hide();
    $('#ajouter-en-favoris-' + id).show();
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
            $('#ajouter-en-favoris-' + id).show();
            $('#supprimer-de-favoris-' + id).hide();
        }
    });
});

