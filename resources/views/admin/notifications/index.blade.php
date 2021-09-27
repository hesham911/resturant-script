@extends('layouts.app')
@section('title')
    {{__('app.notify.titles.index')}}
@endsection
@section('head')
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>{{__('app.notify.titles.index')}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("app.notify.titles.index"),
                ]
            ])
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
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
                        <h5 class="page-header text-center">{{__('app.notify.table.title.unread')}}</h5>
                        <table id="user-list" class="table table-lg">
                            <thead>
                            <tr>
                                <th>{{__('app.notify.table.material')}}</th>
                                <th>{{__('app.notify.table.type')}}</th>
                                <th>{{__('app.notify.table.warning')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(auth()->user()->unreadNotifications as $unreadNotification)
                                <tr>
                                    <td>{{$unreadNotification->data['material']}}</td>
                                    @if($unreadNotification->type == 'App\Notifications\ExpiredMaterialNotification')
                                        <td>{{__('app.notify.table.data.expire')}}</td>
                                        <td>{{$unreadNotification->data['expiry_date']}}</td>
                                    @elseif($unreadNotification->type == 'App\Notifications\LowQuantityStockNotification')
                                        <td>{{__('app.notify.table.data.low')}}</td>
                                        <td>{{$unreadNotification->data['quantity']}}</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
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
                        <h5 class="page-header text-center">{{__('app.notify.table.title.read')}}</h5>
                        <table id="user-list" class="table table-lg">
                            <thead>
                            <tr>
                                <th>{{__('app.notify.table.material')}}</th>
                                <th>{{__('app.notify.table.type')}}</th>
                                <th>{{__('app.notify.table.warning')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(auth()->user()->readNotifications as $readNotification)
                                <tr>
                                    <td>{{$readNotification->data['material']}}</td>
                                    @if($readNotification->type == 'App\Notifications\ExpiredMaterialNotification')
                                        <td>{{__('app.notify.table.data.expire')}}</td>
                                        <td>{{$readNotification->data['expiry_date']}}</td>
                                    @elseif($readNotification->type == 'App\Notifications\LowQuantityStockNotification')
                                        <td>{{__('app.notify.table.data.low')}}</td>
                                        <td>{{$readNotification->data['quantity']}}</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- Datatable -->
    <script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>

    {{--<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>--}}
@endsection
