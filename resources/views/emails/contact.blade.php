<x-email-master>
    @section('content')
        <div style="text-align: center; background-color: #e2e2e2; padding: 50px; margin-top: 20px;" class="container">
            <h3>From: {{$name}}</h3>
            <h3>Email: {{$email}}</h3>
            <h4>{{$body}}</h4>
        </div>
    @endsection
</x-email-master>
