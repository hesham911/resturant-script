@extends('layouts.app')
@section('title')
 {{__('damagedmaterials.titles.create')}}
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
            <h3> {{__('damagedmaterials.titles.create')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("damagedmaterials.titles.create"),
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
                            <h6 class="card-title">{{__('damagedmaterials.titles.create')}}</h6>
                            <form  method="POST"  action="{{route('damagedmaterials.store') }}"  class="repeater">
                                @CSRF
                                <div >
                                    <div data-repeater-list="group">
                                        <div data-repeater-item class="d-flex my-2 justify-content-around">
                                            <select class="select2  mx-3" name="material_id" required=''>
                                                <option disabled  selected> اختر {{__('damagedmaterials.material_id')}}</option>
                                                @if ($materials->count() > 0)
                                                    @foreach ($materials as $material)
                                                        <option  value="{{$material->id}}"> {{$material->name}} ({{$material->measuring->name}}) </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <input type="text" class="form-control mx-3" id="inputPassword" placeholder="{{__('damagedmaterials.quantity')}}" value="{{old('quantity')}}" name="quantity" required>
                                            <input data-repeater-delete type="button" value="Delete" class="btn btn-danger w-25"/>
                                        </div>
                                    </div> 
                                </div>
                                <input data-repeater-create type="button" value="Add" class="btn btn-primary" id="RepeaterButton"/>
                                <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                                <div class="d-flex flex-row-reverse  mt-5">
                                    <button class="btn btn-primary mt-5" type="submit">{{__('app.forms.btn.FormSubmit')}}</button>
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
        $('.repeater').repeater({
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