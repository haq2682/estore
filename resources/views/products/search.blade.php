<x-home-master>
    @section('content')
        <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
            <div class="ps-container">
                <div class="ps-section__header mb-50">
                    <h3 class="ps-section__title" data-mask="Search">- Searched Products</h3>
                    <div id="easy-filter-wrap">
                </div>
                <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
                    <div class="ps-container">
                        <div class="ps-section__content pb-50">
                            <div class="masonry-wrapper" data-col-md="4" data-col-sm="2" data-col-xs="1" data-gap="30" data-radio="100%">
                                <div class="ps-masonry">
                                    <div class="grid-sizer"></div>
                                    @if($products_search)
                                        @foreach($products_search as $product)
                                            <div class="grid-item">
                                                <div class="grid-item__content-wrapper">
                                                    <div class="ps-shoe mb-30">
                                                        <div class="ps-shoe__thumbnail"><img style="overflow: hidden; object-fit: cover;" src="{{$product->product_image1}}" alt=""><a class="ps-shoe__overlay" href="{{route('products.details', $product->id)}}"></a>
                                                        </div>
                                                        <div class="ps-shoe__content">
                                                            <div class="ps-shoe__variants">
                                                                <div class="ps-shoe__variant normal"><img src="{{$product->product_image2}}" alt=""><img src="{{$product->product_image3}}" alt=""><img src="{{$product->product_image4}}"> </div>
                                                                <div>Seller: {{$product->user->name}}</div>
                                                            </div>
                                                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{route('products.details', $product->id)}}">{{$product->name}}</a>
                                                                <p class="ps-shoe__categories"><a href="#">{{$product->category->name}}</a></p><span class="ps-shoe__price" style="color: limegreen;"> @if($product->old_price)<del style="color: red;">${{$product->old_price}}</del>@endif ${{$product->new_price}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div style="text-align: center;"><h3>No items matched with your search query.</h3></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="{{asset('/js/jquery.easyFilter.js')}}"></script>
        <script>
            $(function(){
                $('#easy-filter-wrap').easyFilter();
            });</script>
    @endsection
</x-home-master>
