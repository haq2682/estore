<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
<style>
    #category-header {
        color: black;
    }
    #category-header:hover {
        color: white;
    }
</style>
<x-home-master>
    @section('content')
        <form action="{{route('products.trackorder')}}" method="get">
            @csrf
            <div  class="container">
                <div class="input-group input-group-lg d-flex justify-content-center">
                    <input type="text" style="width: 600px;" name="orderno" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" placeholder="Enter Order Number">
                    <button class="btn btn-lg" type="submit"><i class="ps-icon-search"></i></button>
                </div>
            </div>
            </div>
        </form>
        <div class="container px-1 px-md-4 py-5 mx-auto">
            <div class="card" style="border: none; background-color: #f1f1f1;">
                <div class="row d-flex justify-content-between px-3 top">
                    <div class="d-flex">
                        <h5>ORDER#: <span class="text-primary font-weight-bold">{{$number}}</span></h5>
                    </div>
                </div> <!-- Add class 'active' to progress -->
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <ul id="progressbar" class="text-center">
                            <li class=" @if($status === 'processed' || $status === 'shipped' || $status === 'enroute' || $status === 'delievered') active @endif step0"></li>
                            <li class=" @if($status === 'shipped' || $status === 'enroute' || $status === 'delievered') active @endif step0"></li>
                            <li class=" @if($status === 'enroute' || $status === 'delievered') active @endif step0"></li>
                            <li class=" @if($status === 'delievered') active @endif step0"></li>
                        </ul>
                    </div>
                </div>
                <div class="row justify-content-between top">
                    <div class="row d-flex icon-content" style="position: relative; right: 80px;"> <img class="icon" src="{{asset('img/placed.png')}}">
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold">Order<br>Processed</p>
                        </div>
                    </div>
                    <div class="row d-flex icon-content" style="position: relative; right: 30px;"> <img class="icon" src="{{asset('img/shipped.png')}}">
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold">Order<br>Shipped</p>
                        </div>
                    </div>
                    <div class="row d-flex icon-content" style="position: relative; left: 70px;"> <img class="icon" src="{{asset('img/enroute.png')}}">
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold">Order<br>En Route</p>
                        </div>
                    </div>
                    <div class="row d-flex icon-content" style="position: relative; left: 100px;"> <img class="icon" src="{{asset('img/delivered.png')}}">
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold">Order<br>Arrived</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-home-master>
