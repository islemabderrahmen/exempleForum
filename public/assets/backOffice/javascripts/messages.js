function setMessagesNumberTop() {
    var $numberUnreadMessages = $('#number-unread-messages-top');
    var oldNumberUnreadMessages = parseInt($numberUnreadMessages.text());
    var newNumberUnreadMessages = oldNumberUnreadMessages - 1;
    $numberUnreadMessages.text(newNumberUnreadMessages);
    if (newNumberUnreadMessages === 0) {
        $numberUnreadMessages.hide();
    }
}

//in the TABLE onClick on link has class with-loading (message)
$(document).on('click', ".read-message", function () {
    $(this).removeClass('read-message');
    var dataId = $(this).closest('tr').attr('data-id');
    var $iconClosed = $(this).closest('tr').find('.icon-closed');
    var $iconOpen = $(this).closest('tr').find('.icon-open');
    var $liMessageTop = $('#li-message-top-' + dataId);// in the top header
    $iconClosed.hide();
    $iconOpen.show();
    $liMessageTop.removeClass('bg-gray');
    $liMessageTop.find('.read-message-top').removeClass('read-message-top');
    setMessagesNumberTop();
});

// on the TOP HEADER
$(document).on('click', ".read-message-top", function () {
    var dataId = $(this).closest('li').attr('data-id');
    var $trMessage = $('#tr-message-' + dataId); // in the table
    $(this).closest('li').removeClass('bg-gray');
    $(this).removeClass('read-message-top');
    $trMessage.find('.icon-closed').hide();
    $trMessage.find('.icon-open').show();
    $trMessage.find('.read-message').removeClass('read-message');
    setMessagesNumberTop();
});