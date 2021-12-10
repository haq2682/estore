<x-home-master>
    @section('content')
        <div class="ps-products-wrap inverse pt-80 pb-80">
            <h3 class="ps-section__title" data-mask="Category">- {{$category->name}}</h3>
            <div class="ps-products" data-mh="product-listing">
                <div class="ps-product__columns">
                    @foreach($products as $product)
                        @if($product->count > 0)
                            <a class="ps-shoe__overlay" href="{{route('products.details', $product->id)}}">
                                <div class="ps-product__column">
                                    <div class="ps-shoe mb-30">
                                        <div class="ps-shoe__thumbnail">
                                            @if($product->old_price)<div class="ps-badge"><span>Sale</span></div>@endif
                                            <a style="display: none;" class="ps-shoe__favorite" href="#">
                                            </a>
                                            <img src="/{{$product->product_image1}}" alt="">
                                        </div>
                                        <div class="ps-shoe__content">
                                            <div class="ps-shoe__variants">
                                                <div class="ps-shoe__variant normal"><img src="/{{$product->product_image2}}" alt=""><img src="/{{$product->product_image3}}" alt=""><img src="/{{$product->product_image4}}"><img src="/{{$product->product_image5}}"> </div>
                                                <div>Seller: {{$product->user->name}}</div>
                                            </div>
                                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">{{$product->name}}</a>
                                                <p class="ps-shoe__categories"><a href="#">{{$product->category->name}}</a></p><span class="ps-shoe__price" style="color: limegreen;"> @if($product->old_price)<del style="color: red;">${{$product->old_price}}</del>@endif ${{$product->new_price}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
                <div class="ps-product-action">
                    <div class="ps-pagination">
                        @if ($products->lastPage() > 1)
                            <ul class="pagination">
                                @if ($products->currentPage() > 4 && $page === 2)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                                <li class="{{($products->currentPage()==1)? 'disabled' : ''}}"><a href="{{$category->id.request()->getQueryString()."?".parse_url($products->url(1))['query']}}" @if($products->currentPage()==1) disabled @endif><i class="fa fa-angle-left"></i></a></li>
                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                    <li class="{{($products->currentPage()==$i) ? 'active' : ''}}"><a href="{{$category->id.request()->getQueryString()."?".parse_url($products->url($i))['query']}}">{{$i}}</a></li>
                                @endfor
                                <li class="{{ ($products->currentPage() == $products->lastPage()) ? 'disabled' : '' }}"><a href="{{$category->id.request()->getQueryString()."?".parse_url($products->url($products->currentPage()+1))['query'] }}" @if($products->currentPage() == $products->lastPage()) disabled @endif><i class="fa fa-angle-right"></i></a></li>
                                @if ($products->currentPage() < $products->lastPage() - 3)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="ps-sidebar" data-mh="product-listing">
                <aside class="ps-widget--sidebar ps-widget--category">
                    <div class="ps-widget__header">
                        <h3>Sort By</h3>
                    </div>
                    <div class="ps-product__filter">
                        <ul>
                            <li><a href="{{$category->id."?".request()->getQueryString()."&"."sort=name"}}">Name</a></li>
                            <li><a href="{{$category->id."?".request()->getQueryString()."&"."sort=price_low"}}">Price (Low to High)</a></li>
                            <li><a href="{{$category->id."?".request()->getQueryString()."&"."sort=price_high"}}">Price (High to Low)</a></li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    @endsection
</x-home-master>

