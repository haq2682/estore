<x-seller-master>
	@section('objects')
		<div class="app-wrapper">

            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <h1 class="app-page-title">Update Product</h1>
                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">

                                <div class="app-card-body">
                                    <form class="settings-form" action="{{route('seller.update_status', $order->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
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