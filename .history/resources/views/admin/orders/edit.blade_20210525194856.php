@extends('layouts.app')
@section('title')
    {{__('orders.titles.edit')}}
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
            <h3> {{__('orders.titles.edit')}} </h3>
            <div>
                @include('admin.partials.breadcrumb',[
                    'parent' => [
                        'name' => __('orders.titles.edit'),
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
                            <h6 class="card-title">{{__('orders.titles.edit')}}</h6>
                            <form  method="post" action="{{route('orders.update',$order->id)}}">
                                @CSRF
                                @if($client)
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">{{__('users.clients.phone')}}</label>
                                        <div class="col-sm-10">
                                        <select class="select2" name="client_phone">
                                            @foreach ($client->user->phones->pluck('number') as $phone)
                                                <option  value="{{$phone}}" {{(old('client_phone')==$phone)? 'selected':''}}>
                                                    {{$phone}} </option>
                                             @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">{{__('users.clients.address_details')}}</label>
                                        <div class="col-sm-10">
                                        <select class="select2" name="client_zone">
                                            @foreach ($client->zones as $zone)
                                                <option  value="{{$zone->name}} - {{$zone->pivot->address}}">
                                                    {{$zone->name}}-{{$zone->pivot->address}} </option>
                                             @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <input hidden name="client_id" value="{{$client->id}}">
                               @endif
                                <input type="hidden" name="_method" value="PUT" >
                                <!-- current Emplyee -->
                                <input hidden name="employee_id" value="{{Auth::user()->id}}">
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('orders.category_id')}}</label>
                                    <div class="col-sm-10">
                                    <select class="select2" name="category_id">
                                        @if ($categories->count() > 0)
                                            @foreach ($categories as $category)
                                                <option  value="{{$category->id}}" {{($category->id == old("category_id",
                                                    $order->category_id))? 'selected':''}}>
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
                                        @if ($tables->count() > 0)
                                            @foreach ($tables as $table)
                                                <option  value="{{$table->id}}" {{($table->id == old("table_id",
                                                    $order->table_id))? 'selected':''}}>
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
                                                <option  value="{{$key}}"
                                                {{($key == old("type", $order->type))? 'selected':''}}>
                                                     {{$type}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2">{{__('orders.products')}}</label>
                                    <div class="basic-repeater">
                                        <div data-repeater-list="group_a">
                                            @foreach ($ordProducts as $prodc)
                                                <div data-repeater-item>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12 form-group">
                                                            <label for="product_id">{{__('products.name')}}</label>
                                                            <select name="product_id" id="product_id" class="form-control">
                                                                @if (count($products) > 0)
                                                                    @foreach ($products as $product)
                                                                        <option  value="{{$product->id}}"  {{($prodc->id==$product->id)? 'selected':''}}>
                                                                            {{$product->name}} - {{$product->price}} {{__('app.settings.currency')}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 col-sm-12 form-group">
                                                            <label for="quantity">{{__('products.quantity')}}</label>
                                                            <input type="number" class="form-control" name="quantity" id="quantity"
                                                                min="1" value="{{$prodc->pivot->quantity}}">
                                                        </div>
                                                        <div class="col-md-2 col-sm-12 form-group mt-4">
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
                                <div class="d-flex flex-row-reverse" >
                                    <button class="btn btn-primary " type="submit">{{__('app.forms.btn.edit')}}</button>
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
    <!-- repeater -->
    <script src="{{asset('vendors/jquery.repeater.min.js')}}"></script>
  <script>
    $(document).ready(function ()
    {
        $('.select2').select2({
        //placeholder: 'اختر'
        });
        $('.order-products').select2({
            placeholder: 'اختر المنتجات'
        });
        $('.basic-repeater').repeater();
    });
  </script>
@endsection
