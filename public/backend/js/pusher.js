
var pusher = new Pusher('c7cee6669b1a2022dd51', {
    cluster: 'ap3'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
    let notificationNoOrder = $('#orderCount');
    let notificationNoVendor = $('#vendorCount');
    let notificationNoWithdraw = $('#withdrawNotificationCount');
    if(data.type == 'order') {
        $('#notificationList').append(`
                            <li>
                                <a href="/admin/notify/order-details/${data.order_id}">
                                    <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                    <div class="feeds-body">
                                        <h4 class="title text-danger">#${data.order_code} <small class="float-right text-muted font-12">${data.created_at}</small></h4>
                                        <small>${data.name} ${data.text}</small>
                                    </div>
                                </a>
                            </li>

    `);
        let old = parseInt(notificationNoOrder.text());
        $(notificationNoOrder).text(old + 1);
    }else if (data.type == 'vendor' || data.type == 'user'){
        let link = '';
        if (data.type == 'vendor'){
            link = `/admin/notify/vendor-list/${data.note_id}`;
        }else if (data.type == 'user'){
            link = `/admin/notify/user-list/${data.note_id}`
        }
        $('#vendorSignupNotification').append(`
            <li>
                                        <a href="${link}">
                                            <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger">#${data.name} <small class="float-right text-muted font-12">${data.created_at}</small></h4>
                                                <small>${data.text}</small>
                                            </div>
                                        </a>
                                    </li>

        `);
        let old = parseInt(notificationNoVendor.text());
        $(notificationNoVendor).text(old + 1);
    }else if (data.type == 'withdraw')
    {
        $('#withdrawNotificationList').append(`
            <li>
                                        <a href="../../admin/notify/withdraw-req/${data.note_id}">
                                            <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger">Tk. ${data.amount} <small class="float-right text-muted font-12">${data.created_at}</small></h4>
                                                <small>${data.name} ${data.text}</small>
                                            </div>
                                        </a>
                                    </li>

        `);
        let old = parseInt(notificationNoWithdraw.text());
        $(notificationNoWithdraw).text(old + 1);
    }


});
