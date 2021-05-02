@extends('layouts.app')
@section('title')
    {{__('orders.titles.create')}}
@endsection
@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
    <!-- selectto -->
    <link rel="stylesheet" href="{{asset('vendors/select2/css/select2.min.css')}}" type="text/css">
@endsection

@section('content')

    <div class="page-header">
        <div>
            <h3> {{__('orders.titles.create')}} </h3>
            <div>
                @include('admin.partials.breadcrumb',[
                    'parent' => [
                        'name' => __('orders.titles.create'),
                    ]
                ])
            </div>
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
                            <h6 class="card-title">{{__('orders.titles.create')}}</h6>
                            <form  method="POST"  action="{{route('orders.store') }}" >
                                @CSRF
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('orders.client_id')}}</label>
                                    <div class="col-sm-10">
                                    <select class="select2" name="client_id">
                                        <option disabled ></option>
                                        @if ($clients->count() > 0)
                                            @foreach ($clients as $client)
                                                <option value="{{$client->id}}" {{(old('client_id')==$client->id)? 'selected':''}}>
                                                     {{$client->id}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('orders.subcategory_id')}}</label>
                                    <div class="col-sm-10">
                                    <select class="select2" name="subcategory_id">
                                        <option disabled ></option>
                                        @if ($subcategories->count() > 0)
                                            @foreach ($subcategories as $subcategory)
                                                <option  value="{{$subcategory->id}}" {{(old('subcategory_id')==$subcategory->id)? 'selected':''}}>
                                                     {{$subcategory->name}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('orders.table_id')}}</label>
                                    <div class="col-sm-10">
                                    <select class="select2" name="table_id">
                                        <option value="" selected>{{__('orders.choose_table')}}</option>
                                        @if ($tables->count() > 0)
                                            @foreach ($tables as $table)
                                                <option  value="{{$table->id}}" {{(old('table_id')==$table->id)? 'selected':''}}>
                                                     {{$table->name}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('orders.order_type')}}</label>
                                    <div class="col-sm-10">
                                    <select class="select2" name="type">
                                        <option disabled ></option>
                                        @if (count($types) > 0)
                                            @foreach ($types as $key=>$type)
                                                <option  value="{{$key}}" {{(old('type')==$key)? 'selected':''}}>
                                                     {{$type}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    </div>
                                </div>

                                <div class="d-flex flex-row-reverse" >
                                    <button class="btn btn-primary " type="submit">{{__('app.forms.btn.add')}}</button>
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
    <script src="{{asset('vendors/select2/js/select2.min.js')}}"></script>
    <!-- Form repeater -->
    <script src="{{ url('vendors/jquery.repeater.min.js') }}"></script>
    <!-- Form repeater examples -->
    <script src="{{ url('assets/js/examples/pages/form-repeater.js') }}"></script>
  <script>
    $('.select2').select2({
       // placeholder: 'اختر'
    });
  </script>
@endsection
