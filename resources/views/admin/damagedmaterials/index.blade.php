@extends('layouts.app')
@section('title')
{{__('damagedmaterials.titles.index')}}
@endsection
@section('head')
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('vendors/dataTable/Buttons-1.6.1/css/buttons.dataTables.min.css') }}" type="text/css">

@endsection

@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3> {{__('damagedmaterials.titles.index')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("damagedmaterials.titles.index"),
                ]
            ])
        </div>
        <div class="mt-2 mt-md-0">
            <div class="dropdown ml-2">
                <a href="{{route('damagedmaterials.create')}}" class="btn btn-primary " >{{__('damagedmaterials.titles.create')}}</a>
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
                        <table id="myTable" class="table table-lg">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> {{__('damagedmaterials.material_id')}}</th>
                                <th> {{__('damagedmaterials.quantity')}}</th>
                                <th> {{__('damagedmaterials.price')}}</th>
                                <th> {{__('damagedmaterials.employee_id')}}</th>
                                {{-- <th class="text-right"> خيارات</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                                @if($damaged_materials->count() > 0)
                                    @foreach($damaged_materials as $damaged_material )
                                    <tr>
                                        <td>{{ $damaged_material->id }}</td>
                                        <td>{{ $damaged_material->material->name }}</td>
                                        <td>{{ $damaged_material->quantity }}</td>
                                        <td>{{ $damaged_material->price }}</td>
                                        <td>{{ $damaged_material->employee->user->name }}</td>
                                        {{-- <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" data-toggle="dropdown"
                                                class="btn btn-floating"
                                                aria-haspopup="true" aria-expanded="false">
                                                    <i class="ti-more-alt"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{route('damagedmaterials.edit',$damaged_material->id)}}" class="dropdown-item">{{__('app.forms.btn.edit')}}</a>
                                                    <form method="POST" action="{{route('damagedmaterials.destroy',$damaged_material->id)}}" class="dropdown-item text-danger" >
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE" >
                                                        <button class="btn btn-link" >
                                                            {{__('app.forms.btn.delete')}}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td> --}}
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
        $('#myTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'print','excel', 'pdf'
            ],
            language: {
                url: "{{ url('vendors/dataTable/arabic.json') }}"
            }
        } );
    </script>
@endsection
