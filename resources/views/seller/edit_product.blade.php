<x-seller-master>
    @section('objects')
        @if(session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{session('message')}}
            </div>
        @endif
        <div class="app-wrapper">

            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <h1 class="app-page-title">Update Product</h1>
                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">

                                <div class="app-card-body">
                                    <form class="settings-form" action="{{route('seller.update', $product->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3 form-group form-group--inline">
                                            <label class="form-label">Product Name</label>
                                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group form-group--inline">
                                            <label class="form-label">Overview</label>
                                            <input name="overview" type="text" class="form-control @error('overview') is-invalid @enderror" value="{{$product->overview}}">
                                            @error('overview')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group form-group--inline">
                                            <label class="form-label">Description</label>
                                            <input style="
  height: 300px;" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$product->description}}">
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group form-group--inline">
                                            <label class="form-label">Product Image 1</label>
                                            <input name="product_image1" type="file" class="form-control @error('product_image1') is-invalid @enderror">
                                            @error('product_image1')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group form-group--inline">
                                            <label class="form-label">Product Image 2</label>
                                            <input name="product_image2" type="file" class="form-control @error('product_image2') is-invalid @enderror">
                                            @error('product_image2')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group form-group--inline">
                                            <label class="form-label">Product Image 3</label>
                                            <input name="product_image3" type="file" class="form-control @error('product_image3') is-invalid @enderror">
                                            @error('product_image3')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group form-group--inline">
                                            <label class="form-label">Product Image 4</label>
                                            <input name="product_image4" type="file" class="form-control @error('product_image4') is-invalid @enderror">
                                            @error('product_image4')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group form-group--inline">
                                            <label class="form-label">Product Image 5</label>
                                            <input name="product_image5" type="file" class="form-control @error('product_image5') is-invalid @enderror">
                                            @error('product_image5')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group form-group--inline">
                                            <label class="form-label">Amount of Stock</label>
                                            <input min="1" name="count" type="number" class="form-control @error('count') is-invalid @enderror" value="{{$product->count}}">
                                            @error('count')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group form-group--inline">
                                            <label class="form-label">New Price (Current Price)</label>
                                            <input min="1" name="new_price" type="number" class="form-control @error('new_price') is-invalid @enderror" value="{{$product->new_price}}">
                                            @error('new_price')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group form-group--inline">
                                            <label class="form-label">Old Price (Only fill if you want your product to be on sale)</label>
                                            <input min="1" name="old_price" type="number" value="{{$product->old_price}}" class="form-control @error('old_price') is-invalid @enderror">
                                            @error('old_price')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group form-group--inline">
                                            <label class="form-label">
                                                Category
                                            </label>
                                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn app-btn-primary">Add Product</button>
                                    </form>
                                </div><!--//app-card-body-->

                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                </div><!--//container-fluid-->
            </div><!--//app-content-->
        </div><!--//app-wrapper-->
    @endsection
</x-seller-master>
