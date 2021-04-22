@extends('layouts.app')
@section('title')
    {{__('orders.titles.index')}}
@endsection
@section('head')
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3> {{__('orders.titles.index')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __('orders.titles.index'),
                ]
            ])
        </div>
        <div class="mt-2 mt-md-0">
            <a href="#" class="btn btn-primary">{{__('orders.titles.create')}}</a>
        </div>
       {{--  <div class="mt-2 mt-md-0">
            <div class="dropdown">
                <a href="#" class="btn btn-success dropdown-toggle" title="Filter" data-toggle="dropdown">Filters</a>
                <div class="dropdown-menu dropdown-menu-big p-4 dropdown-menu-right">
                    <form>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control">
                                <option value="">Select</option>
                                <option value="">User</option>
                                <option value="">Staff</option>
                                <option value="">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control">
                                <option value="">Select</option>
                                <option value="">Active</option>
                                <option value="">Blocked</option>
                                <option value="">Admin</option>
                            </select>
                        </div>
                        <button class="btn btn-primary">Get Results</button>
                        <button class="btn btn-link ml-2">Save Filter</button>
                    </form>
                </div>
            </div>
            <div class="dropdown ml-2">
                <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Actions</a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item">Edit</a>
                    <a href="#" class="dropdown-item">Change Status</a>
                    <a href="#" class="dropdown-item text-danger">Delete</a>
                </div>
            </div>
        </div> --}}
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
                                <th>{{__('app.tables.num')}}</th>
                                <th>{{__('orders.client_id')}}</th>
                                <th>{{__('orders.subcategory_id')}}</th>
                                <th>{{__('orders.table_id')}}</th>
                                <th>{{__('orders.type')}}</th>
                                <th>{{__('orders.status')}}</th>
                                <th class="text-right">{{__('app.tables.control')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($orders->count() > 0)
                                    @foreach($orders as $order )
                                        <tr>
                                            <td></td>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->client_id }}</td>
                                            <td>{{ $order->subcategory->name }}</td>
                                            <td>{{ $order->table_id }}</td>
                                            <td>{{ $order->type }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown"
                                                    class="btn btn-floating"
                                                    aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-more-alt"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{route('orders.edit',$order->id)}}" class="dropdown-item">{{__('app.tables.btn.edit')}}</a>
                                                        <form method="POST" action="{{route('orders.destroy',$order->id)}}"  >
                                                            @csrf
                                                            <input type="hidden" name="_method" value="DELETE" >
                                                            <button class="dropdown-item text-danger" >
                                                                {{__('app.tables.btn.delete')}}
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
