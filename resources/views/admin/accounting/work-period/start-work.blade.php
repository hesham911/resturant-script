@extends('layouts.app')
@section('title')
    {{__('accounting.work-periods.start.titles.create')}}
@endsection
@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">

    <!-- select2 css -->
    <link rel="stylesheet" href="{{url('vendors/select2/css/select2.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('vendors/checkbox-nested/css/bootstrap-multiselect.min.css')}}" type="text/css">
@endsection

@section('content')

    <div class="page-header">
        <div>
            <h3>{{__('accounting.work-periods.start.titles.index')}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("accounting.work-periods.start.titles.create"),
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
                            <h6 class="card-title">{{__('accounting.work-periods.start.titles.subcreate')}}</h6>
                            <form method="post" action="{{route('start.work.store')}}" multiple>
                                @csrf
                                <div class="form-group row">
                                    <label for="types_bank" class="col-sm-2 col-form-label">{{__('accounting.work-periods.start.bank')}}</label>
                                    <div class="col-sm-10">
                                        <select name="bank" id="bank" class="bank">
                                            <option disabled >{{__('accounting.work-periods.start.placeholder.bank')}}</option>
                                            @if(count($banks) > 0)
                                                @foreach($banks as $key => $bank)
                                                    <option value="{{$bank->id}}" {{(old('type')==$bank->id)? 'selected':''}}>{{$bank->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                {{--<div class="form-group row">--}}
                                    {{--<label for="balance" class="col-sm-2 col-form-label">{{__('accounting.work-periods.start.pocket_money')}}</label>--}}
                                    {{--<div class="col-sm-10">--}}
                                        {{--<input type="text" name="opening_balance" value="{{old('opening_balance')}}" class="form-control" id="balance" placeholder="{{__('accounting.work-periods.start.placeholder.pocket_money')}}">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
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

    <!-- select2 script -->
    <script src="{{url('vendors/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('vendors/jquery.repeater.min.js')}}"></script>
    <script  src="{{asset('vendors/checkbox-nested/js/bootstrap-multiselect.min.js')}}" ></script>
    <script>
        $(document).ready(function () {
            $('.bank').select2({
                placeholder: "أختر الخزينة التي تعمل عليها "
            });
        });
    </script>

@endsection
