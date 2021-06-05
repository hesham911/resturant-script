@extends('layouts.app')
@section('title')
    {{__('orders.titles.index')}}
@endsection
@section('head')
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3> {{__('orders.titles.index')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __('orders.titles.index'),
                ]
            ])
        </div>
        <div class="mt-2 mt-md-0">

        </div>
        <div class="mt-2 mt-md-0">
            <form method="get" action="{{route('orders.index')}}">
                <select name="status" class="btn btn-success" id="order_status">
                    @foreach(\App\Order::status() as $key=>$item)
                        <option value="{{$key}}" {{($key == app('request')->input('status'))? 'selected':''}}>{{$item}}</option>
                    @endforeach
                </select>
                <a href="{{route('orders.create')}}" class="btn btn-primary">{{__('orders.titles.create')}}</a>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="user-list" class="table table-lg">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="user-list-select-all">
                                            <label class="custom-control-label" for="user-list-select-all"></label>
                                        </div>
                                    </th>
                                    <th>{{__('app.tables.num')}}</th>
                                    {{-- <th>{{__('orders.client_id')}}</th> --}}
                                    <th>{{__('orders.category_id')}}</th>
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
                                            {{-- <td>{{ $order->client_id }}</td> --}}
                                            <td>{{ $order->category->name }}</td>
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
                                                        <!-- علشان مفيش شاشه ف المطبخ هنعملها كومنت  -->
{{--                                                         <a href="{{route('orders.status',['order'=>$order->id,'state'=>1])}}" class="dropdown-item">{{__('orders.actions.prepare')}}</a> --}}
                                                        @if ($order->status == 0)
                                                            <a href="{{route('orders.status',['order'=>$order->id,'state'=>2])}}" class="dropdown-item">{{__('orders.actions.close')}}</a>
                                                            <a href="{{route('orders.edit',$order->id)}}" class="dropdown-item">{{__('app.tables.btn.edit')}}</a>
                                                            <a class="dropdown-item sendCancelOrder"
                                                                    data-toggle="modal" data-id="{{$order->id}}"
                                                                    data-target=".examplePostModal{{$order->id}}"
                                                                    data-commentNotice="{{route('orders.cancel',$order->id)}}">
                                                                {{__('orders.actions.cancel')}}
                                                            </a>
                                                        @elseif($order->status == 2)
                                                            <a href="{{route('orders.status',['order'=>$order->id,'state'=>3])}}" class="dropdown-item">{{__('orders.actions.payed')}}</a>
                                                        @endif
                                                        @if($order->status != 4)
                                                            <a href="{{route('orders.show',['order'=>$order->id])}}" class="dropdown-item">{{__('orders.actions.view')}}</a>
                                                        @else
                                                            <div class="p-">
                                                                <span class="text-danger">{{__('orders.cancel_reason')}}</span><hr>
                                                                {{$order->cancel_reason}}
                                                            </div>
                                                        @endif
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
        });
        // filter
        $(document).ready(function()
        {
            $("#order_status").change( function()
            {
                this.form.submit();
            });
        });
    </script>
@endsection
