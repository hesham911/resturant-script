@extends('layouts.app')
@section('title')
    {{__('accounting.banks.titles.create')}}
@endsection
@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header">
        <div>
            <h3>{{__('accounting.banks.titles.create')}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("accounting.banks.titles.create"),
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
                            <h6 class="card-title">{{__('accounting.banks.titles.subcreate')}}</h6>
                            <form method="post" action="{{route('banks.store')}}" multiple>
                                @CSRF
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">{{__('accounting.banks.name')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="{{__('accounting.banks.placeholder.name')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="notes" class="col-sm-2 col-form-label">{{__('accounting.banks.notes')}}</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" name="notes"  class="form-control" id="notes" placeholder="{{__('accounting.banks.placeholder.notes')}}">{{old('name')}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="balance" class="col-sm-2 col-form-label">{{__('accounting.banks.balance')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="opening_balance" value="{{old('opening_balance')}}" class="form-control" id="balance" placeholder="{{__('accounting.banks.placeholder.balance')}}">
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
@endsection
