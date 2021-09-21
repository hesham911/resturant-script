@extends('layouts.app')
@section('title')
    {{__('reports.titles.warehouseout')}}
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
            <h3> {{__('reports.titles.warehouseout')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __('reports.titles.warehouseout'),
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
                            <h6 class="card-title">{{__('reports.titles.warehouseout')}}</h6>
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
                                    <button class="btn btn-primary" id="view">عرض </button>
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
    $(document).ready(function(){
        $('.select2').select2();
        $('#view').click(function(){
            table.ajax.reload();
        });
        var table = $('#myTable').DataTable({
                language: {
                    url: "{{ url('vendors/dataTable/arabic.json') }}"
                },
                processing: true,
                serverSide: true,
                searching:false,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'print'
                ],
                ajax:{
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'{{route("reports.warehouseout.index.data")}}',
                    data: function(d){
                        d.to = $('#to').val();
                        d.from = $('#from').val();
                        d.material =  $('#material').val();
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
                            $.each(data.kitchenrequests,function(index , value){
                                quantity += +value.quantity;
                            });
                            return quantity;
                        },
                        name: 'quantity'
                    },{
                        data:function(data){
                            var price = 0;
                            $.each(data.kitchenrequests,function(index , value){
                                price +=  + value.price;
                            });
                            return price;
                        },
                        name: 'price'
                    },
                ],
        }).on( 'draw.dt', function () {
            $('.layout-wrapper .content-wrapper .content-body .content').getNiceScroll().resize();
        });
    });
    </script>
@endsection
