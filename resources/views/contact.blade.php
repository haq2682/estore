<title>E-Store - Contact Us</title>
<x-home-master>
    @section('content')
            <div id="contact-map" data-address="New York, NY" data-title="Sky Store!" data-zoom="17"></div>
            <div style="margin-top: 20px;" class="ps-container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="ps-section__header mb-50">
                            <h2 class="ps-section__title" data-mask="Contact">- Get in touch</h2>
                            <form class="ps-contact__form" action="/contact/message" method="post">
                                @csrf
                                <div class="row">
                                    @if(!Auth::check())
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                            <div class="form-group">
                                                <label>Name <sub>*</sub></label>
                                                <input name="name" class="form-control" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                            <div class="form-group">
                                                <label>Email <sub>*</sub></label>
                                                <input name="email" class="form-control" type="email" placeholder="">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                        <div class="form-group mb-25">
                                            <label>Your Message <sub>*</sub></label>
                                            <textarea name="message" class="form-control" rows="6"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="ps-btn">Send Message<i class="ps-icon-next"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="ps-section__content">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="ps-contact__block" data-mh="contact-block">
                                        <header>
                                            <h3>USA <span> San Francisco</span></h3>
                                        </header>
                                        <footer>
                                            <p><i class="fa fa-map-marker"></i> 19C Trolley Square  Wilmington, DE 19806</p>
                                            <p><i class="fa fa-envelope-o"></i><a href="mailto@supportShoes@shoes.net">supportShoes@shoes.net</a></p>
                                            <p><i class="fa fa-phone"></i> ( +84 ) 9892 2324  -  9401 123 003</p>
                                        </footer>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="ps-contact__block" data-mh="contact-block">
                                        <header>
                                            <h3>Ireland  <span> Dublin</span></h3>
                                        </header>
                                        <footer>
                                            <p><i class="fa fa-map-marker"></i> 19C Trolley Square  Wilmington, DE 19806</p>
                                            <p><i class="fa fa-envelope-o"></i><a href="mailto@supportShoes@shoes.net">supportShoes@shoes.net</a></p>
                                            <p><i class="fa fa-phone"></i> ( +84 ) 9892 2324  -  9401 123 003</p>
                                        </footer>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="ps-contact__block" data-mh="contact-block">
                                        <header>
                                            <h3>Brazil <span> S??o Paulo</span></h3>
                                        </header>
                                        <footer>
                                            <p><i class="fa fa-map-marker"></i> 19C Trolley Square  Wilmington, DE 19806</p>
                                            <p><i class="fa fa-envelope-o"></i><a href="mailto@supportShoes@shoes.net">supportShoes@shoes.net</a></p>
                                            <p><i class="fa fa-phone"></i> ( +84 ) 9892 2324  -  9401 123 003</p>
                                        </footer>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="ps-contact__block" data-mh="contact-block">
                                        <header>
                                            <h3>Philippines <span> Quezon City</span></h3>
                                        </header>
                                        <footer>
                                            <p><i class="fa fa-map-marker"></i> 19C Trolley Square  Wilmington, DE 19806</p>
                                            <p><i class="fa fa-envelope-o"></i><a href="mailto@supportShoes@shoes.net">supportShoes@shoes.net</a></p>
                                            <p><i class="fa fa-phone"></i> ( +84 ) 9892 2324  -  9401 123 003</p>
                                        </footer>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endsection
</x-home-master>
