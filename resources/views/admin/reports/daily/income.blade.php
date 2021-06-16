@extends('layouts.app')
@section('title')
    {{__('reports.titles.create')}}
@endsection
@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
    <!-- selectto -->
    <link rel="stylesheet" href="{{asset('vendors/select2/css/select2.min.css')}}" type="text/css">
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header">
        <div>
            <h3> {{__('reports.titles.warehouse')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __('reports.titles.warehouse'),
                ]
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
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
                            <h6 class="card-title">{{__('reports.titles.warehouse')}}</h6>
                            <table id="myTable" class="table table-hover ">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('reports.daily.employee')}}</th>
                                    <th>{{__('reports.daily.bank')}}</th>
                                    <th>{{__('reports.daily.amount')}}</th>
                                    <th>{{__('reports.daily.time')}}</th>
                                    <th>{{__('reports.daily.order_show')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                        <tr>
                                            <td>{{$payment->id}}</td>
                                            <td>{{$payment->user->name}}</td>
                                            <td>{{$payment->workperiod->bank->name}}</td>
                                            <td>{{$payment->total_price}}</td>
                                            <td>{{$payment->created_at->format('H:i:s')}}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown"
                                                       class="btn btn-floating"
                                                       aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-more-alt"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{route('orders.show',['order'=>$payment->order_id])}}" class="dropdown-item">{{__('orders.actions.view')}}</a>                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th> {{__('reports.daily.date')}} {{\Carbon\Carbon::today()->format('Y-m-d')}}</th>
                                        <th> {{__('reports.daily.total')}} {{$payments->sum('total_price')}}</th>
                                        <th> {{__('reports.daily.orders_count')}} {{$payments->count()}}</th>
                                    </tr>

                                </tfoot>
                                {{--<thead>--}}
                               {{----}}
                                {{--<tr>--}}
                                    {{--<th>التاريخ</th>--}}
                                    {{--<th>المجموع الكلي</th>--}}
                                    {{--<th>عدد الأوردرات</th>--}}
                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}
                                {{--<tr>--}}
                                    {{--<td>{{\Carbon\Carbon::today()->format('Y-m-d')}}</td>--}}
                                    {{--<td>{{$payments->sum('total_price')}}</td>--}}
                                    {{--<td>{{$payments->count()}}</td>--}}
                                {{--</tr>--}}
                                {{--</tbody>--}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Form validation example -->
    <script src="{{ url('assets/js/examples/form-validation.js') }}"></script>
    <!-- Prism -->
    <script src="{{ url('vendors/prism/prism.js') }}"></script>
    <!-- selectto -->
    <script src="{{asset('vendors/select2/js/select2.min.js')}}"></script>
    <!-- Datatable -->
    <script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
    <script src="{{ url('vendors/dataTable/Buttons-1.6.1/js/dataTables.buttons.min.js') }}"></script>
    <script>
        var table = $('#myTable').DataTable({
            language: {
                url: "{{ url('vendors/dataTable/arabic.json') }}"
            },
            searching:false,
            dom: 'Bfrtip',
            buttons: [
                'print',
                { extend: 'excelHtml5', footer: true }
            ]
        })



    </script>
@endsection
