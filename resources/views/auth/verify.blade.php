<title>E-Store - Verify</title>
<x-home-master>
    @section('content')
    <div class="ps-checkout pt-80 pb-80">
        <div style="text-align: center; background-color: #e2e2e2; padding: 50px; margin-top: 20px;" class="container">
                    <h3>Verify your E-Mail Address</h3>

                    <div>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-home-master>
