<x-home-master>
    @section('content')
        <div class="ps-checkout pt-80 pb-80">
            <div class="ps-container">
                <form class="ps-checkout__form" action="{{route('user.postcheckout')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                            <div class="ps-checkout__billing">
                                <h3>Billing Detail</h3>
                                <div class="form-group form-group--inline">
                                    <label>Phone<span>*</span>
                                    </label>
                                    <input name="phone" class="form-control @error('phone') is-invalid @enderror" type="number">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-group--inline">
                                    <label>Address<span>*</span>
                                    </label>
                                    <input name="address" class="form-control @error('address') is-invalid @enderror" type="text" value="@if($address) {{$address->address}} @endif">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-group--inline">
                                    <label>City<span>*</span>
                                    </label>
                                    <input name="city" class="form-control @error('city') is-invalid @enderror" type="text" value="@if($address) {{$address->city}} @endif">
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-group--inline">
                                    <label>Postal Code<span>*</span>
                                    </label>
                                    <input name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" type="string" value="@if($address) {{$address->postal_code}} @endif">
                                    @error('postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-group--inline">
                                    <label>Province<span>*</span>
                                    </label>
                                    <input name="province" class="form-control @error('province') is-invalid @enderror" type="text" value="@if($address) {{$address->province}} @endif">
                                    @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-group--inline">
                                    <label>Country<span>*</span>
                                    </label>
                                    <input name="country" class="form-control @error('country') is-invalid @enderror" type="text" value="@if($address) {{$address->country}} @endif">
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-group--inline">
                                    <label style="text-align: center;">Credit/Debit Number<span>*</span>
                                    </label>
                                    <input name="credit-debit" class="form-control @error('credit-debit') is-invalid @enderror" type="number">
                                    @error('credit-debit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <label>Credit/Debit Card Expiry Date</label>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="ccmonth">Month</label>
                                        <select name="month" class="form-control @error('month') is-invalid @enderror" id="ccmonth">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                        @error('month')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="ccyear">Year</label>
                                        <select name="year" class="form-control @error('year') is-invalid @enderror" id="ccyear">
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                            <option value="2032">2032</option>
                                        </select>
                                        @error('year')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cvv">CVV/CVC</label>
                                            <input name="cvv" class="form-control @error('cvv') is-invalid @enderror" id="cvv" type="number">
                                            @error('cvv')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                            <div class="ps-checkout__order">
                                <header>
                                    <h3>Your Order</h3>
                                </header>
                                <div class="content">
                                    <table class="table ps-checkout__products">
                                        <thead>
                                        <tr>
                                            <th class="text-uppercase">Product</th>
                                            <th class="text-uppercase">Quantity</th>
                                            <th class="text-uppercase">Subtotal</th>
                                        </tr>
                                        </thead>
                                        @foreach($carts as $cart)
                                            <tbody>
                                            <tr>
                                                <td>{{$cart->product->name}}</td>
                                                <td style="text-align: center;">{{$cart->quantity}}</td>
                                                <td>${{$cart->subtotal}}</td>
                                            </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                                <footer>
                                    <h3 class="total">Total: </h3> <strong><h2 style="color: white; display: inline; float: right; margin: 0; margin-right: 30px; line-height: 95px;">${{$sum}}</h2></strong>
                                    <hr>
                                    <h3>Payment Method</h3>
                                    <div class="form-group paypal">
                                        <div class="ps-radio ps-radio--inline">
                                            <p style="color: white;">We accept the following payment methods:</p>
                                        </div>
                                        <ul class="ps-payment-method">
                                            <li><a href="#"><img src="images/payment/1.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/payment/2.png" alt=""></a></li>
                                            <li><a href="#"><img src="images/payment/3.png" alt=""></a></li>
                                        </ul>
                                        <button type="submit" class="ps-btn ps-btn--fullwidth">Place Order<i class="ps-icon-next"></i></button>
                                    </div>
                                </footer>
                            </div>
                            <div class="ps-shipping">
                                <h3>FREE SHIPPING</h3>
                                <p>YOUR ORDER QUALIFIES FOR FREE SHIPPING.<br>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</x-home-master>
