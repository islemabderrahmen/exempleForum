$(document).ready(function () {
    $(".reorder-list").sortable({
        update: function () {
            updateOrder();
        }
    });
});

function updateOrder() {
    var url = $('.reorder-list').attr('data-order-target');
    var item_order = new Array();
    $('.reorder-list .ui-sortable-handle').each(function () {
        item_order.push($(this).attr("id"));
    });
    var order_string = 'order=' + item_order;
    $.ajax({
        type: "POST",
        url: url,
        data: order_string,
        cache: false,
        success: function (data) {
        }
    });
}