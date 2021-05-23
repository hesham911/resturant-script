@extends('layouts.app')
@section('title')
 {{__('productmanufactures.titles.create')}}
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
            <h3> {{__('productmanufactures.titles.create')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("productmanufactures.titles.create"),
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
                            <h6 class="card-title">{{__('productmanufactures.titles.create')}}</h6>
                            <form  method="POST"  action="{{route('productmanufactures.store') }}" class="repeater">
                              @CSRF
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('productmanufactures.product_id')}}</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select class="productselect " name="product_id">
                                            <option disabled  selected> اختر {{__('productmanufactures.product_id')}}</option>
                                            @if ($products->count() > 0)
                                                @foreach ($products as $product)
                                                    <option  value="{{$product->id}}"> {{$product->name}}  </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div data-repeater-list="group">
                                    <div data-repeater-item class="form-group row mb-5">
                                        <label class="col-sm-2 col-form-label">مواد التصنيع </label>
                                        <div class="form-group  col-md-3 col-sm-12">
                                            <select class="ajaxmaterial form-control" name="material_id">
                                                <option disabled  selected> اختر {{__('productmanufactures.material_id')}}</option>
                                                @if(isset($materials))
                                                @if ($materials->count() > 0)
                                                    @foreach ($materials as $material)
                                                        <option  value="{{$material->id}}"> {{$material->name}} ({{$material->measuring->name}}) </option>
                                                    @endforeach
                                                @endif
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-10 col-md-3 col-sm-12">
                                            <input type="text" class="form-control" id="inputPassword" placeholder="{{__('productmanufactures.required_quantity')}}" value="{{old('required_quantity')}}" name="required_quantity" required>
                                        </div>
                                        <div class="form-group col-sm-10 col-md-3 col-sm-12">
                                            <input type="text" class="form-control" id="inputPassword" placeholder="{{__('productmanufactures.waste_percentage')}}" value="{{old('waste_percentage')}}" name="waste_percentage" required>
                                        </div>
                                        <input data-repeater-delete type="button" value="{{__('app.forms.btn.delete')}}" class="btn btn-danger "/>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" data-repeater-create="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> {{__('app.forms.btn.add')}}
                                </button>   
                                <input type="hidden" value="{{Auth::id()}}" name="user_id">
                                <div class="d-flex flex-row-reverse mt-5 pt-5">
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
        var product_id ;
        function MaterialSelect() {
            $('.ajaxmaterial').select2({
                placeholder: 'اختر',
                ajax: {
                        url: '{{route('productmanufactures.selectto')}}',
                        dataType: 'json',
                        type:'POST',
                        headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                        delay: 1000,
                        data: function (params) {
                            var query = {
                                search: params.term,
                                product_id: product_id,
                            }
                            return query;
                        },
                        processResults: function (data) {
                            return {
                            results:  $.map(data, function (material) {
                                    return {
                                        text: material.name,
                                        id: material.id
                                    }

                                })
                            };
                        }

                    },
            });
        }
        function ProductSelect() {
            $('.productselect').select2();
            $('.productselect').on('select2:select', function (e) {
                product_id = $(e.params.data.element).val();
                console.log(product_id);
            });
            MaterialSelect();
        }   
        ProductSelect();
        $('.repeater').repeater({
            show: function () {
                $(this).slideDown();
                $('.select2-container').remove();
                ProductSelect();
                $('.select2-container').css('width','100%');
            }
        });
        
    });
  </script>
@endsection
