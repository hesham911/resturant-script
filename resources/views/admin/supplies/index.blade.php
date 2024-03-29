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
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("supplies.titles.index"),
                ]
            ])
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
                        <table id="myTable" class="table table-sm table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> {{__('supplies.employee_id')}}</th>
                                <th> {{__('supplies.material_id')}}</th>
                                <th> {{__('supplies.quantity')}}</th>
                                <th> {{__('supplies.measuring_id')}}</th>
                                <th> {{__('supplies.price')}}</th>
                                <th> {{__('supplies.Supplier_name')}}</th>
                                <th> {{__('supplies.expiry_date')}}</th>
                                <th> {{__('supplies.status')}}</th>
                                <th> {{__('supplies.used_amount')}}</th>
                                <th> {{__('supplies.bill_number')}}</th>
                                <th class="text-right"> خيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($supplies->count() > 0)
                                    @foreach($supplies as $supply )
                                    <tr>
                                        <td>{{ $supply->id }}</td>
                                        <td>{{ $supply->user->name }}</td>
                                        <td>{{ $supply->material->name }}</td>
                                        <td>{{ $supply->quantity }}</td>
                                        <td>{{ $supply->material->measuring->name }}</td>
                                        <td>{{ $supply->price }}</td>
                                        <td>{{ $supply->Supplier_name }}</td>
                                        <td>{{ $supply->expiry_date }}</td>
                                        <td>{{ $supply->status == false ? "غير منتهي" : "منتهي" }}</td>
                                        <td>{{ $supply->used_amount }}</td>
                                        <td>{{ $supply->bill_number }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" data-toggle="dropdown"
                                                class="btn btn-floating"
                                                aria-haspopup="true" aria-expanded="false">
                                                    <i class="ti-more-alt"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{route('supplies.edit',$supply->id)}}" class="dropdown-item">{{__('app.forms.btn.edit')}}</a>
                                                    <form method="POST" action="{{route('supplies.destroy',$supply->id)}}" >
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE" >
                                                        <button class="dropdown-item text-danger" >
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
    <script src="{{ url('vendors/dataTable/Buttons-1.6.1/js/dataTables.buttons.min.js') }}"></script>

    <script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>
    <script>
        $('#myTable').DataTable({
            language: {
                url: "{{ url('vendors/dataTable/arabic.json') }}"
            }
        });
    </script>
@endsection
