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
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('orders.category_id')}}</label>
                                    <div class="col-sm-10">
                                    <select class="select2" name="category_id">
                                        <option disabled ></option>
                                        @if ($categories->count() > 0)
                                            @foreach ($categories as $category)
                                                <option  value="{{$category->id}}" {{(old('category_id')==$category->id)? 'selected':''}}>
                                                     {{$category->name}} </option>
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
                                {{-- <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('orders.products')}}</label>
                                    <div class="col-sm-10">
                                        <select class="select2 order-products" name="products[]" multiple="multiple">
                                            <option disabled ></option>
                                            @if (count($products) > 0)
                                                @foreach ($products as $product)
                                                    <option  value="{{$product->id}}" @if(is_array(old('products')) && in_array($product->id, old('products'))) selected @endif>
                                                        {{$product->name}} - {{$product->price}} {{__('app.settings.currency')}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label class="col-sm-2">{{__('orders.products')}}</label>
                                    <div class="basic-repeater">
                                        <div data-repeater-list="group_a">
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class="col-md-10 col-sm-12 form-group">
                                                        <input type="text" class="form-control" name="number" id="number"
                                                               placeholder="{{__('users.employees.placeholder.phone')}}">
                                                        <select class="select2 order-products" name="product_id">
                                                        <option disabled ></option>
                                                        @if (count($products) > 0)
                                                            @foreach ($products as $product)
                                                                <option  value="{{$product->id}}">
                                                                    {{$product->name}} - {{$product->price}} {{__('app.settings.currency')}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
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
  <script>
    $('.select2').select2({
        //placeholder: 'اختر'
    });
    $('.order-products').select2({
        placeholder: 'اختر المنتجات'
    });
  </script>
@endsection