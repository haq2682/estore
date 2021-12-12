<x-error-master>
    @section('error')
        <div class="ps-404 bg--cover" data-background="{{asset('img/error.jpg')}}">
            <div class="ps-404__content">
                <h1>419</h1>
                <h3>Page Expired</h3>
                <p style="color: white;">This page has been expired.</p><a class="ps-btn" href="{{route('index')}}">Back to home<i class="ps-icon-next"></i></a>
            </div>
        </div>
    @endsection
</x-error-master>
