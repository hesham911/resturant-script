@extends('layouts.app')
@section('title')
    {{__('users.employees.titles.create')}}
@endsection
@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">

    <!-- select2 css -->
    <link rel="stylesheet" href="{{url('vendors/select2/css/select2.min.css')}}" type="text/css">
@endsection

@section('content')

    <div class="page-header">
        <div>
            <h3>{{__('users.employees.titles.create')}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("users.employees.titles.create"),
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
                            <h6 class="card-title">{{__('users.employees.titles.subcreate')}}</h6>
                            <form method="post" action="{{route('zones.store')}}" multiple>
                                @CSRF
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">{{__('users.employees.name')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="{{__('users.employees.placeholder.name')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">{{__('users.employees.email')}}</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="{{__('users.employees.placeholder.email')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">{{__('users.employees.password')}}</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" value="{{old('password')}}" class="form-control" id="password" placeholder="{{__('users.employees.placeholder.password')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="type-employees" class="col-sm-2 col-form-label">{{__('users.employees.types_employees')}}</label>
                                    <div class="col-sm-10">
                                        <select name="type-employees" id="type-employees" class="type-employees">
                                            <option>{{__('users.employees.placeholder.types_employees')}}</option>
                                            <option value="France">France</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="custom-control custom-switch custom-checkbox-success">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch3" >
                                        <label class="custom-control-label" for="customSwitch3">Toggle this switch element - Success</label>
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

    <!-- select2 script -->
    <script src="{{url('vendors/select2/js/select2.min.js')}}"></script>

    <script>
        $('.type-employees').select2({
            placeholder: "type-employees"
        });
    </script>
@endsection
