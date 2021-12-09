<x-home-master>

    @section('content')
                   @if(session()->has('message'))
            <div class="alert alert-danger" role="alert">
                {{session('message')}}
            </div>
                       @elseif(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{session('message')}}
            </div>
                       @endif
    <x-profile-master>
        @section('account')
<section class="py-5 my-5">
    <div class="container">
        <h1 class="mb-5">Account Settings</h1>
        <div class="bg-white shadow rounded-lg d-block d-sm-flex">
            <div class="profile-tab-nav border-right">
                <form action="{{route('user.updateavatar')}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="p-4">
                        <div class="img-circle text-center mb-3">
                            <img src="{{asset($user->avatar)}}" alt="avatar" class="shadow" style="object-fit: cover;">
                        </div>
                        <h4 class="text-center">{{$user->name}}</h4>
                        <label class="img-upload btn"><input type="file" name="avatar">Choose a picture</label><div style= "text-align: center; padding: 10px;" class="align-items-center"><button type="submit" class="btn btn-primary" style="background-color:#49cd70; border-color: #49cd70;">Update Avatar</button></div>
                    </div>
                </form>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                        <i class="fa fa-home text-center mr-1"></i>
                        Account
                    </a>
                    <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
                        <i class="fa fa-key text-center mr-1"></i>
                        Password
                    </a>
                    <a class="nav-link" id="mywishlist-tab" data-toggle="pill" href="#mywishlist" role="tab" aria-controls="mywishlist" aria-selected="false">
                        <i class="fa fa-heart text-center mr-1"></i>
                        My Wishlist
                    </a>
                    <a class="nav-link" id="myorders-tab" data-toggle="pill" href="#myorders" role="tab" aria-controls="myorders" aria-selected="false">
                        <i class="fa fa-shopping-bag text-center mr-1"></i>
                        My Orders
                    </a>
                    <a class="nav-link" id="address-tab" data-toggle="pill" href="#address" role="tab" aria-controls="address" aria-selected="false">
                        <i class="fa fa-address-card text-center mr-1"></i>
                        Address
                    </a>
                </div>
            </div>
            <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <h3 class="mb-4">Account Settings</h3>
                    <form action="{{route('user.updateinfo')}}" method="post">
                        @method('PUT')
                        @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{$user->name}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" name="email" class="form-control" value="{{$user->email}}" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                        <h3 class="mb-4">Password Settings</h3>
                        <form action="{{route('user.updatepassword')}}" method="post">
                            @method('PUT')
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Old password</label>
                                            <input type="password" name="oldpass" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>New password</label>
                                            <input type="password" name="newpass" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm new password</label>
                                            <input type="password" name="confirmpass" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <div class="tab-pane fade" id="mywishlist" role="tabpanel" aria-labelledby="mywishlist-tab">
                    <h3 class="mb-4">My Wishlist</h3>
                    @if(count($wishlists) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-wrap">
                                <table class="table">
                                    <thead class="thead-primary">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Seller</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Remove</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($wishlists as $wishlist)
                                        <tr>
                                            <th scope="row" class="scope" >{{$wishlist->product->id}}</th>
                                            <td>{{$wishlist->product->user->name}}
                                            <td><a href="{{route('products.details', $wishlist->product->id)}}" style="text-decoration: none; color: black;">{{$wishlist->product->name}}</a></td>
                                            <td>${{$wishlist->product->new_price}}</td>
                                            <td><form action="{{route('products.details.destroywishlist', $wishlist->product->id)}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="ps-product__actions">
                                                        <input type="hidden" name="details" value="{{$wishlist->product->id}}">
                                                        <button type="submit" class="btn btn-danger">Remove</button>
                                                    </div>
                                                </form></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @else
                        <h3>You don't have anything in your wishlist.</h3>
                    @endif
                </div>
                <div class="tab-pane fade" id="myorders" role="tabpanel" aria-labelledby="myorders-tab">
                    <h3 class="mb-4">My Orders</h3>
                    @if(count($orders) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-wrap">
                                <table class="table">
                                    <thead class="thead-primary">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Seller</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Remove</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($orders as $order)
                                            <tr>
                                                <th scope="row" class="scope" >{{$order->product->id}}</th>
                                                <td>{{$order->product->user->name}}</td>
                                                <td><a href="{{route('products.details', $order->product->id)}}" style="text-decoration: none; color: black;">{{$order->product->name}}</a></td>
                                                <td>${{$order->product->new_price}}</td>
                                                <td>{{ucfirst($order->orderstatus->status)}}</td>
                                                <td>
                                                    <form action="{{route('products.details.destroyorder', $order->product->id)}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="ps-product__actions">
                                                            <input type="hidden" name="details" value="{{$order->product->id}}">
                                                            <button type="submit" class="btn btn-danger">Remove</button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @else
                        <h3>You haven't ordered or purchased anything yet.</h3>
                    @endif
                </div>
                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                    <h3 class="mb-4">Address</h3>
                    @if(!empty($address))
                    <form action="{{route('user.updateaddress')}}" method="post">
                        @method('PUT')
                        @csrf
                        <div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="float: left;">Address</label>
                                        <input
                                            type="text"
                                            name="address"
                                            class="form-control @error('address') is-invalid @enderror"
                                            value="@if(!empty($address->address)){{$address->address}}@endif">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="float: left;">City</label>
                                        <input
                                            type="text"
                                            name="city"
                                            class="form-control @error('city') is-invalid @enderror"
                                            value="@if(!empty($address->city)){{$address->city}}@endif">
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="float: left;">Postal Code</label>
                                        <input
                                            type="text"
                                            name="postal_code"
                                            class="form-control @error('postal_code') is-invalid @enderror"
                                            value="@if(!empty($address->postal_code)){{$address->postal_code}}@endif">
                                        @error('postal_code')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="float: left;">Province</label>
                                        <input
                                            type="text"
                                               name="province"
                                               class="form-control @error('province') is-invalid @enderror"
                                               value="@if(!empty($address->province)){{$address->province}}@endif">
                                        @error('province')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="float: left;">Country</label>
                                        <input
                                            type="text"
                                               name="country"
                                               class="form-control @error('country') is-invalid @enderror"
                                               value="@if(!empty($address->country)){{$address->country}}@endif">
                                        @error('country')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    @else
                        <form action="{{route('user.createaddress')}}" method="post">
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="float: left;">Address</label>
                                            <input
                                                type="text"
                                                name="address"
                                                class="form-control @error('address') is-invalid @enderror"
                                                >
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="float: left;">City</label>
                                            <input
                                                type="text"
                                                name="city"
                                                class="form-control @error('city') is-invalid @enderror"
                                                >
                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="float: left;">Postal Code</label>
                                            <input
                                                type="text"
                                                name="postal_code"
                                                class="form-control @error('postal_code') is-invalid @enderror"
                                                >
                                            @error('postal_code')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="float: left;">Province</label>
                                            <input
                                                type="text"
                                                name="province"
                                                class="form-control @error('province') is-invalid @enderror"
                                                >
                                            @error('province')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="float: left;">Country</label>
                                            <input
                                                type="text"
                                                name="country"
                                                class="form-control @error('country') is-invalid @enderror"
                                                >
                                            @error('country')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
        @endsection
    </x-profile-master>
@endsection
</x-home-master>

