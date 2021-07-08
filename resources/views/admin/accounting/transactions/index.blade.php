@extends('layouts.app')
@section('title')
    {{__('accounting.transactions.titles.index')}}
@endsection
@section('head')
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>{{__('accounting.transactions.titles.index')}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("accounting.transactions.titles.index"),
                ]
            ])
        </div>
        <div class="mt-2 mt-md-0">
            <a href="{{route('transactions.create')}}" class="btn btn-primary">{{__('accounting.transactions.titles.subcreate')}}</a>
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
                                <th>{{__('accounting.transactions.date')}}</th>
                                <th>{{__('accounting.transactions.fromBank')}}</th>
                                <th>{{__('accounting.transactions.toBank')}}</th>
                                <th>{{__('accounting.transactions.amount')}}</th>
                                <th class="text-right">{{__('app.tables.control')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bankTrans as $k=> $bankTran)
                                <tr>
                                <td>{{$k}}</td>
                                <td>{{\App\Bank::getBankFromId($bankTran[1]->bank_id)->name}}</td>
                                <td>{{\App\Bank::getBankFromId($bankTran[0]->bank_id)->name}}</td>
                                <td>{{$bankTran[0]->amount}}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown"
                                           class="btn btn-floating"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        {{--<div class="dropdown-menu dropdown-menu-right">--}}
                                            {{--<a href="{{route('banks.edit',['bank'=> $bank->id])}}" class="dropdown-item">{{__('app.tables.btn.edit')}}</a>--}}
                                           {{--@if($bank->bankTransactions->count() > 1)--}}
                                                {{--<button class="dropdown-item text-danger" disabled>{{__('accounting.banks.massages.cant_delete_bank')}}</button>--}}
                                            {{--@else--}}
                                                {{--<form method="POST" action="{{route('banks.destroy',['bank'=>$bank->id])}}"  >--}}
                                                    {{--@CSRF--}}
                                                    {{--<input type="hidden" name="_method" value="DELETE" >--}}
                                                    {{--<button class="dropdown-item text-danger" >--}}
                                                        {{--{{__('app.tables.btn.delete')}}--}}
                                                    {{--</button>--}}
                                                {{--</form>--}}
                                           {{--@endif--}}

                                        {{--</div>--}}
                                    </div>
                                </td>
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
