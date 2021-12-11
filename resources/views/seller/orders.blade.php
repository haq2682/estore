<x-seller-master>
	@section('objects')
		        <div class="app-wrapper">

            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">

                    <div class="row g-3 mb-4 align-items-center justify-content-between">
                        <div class="col-auto">
                            <h1 class="app-page-title mb-0">Orders</h1>
                        </div>
                        <div class="col-auto">
                            <div class="page-utilities">
                                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                    <div class="col-auto">
                                        <form class="table-search-form row gx-1 align-items-center">
                                            <div class="col-auto">
                                                <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn app-btn-secondary">Search</button>
                                            </div>
                                        </form>

                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//table-utilities-->
                        </div><!--//col-auto-->
                    </div><!--//row-->

                    <div class="tab-content" id="orders-table-tab-content">
                        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                            @if(count($orders)>0)
                            <div class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">

                                    <div class="table-responsive">
                                        <table class="table app-table-hover mb-0 text-left">
                                            <thead>
                                            <tr>
                                                <th class="cell">Order #</th>
                                                <th class="cell">Product Name</th>
                                                <th class="cell">Customer Name</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Subtotal</th>
                                                <th class="cell">Total</th>
                                                <th class="cell">Address</th>
                                                <th class="cell">Contact #</th>
                                                <th class="cell"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                            <tr>
                                                <td>{{$order->orderno}}</td>
                                                <td>{{$order->product->name}}</td>
                                                <td>{{$order->user->name}}</td>
                                                <td>{{$order->orderstatus->status}}</td>
                                                <td>{{$order->subtotal}}</td>
                                                <td>{{$order->total}}</td>
                                                <td>{{$order->address}}, {{$order->city}}, {{$order->province}}, {{$order->country}}, {{$order->postal_code}}</td>
                                                <td>{{$order->phone}}</td>
                                                <td>
                                                    <a class="btn-sm app-btn-secondary" href="{{route('seller.edit_status', $order->id)}}">
                                                        Edit Status
                                                    </a>
                                                </td>
                                            </tr>
                                                @endforeach

                                    </div><!--//table-responsive-->

                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                            @else
                                <h4 style="text-align: center;">You don't have any orders yet.</h4>
                            @endif
                        </div><!--//tab-pane-->
                    </div><!--//tab-content-->



                </div><!--//container-fluid-->
            </div><!--//app-content-->
        </div><!--//app-wrapper-->
	@endsection
</x-seller-master>
