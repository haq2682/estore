<x-seller-master>
    @section('objects')
        <div style="margin-left: 250px;" class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <h1 class="app-page-title">Overview</h1>
                <div class="row g-4 mb-4">
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Total Items Sold</h4>
                                <div class="stats-figure">{{$items_sold}}</div>
                            </div><!--//app-card-body-->
                            <a class="app-card-link-mask" href="#"></a>
                        </div><!--//app-card-->
                    </div><!--//col-->

                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Total Revenue Made</h4>
                                <div class="stats-figure">${{$sum}}</div>
                            </div><!--//app-card-body-->
                            <a class="app-card-link-mask" href="#"></a>
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Products</h4>
                                <div class="stats-figure">{{count($products)}}</div>
                            </div><!--//app-card-body-->
                            <a class="app-card-link-mask" href="{{route('seller.products')}}"></a>
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Orders</h4>
                                <div class="stats-figure">{{count($orders)}}</div>
                            </div><!--//app-card-body-->
                            <a class="app-card-link-mask" href="{{route('seller.orders')}}"></a>
                        </div><!--//app-card-->
                    </div><!--//col-->
                </div><!--//row-->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Sales</h4>
                                    </div><!--//col-->
                                    <div class="col-auto">
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="chart-container">
                                    <canvas id="canvas-linechart" ></canvas>
                                </div>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Revenue</h4>
                                    </div><!--//col-->
                                    <div class="col-auto">
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="chart-container">
                                    <canvas id="canvas-barchart" ></canvas>
                                </div>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->

                </div><!--//row-->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-stats-table h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Recently Sold Items</h4>
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <div class="card-header-action">
                                            <a href="#">View All</a>
                                        </div><!--//card-header-actions-->
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="table-responsive">
                                    @if(count($products) > 0)
                                    <table class="table table-borderless mb-0">
                                        <thead>
                                        <tr>
                                            <th class="meta">Product Name</th>
                                            <th class="meta stat-cell">Total Items Sold</th>
                                            <th class="meta stat-cell">Remaining</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td><a href="#">{{$product->product->name}}</a></td>
                                                <td class="stat-cell">{{$product->product->sold}}</td>
                                                <td class="stat-cell">{{$product->product->count}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                        <h6>You haven't made any sales yet.</h6>
                                    @endif
                                </div><!--//table-responsive-->
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    @endsection
</x-seller-master>
<script src="{{asset('assets/js/index-charts.js')}}"></script>
<script>
    var sold = {!! json_encode($sold) !!};
    for(var i = 1; i <= Object.keys(sold).length; i++) {
        lineChartConfig.data.datasets[0].data.push(sold[i]);
    }
    var total = {!! json_encode($total) !!};
    for(var i = 1; i <= Object.keys(total).length; i++) {
        barChartConfig.data.datasets[0].data.push(total[i]);
    }
</script>

