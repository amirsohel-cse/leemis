
var pusher = new Pusher('c7cee6669b1a2022dd51', {
    cluster: 'ap3'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
    const vendorNotifyList = $('#vendorOrderNotify');
    const vendorNotificationCount = $('#vendorOrderCount');
    const vendorId = $('#vendorId').val();
    if (data.type == 'order'){
        if (data.vendors.length > 0){
            for (let i = 0; i < data.vendors.length; i++){
                if (data.vendors[i] == vendorId){
                    $(vendorNotifyList).append(`
                            <li>
                                            <a href="/vendor/notify/${data.order_product_id[i]}/vendorOrder">
                                                <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                                <div class="feeds-body">
                                                    <h4 class="title text-danger">#${data.order_code} <small class="float-right text-muted font-12">${data.created_at}</small></h4>
                                                    <small>${data.name} has placed an order</small>
                                                </div>
                                            </a>
                                            </li>
                            `);

                    let old = parseInt(vendorNotificationCount.text());
                    $(vendorNotificationCount).text(old + 1);
                    break;
                }
            }
        }

    }
});
