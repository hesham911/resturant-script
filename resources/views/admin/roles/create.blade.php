@extends('layouts.app')
@section('title')
    {{__('roles.titles.create')}}
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
            <h3>{{__('roles.titles.create')}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("roles.titles.create"),
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
                            <h6 class="card-title">{{__('geo.zones.titles.subcreate')}}</h6>
                            <form method="post" action="{{route('roles.store')}}" multiple>
                                @CSRF
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">{{__('roles.name')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="{{__('roles.placeholder.name')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="permission" class="col-sm-2 col-form-label">{{__('roles.permissions')}}</label>
                                    <div class="col-sm-10">
                                        <select name="permission[]" id="permission" class="roles-employees" multiple>
                                            <option disabled >{{__('roles.placeholder.permissions')}}</option>
                                            @if(count($permissions) > 0)
                                                @foreach($permissions as $key => $permission)
                                                    <option value="{{$permission->name}}" {{ (old('permission') == $permission->name) ? 'selected':'' }}>{{$permission->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
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
            $('.roles-employees').select2({
                placeholder: "إضافة الأذونات"
            });
        });
    </script>
@endsection
