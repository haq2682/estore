<x-seller-master>
    @section('objects')
        <div class="app-wrapper">

            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">

                    <div class="row g-3 mb-4 align-items-center justify-content-between">
                        <div class="col-auto">
                            <h1 class="app-page-title mb-0">Sold Items</h1>
                        </div>
                    </div><!--//row-->

                    <div class="tab-content" id="orders-table-tab-content">
                        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                            @if(count($requests)>0)
                                <div style="padding: 30px;" class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body">

                                        <div class="table-responsive">
                                            <table id="dataTable" class="table app-table-hover mb-0 text-left">
                                                <thead>
                                                <tr>
                                                    <th class="cell">User ID</th>
                                                    <th class="cell">User Name</th>
                                                    <th class="cell">Give Seller Role</th>
                                                    <th class="cell">Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody class="tbody">
                                                @foreach($requests as $request)
                                                    <tr>
                                                        <td class="cell">{{$request->user->id}}</td>
                                                        <td class="cell">{{$request->user->name}}</td>
                                                        <td class="cell">
                                                            <form style="display: inline;" action="{{route('seller.grant_request', $request->user->id)}}" method="post">
                                                                @csrf
                                                                <input type="hidden" value="{{$request->user->id}}">
                                                                <button type="submit" style="background: none; border: none;">
                                                                    <a class="btn-sm app-btn-secondary">
                                                                        Grant
                                                                    </a>
                                                                </button>
                                                            </form>
                                                        </td>
                                                        <td class="cell">
                                                            <form style="display: inline;" action="{{route('seller.delete_request', $request->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" style="background: none; border: none;"><a class="btn-sm app-btn-secondary">Delete</a></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div><!--//table-responsive-->
                                    </div><!--//app-card-body-->
                                </div><!--//app-card-->
                            @else
                                <h4 style="text-align: center;">There are no seller requests.</h4>
                            @endif
                        </div><!--//tab-pane-->
                    </div><!--//tab-content-->
                </div><!--//container-fluid-->
            </div><!--//app-content-->
        </div><!--//app-wrapper-->
    @endsection
</x-seller-master>
