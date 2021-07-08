@extends('layouts.app')
@section('title')
    {{__('users.employees.titles.edit')}}
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
            <h3>{{__('users.employees.titles.edit')}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("users.employees.titles.edit"),
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
                            <h6 class="card-title">{{__('users.employees.titles.edit')}}: <span style="color: #5066E1">{{$employee->user->name}}</span></h6>
                            <form method="post" action="{{route('employees.update',['employee'=>$employee->id])}}" multiple>
                                @csrf
                                <input type="hidden" name="_method" value="PUT" >
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">{{__('users.employees.name')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{old('name',$employee->user->name)}}" class="form-control" id="name" placeholder="{{__('users.employees.placeholder.name')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">{{__('users.employees.email')}}</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" value="{{old('email',$employee->user->email)}}" class="form-control" id="email" placeholder="{{__('users.employees.placeholder.email')}}">
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
                                                    <option value="{{$key}}" {{ (old('type',$employee->type) == $key) ? 'selected':''}}>{{$type}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="roles" class="col-sm-2 col-form-label">{{__('users.employees.roles_employees')}}</label>
                                    <div class="col-sm-10">
                                        @foreach($roles as $k =>$role)
                                            <select id="{{$role->name}}" name="roles[{{$role->name}}][]" multiple="multiple">
                                                @foreach($role->permissions as $k =>$v)
                                                    <option value="{{$v->name}}" {{in_array($v->name,$userPermissions) ? 'selected' : ''}}>{{$v->name}}</option>
                                                @endforeach
                                            </select>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2">{{__('users.employees.status')}}</label>
                                    <div class="col-sm-10">
                                        <div class="custom-control custom-switch custom-checkbox-success">
                                            <input type="hidden" value="0"  name="status_employees">
                                            <input type="checkbox" name="status_employees" class="custom-control-input" value="1"  id="status_employees" {{ old('status_employees',$employee->status) ? 'checked' : '' }}>
                                            <label for="status_employees" class="custom-control-label"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2">{{__('users.employees.phone')}}</label>
                                    <div class="basic-repeater">
                                        <div data-repeater-list="group_a">
                                            @foreach($phones as $phone)
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class="col-md-10 col-sm-12 form-group">
                                                        <input type="text" value="0{{$phone}}" class="form-control" name="number" id="number"
                                                               placeholder="{{__('users.employees.placeholder.phone')}}">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 form-group">
                                                        <button type="button" class="btn btn-danger" data-repeater-delete>
                                                            <i class="ti-close font-size-10 mr-2"></i> {{__('app.forms.btn.delete')}}
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-primary" data-repeater-create>
                                            <i class="ti-plus font-size-10 mr-2"></i> {{__('app.forms.btn.add')}}
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10 text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">{{__('app.forms.btn.edit')}}</button>
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
            $('.basic-repeater').repeater();

            $('.type-employees').select2({
                placeholder: "الوظيفة"
            });

//            $('.roles-employees').select2({
//                placeholder: "الصلاحية"
//            });
            var hhh = {!! json_encode($roles) !!}

            $.each( hhh, function (index,value) {
                $('#'+value.name).multiselect({
                    nonSelectedText: value.name,
                    includeSelectAllOption: true
                });
            });
        });
    </script>

@endsection
