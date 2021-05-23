@extends('layouts.app')
@section('title')
{{__('stocks.titles.index')}}
@endsection
@section('head')
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('vendors/dataTable/Buttons-1.6.1/css/buttons.dataTables.min.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3> {{__('stocks.warehousestock')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("stocks.warehousestock"),
                ]
            ])
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
                                <th> {{__('stocks.material_id')}}</th>
                                <th> {{__('stocks.quantity')}}</th>
                                <th> {{__('stocks.measuring_id')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($stocks->count() > 0)
                                    @foreach($stocks as $stock )
                                    <tr>
                                        <td>{{ $stock->id }}</td>
                                        <td>{{ $stock->material->name }}</td>
                                        <td>{{ $stock->quantity }}</td>
                                        <td>{{ $stock->material->measuring->name }}</td>
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


    <!-- Datatable -->
    <script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
    <script src="{{ url('vendors/dataTable/Buttons-1.6.1/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>
    <script>
        $('#myTable').DataTable({
            language: {
                url: "{{ url('vendors/dataTable/arabic.json') }}"
            },
            dom: 'Bfrtip',
            buttons: [
                'print','excel', 'pdf'
            ]
        });
    </script>
@endsection 
