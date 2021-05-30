@extends('layouts.app')
@section('title')
 {{__('categories.titles.create')}}
@endsection
@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
    <!-- selectto -->
    <link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">
     <!-- Datatable -->
     <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header">
        <div>
            <h3> {{__('categories.titles.create')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __("categories.titles.create"),
                ]
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
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
                            <h6 class="card-title">{{__('categories.titles.create')}}</h6>
                            <div class="mb-5 row">
                                <div class="form-group row col-md-3">
                                    <label class="col-3">من </label>
                                    <input type="date" class="form-control col-9" id="from">
                                </div>
                                <div class="form-group row col-md-4">
                                    <label class="col-3">الي </label>
                                    <input type="date" class="form-control col-9" id="to">
                                </div>
                                <div class="form-group d-flex col-md-4">
                                    <label class="col-4">المادة الخام </label>
                                    <select class="select2 col-8 " multiple id="material">
                                        @if ($materials->count() > 0)
                                            @foreach ($materials as $material)
                                                <option value="{{$material->id}}">{{$material->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="">
                                    <button class="btn btn-primary">عرض </button>
                                </div>
                            </div>
                            <table id="myTable" class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>المادة الخام</th>
                                        <th> الوحدة </th>
                                        <th>الكمية </th>
                                        <th>السعر</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Form validation example -->
    <script src="{{ url('assets/js/examples/form-validation.js') }}"></script>
    <!-- Prism -->
    <script src="{{ url('vendors/prism/prism.js') }}"></script>
    <!-- selectto -->
    <script src="{{asset('vendors/select2/js/select2.min.js')}}"></script>
    <!-- Datatable -->
    <script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
    <script src="{{ url('vendors/dataTable/Buttons-1.6.1/js/dataTables.buttons.min.js') }}"></script>
    <script>
        $('.select2').select2();

        $('#myTable').DataTable({
                language: {
                    url: "{{ url('vendors/dataTable/arabic.json') }}"
                },
                processing: true,
                serverSide: true,
                ajax:{
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'{{route("reports.warehouse.index.data")}}',
                    data: {
                        to: $('#to').val(),
                        from: $('#from').val(),
                        material: $('#material').val(),
                    },
                    type:'POST',
                },
                columns:[
                    {
                        data:'id',
                        name: 'id'
                    },{
                        data:'name',
                        name: 'name'
                    },{
                        data:'measuring.name',
                        name: 'unit'
                    },{
                        data:function(data){
                            var quantity = 0;
                            $.each(data.supplies,function(index , value){
                                quantity = quantity + value.quantity;
                            });
                            return quantity;
                        },
                        name: 'quantity'
                    },{
                        data:function(data){
                            var price = 0;
                            $.each(data.supplies,function(index , value){
                                price = price + value.price;
                            });
                            return price;
                        },
                        name: 'price'
                    },
                ],


        });
    </script>
@endsection
