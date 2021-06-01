@extends('layouts.app')
@section('title')
    {{__('orders.titles.index')}}
@endsection
@section('head')
    <!-- selectto -->
    <link rel="stylesheet" href="{{asset('vendors/select2/css/select2.min.css')}}" type="text/css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form  method="POST"  action="{{route('orders.store') }}" >
                @CSRF
                <input hidden name="user_id" value="{{Auth::user()->id}}">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- options -->
                                {{-- <div class="">
                                    <a href="">
                                        <i class="fa fa-print fa-2x"></i>
                                    </a>
                                </div> --}}
                                {{-- <h6 class="card-title">Filter Products</h6> --}}
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
                                    <table id="myTable" class="table  table-lg">
                                        <thead>
                                            <tr>
                                                <th>المنتج</th>
                                                <th>السعر</th>
                                                <th>الكمية</th>
                                                <th>الاجمالى</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="products-list">
                                            <!-- Content -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex flex-row-reverse" >
                                    <button class="btn btn-primary " type="submit">{{__('app.forms.btn.add')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="m-2 mt-md-0">
                            <select name="subcategory_id" class="btn btn-success" id="order_subcategory_id">
                                <option value="">--الكل--</option>
                                @foreach($subcategories as $subcategory)
                                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                @endforeach
                            </select>
                            <!-- category_id -->
                            <select class="btn btn-primary" name="category_id">
                                <option disabled ></option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option  value="{{$category->id}}" {{(old('category_id')==$category->id)? 'selected':''}}>
                                            {{$category->name}} </option>
                                    @endforeach
                                @endif
                            </select>
                            <!-- type -->
                            <select class="btn btn-info" name="type" id="orderType">
                                <option disabled ></option>
                                @if (count($types) > 0)
                                    @foreach ($types as $key=>$type)
                                        <option  value="{{$key}}" {{(old('type')==$key)? 'selected':''}}>
                                            {{$type}} </option>
                                    @endforeach
                                @endif
                            </select>
                            <!-- table -->
                            <select class="btn btn-info" name="table_id" id="tableHall">
                                <option disabled ></option>
                                @if (count($tables) > 0)
                                    @foreach ($tables as $table)
                                        <option  value="{{$table->id}}" {{(old('table_id')==$table->id)? 'selected':''}}>
                                            {{$table->name}} </option>
                                    @endforeach
                                @endif
                            </select>
                            <select class="btn btn-info select2 col-3" name="client_phone" id="orderClient">
                                <option value="">رقم العميل</option>
                                @foreach ($phones as $phone)
                                        <option  value="{{$phone->id}}">
                                            {{$phone->number}} </option>
                                    @endforeach
                            </select>
                            <!-- client zone and phone -->
                            <div class="col-12 mt-1" id="clientInfo">
                                @include('admin.orders.clientInfo')
                            </div>
                            <!-- end -->
                        </div>
                        <div class="row" id="product-data">
                            <!-- content -->
                            @include('admin.orders.posContent')
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- modal -->
    <div class="modal" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('users.clients.titles.subcreate')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="client_form" method="post" action="{{route('clients.store')}}" multiple>
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="col-3">
                                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="{{__('users.clients.placeholder.name')}}">
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" name="number"  placeholder="{{__('users.clients.placeholder.phone')}}">
                            </div>
                            <div class="col-3">
                                <select id="inputState" name="zone" class="form-control">
                                    @if(count($zones) > 0)
                                        @foreach($zones as $key => $zone)
                                            <option value="{{$zone->id}}" {{(old('zone')==$zone->id)? 'selected':''}}>{{$zone->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-3">
                                <input type="text" name="address" class="form-control" placeholder="{{__('users.clients.placeholder.address')}}">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button onclick="handleSubmit()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- selectto -->
    <script src="{{asset('vendors/select2/js/select2.min.js')}}"></script>
    <!-- repeater -->
    <script src="{{asset('vendors/jquery.repeater.min.js')}}"></script>
    <script>
        // modal
        function handleSubmit (data) {
                var url = '{{route('clients.store.ajax')}}';
                $.ajax({
                    type: "POST",
                    url: url,
                    data:   $('#client_form').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $(document).ajaxStop(function(){
                            $('#exampleModal').modal('hide');
                            $('#clientSearchInput').val('');
                            window.location.reload();
                        });
                    }
                });
            };
            //
        // filter
        $(document).ready(function()
        {
            $('.select2').select2({
                "language": {
                    "noResults": function(){
                        return '<button type="button" id="new-record" class="btn btn-outline-secondary btn-uppercase" data-toggle="modal" data-target="#exampleModal"><i class="ti-plus mr-2"></i>{{__('users.clients.titles.subcreate')}}</button>';
                        },
                    },
                escapeMarkup: function (markup) {
                    return markup;
                }
            });
            $('.select2').hide();
            var addingList=function()
            {
                $('.product_adding').on('click',function(e)
                {
                    e.preventDefault();
                    var id=$(this).data('id');
                    var name=$(this).data('name');
                    var price=$(this).data('price');
                    var html="<tr class='prodList'><td>"+name+"</td><td><span>"+price+"</span></td>"+
                        "<td><input value='1' name='group_a["+id+"][quantity]' type='number' style='width: 40px;text-align: center;'></td>"+
                        "<td><span>"+price+"</span></td><td><button type='button' class='btn btn-danger delprod'>"+
                        "<i class=ti-close></i></button></td>"+
                        "<td><input value="+id+" name='group_a["+id+"][product_id]' hidden></td>"+
                        "</tr>";
                    $('#products-list').append(html);
                    $(".delprod").on('click',function(e){
                        e.preventDefault();
                        $(this).closest('.prodList').remove();
                    });
                
                });
            };
            addingList();
            //
            $("#order_subcategory_id").change( function()
            {
                //alert($(this).val());
                var subcat=$(this).val();
                $.ajax({
                    type: "GET",
                    data: {
                        'subcategory_id':subcat,
                    },
                    url: "{{ route('orders.filter') }}",
                    success:function(data) {
                        $('#product-data').html(data);
                        /**/
                        addingList();
                    }
                });
            });
            // table and order type
            $('#orderType').on('change',function()
            {
                if($(this).val() !=0)
                {
                    $('#tableHall').hide();
                }
                else
                {
                    $('#tableHall').show();
                }
            });
            // client and order type
            $('#orderClient').hide();
            $('#orderType').on('change',function()
            {
                if($(this).val() !=1)
                {
                    $('#orderClient').hide();
                    $("#orderClient").val($("#orderClient option:first").val());
                    // to make phone and zone null
                    $('#orderClientPhone,#orderClientZone').hide();
                    //$("#orderClientPhone").val($("#orderClientPhone option:first").val());
                    $("#orderClientZone").val($("#orderClientZone option:first").val());
                }
                else
                {
                    $('.select2').show();
                    $('#orderClient').show();
                }
            });
            // client info
            $('#clientInfo').hide();
            $('#orderClient').on('change',function()
            {
                if($(this).val() != "")
                {
                    var client_id=$(this).val();
                    $('#clientInfo').show();
                    $.ajax({
                        type: "GET",
                        data: {
                            'client_id':client_id,
                        },
                        url: "{{ route('orders.clientinfo') }}",
                        success:function(data)
                        {
                            $('#clientInfo').html(data);
                        }
                    });
                }
                else
                {
                    $('#clientInfo').hide();
                }
            });
        });
    </script>
@endsection
