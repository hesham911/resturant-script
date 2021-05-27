@extends('layouts.app')
@section('title')
    {{__('accounting.indirect-cost.titles.edit')}}
@endsection
@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header">
        <div>
            <h3>{{__('accounting.indirect-cost.titles.edit')}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("accounting.indirect-cost.titles.edit"),
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
                            <h6 class="card-title">{{__('accounting.indirect-cost.titles.edit')}}</h6>
                            <form method="post" action="{{route('indirect.costs.update',['indirectCost'=>$indirectCost->id])}}" multiple>
                                @CSRF
                                <input type="hidden" name="_method" value="PUT" >
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">{{__('accounting.indirect-cost.name')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{old('name',$indirectCost->name)}}" class="form-control" id="name" placeholder="{{__('accounting.indirect-cost.placeholder.name')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">{{__('app.forms.btn.edit')}}</button>
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
