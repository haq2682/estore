<x-seller-master>
    @section('objects')

        <div class="app-content pt-3 p-md-3 p-lg-4">

            <div class="container-xl">

                <div id="empty">

                <div class="position-relative mb-3" >

                    <div class="row g-3 justify-content-between">
                        <div class="col-auto">
                            <h1 class="app-page-title mb-0">Notifications</h1>
                        </div>
                        @if(count(auth()->user()->notifications) > 0)
                        <div class="col-auto">
                            <button class="btn app-btn-primary">Clear All</button>
                        </div>
                    </div>
                </div>

            @foreach(auth()->user()->notifications as $notification)
                    <div class="app-card app-card-notification shadow-sm mb-4">
                        <div class="app-card-header px-4 py-3">
                            <div class="row g-3 align-items-center">
                                <div class="col-12 col-lg-auto text-center text-lg-start">
                                    <img class="profile-image" src="{{asset($notification->data['user']['avatar'])}}" alt="avatar">
                                </div><!--//col-->
                                <div class="col-12 col-lg-auto text-center text-lg-start">
                                    @if($notification->type === 'App\Notifications\OrderPlaced')
                                        <div class="notification-type mb-2"><span class="badge bg-success">Order</span></div>
                                    @elseif($notification->type === 'App\Notifications\CommentedOnProduct')
                                        <div class="notification-type mb-2"><span class="badge bg-info">Comment</span></div>
                                    @endif
                                    @if($notification->type === 'App\Notifications\OrderPlaced')
                                        <h4 class="notification-title mb-1">{{$notification->data['user']['name']}} ordered
                                            {{$notification->data['cart']['name']}}</h4>
                                        @elseif($notification->type === 'App\Notifications\CommentedOnProduct')
                                            <h4 class="notification-title mb-1">{{$notification->data['user']['name']}} commented on
                                                {{$notification->data['product']['name']}}</h4>
                                    @endif
                                    <ul class="notification-meta list-inline mb-0">
                                        <li class="list-inline-item">{{$notification->created_at->diffForHumans()}}</li>
                                        <li class="list-inline-item">|</li>
                                        <li class="list-inline-item">{{$notification->data['user']['name']}}</li>
                                    </ul>

                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//app-card-header-->
                        @if($notification->type === 'App\Notifications\CommentedOnProduct')
                            <div class="app-card-body p-4">
                                <div class="notification-content">{{$notification->data['comment']}}</div>
                            </div><!--//app-card-body-->
                        @endif
                        <div class="app-card-footer px-4 py-3">
                            @if($notification->type === 'App\Notifications\CommentedOnProduct')
                            <a class="action-link" href="{{route('products.details', $notification->data['product']['id'])}}">View Product<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right ms-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg></a>
                                @elseif($notification->type === 'App\Notifications\OrderPlaced')
                                <a class="action-link" href="{{route('seller.orders')}}">View All Orders<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right ms-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                    </svg></a>
                            @endif
                        </div><!--//app-card-footer-->
                    </div><!--//app-card-->
                    @endforeach
                @else
                    <h4 style="text-align: center;">You don't have any notifications.</h4>
                @endif
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            $(document).ready(function(){
               $('.app-btn-primary').click(function(){
                   $.ajax({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                       data: {
                           "_token": "{{ csrf_token() }}",
                       },
                      url:'/seller/notifications/clearall',
                      type:'GET',
                      success: function() {
                          $('#empty').html("<h4 style='text-align: center;'>Notifications Cleared!</h4>");
                      }
                   });
               });
            });
        </script>
        @endsection
</x-seller-master>

