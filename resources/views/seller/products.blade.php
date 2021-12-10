<x-seller-master>
    @section('objects')
        @if(session()->has('message'))
            <span class="alert alert-danger" role="alert">
                {{session('message')}}
            </span>
        @endif
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
                            @if(count($products)>0)
                            <div class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">

                                    <div class="table-responsive">
                                        <table class="table app-table-hover mb-0 text-left">
                                            <thead>
                                            <tr>
                                                <th class="cell">ID</th>
                                                <th class="cell">Product Name</th>
                                                <th class="cell">Stock Status</th>
                                                <th class="cell">Created At</th>
                                                <th class="cell">In Stock Count</th>
                                                <th class="cell">Sold</th>
                                                <th class="cell">Old Price</th>
                                                <th class="cell">New Price</th>
                                                <th class="cell">Category</th>
                                                <th class="cell"></th>
                                                <th class="cell"></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($products as $product)
                                            <tr>
                                                <td class="cell">{{$product->id}}</td>
                                                <td class="cell">{{$product->name}}</td>
                                                <td class="cell">{{$product->stock_status}}</td>
                                                <td class="cell">{{$product->created_at}}</td>
                                                <td class="cell">{{$product->count}}</td>
                                                <td class="cell">{{$product->sold}}</td>
                                                <td class="cell">{{$product->old_price}}</td>
                                                <td class="cell">{{$product->new_price}}</td>
                                                <td class="cell">{{$product->category->name}}</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="{{route('products.details', $product->id)}}">View</a></td>
                                                <td class="cell">
                                                    <form action="{{route('seller.delete', $product->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="background: none; border: none;"><a class="btn-sm app-btn-secondary">Delete</a></button>
                                                    </form>
                                                </td>
                                            </tr>
                                                @endforeach

                                    </div><!--//table-responsive-->

                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                            @else
                                <h4 style="text-align: center;">You haven't posted any product yet.</h4>
                            @endif
                                <div class="ps-pagination">
                                    @if ($products->lastPage() > 1)
                                        <ul class="pagination">
                                            @if ($products->currentPage() > 4 && $page === 2)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                            <li class="{{($products->currentPage()==1)? 'disabled' : ''}}"><a href="{{"show?".request()->getQueryString()."&".parse_url($products->url(1))['query']}}" @if($products->currentPage()==1) disabled @endif><i class="fa fa-angle-left"></i></a></li>
                                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                                <li class="{{($products->currentPage()==$i) ? 'active' : ''}}"><a href="{{"show?".request()->getQueryString()."&".parse_url($products->url($i))['query']}}">{{$i}}</a></li>
                                            @endfor
                                            <li class="{{ ($products->currentPage() == $products->lastPage()) ? 'disabled' : '' }}"><a href="{{"show?".request()->getQueryString()."&".parse_url($products->url($products->currentPage()+1))['query'] }}" @if($products->currentPage() == $products->lastPage()) disabled @endif><i class="fa fa-angle-right"></i></a></li>
                                            @if ($products->currentPage() < $products->lastPage() - 3)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                        </div><!--//tab-pane-->
                    </div><!--//tab-content-->



                </div><!--//container-fluid-->
            </div><!--//app-content-->
        </div><!--//app-wrapper-->
    @endsection
</x-seller-master>
