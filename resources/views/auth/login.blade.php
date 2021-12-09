<x-home-master>

@section('content')
<div class="ps-checkout pt-80 pb-80">
    <div class="ps-container">
        <form class="ps-checkout__form" method="POST" action="{{ route('login') }}">
        @csrf
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                    <div class="ps-checkout__billing">
                        <h3>Login</h3>
                        <div class="form-group form-group--inline">
                            <label>Email</label>
                            <input name="email" class="form-control @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group form-group--inline">
                            <label>Password</label>
                            <input name="password" class="form-control @error('password') is-invalid @enderror" type="password" required autofocus>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                            <button style="float: right;" type="submit" class="ps-btn">Login<i class="ps-icon-next"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
</x-home-master>

