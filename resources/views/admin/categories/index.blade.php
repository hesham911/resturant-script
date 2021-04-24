@extends('layouts.app')
@section('title')
{{__('categories.titles.index')}}
@endsection
@section('head')
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div class="page-header d-md-flex justify-content-between">
            <div>
                <h3>{{__('categories.titles.index')}}</h3>
                @include('admin.partials.breadcrumb',[
                    'parent' => [
                        'name' => __("geo.zones.titles.index"),
                    ]
                ])
            </div>
        </div>  
        <div class="mt-2 mt-md-0">
            <div class="dropdown ml-2">
                <a href="{{route('categories.create')}}" class="btn btn-primary " >{{__('categories.titles.create')}}</a>
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
                                <th>{{__('app.tables.num')}}</th>
                                <th> {{__('categories.name')}}</th>
                                <th class="text-right"> {{__('app.tables.control')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($categories->count() > 0)
                                    @foreach($categories as $category )
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" data-toggle="dropdown"
                                                class="btn btn-floating"
                                                aria-haspopup="true" aria-expanded="false">
                                                    <i class="ti-more-alt"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{route('categories.edit',$category->id)}}" class="dropdown-item">{{__('app.tables.btn.edit')}}</a>
                                                    <form method="POST" action="{{route('categories.destroy',$category->id)}}"  >
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
