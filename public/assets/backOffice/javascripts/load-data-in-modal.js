// display data inside a modal
$(document).on('show.bs.modal', "#myModalShow", function (e) {
    // load content into modal from the link
    var link = $(e.relatedTarget);
    $(this).load(link.attr("href"), function (responseTxt, statusTxt, xhr) {
        if (statusTxt === "success") {
            hideLoadingDiv();
            bodyOpacityOff();
        }
        if (statusTxt === "error") {
            alert("Erreur: " + xhr.status + ": " + xhr.statusText);
            hideLoadingDiv();
            bodyOpacityOff()
        }
    });

    $(this).on("hidden.bs.modal", function () {
        hideLoadingDiv();
        bodyOpacityOff();
        $(this).html('');
    });
});
