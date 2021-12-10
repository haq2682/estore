<x-home-master>
    @section('content')
        <main class="ps-main">
            <div class="ps-content pt-80 pb-80">
                <div class="ps-container">
                    <div class="ps-cart-listing">
                        @if(count($carts)>0)
                        <table class="table ps-cart__table">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $cart)
                            <tr id='price'>
                                <td><img style= "height: 100px; width: 100px; object-fit: cover;" src='/{{$cart->product->product_image1}}' alt=''><a style="padding-left: 30px;" class='ps-product__preview' href="/details/{{$cart->product->id}}">{{$cart->product->name}}</a></td>
                                <td>${{$cart->product->new_price}}</td>
                                <td>
                                    <div class="form-group--number">
                                        <form style="display: inline;" action="{{route('user.cart.decrementqty', $cart->id)}}" method="post">
                                            @csrf
                                            <input type="hidden" name="quantity" value="{{$cart->id}}">
                                            <button type="submit" class="minus" @if($cart->quantity == 1) disabled @endif>
                                                <span>-</span>
                                            </button>
                                        </form>
                                        <input id="quantity" class="form-control" type="number" value="{{$cart->quantity}}" min="1">
                                        <form style="display: inline;" action="{{route('user.cart.incrementqty', $cart->id)}}" method="post">
                                            @csrf
                                            <input type="hidden" id="quantity" name="quantity" value="{{$cart->id}}">
                                            <button onclick="add()" class="plus" @if($cart->quantity == $cart->product->count) disabled @endif>
                                                <span>+</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td id='subtotalprice'>${{$cart->subtotal}}</td>
                                <td>
                                    <form action="{{route('user.cart.delete', $cart->id)}}" method='post'>
                                        @method('DELETE')
                                        @csrf
                                        <input type='hidden' name='cart' value="{{$cart->id}}">
                                            <button style="border: none;" type="submit" class="ps-remove"></button>
                                    </form>
                                </td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="ps-cart__actions">
                            <div class="ps-cart__total">
                                <h3>Total Price: <span id="sum">${{$sum}}</span></h3><a class="ps-btn" href="{{route('user.checkout')}}">Process to checkout<i class="ps-icon-next"></i></a>
                            </div>
                        </div>
                        @else
                            <h3 style="text-align: center;">You don't have anything in your cart.</h3>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    @endsection
</x-home-master>
