@extends('layouts.app')
@section('title')
 {{__('supplies.titles.create')}}
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
            <h3> {{__('supplies.titles.create')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("supplies.titles.create"),
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
                            <h6 class="card-title">{{__('supplies.titles.create')}}</h6>
                            <form  method="POST"  action="{{route('supplies.store') }}" class="basic-repeater">
                              @CSRF
                                <div data-repeater-list="group-a">
                                    <div data-repeater-item="" class = "mb-3 row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="customer_name">{{__('supplies.expiry_date')}}</label>
                                                    <input type="date" class="form-control" id="inputPassword" placeholder="{{__('supplies.expiry_date')}}" name="expiry_date" value="{{old('expiry_date')}}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="customer_name">{{__('supplies.Supplier_name')}}</label>
                                                    <input type="text" class="form-control" id="inputPassword" placeholder="{{__('supplies.Supplier_name')}}" value="{{old('Supplier_name')}}" name="Supplier_name">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="customer_name">
                                                         {{__('supplies.price')}} 
                                                    </label>
                                                    <input type="text" class="form-control" id="inputPassword" placeholder="{{__('supplies.price')}}" value="{{old('price')}}" name="price">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="customer_name"> {{__('supplies.quantity')}} </label>
                                                    <input type="text" class="form-control" id="inputPassword" placeholder="{{__('supplies.quantity')}}" value="{{old('quantity')}}" name="quantity">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="customer_name">
                                                        {{__('supplies.material_id')}}
                                                    </label>
                                                    <select class="select2 " name="material_id">
                                                        <option disabled  selected> اختر {{__('supplies.material_id')}}</option>
                                                        @if ($materials->count() > 0)
                                                            @foreach ($materials as $material)
                                                                <option  value="{{$material->id}}"> {{$material->name}} ({{$material->measuring->name}}) </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" data-repeater-create="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Add
                                </button>
                                <input type="hidden" value="{{Auth::id()}}" name="user_id">
                                <div class="d-flex flex-row-reverse  mt-5">
                                    <button class="btn btn-primary " type="submit">{{__('app.forms.btn.FormSubmit')}}</button>
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
    {{-- repeater --}}
    <script src="{{ url('vendors/jquery.repeater.min.js') }}"></script>
  <script>
    $(document).ready(function (){
        $('.select2').select2({
            placeholder: 'اختر'
        });
        $('.basic-repeater').repeater({
            show: function () {
                $(this).slideDown();
                $('.select2-container').remove();
                $('.select2').select2({});
                $('.select2-container').css('width','100%');
            }
        });
        
    });
  </script>
@endsection
