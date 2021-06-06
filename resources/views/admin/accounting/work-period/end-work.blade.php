@extends('layouts.app')
@section('title')
    {{__('accounting.work-periods.end.titles.money')}}
@endsection
@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">

    <!-- select2 css -->
    <link rel="stylesheet" href="{{url('vendors/select2/css/select2.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('vendors/checkbox-nested/css/bootstrap-multiselect.min.css')}}" type="text/css">
@endsection

@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>{{__("accounting.work-periods.end.titles.index")}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("accounting.work-periods.end.titles.money"),
                ]
            ])
        </div>
        <div class="mt-2 mt-md-0">
            <a href="{{route('end.work.update',['workperiod'=>$workperiod->id])}}" onclick="event.preventDefault();
                                     document.getElementById('end-work').submit();" class="btn btn-primary"  aria-expanded="false">
                <i class="ti-settings mr-2"></i> {{__("app.forms.btn.word-period")}}
            </a>
            <form id="end-work" action="{{ route('end.work.update',['workperiod'=>$workperiod->id]) }}" method="POST" class="d-none">
                @csrf
                <input type="hidden" name="_method" value="PUT" >
                <input type="hidden" name="close_balance" value="{{$total}}" >
                <input type="hidden" name="date_end" value="{{\Carbon\Carbon::now()}}" >
                <input type="hidden" name="status" value="0" >
            </form>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title mb-2">{{__("accounting.work-periods.end.titles.money")}}</h6>
                    </div>
                    <div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h5>{{__("accounting.work-periods.end.money-report.income")}}</h5>
                                    <div>{{__("accounting.work-periods.end.placeholder.income")}}</div>
                                </div>
                                <h3 class="text-success mb-0">{{$payments->sum('total_price')}}</h3>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h5>{{__("accounting.work-periods.end.money-report.outcome")}}</h5>
                                    <div>{{__("accounting.work-periods.end.placeholder.outcome")}}</div>
                                </div>
                                <div>
                                    <h3 class="text-danger mb-0">- {{$expenses->sum('amount')}}</h3>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h5>{{__("accounting.work-periods.end.money-report.total")}}</h5>
                                    <div>{{__("accounting.work-periods.end.placeholder.total")}}</div>
                                </div>
                                <div>
                                    <h3 class="text-info mb-0">{{$total}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="mt-3">--}}
                        {{--<a href="#" class="btn btn-info">Report Detail</a>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title mb-2">{{__("accounting.work-periods.end.titles.analytics")}}</h6>
                    </div>
                    <div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h5>{{__("accounting.work-periods.end.money-report.total")}}</h5>
                                    <div>{{__("accounting.work-periods.end.placeholder.total")}}</div>
                                </div>
                                <h3 class="text-primary mb-0">{{$payments->count()}}</h3>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h5>{{__("accounting.work-periods.end.placeholder.total")}}</h5>
                                    <div>{{__("accounting.work-periods.end.placeholder.total")}}</div>
                                </div>
                                <div>
                                    <h3 class="text-success mb-0">{{$expenses->count()}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="mt-3">--}}
                        {{--<a href="#" class="btn btn-warning">Statistics Detail</a>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
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
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title mb-2">{{__("accounting.work-periods.end.titles.payments-table")}}</h6>
                        </div>
                    <div class="table-responsive">
                        <table id="user-list" class="table table-lg">
                            <thead>
                            <tr>
                                <th>{{__('app.tables.num')}}</th>
                                <th>{{__('orders.view.total_product')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{$payment->id}}</td>
                                    <td>{{$payment->total_price}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
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
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title mb-2">{{__("accounting.work-periods.end.titles.expenses-table")}}</h6>
                        </div>
                    <div class="table-responsive">
                        <table id="user-list" class="table table-lg">
                            <thead>
                            <tr>
                                <th>{{__('app.tables.num')}}</th>
                                <th>{{__('accounting.indirect-cost.placeholder.name')}}</th>
                                <th>{{__('accounting.indirect-expenses.amount')}}</th>
                                <th class="text-right">{{__('app.tables.control')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expenses as $expens)
                                <tr>
                                    <td>{{$expens->id}}</td>
                                    <td>{{$expens->indirectcost->name}}</td>
                                    <td>{{$expens->amount}}</td>
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
    <!-- Form validation example -->
    <script src="{{ url('assets/js/examples/form-validation.js') }}"></script>

    <!-- Prism -->
    <script src="{{ url('vendors/prism/prism.js') }}"></script>

    <!-- select2 script -->
    <script src="{{url('vendors/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('vendors/jquery.repeater.min.js')}}"></script>
    <script  src="{{asset('vendors/checkbox-nested/js/bootstrap-multiselect.min.js')}}" ></script>
    <script>
        $(document).ready(function () {
            $('.bank').select2({
                placeholder: "الوظيفة"
            });
        });
    </script>

@endsection
