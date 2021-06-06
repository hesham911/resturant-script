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
                            <form method="post" action="{{route('employees.store')}}" multiple>
                                @csrf
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
                                    <label for="type_employees" class="col-sm-2 col-form-label">{{__('users.employees.types_employees')}}</label>
                                    <div class="col-sm-10">
                                        <select name="type_employees" id="type_employees" class="type-employees">
                                            <option disabled >{{__('users.employees.placeholder.types_employees')}}</option>
                                            @if(count($types) > 0)
                                                @foreach($types as $key => $type)
                                                    <option value="{{$key}}" {{(old('type')==$key)? 'selected':''}}>{{$type}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="roles" class="col-sm-2 col-form-label">{{__('users.employees.roles_employees')}}</label>
                                    <div class="col-sm-10">
                                        <select name="roles[]" id="roles" class="roles-employees" multiple>
                                            <option disabled >{{__('users.employees.placeholder.roles_employees')}}</option>
                                            @if(count($roles) > 0)
                                                @foreach($roles as $key => $role)
                                                    <option value="{{$role}}" {{(old('roles')==$role)? 'selected':''}}>{{$role}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2">{{__('users.employees.status')}}</label>
                                    <div class="col-sm-10">
                                        <div class="custom-control custom-switch custom-checkbox-success">
                                            <input type="hidden" value="0"  name="status_employees">
                                            <input type="checkbox" name="status_employees" class="custom-control-input" value="1"  id="status_employees" {{ old('status_employees') ? 'checked="checked"' : '' }}>
                                            <label for="status_employees" class="custom-control-label"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2">{{__('users.employees.phone')}}</label>
                                    <div class="basic-repeater">
                                        <div data-repeater-list="group_a">
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class="col-md-10 col-sm-12 form-group">
                                                        <input type="text" class="form-control" name="number" id="number"
                                                               placeholder="{{__('users.employees.placeholder.phone')}}">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 form-group">
                                                        <button type="button" class="btn btn-danger" data-repeater-delete>
                                                            <i class="ti-close font-size-10 mr-2"></i> {{__('app.forms.btn.delete')}}
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <button type="button" class="btn btn-primary" data-repeater-create>
                                            <i class="ti-plus font-size-10 mr-2"></i> {{__('app.forms.btn.add')}}
                                        </button>
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
    <script src="{{asset('vendors/jquery.repeater.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.basic-repeater').repeater({show: function () {
                $(this).slideDown(function (){
                    $('.layout-wrapper .content-wrapper .content-body .content').getNiceScroll().resize();
                });}
            });

            $('.type-employees').select2({
                placeholder: "الوظيفة"
            });

            $('.roles-employees').select2({
                placeholder: "الصلاحية"
            });
        });
    </script>

@endsection
