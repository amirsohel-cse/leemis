<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $product_sold }}<i class="fa fa-shopping-basket float-right"></i></h3>
                <span>Products Sold</span>
            </div>
            <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                <div class="progress-bar" data-transitiongoal="64"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $total_profit }}<i class="fa fa-dollar float-right"></i></h3>
                <span>Total Profit</span>
            </div>
            <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                <div class="progress-bar" data-transitiongoal="64"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $total_sell }}<i class="fa fa-dollar float-right"></i></h3>
                <span>Total Selling Amount</span>
            </div>
            <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                <div class="progress-bar" data-transitiongoal="64"></div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div id="todayr" class="table mt-3">
            <table id="r"class="table table-striped table-hover dataTable js-exportable">
    
                <thead>
                    <tr>
                        <th>Order Code</th>
                        <th>Date</th>
                        <th>Biller Name</th>
                        <th>Biller Phone</th>
                        <th>Products</th>
                        <th>Payment Method</th>
                        <th>Shipping Method</th>
                        <th>Total</th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($all_oders as $row)
                        <tr>
                            <td>{{ $row->order_id }}</td>
                            <td>{{ $row->created_at->format('d-m-Y') }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->orderProduct->sum('qty') }}</td>
                            <td>{{ $row->payment_method }}</td>
                            <td>{{ $row->shipping_method }}</td>
                            <td>{{ $row->subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>