<x-home-master>
    @section('content')
        <div style="text-align: center; background-color: #e2e2e2; padding: 50px; margin-top: 20px;" class="container">
            <h3>Order placed successfully! Thank you for shopping with us!</h3>
            <h4>Here is your Order Number. For any complaints and order trackings, this number will be required.</h4>
            <h2>Order#: {{$orderno}}</h2>
        </div>
    @endsection
</x-home-master>
