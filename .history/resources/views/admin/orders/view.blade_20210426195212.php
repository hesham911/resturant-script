@extends('layouts.app')
@section('title')
    {{__('orders.titles.show')}}
@endsection
@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3> {{__('orders.titles.index')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __('orders.titles.show'),
                ]
            ])
        </div>
        <div class="mt-2 mt-md-0">
            <a href="#" class="btn btn-primary">{{__('orders.titles.create')}}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                    <div class="table-responsive">
                        <table id="user-list" class="table table-lg">
                            <thead>
                                <tr
                                    <th>{{__('app.tables.num')}}</th>
                                    <th>{{__('orders.client_id')}}</th>
                                    <th>{{__('orders.subcategory_id')}}</th>
                                    <th>{{__('orders.table_id')}}</th>
                                    <th>{{__('orders.order_type')}}</th>
                                    <th>{{__('orders.order_status')}}</th>
                                    <th>{{__('orders.total_price')}}</th>
                                    <th class="text-right">{{__('app.tables.control')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orders->count() > 0)
                                    @foreach($orders as $order )
                                        <tr>
                                            <td></td>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->client_id }}</td>
                                            <td>{{ $order->subcategory->name }}</td>
                                            <td>{{($order->table_id == null)?__('orders.no_thing'):$order->table_id}}</td>
                                            <td>
                                                <span class="badge bg-primary-bright text-primary">
                                                    {{ $order->typee }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info-bright text-primary">
                                                    {{ $order->statuss }}
                                                </span>
                                            </td>
                                            <td>{{ $order->total_price}} {{__('app.settings.currency')}}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="btn btn-floating"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-more-alt"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{route('orders.status',['order'=>$order->id,'state'=>1])}}" class="dropdown-item">{{__('orders.actions.prepare')}}</a>
                                                        <a href="{{route('orders.status',['order'=>$order->id,'state'=>2])}}" class="dropdown-item">{{__('orders.actions.close')}}</a>
                                                        <a href="{{route('orders.status',['order'=>$order->id,'state'=>3])}}" class="dropdown-item">{{__('orders.actions.payed')}}</a>
                                                        <a href="{{route('orders.view',['order'=>$order->id])}}" class="dropdown-item">{{__('orders.actions.view')}}</a>
                                                        <a class="dropdown-item sendCancelOrder"
                                                                data-toggle="modal" data-id="{{$order->id}}"
                                                                data-target=".examplePostModal{{$order->id}}"
                                                                data-commentNotice="{{route('orders.cancel',$order->id)}}">
                                                            {{__('orders.actions.cancel')}}
                                                        </a>
                                                        {{-- <form method="POST" action="{{route('orders.destroy',$order->id)}}"  >
                                                            @csrf
                                                            <input type="hidden" name="_method" value="DELETE" >
                                                            <button class="dropdown-item text-danger" >
                                                                {{__('app.tables.btn.delete')}}
                                                            </button>
                                                        </form> --}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="examplePostModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">إلغاء طلب</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" id="formModalPost" action="#">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">سبب الإلغاء:</label>
                            <input type="text" name="cancel_reason" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق
                            </button>
                            <button type="submit" class="btn btn-primary">إرسال السبب</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Datatable -->
    <script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>

    <script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>
    <script>
        // cancel order
        $('.sendCancelOrder').on('click',function ()
        {
            var comment_id=$(this).attr("data-id");
            var url=$(this).attr('data-commentNotice');
            $('#formModalPost').attr('action',url);
            $('#examplePostModal').addClass('examplePostModal'+comment_id);
            //$('#examplePostModal h3').text('Send Notice ( Comment )');
            /* var node = document.getElementById('formModalPost');
            domtoimage.toPng(node)
                .then(function (dataUrl) {
                    var img = new Image();
                    img.src = dataUrl;
                    console.log(dataUrl);
                    //document.body.appendChild(img);
                })
                .catch(function (error) {
                    console.error('oops, something went wrong!', error);
                }); */
            /**/
            /* domtoimage.toJpeg(document.getElementById('user-list'), { quality: 0.95 })
            .then(function (dataUrl) {
                var link = document.createElement('a');
                link.download = 'my-image-name.jpeg';
                link.href = dataUrl;
                link.click();
            }); */
        });
        // print reset
    </script>
@endsection
