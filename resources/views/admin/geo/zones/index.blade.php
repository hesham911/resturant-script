@extends('layouts.app')
@section('title')
    المناطق
@endsection
@section('head')
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>{{__('geo.zones.titles.index')}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("geo.zones.titles.index"),
                ]
            ])
        </div>
        <div class="mt-2 mt-md-0">

                <a href="#" class="btn btn-primary">{{__('geo.zones.titles.subcreate')}}</a>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="user-list" class="table table-lg">
                            <thead>
                            <tr>
                                <th>{{__('app.tables.num')}}</th>
                                <th>{{__('geo.zones.name')}}</th>
                                <th>{{__('geo.zones.price')}}</th>
                                <th class="text-right">{{__('app.tables.control')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($zones as $zone)
                                <tr>
                                <td>{{$zone->id}}</td>
                                <td>{{$zone->name}}</td>
                                <td>{{$zone->price}}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown"
                                           class="btn btn-floating"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{route('zones.edit',['zone'=>$zone->id])}}" class="dropdown-item">{{__('app.edit')}}</a>
                                            <a href="{{route('zones.destroy',['zone'=>$zone->id])}}" class="dropdown-item text-danger">{{__('app.delete')}}</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
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

    {{--<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>--}}
@endsection
