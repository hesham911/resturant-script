@extends('layouts.app')
@section('title')
{{__('damagedmaterials.titles.edit')}}
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
            <h3> {{__('damagedmaterials.titles.edit')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("kitchenrequests.titles.edit"),
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
                            <h6 class="card-title">{{__('damagedmaterials.titles.edit')}}</h6>
                            <form class="needs-validation" novalidate="" method="POST"  action="{{route('kitchenrequests.update',$kitchenrequest->id ) }}" >
                                @csrf
                                <input type="hidden" name="_method" value="PUT" >
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('damagedmaterials.material_id')}}</label>
                                    <div class="col-sm-10">
                                    <select class="select2 " name="material_id">
                                        <option disabled  selected> اختر {{__('damagedmaterials.material_id')}}</option>
                                        @if ($materials->count() > 0)
                                            @foreach ($materials as $material)
                                                <option  value="{{$material->id}}" @if ($material->id == old('material_id',$kitchenrequest->material_id)) selected @endif> {{$material->name}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">
                                        {{__('damagedmaterials.quantity')}}
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPassword" placeholder="{{__('damagedmaterials.quantity')}}" value="{{old('quantity',$kitchenrequest->quantity)}}" name="quantity">
                                    </div>
                                </div>
                                <input type="hidden" value="{{$kitchenrequest->employee_id}}" name="employee_id">
                                <div class="d-flex flex-row-reverse" >
                                    <button class="btn btn-primary " type="submit">
                                       {{__('app.forms.btn.FormSubmit')}}
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