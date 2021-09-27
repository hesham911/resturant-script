@extends('layouts.app')
@section('title')
    {{__('users.clients.titles.index')}}
@endsection
@section('head')
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>{{__('users.clients.titles.index')}}</h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("users.clients.titles.index"),
                ]
            ])
        </div>
        <div class="mt-2 mt-md-0">
            <a href="{{route('clients.create')}}" class="btn btn-primary">{{__('users.clients.titles.subcreate')}}</a>
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
                                <th>{{__('users.clients.name')}}</th>
                                <th>{{__('users.clients.phone')}}</th>
                                <th class="text-right">{{__('app.tables.control')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$client->id}}</td>
                                    <td>{{$client->user->name}}</td>
                                    <td>{{$client->user->getNumbersPhones($client->user)}}</td>
                                    <td class="text-right d-flex flex-wrap ">
                                        @if ($client->blacklist == 0)
                                            <form action="{{route('clients.blacklist.add', $client->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-danger" type="submit">
                                                    {{__('users.clients.placeholder.addtoblacklist')}}
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{route('clients.blacklist.remove', $client->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-success">
                                                    {{__('users.clients.placeholder.removefromblacklist')}}
                                                </button>
                                            </form>
                                        @endif
                                        <div class="dropdown px-3">
                                            <a href="#" data-toggle="dropdown"
                                               class="btn btn-floating"
                                               aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('clients.edit',['client'=>$client->id])}}" class="dropdown-item">{{__('app.tables.btn.edit')}}</a>
                                                <form method="POST" action="{{route('clients.destroy',['client'=>$client->id])}}"  >
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
