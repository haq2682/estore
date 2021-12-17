<x-seller-master>
	@section('objects')
		        <div class="app-wrapper">

            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">

                    <div class="row g-3 mb-4 align-items-center justify-content-between">
                        <div class="col-auto">
                            <h1 class="app-page-title mb-0">Orders</h1>
                        </div>
                    </div><!--//row-->

                    <div class="tab-content" id="orders-table-tab-content">
                        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                            @if(count($orders)>0)
                            <div style="padding: 30px;" class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">

                                    <div class="table-responsive">
                                        <table id="dataTable" class="table app-table-hover mb-0 text-left">
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
                                                <th class="cell">Edit Status</th>
                                            </tr>
                                            </thead>
                                            <tbody class="tbody">
                                                @foreach($orders as $order)
                                            <tr>
                                                <td class="cell">{{$order->orderno}}</td>
                                                <td class="cell">{{$order->product->name}}</td>
                                                <td class="cell">{{$order->user->name}}</td>
                                                <td class="cell">{{$order->orderstatus->status}}</td>
                                                <td class="cell">{{$order->subtotal}}</td>
                                                <td class="cell">{{$order->total}}</td>
                                                <td class="cell">{{$order->address}}, {{$order->city}}, {{$order->province}}, {{$order->country}}, {{$order->postal_code}}</td>
                                                <td class="cell">{{$order->phone}}</td>
                                                <td class="cell">
                                                    <a class="btn-sm app-btn-secondary" href="{{route('seller.edit_status', $order->id)}}">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

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
        @section('scripts')

            <script>
                $(document).ready(function(){
                    $('#dataTable').DataTable();
                });
            </script>
        @endsection
</x-seller-master>

