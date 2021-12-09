<x-error-master>
    @section('error')
        <div class="ps-404 bg--cover" data-background="{{asset('img/error.jpg')}}">
            <div class="ps-404__content">
                <h1>404</h1>
                <h3>Page not found</h3>
                <p style="color: white;">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p><a class="ps-btn" href="{{route('index')}}">Back to home<i class="ps-icon-next"></i></a>
            </div>
        </div>
    @endsection
</x-error-master>
