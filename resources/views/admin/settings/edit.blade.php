@extends('layouts.app')
@section('title')
{{__('settings.titles.edit')}}
@endsection
@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
    <!-- selectto -->
    <link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">
@endsection

@section('content')

    <div class="page-header">
        <div>
            <h3> {{__('settings.titles.edit')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("settings.titles.edit"),
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
                            <h6 class="card-title">{{__('settings.titles.edit')}}</h6>
                            <form class="needs-validation" novalidate="" method="POST"  action="{{route('settings.update',$setting->id ) }}" >
                                @csrf
                                <input type="hidden" name="_method" value="PUT" >
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('settings.name')}}</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputPassword" value="{{old('name',$setting->name)}}" name="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">
                                        {{__('settings.value')}}
                                    </label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputPassword" value="{{old('value',$setting->value)}}" name="value">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">
                                        {{__('settings.active')}}
                                    </label>
                                    <div class="custom-control custom-switch custom-checkbox-success col-sm-10">
                                        <input type="hidden" value="0"  name="active">
                                        <input type="checkbox" name="active" class="custom-control-input" value="1"  id="active" {{ old('active',$setting->status) ? 'checked="checked"' : '' }}>
                                        <label for="active" class="custom-control-label"></label>
                                    </div>
                                </div>
                                <div class="d-flex flex-row-reverse" >
                                    <button class="btn btn-primary " type="submit">
                                        {{__('app.forms.btn.edit')}}
                                    </button>
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
    <!-- selectto -->
    <script src="../../vendors/select2/js/select2.min.js"></script>
  <script>
    $('.select2').select2({
        placeholder: 'اختر'
    });
  </script>
@endsection
