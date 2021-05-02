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
                                <tr>
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
@endsection

@section('script')
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
        // print reset
    </script>
@endsection
