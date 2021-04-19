@extends('layouts.app')
@section('title')
 {{__('categories.titles.create')}}
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
            <h3> {{__('categories.titles.create')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Forms</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Form Validation</li>
                </ol>
            </nav>
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
                            <h6 class="card-title">{{__('categories.titles.create')}}</h6>
                            <form  method="POST"  action="{{route('categories.store') }}" >
                              @CSRF
                              <div class="form-group row">
                                  <label for="inputPassword" class="col-sm-2 col-form-label">{{__('categories.name')}}</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword" placeholder="{{__('categories.name')}}" name="name" value="{{old('name')}}">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="inputPassword" class="col-sm-2 col-form-label">{{__('categories.type')}}</label>
                                  <div class="col-sm-10">
                                    <select class="select2 " name="type">
                                      <option  value="1"> اضافات </option>
                                      <option value="0">قسم </option>
                                    </select>
                                  </div>
                              </div>
                              <div class="d-flex flex-row-reverse" >
                                <button class="btn btn-primary " type="submit">{{__('app.FormSubmit')}}</button>
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
