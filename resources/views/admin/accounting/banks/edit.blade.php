@extends('layouts.app')
@section('title')
    {{__('accounting.banks.titles.edit')}}
@endsection
@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
    <link rel="stylesheet" href="{{url('vendors/select2/css/select2.min.css')}}" type="text/css">
@endsection

@section('content')

    <div class="page-header">
        <div>
            <h3>{{__('accounting.banks.titles.edit')}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("accounting.banks.titles.edit"),
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
                            <h6 class="card-title">{{__('accounting.banks.titles.edit')}}</h6>
                            <form method="post" action="{{route('banks.update',['bank'=>$bank->id])}}" multiple>
                                @CSRF
                                <input type="hidden" name="_method" value="PUT" >
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">{{__('accounting.banks.name')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{old('name',$bank->name)}}" class="form-control" id="name" placeholder="{{__('accounting.banks.placeholder.name')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="types_bank" class="col-sm-2 col-form-label">{{__('accounting.banks.types_bank')}}</label>
                                    <div class="col-sm-10">
                                        <select name="type" id="types_bank" class="types_bank">
                                            <option disabled >{{__('accounting.banks.placeholder.types_bank')}}</option>
                                            @if(count($types) > 0)
                                                @foreach($types as $key => $type)
                                                    <option value="{{$key}}" {{(old('type',$bank->type)==$key)? 'selected':''}}>{{$type}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="notes" class="col-sm-2 col-form-label">{{__('accounting.banks.notes')}}</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" name="notes"  class="form-control" id="notes" placeholder="{{__('accounting.banks.placeholder.notes')}}">{{old('name',$bank->notes)}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="balance" class="col-sm-2 col-form-label">{{__('accounting.banks.balance')}}</label>
                                    <div class="col-sm-10">
                                        @if($transCount > 1)
                                        <input readonly type="text" name="opening_balance" value="{{old('opening_balance',$bank->opening_balance)}}" class="form-control" id="balance" placeholder="{{__('accounting.banks.placeholder.balance')}}">
                                            <p class="alert alert-danger">{{__('accounting.banks.massages.cant_edit_balance')}}</p>
                                        @else
                                            <input  type="text" name="opening_balance" value="{{old('opening_balance',$bank->opening_balance)}}" class="form-control" id="balance" placeholder="{{__('accounting.banks.placeholder.balance')}}">
                                        @endif
                                    </div>
                                </div>
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
    <script src="{{url('vendors/select2/js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.types_bank').select2({
                placeholder: "الوظيفة"
            });
        });
    </script>
@endsection
