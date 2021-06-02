@extends('layouts.app')
@section('title')
    {{__('accounting.transactions.titles.create')}}
@endsection
@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
    <!-- select2 -->
    <link rel="stylesheet" href="{{url('vendors/select2/css/select2.min.css')}}" type="text/css">
@endsection

@section('content')

    <div class="page-header">
        <div>
            <h3>{{__('accounting.transactions.titles.create')}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("accounting.transactions.titles.create"),
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
                            <h6 class="card-title">{{__('accounting.transactions.titles.subcreate')}}</h6>
                            <form method="post" action="{{route('transactions.store')}}" multiple>
                                @CSRF
                                <div class="form-group row">
                                    <label for="fromBank" class="col-sm-2 col-form-label">{{__('accounting.transactions.fromBank')}}</label>
                                    <div class="col-sm-4">
                                        <select name="fromBank" id="fromBank" class="fromBank">
                                            <option disabled >{{__('accounting.transactions.placeholder.fromBank')}}</option>
                                            @if(count($banks) > 0)
                                                @foreach($banks as $key => $bank)
                                                    <option value="{{$bank->id}}" {{(old('fromBank')==$bank->id)? 'selected':''}}>{{$bank->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <label for="toBank" class="col-sm-2 col-form-label">{{__('accounting.transactions.toBank')}}</label>
                                    <div class="col-sm-4">
                                        <select name="toBank" id="toBank" class="toBank">
                                            <option disabled >{{__('accounting.transactions.placeholder.toBank')}}</option>
                                            @if(count($banks) > 0)
                                                @foreach($banks as $key => $bank)
                                                    <option value="{{$bank->id}}" {{(old('toBank')==$bank->id)? 'selected':''}}>{{$bank->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="notes" class="col-sm-2 col-form-label">{{__('accounting.banks.notes')}}</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" name="notes"  class="form-control" id="notes" placeholder="{{__('accounting.banks.placeholder.notes')}}">{{old('name')}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="amount" class="col-sm-2 col-form-label">{{__('accounting.transactions.amount')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="amount" value="{{old('amount')}}" class="form-control" id="amount" placeholder="{{__('accounting.transactions.placeholder.amount')}}">
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
    <script src="{{url('vendors/select2/js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.fromBank').select2({
                placeholder: "الخزينة المحول منها "
            });

            $('.toBank').select2({
                placeholder: "الخزينة المحول إليها "
            });
        });


    </script>
@endsection
