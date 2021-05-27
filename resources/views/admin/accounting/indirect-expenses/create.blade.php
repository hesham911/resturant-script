
@extends('layouts.app')
@section('title')
    {{__('accounting.indirect-expenses.titles.create')}}
@endsection
@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
    <link rel="stylesheet" href="{{url('vendors/datepicker/daterangepicker.css')}}" type="text/css">
    <!-- select2 css -->
    <link rel="stylesheet" href="{{url('vendors/select2/css/select2.min.css')}}" type="text/css">
@endsection

@section('content')

    <div class="page-header">
        <div>
            <h3>{{__('accounting.indirect-expenses.titles.create')}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("accounting.indirect-expenses.titles.create"),
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
                            <h6 class="card-title">{{__('accounting.indirect-expenses.titles.subcreate')}}</h6>
                            <form method="post" action="{{route('indirect.expenses.store')}}" multiple>
                                @CSRF
                                <div class="form-group row">
                                    <label for="costs" class="col-sm-2 col-form-label">{{__('accounting.indirect-expenses.cost')}}</label>
                                    <div class="col-sm-10">
                                        <select name="costs" id="costs" class="costs">
                                            <option disabled >{{__('accounting.indirect-expenses.placeholder.cost')}}</option>
                                            @if(count($IndirectCosts) > 0)
                                                @foreach($IndirectCosts as $key => $indirectCost)
                                                    <option value="{{$indirectCost->id}}" {{(old('costs')==$indirectCost->id)? 'selected':''}}>{{$indirectCost->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="daterangepicker" class="col-sm-2 col-form-label">{{__('accounting.indirect-expenses.placeholder.daterangepicker')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="daterangepicker"  id="daterangepicker" value="{{old('daterangepicker')}}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="amount" class="col-sm-2 col-form-label">{{__('accounting.indirect-expenses.placeholder.amount')}}</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="any" name="amount" value="{{old('amount')}}" class="form-control" id="amount" placeholder="{{__('accounting.indirect-expenses.amount')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">{{__('app.forms.btn.add')}}</button>
                                    </div>
                                </div>
                            </form>
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

    <script src="{{asset('vendors/datepicker/daterangepicker.js')}}"></script>

    <script src="{{url('vendors/select2/js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.costs').select2({
                placeholder: "التكاليف الغير مباشرة"
            });
        });
        $('input[name="daterangepicker"]').daterangepicker();


    </script>
@endsection
