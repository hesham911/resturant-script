@extends('layouts.app')
@section('title')
{{__('kitchenrequests.titles.index')}}
@endsection
@section('head')
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3> {{__('kitchenrequests.titles.index')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("kitchenrequests.titles.index"),
                ]
            ])
        </div>
        <div class="mt-2 mt-md-0">
            <div class="dropdown ml-2">
                <a href="{{route('kitchenrequests.create')}}" class="btn btn-primary " >{{__('kitchenrequests.titles.create')}}</a>
            </div>
        </div>
    </div>

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
                    <div class="table-responsive">
                        <table id="user-list" class="table table-lg">
                            <thead>
                            <tr>
                                <th>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="user-list-select-all">
                                        <label class="custom-control-label" for="user-list-select-all"></label>
                                    </div>
                                </th>
                                <th>#</th>
                                <th> {{__('kitchenrequests.material_id')}}</th>
                                <th> {{__('kitchenrequests.quantity')}}</th>
                                <th> {{__('kitchenrequests.status')}}</th>
                                <th> {{__('kitchenrequests.employee_id')}}</th>
                                <th class="text-right"> خيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($kitchenrequests->count() > 0)
                                    @foreach($kitchenrequests as $kitchenrequest )
                                    <tr>
                                        <td></td>
                                        <td>{{ $kitchenrequest->id }}</td>
                                        <td>{{ $kitchenrequest->material->name }}</td>
                                        <td>{{ $kitchenrequest->quantity }}</td>
                                        <td>{{ $kitchenrequest->status() [$kitchenrequest->status]}}</td>
                                        <td>{{ $kitchenrequest->employee->user->name }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" data-toggle="dropdown"
                                                class="btn btn-floating"
                                                aria-haspopup="true" aria-expanded="false">
                                                    <i class="ti-more-alt"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{route('kitchenrequests.edit',$kitchenrequest->id)}}" class="dropdown-item">{{__('app.forms.btn.edit')}}</a>
                                                    <form method="POST" action="{{route('kitchenrequests.destroy',$kitchenrequest->id)}}" class="dropdown-item text-danger" >
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE" >
                                                        <button class="btn btn-link" >
                                                            {{__('app.forms.btn.delete')}}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- Datatable -->
    <script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>

    <script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>
@endsection
