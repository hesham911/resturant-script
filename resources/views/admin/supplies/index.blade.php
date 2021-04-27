@extends('layouts.app')
@section('title')
{{__('supplies.titles.index')}}
@endsection
@section('head')
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3> {{__('supplies.titles.index')}} </h3>
            {{-- @include('admin.partials.breadcrumbs',[
                        'name' => 'الأقسام',
                        'parent' => [
                            'name' => 'Blog',
                            'url' =>'articles/'
                            ]
                        ]) --}}
            <nav aria-label="breadcrumb" class="d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Pages</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>
        <div class="mt-2 mt-md-0">
            <div class="dropdown ml-2">
                <a href="{{route('supplies.create')}}" class="btn btn-primary " >{{__('supplies.titles.create')}}</a>
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
                                <th> {{__('supplies.employee_id')}}</th>
                                <th> {{__('supplies.material_id')}}</th>
                                <th> {{__('supplies.quantity')}}</th>
                                <th> {{__('supplies.measuring_id')}}</th>
                                <th> {{__('supplies.price')}}</th>
                                <th> {{__('supplies.Supplier_name')}}</th>
                                <th> {{__('supplies.expiry_date')}}</th>
                                <th class="text-right"> خيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($supplies->count() > 0)
                                    @foreach($supplies as $supply )
                                    <tr>
                                        <td></td>
                                        <td>{{ $supply->id }}</td>
                                        <td>{{ $supply->employee->user->name }}</td>
                                        <td>{{ $supply->material->name }}</td>
                                        <td>{{ $supply->quantity }}</td>
                                        <td>{{ $supply->material->measuring->name }}</td>
                                        <td>{{ $supply->price }}</td>
                                        <td>{{ $supply->Supplier_name }}</td>
                                        <td>{{ $supply->expiry_date }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" data-toggle="dropdown"
                                                class="btn btn-floating"
                                                aria-haspopup="true" aria-expanded="false">
                                                    <i class="ti-more-alt"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{route('supplies.edit',$supply->id)}}" class="dropdown-item">{{__('app.forms.btn.edit')}}</a>
                                                    <form method="POST" action="{{route('supplies.destroy',$supply->id)}}" class="dropdown-item text-danger" >
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
