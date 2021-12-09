<x-error-master>
    @section('error')
        <div class="ps-404 bg--cover" data-background="{{asset('img/error.jpg')}}">
            <div class="ps-404__content">
                <h1>403</h1>
                <h3>Forbidden</h3>
                <p style="color: white;">You are not authorized to visit the page you are looking for.</p><a class="ps-btn" href="{{route('index')}}">Back to home<i class="ps-icon-next"></i></a>
            </div>
        </div>
    @endsection
</x-error-master>
