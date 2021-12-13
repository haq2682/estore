<x-home-master>
    @section('content')
        <div class="ps-products-wrap inverse pt-80 pb-80">
            <div class="ps-products" data-mh="product-listing">
                <div class="ps-product__columns">
                    @foreach($products as $product)
                        @if($product->count > 0)
                        <a class="ps-shoe__overlay" href="{{route('products.details', $product->id)}}">
                            <div class="ps-product__column">
                                <div class="ps-shoe mb-30">
                                    <div class="ps-shoe__thumbnail">
                                        @if($product->created_at->diffForHumans() < 252000)<div class="ps-badge"><span>New</span></div> @endif
                                        @if($product->old_price)<div class="ps-badge ps-badge--sale ps-badge--2nd"><span>Sale</span></div>@endif
                                            <a style="display: none;" class="ps-shoe__favorite" href="#">
                                            </a>
                                            <img src="{{$product->product_image}}" alt="">
                                    </div>
                                    <div class="ps-shoe__content">
                                        <div class="ps-shoe__variants">
                                            <div>Seller: {{$product->user->name}}               <img src="{{$product->user->avatar}}" height="30px" width="30px" class="rounded-circle z-depth-2 float-left float-right"></div>
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
                    <div class="ps-product__filter">
                        <h3>Sort By:</h3>
                        <ul>
                            <li><a href="{{"all?".request()->getQueryString()."&" . "sort=name"}}">Name</a></li>
                            <li><a href="{{"all?".request()->getQueryString()."&" . "sort=price_low"}}">Price (Low to High)</a></li>
                            <li><a href="{{"all?".request()->getQueryString()."&" . "sort=price_high"}}">Price (High to Low)</a></li>
                        </ul>
                    </div>
                    <div class="ps-pagination">
                        @if ($products->lastPage() > 1)
                            <ul class="pagination">
                                @if ($products->currentPage() > 4 && $page === 2)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                                <li class="{{($products->currentPage()==1)? 'disabled' : ''}}"><a href="{{"all?".request()->getQueryString()."&".parse_url($products->url(1))['query']}}" @if($products->currentPage()==1) disabled @endif><i class="fa fa-angle-left"></i></a></li>
                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                    <li class="{{($products->currentPage()==$i) ? 'active' : ''}}"><a href="{{"all?".request()->getQueryString()."&".parse_url($products->url($i))['query']}}">{{$i}}</a></li>
                                @endfor
                                <li class="{{ ($products->currentPage() == $products->lastPage()) ? 'disabled' : '' }}"><a href="{{"all?".request()->getQueryString()."&".parse_url($products->url($products->currentPage()+1))['query'] }}" @if($products->currentPage() == $products->lastPage()) disabled @endif><i class="fa fa-angle-right"></i></a></li>
                                    @if ($products->currentPage() < $products->lastPage() - 3)
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="ps-sidebar" data-mh="product-listing">
                @foreach($categories as $category)
                <form action="{{"all?".request()->getQueryString()}}" method="get">
                <aside class="ps-widget--sidebar ps-widget--category">
                    <div class="ps-widget__header">
                        <h3>Product Type</h3>
                    </div>
                    <div class="ps-widget__content">
                        <ul class="ps-list--checked">
                            <li><button type="submit" style="border: none; background: none; font-weight: bolder;" name="product_type" value="{{$category->id}}">{{$category->name}}</li>
                        </ul>
                    </div>
                </aside>
                </form>
                @endforeach
            </div>
        </div>
    @endsection
</x-home-master>

