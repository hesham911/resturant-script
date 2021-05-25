@extends('layouts.app')
@section('title')
    {{__('users.clients.titles.create')}}
@endsection
@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">

    <!-- select2 css -->
    <link rel="stylesheet" href="{{url('vendors/select2/css/select2.min.css')}}" type="text/css">
@endsection

@section('content')

    <div class="page-header">
        <div>
            <h3>{{__('users.clients.titles.create')}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("users.clients.titles.create"),
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
                            <h6 class="card-title">{{__('users.clients.titles.subcreate')}}</h6>
                            <form method="post" action="{{route('clients.store')}}" multiple>
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">{{__('users.clients.name')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="{{__('users.clients.placeholder.name')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2">{{__('users.clients.phone')}}</label>
                                    <div class="basic-repeater col-sm-4">
                                        <div data-repeater-list="group_a">
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class="col-md-10 col-sm-12 form-group">
                                                        <input type="text" class="form-control" name="number" id="number"
                                                               placeholder="{{__('users.clients.placeholder.phone')}}" required>
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
                                <div class="form-group row">
                                    <label class="col-sm-2">{{__('users.clients.address')}}</label>
                                    <div class="basic-repeater col-sm-10">
                                        <div data-repeater-list="group_b">
                                            <div data-repeater-item >
                                                <div class="row">
                                                    <div class="col-md-5 col-sm-12 form-group">
                                                        <label  for="zone">{{__('users.clients.zone')}}</label>
                                                        <select name="zone" id="zone" class="zone" required>
                                                            <option disabled >{{__('users.clients.placeholder.zone')}}</option>
                                                            @if(count($zones) > 0)
                                                                @foreach($zones as $key => $zone)
                                                                    <option value="{{$zone->id}}" {{(old('zone')==$zone->id)? 'selected':''}}>{{$zone->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5 col-sm-12 form-group">
                                                        <label for="address">{{__('users.clients.address_details')}}</label>
                                                        <input class="form-control" name="address" id="address" placeholder="{{__('users.clients.placeholder.address')}}" required/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 form-group">
                                                        <div><label>&nbsp;</label></div>
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

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">{{__('app.forms.btn.add')}}</button>
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

    <!-- select2 script -->
    <script src="{{url('vendors/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('vendors/jquery.repeater.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.zone').select2({
                placeholder: "المنطقة"
            });

            $('.basic-repeater').repeater({
                show: function () {
                    $(this).slideDown();
                    $('.select2-container').remove();
                    $('.zone').select2({});
                    $('.select2-container').css('width','100%');
                }
            });



        });
    </script>

@endsection
