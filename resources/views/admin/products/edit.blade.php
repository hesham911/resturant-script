@extends('layouts.app')
@section('title')
    {{__('products.titles.edit')}}
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
            <h3> {{__('products.titles.edit')}} </h3>
            <div>
                @include('admin.partials.breadcrumb',[
                    'parent' => [
                        'name' => __('products.titles.edit'),
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
                            <h6 class="card-title">{{__('products.titles.edit')}}</h6>
                            <form method="post" action="{{route('products.update',$product->id)}}" class="repeater" >
                                @CSRF
                                <input type="hidden" name="_method" value="PUT" >
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">{{__('products.name')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{old('name',$product->name)}}" class="form-control" id="name" placeholder="{{__('products.placeholder.name')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('products.subcategory_id')}}</label>
                                    <div class="col-sm-10">
                                    <select class="select2" name="subcategory_id">
                                        @if ($subcategories->count() > 0)
                                            @foreach ($subcategories as $subcategory)
                                                <option  value="{{$subcategory->id}}" {{($subcategory->id == old("subcategory_id", $product->subcategory_id))? 'selected':''}}>
                                                    {{$subcategory->name}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="price" class="col-sm-2 col-form-label">{{__('products.price')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="price" value="{{old('price',$product->price)}}" class="form-control" id="price" placeholder="{{__('products.placeholder.price')}}">
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('products.type')}}</label>
                                    <div class="col-sm-10">
                                    <select class="select2" name="type">
                                        @if (count($types) > 0)
                                            @foreach ($types as $key=>$type)
                                                <option  value="{{$key}}" {{($key == old("type", $product->type))? 'selected':''}}>
                                                     {{$type}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    </div>
                                </div> --}}

                                <div data-repeater-list="group" class="my-5">
                                    @foreach ($product->ProductManufactures as $productManufacture)
                                    <div data-repeater-item class="form-group row mb-5">
                                        <label class="col-sm-2 col-form-label">مواد التصنيع </label>
                                        <div class="form-group  col-md-4 col-sm-12">
                                            <select class="select2 form-control" name="material_id">
                                                <option disabled  selected> اختر {{__('productmanufactures.material_id')}}</option>
                                                @if(isset($materials))
                                                @if ($materials->count() > 0)
                                                    @foreach ($materials as $material)
                                                        <option  value="{{$material->id}}" @if ($material->id == old('material_id',$productManufacture->material_id)) selected @endif> {{$material->name}} ({{$material->measuring->name}}) </option>
                                                    @endforeach
                                                @endif
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-10 col-md-4 col-sm-12">
                                            <input type="text" class="form-control" id="inputPassword" placeholder="{{__('productmanufactures.required_quantity')}}" value="{{old('required_quantity',$productManufacture->required_quantity)}}" name="required_quantity" required>
                                        </div>
                                        <input data-repeater-delete type="button" value="{{__('app.forms.btn.delete')}}" class="btn btn-danger "/>
                                    </div>
                                    @endforeach
                                    <div data-repeater-item class="form-group row mb-5">
                                        <label class="col-sm-2 col-form-label">مواد التصنيع </label>
                                        <div class="form-group  col-md-4 col-sm-12">
                                            <select class="select2 form-control" name="material_id">
                                                <option disabled  selected> اختر {{__('productmanufactures.material_id')}}</option>
                                                @if(isset($materials))
                                                @if ($materials->count() > 0)
                                                    @foreach ($materials as $material)
                                                        <option  value="{{$material->id}}" @if ($material->id == old('material_id')) selected @endif> {{$material->name}} ({{$material->measuring->name}}) </option>
                                                    @endforeach
                                                @endif
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-10 col-md-4 col-sm-12">
                                            <input type="text" class="form-control" id="inputPassword" placeholder="{{__('productmanufactures.required_quantity')}}" value="{{old('required_quantity')}}" name="required_quantity" required>
                                        </div>
                                        <input data-repeater-delete type="button" value="{{__('app.forms.btn.delete')}}" class="btn btn-danger "/>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary mb-5" data-repeater-create="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> {{__('app.forms.btn.add')}}
                                </button> 
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">{{__('app.forms.btn.edit')}}</button>
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
    <!-- selectto -->
    <script src="{{asset('vendors/select2/js/select2.min.js')}}"></script>
    {{-- form repeater --}}
    <script src="{{ url('vendors/jquery.repeater.min.js') }}"></script>
    <script>  
        function MaterialSelect() {
                $('.select2').select2({
                    language: "ar",
                });
            }
            
            MaterialSelect();
            $('.repeater').repeater({
                show: function () {
                    $(this).slideDown(function (){
                        $('.layout-wrapper .content-wrapper .content-body .content').getNiceScroll().resize();
                    });
                    $('.select2-container').remove();
                    MaterialSelect();
                    $('.select2-container').css('width','100%');
                }
            });
    </script>
@endsection
