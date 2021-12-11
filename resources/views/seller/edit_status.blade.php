<x-seller-master>
	@section('objects')
        @if(session()->has('message'))
            <div style="text-align: center;" class="alert alert-success" role="alert">
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
                                    <form class="settings-form" action="{{route('seller.update_status', $order->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3 form-group form-group--inline">
                                            <label class="form-label">
                                                Statuses
                                            </label>
                                            <h5>Current Status: {{$order->orderstatus->status}}</h5>
                                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                                @foreach($statuses as $status)
                                                <option value="{{$status->id}}">{{$status->status}}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn app-btn-primary">Save Changes</button>
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
