@extends('layouts.app')
@section('title')
    {{__('products.titles.index')}}
@endsection
@section('head')
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3> {{__('products.titles.index')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __('products.titles.index'),
                ]
            ])
        </div>
        <div class="mt-2 mt-md-0">
            <a href="{{route('products.create')}}" class="btn btn-primary">{{__('products.titles.create')}}</a>
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
                                    <th>{{__('app.tables.num')}}</th>
                                    <th>{{__('products.name')}}</th>
                                    <th>{{__('products.subcategory_id')}}</th>
                                    <th>{{__('products.price')}}</th>
                                    <th>{{__('products.type')}}</th>
                                    <th class="text-right">{{__('app.tables.control')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($products->count() > 0)
                                    @foreach($products as $product )
                                        <tr>
                                            <td></td>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->subcategory->name }}</td>
                                            <td>{{ $product->price }} {{__('app.settings.currency')}}</td>
                                            <td>
                                                <span class="badge bg-primary-bright text-primary">
                                                    {{ $product->typeث }}
                                                </span>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown"
                                                       class="btn btn-floating"
                                                       aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-more-alt"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{route('products.edit',$product->id)}}" class="dropdown-item">{{__('app.tables.btn.edit')}}</a>
                                                        <form method="POST" action="{{route('products.destroy',$product->id)}}"  >
                                                            @CSRF
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
