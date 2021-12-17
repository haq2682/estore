<x-seller-master>
    @section('objects')
        @if(session()->has('message'))
            <span style="text-align: center;" class="alert alert-danger" role="alert">
                {{session('message')}}
            </span>
        @endif
        <div class="app-wrapper">

            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">

                    <div class="row g-3 mb-4 align-items-center justify-content-between">
                        <div class="col-auto">
                            <h1 class="app-page-title mb-0">Products</h1>
                        </div>
                    </div><!--//row-->

                    <div class="tab-content" id="orders-table-tab-content">
                        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                            @if(count($products)>0)
                            <div style="padding: 30px;" class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">

                                    <div class="table-responsive">
                                        <table id="dataTable" class="table app-table-hover mb-0 text-left">
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
                                                <th class="cell"></th>
                                            </tr>
                                            </thead>
                                            <tbody class="tbody">

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
                                                    <form style="display: inline;" action="{{route('seller.delete', $product->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="background: none; border: none;"><a class="btn-sm app-btn-secondary">Delete</a></button>
                                                    </form>
                                                </td>
                                                <td class="cell">
                                                    <button style="background: none; border: none;">
                                                        <a class="btn-sm app-btn-secondary" href="{{route('seller.edit_product', $product->id)}}">
                                                            Edit
                                                        </a>
                                                    </button>
                                                </td>
                                            </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div><!--//table-responsive-->

                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                            @else
                                <h4 style="text-align: center;">You haven't posted any product yet.</h4>
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

