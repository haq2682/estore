<title>E-Store - {{$details->name}}</title>
<x-home-master>

    @section('content')
        @if(session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{session('message')}}
            </div>
        @endif
        <div class="ps-product--detail pt-60">
            <div class="ps-container">
                <div class="row">
                    <div class="col-lg-10 col-md-12 col-lg-offset-1">
                        <div class="ps-product__thumbnail">
                            <div class="ps-product__preview">
                                <div class="ps-product__variants">
                                    <div class="item"><img src="{{asset($details->product_image1)}}" alt=""></div>
                                    <div class="item"><img src="{{asset($details->product_image2)}}" alt=""></div>
                                    <div class="item"><img src="{{asset($details->product_image3)}}" alt=""></div>
                                    <div class="item"><img src="{{asset($details->product_image4)}}" alt=""></div>
                                    <div class="item"><img src="{{asset($details->product_image5)}}" alt=""></div>
                                </div><img src="{{asset($details->product_image1)}}" alt="">
                            </div>
                            <div class="ps-product__image">
                                <div class="item"><img class="zoom" src="{{asset($details->product_image1)}}" alt="" data-zoom-image="{{asset($details->product_image1)}}"></div>
                                <div class="item"><img class="zoom" src="{{asset($details->product_image2)}}" alt="" data-zoom-image="{{asset($details->product_image2)}}"></div>
                                <div class="item"><img class="zoom" src="{{asset($details->product_image3)}}" alt="" data-zoom-image="{{asset($details->product_image3)}}"></div>
                                <div class="item"><img class="zoom" src="{{asset($details->product_image4)}}" alt="" data-zoom-image="{{asset($details->product_image3)}}"></div>
                                <div class="item"><img class="zoom" src="{{asset($details->product_image5)}}" alt="" data-zoom-image="{{asset($details->product_image3)}}"></div>
                            </div>
                        </div>
                        <div class="ps-product__thumbnail--mobile">
                            <div class="ps-product__main-img"><img src="{{asset($details->product_image1)}}" alt=""></div>
                            <div class="ps-product__preview owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false" data-owl-item="3" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on"><img src="{{asset($details->product_image2)}}" alt=""><img src="{{asset($details->product_imag3)}}}" alt=""><img src="{{asset($details->product_imag4)}}" alt=""><img src="{{asset($details->product_imag5)}}" alt=""></div>
                        </div>
                        <div class="ps-product__info">
                            <h1>{{$details->name}}</h1>
                            <p class="ps-product__category"><a href="#">{{$details->category->name}}</a>
                            <h3 style="color: limegreen;" class="ps-product__price">${{$details->new_price}} @if($details->old_price)<del style="color: red;">${{$details->old_price}}</del>@endif</h3>
                            <div class="ps-product__block ps-product__quickview">
                                <h4>SELLER</h4>
                                <img class="img-circle" style="height: 45px; width: 45px; object-fit: cover;" src="{{asset($details->user->avatar)}}"><p style="display: inline; padding: 10px;">{{$details->user->name}}</p>
                            </div>
                            @if(Auth::check())
                                @if(!$cart)
                                    <form action="{{route('user.cart.add', $details->id)}}" method="post">
                                        @csrf
                                        <div class="ps-product__shopping">
                                            <input type="hidden" name="product" value="{{$details}}">
                                            <button style="border: none; background: none;" type="submit"><a class="ps-btn mb-10">Add to cart
                                                <i class="ps-icon-next"></i>
                                            </a></button>
                                        </div>
                                    </form>
                                @else
                                    <h4>This item is in your cart.</h4>
                                @endif
                                @if(!$cart)
                                    @if(!$wishlist)
                                    <form action="{{route('products.details.addwishlist', $details->id)}}" method="post">
                                        @csrf
                                        <div class="ps-product__actions">
                                            <input type="hidden" name="details" value="{{$details->id}}">
                                            <button type="submit" class="ps-btn">Add to Wishlist <i class="ps-icon-heart"></i></button>
                                        </div>
                                    </form>
                                    @else
                                        <form action="{{route('products.details.destroywishlist', $details->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <div class="ps-product__actions">
                                                <input type="hidden" name="details" value="{{$details->id}}">
                                                <button type="submit" class="ps-btn">Remove from Wishlist<i class="fa fa-ban"></i></button>
                                            </div>
                                        </form>
                                        @endif
                                @endif
                            </div>
                            @else
                                <h3>You must be logged in to Add this product to your cart. <a href="/login">Login?</a></h3>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <div class="ps-product__content mt-50">
                            <ul class="tab-list" role="tablist">
                                <li class="active"><a href="#tab_01" aria-controls="tab_01" role="tab" data-toggle="tab">Overview</a></li>
                                <li><a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">Review</a></li>
                                <li><a href="#tab_03" aria-controls="tab_03" role="tab" data-toggle="tab">Description</a></li>
                            </ul>
                        </div>
                        <div class="tab-content mb-60">
                            <div class="tab-pane active" role="tabpanel" id="tab_01">
                                <p>{{$details->overview}}</p>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="tab_02">
                                @foreach($comments as $comment)
                                <div class="ps-review">
                                    <div class="ps-review__content">
                                        <header>
                                            <img src="{{asset($comment->user->avatar)}}" style="border-radius: 30px;" height="30px" width="30px" class="rounded-circle z-depth-2 float-left float-right">   <p><a href=""> {{$comment->user->name}}</a> Posted: {{$comment->created_at->diffForHumans()}}</p>
                                        </header>
                                        <p>{{$comment->comment}}</p>
                                        @if(Auth::check())
                                            @if($comment->user->id == auth()->user()->id)
                                                <form method="post" action="{{route('comments.delete', $comment->id)}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div style="padding-top: 30px; float: right;"><button type="submit" class="ps-btn ps-btn--sm">Delete</button></div>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                                    <h4>ADD YOUR REVIEW</h4>
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 ">
                                            @if(Auth::check())
                                                <form class="ps-product__review" action="{{route('comments.store')}}" method="post">
                                                    <div class="form-group">
                                                        <label>Your Review:</label>
                                                        @csrf
                                                        <textarea class="form-control" name="comment" rows="6"></textarea>
                                                        <input type="hidden" name="product_id" value="{{$details->id}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="ps-btn ps-btn--sm">Submit<i class="ps-icon-next"></i></button>
                                                    </div>
                                                </form>
                                            @else
                                                <h3>You must be logged in to add a review</h3>
                                                <div style="padding-top: 30px;"><a class="ps-btn ps-btn--sm" href="/login">Login</a></div>
                                            @endif
                                        </div>
                                    </div>

                            </div>
                            <div class="tab-pane" role="tabpanel" id="tab_03">
                                    <div class="form-group">
                                        <p>{{$details->description}}</p>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-section ps-section--top-sales ps-owl-root pt-40 pb-80">
            <div class="ps-container">
                <div class="ps-section__header mb-50">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                            <h3 class="ps-section__title" data-mask="Related item">- YOU MIGHT ALSO LIKE</h3>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                            <div class="ps-owl-actions"><a class="ps-prev" href="#"><i class="ps-icon-arrow-right"></i>Prev</a><a class="ps-next" href="#">Next<i class="ps-icon-arrow-left"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="ps-section__content">
                    <div class="ps-owl--colection owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                        @if($recommendations !== null)
                        @foreach($recommendations as $recommended)
                            <div class="ps-shoes--carousel">
                                <div class="ps-shoe">
                                    <div class="ps-shoe__thumbnail">
                                            @if($recommended->old_price)<div class="ps-badge"><span>Sale</span></div>@endif
                                            <img src="{{asset($recommended->product_image1)}}" alt=""><a class="ps-shoe__overlay" href="{{route('products.details', $recommended->id)}}"></a>
                                    </div>
                                    <div class="ps-shoe__content">
                                        <div class="ps-shoe__variants">
                                            <div class="ps-shoe__variant normal"><img src="{{asset($recommended->product_image2)}}" alt=""><img src="{{asset($recommended->product_image3)}}" alt=""><img src="{{asset($recommended->product_image4)}}"><img src="{{asset($recommended->product_image5)}}" alt=""> </div>
                                            <div>Seller: {{$recommended->user->name}}</div>
                                        </div>
                                        <div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{route('products.details', $recommended->id)}}">{{$recommended->name}}</a>
                                            <p class="ps-shoe__categories"><a href="#">{{$recommended->category->name}}</a><span class="ps-shoe__price" style="color: limegreen;"> @if($recommended->old_price)<del style="color: red;">$ {{$recommended->old_price}}</del> @endif $ {{$recommended->new_price}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                                <div style="text-align: center;"><h3>There are currently no products.</h3></div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-home-master>
