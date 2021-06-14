<!doctype html>
<html lang="ar">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pos</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ url('assets/media/image/favicon.png') }}"/>
        <!-- Main css -->
        <link rel="stylesheet" href="{{ url('vendors/bundle.css') }}" type="text/css">
        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!-- App css -->
        <link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" type="text/css">
        <!-- print -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>
        <!-- print -->
        <!-- selectto -->
        <link rel="stylesheet" href="{{asset('vendors/select2/css/select2.min.css')}}" type="text/css">
        <!-- Datatable -->
        <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
        <!-- css -->
        <style >
            body.rtl .layout-wrapper .content-wrapper .content-body .content {
                margin-left: 30px;
                margin-right: 30px;
            }
            body:not(.horizontal-navigation) .navigation {
                z-index: 998;
                width: 0;
                position: fixed;
                display: flex;
                flex-direction: row;
                left: 0;
                bottom: 50px;
                top: 70px;
            }
            .listProductsTotalPrice
            {
                background-color: #D6DEFF;
                padding: 5px;
                text-align: center;
                font-size: 16px;
                margin-bottom: 12px;
            }
        </style>
    </head>
    <body class="small-navigation2 rtl">
        <!-- Preloader -->
        <div class="preloader">
            <div class="preloader-icon"></div>
            <span>Loading...</span>
        </div>
        <!-- ./ Preloader -->
        <!-- Sidebar group -->
        <div class="sidebar-group">
            <!-- BEGIN: Settings -->
            @include('admin.partials.sidebar')
            <!-- END: Settings -->
        </div>
        <!-- ./ Sidebar group -->
        <!-- Layout wrapper -->
        <div class="layout-wrapper">
            <!-- Header -->
            <div class="header d-print-none">
                @include('admin.partials.header')
            </div>
            <!-- ./ Header -->
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- begin::navigation -->
                <div class="navigation">
                    <div class="navigation-header">
                        <span>Navigation</span>
                        <a href="#">
                            <i class="ti-close"></i>
                        </a>
                    </div>
                    <div class="navigation-menu-body">
                       {{--  @include('admin.partials.menu') --}}
                    </div>
                </div>
                <!-- end::navigation -->
                <!-- Content body -->
                <div class="content-body">
                    <!-- Content -->
                    <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <form  method="POST"  action="{{route('orders.store') }}" >
                                    @CSRF
                                    <input hidden name="user_id" value="{{Auth::user()->id}}">
                                    <input hidden name="work_period_id" value="{{$workPeriod}}">
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
                                                    <div class="col-12 listProductsTotalPrice">
                                                         الاجمالي: <span>00</span>.00
                                                    </div>
                                                    <div class="d-flex flex-row-reverse" >
                                                        <button class="btn btn-primary " type="submit">تأكيد الطلب</button>
                                                    </div>
                                                </div>
                                                <div class="row mr-3">
                                                    <button type="button" class="btn btn-warning mr-2 mb-2"
                                                        data-toggle="modal" data-target="#ordersListing">
                                                        <i class="fa fa-clock-o mr-1"></i>  الطلبات
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-12">
                                            <div class="m-2 mt-md-0">
                                                <!-- category_id -->
                                                <select class="btn btn-primary" name="category_id" id="order_category_id">
                                                    <option disabled ></option>
                                                    @if (count($categories) > 0)
                                                        @foreach ($categories as $category)
                                                            <option  value="{{$category->id}}" {{(old('category_id')==$category->id)? 'selected':''}}>
                                                                {{$category->name}} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <!-- subcategory_id -->
                                                <select name="subcategory_id" class="btn btn-success" id="order_subcategory_id">
                                                    @foreach($subcategories as $subcategory)
                                                        <option value="{{$subcategory->id}}" data-tag="{{$subcategory->category->id}}">
                                                            {{$subcategory->name}}</option>
                                                    @endforeach
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
                                                    <option value="">الطاولة</option>
                                                    @if (count($tables) > 0)
                                                        @foreach ($tables as $table)
                                                            <option  value="{{$table->id}}" {{(old('table_id')==$table->id)? 'selected':''}}>
                                                                {{$table->name}} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <select class="btn btn-info select2 col-12" name="client_phone"
                                                    id="orderClient" style="37% !important">
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
                        <!-- .modal-lg for orders -->
                        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="ordersListing">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">احدث الطلبات</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="ti-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
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
                                                                    <th>#</th>
                                                                    {{-- <th>{{__('orders.client_id')}}</th> --}}
                                                                    <th>{{__('orders.category_id')}}</th>
                                                                    <th>{{__('orders.table_id')}}</th>
                                                                    <th>{{__('orders.order_type')}}</th>
                                                                    <th>{{__('orders.order_status')}}</th>
                                                                    <th>{{__('orders.total_price')}}</th>
                                                                    <th class="text-right">{{__('app.tables.control')}}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @if($orders->count() > 0)
                                                                    @foreach($orders as $order )
                                                                        <tr>
                                                                            <td></td>
                                                                            <td>{{ $order->id }}</td>
                                                                            {{-- <td>{{ $order->client_id }}</td> --}}
                                                                            <td>{{ $order->category->name }}</td>
                                                                            <td>{{($order->table_id == null)?__('orders.no_thing'):$order->table_id}}</td>
                                                                            <td>
                                                                                    <span class="badge bg-primary-bright text-primary">
                                                                                        {{ $order->typee }}
                                                                                    </span>
                                                                            </td>
                                                                            <td>
                                                                                    <span class="badge bg-info-bright text-primary">
                                                                                        {{ $order->statuss }}
                                                                                    </span>
                                                                            </td>
                                                                            <td>{{ $order->total_price}} {{__('app.settings.currency')}}</td>
                                                                            <td class="text-right">
                                                                                <a href="{{route('orders.printkitchen',$order->id)}}" role="button" class="btn btn-primary btn-sm"
                                                                                   title="طباعة للمطبخ"><i class="fa fa-building"></i>
                                                                                </a>
                                                                                <a href="{{route('orders.edit',$order->id)}}" role="button" class="btn btn-warning btn-sm"
                                                                                   title="{{__('app.tables.btn.edit')}}"><i class="fa fa-edit"></i>
                                                                                </a>
                                                                                <a href="{{route('orders.status',['order'=>$order->id,'state'=>3])}}" role="button" class="btn btn-success btn-sm"
                                                                                   title="{{__('orders.actions.payed')}}"><i class="fa fa-credit-card"></i>
                                                                                </a>
                                                                                <a href="{{route('orders.printclient',$order->id)}}" role="button" class="btn btn-primary btn-sm"
                                                                                   title="طباعة"><i class="fa fa-print"></i>
                                                                                </a>
                                                                                <a class="sendCancelOrder btn btn-danger btn-sm" role="button" data-toggle="modal"
                                                                                   title="{{__('orders.actions.cancel')}}" data-id="{{$order->id}}"
                                                                                   data-target=".examplePostModal{{$order->id}}"
                                                                                   data-commentNotice="{{route('orders.cancel',$order->id)}}">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </a>
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
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal cancel reason -->
                        <div class="modal fade" id="examplePostModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">إلغاء طلب</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="ti-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form  method="POST" id="formModalPost" action="#">
                                            {{ csrf_field() }}
                                            {{ method_field('POST') }}
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">سبب الإلغاء:</label>
                                                <input type="text" name="cancel_reason" class="form-control" id="recipient-name" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق
                                                </button>
                                                <button type="submit" class="btn btn-primary">إرسال السبب</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./ Content -->

                    <!-- Footer -->
                    <footer class="content-footer">
                        <div>© {{ date('Y') }} Gogi - <a href="http://laborasyon.com" target="_blank">Laborasyon</a></div>
                        <div>
                            <nav class="nav">
                                <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
                                <a href="#" class="nav-link">Change Log</a>
                                <a href="#" class="nav-link">Get Help</a>
                            </nav>
                        </div>
                    </footer>
                    <!-- ./ Footer -->
                </div>
                <!-- ./ Content body -->
            </div>
            <!-- ./ Content wrapper -->
        </div>
        <!-- ./ Layout wrapper -->

        <!-- Main scripts -->
        <script src="{{ url('vendors/bundle.js') }}"></script>

        <!-- App scripts -->
        <script src="{{ url('assets/js/app.min.js') }}"></script>
        <!-- selectto -->
    <script src="{{asset('vendors/select2/js/select2.min.js')}}"></script>
    <!-- repeater -->
    <script src="{{asset('vendors/jquery.repeater.min.js')}}"></script>
    <!-- Datatable -->
    <script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
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
                        console.log(data.phone);
                        $(document).ajaxStop(function(){
                            $('#exampleModal').modal('hide');
                        });
                        var datam = {
                            id: data.phone.id,
                            text: data.phone.number
                        };
                        var newOption = new Option(datam.text, datam.id, false, false);
                        $('.select2').append(newOption);
                        $('.select2').val($('.select2 option:last-child').val()).trigger('change');
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
            var prodListArr=[];
            var addingList=function()
            {
                $('.product_adding').on('click',function(e)
                {
                    e.preventDefault();
                    var id=$(this).data('id');
                    if(prodListArr.includes(id))
                    {
                        //alert('exist');
                    }
                    else
                    {
                        prodListArr.push(id);
                        var name=$(this).data('name');
                        var price=$(this).data('price');
                        var html="<tr class='prodList'><td>"+name+"</td><td><span class='prodCurrPrice"+id+"'>"+price+"</span>.00</td>"+
                            "<td><input value='1' class='prodCurrQuan"+id+"' min='1' data-quantity="+id+" name='group_a["+id+"][quantity]' type='number' style='width: 40px;text-align: center;'></td>"+
                            "<td><span class='toloOfPro prodTotlPrice"+id+"'>"+price+"</span>.00</td><td><button type='button' class='btn btn-danger delprod"+id+"' data-id='"+id+"'>"+
                            "<i class=ti-close></i></button></td>"+
                            "<td><input value="+id+" name='group_a["+id+"][product_id]' hidden></td>"+
                            "</tr>";
                        $('#products-list').append(html);
                        var oldPrice=parseInt($('.listProductsTotalPrice span').text());
                        $('.listProductsTotalPrice span').text(oldPrice+price);
                        //////////////////////////
                        $(".delprod"+id).on('click',function(e)
                        {
                            e.preventDefault();
                            var currId=$(this).data('id');
                            var currPrice=parseInt($('.prodCurrPrice'+currId).text());
                            var currQuantity=$('.prodCurrQuan'+currId).val();
                            var meCalc=currPrice*currQuantity;
                            const index = prodListArr.indexOf(currId);
                            if (index > -1)
                            {
                                prodListArr.splice(index, 1);
                            }
                            var totalPrice=parseInt($('.listProductsTotalPrice span').text());
                            $('.listProductsTotalPrice span').text(totalPrice-meCalc);
                            $(this).closest('.prodList').remove();
                        });
                        // change quantity
                        $('[data-quantity]').on('change',function ()
                        {
                            var currId=$(this).data('quantity');
                            var currPrice=parseInt($('.prodCurrPrice'+currId).text());
                            var currQuantity=$(this).val();
                            $('.prodTotlPrice'+currId).text(currPrice*currQuantity);
                            /***/
                            var inputs = $(".toloOfPro");
                            var totalPrice=0;
                            for(var i=0;i<inputs.length;i++)
                            {
                                totalPrice += parseInt($(inputs[i]).text());
                            }
                            $('.listProductsTotalPrice span').text(totalPrice);
                        });

                    }
                    // save id in array
                    /* if(prodListArr.includes(id))
                    {
                        //alert('exist');
                    }
                    else
                    {
                        prodListArr.push(id);
                        //alert('Added Now : '+prodListArr);
                        //
                        var name=$(this).data('name');
                        var price=$(this).data('price');
                        var html="<tr class='prodList'><td>"+name+"</td><td><span class='prodCurrPrice"+id+"'>"+price+"</span>.00</td>"+
                            "<td><input value='1' min='1' data-quantity="+id+" name='group_a["+id+"][quantity]' type='number' style='width: 40px;text-align: center;'></td>"+
                            "<td><span class='toloOfPro prodTotlPrice"+id+"'>"+price+"</span>.00</td><td><button type='button' class='btn btn-danger delprod' data-id='"+id+"'>"+
                            "<i class=ti-close></i></button></td>"+
                            "<td><input value="+id+" name='group_a["+id+"][product_id]' hidden></td>"+
                            "</tr>";
                        $('#products-list').append(html);
                        var oldPrice=parseInt($('.listProductsTotalPrice span').text());
                        $('.listProductsTotalPrice span').text(oldPrice+price);
                    } */
                });
            };
            addingList();
            // table and order type
            $('#orderType').on('change',function()
            {
                if($(this).val() !=0)
                {
                    $('#tableHall').hide();
                    $("#tableHall").val($("#tableHall option:first").val());
                }
                else
                {
                    $('#tableHall').show();
                }
            });
            // client and order type
            $('#orderType').on('change',function()
            {
                if($(this).val() !=1)
                {

                    $('.select2').val($('.select2 option:first-child').val()).trigger('change');
                    $('.select2').hide();
                    // to make phone and zone null
                    $('#orderClientPhone,#orderClientZone').hide();
                    //$("#orderClientPhone").val($("#orderClientPhone option:first").val());
                    $("#orderClientZone").val($("#orderClientZone option:first").val());
                }
                else
                {
                    $('.select2').show();
                }
            });
            // client info
            $('#clientInfo').hide();
            $('.select2').on('change',function()
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
                            console.log(data);
                            $('#clientInfo').html(data);
                        }
                    });
                }
                else
                {
                    $('#clientInfo').hide();
                }
            });
            /************************/
            // category and subcategory
            // select category and subcategory
            //id="order_subcategory_id"//order_subcategory_id
            $('#order_category_id').on('change', function()
            {
                var selected = $(this).val();
                var mysub;
                $('#order_subcategory_id option').each(function()
                {
                    var element = $(this);
                    if (element.data("tag") != selected)
                    {
                        element.hide();
                    }
                    else
                    {
                        element.show();
                        mysub=element.val();
                    }
                });
                $('#order_subcategory_id').val(mysub);
            });
            var selected = $('#order_category_id').val();
            $('#order_subcategory_id option').each(function()
            {
                var element = $(this);
                if (element.data("tag") != selected)
                {
                    element.hide();
                }
                else
                {
                    $("#order_subcategory_id").val(element.val());
                    $.ajax({
                        type: "GET",
                        data: {
                            'subcategory_id':element.val(),
                        },
                        url: "{{ route('orders.filter') }}",
                        success:function(data) {
                            $('#product-data').html(data);
                            addingList();
                        }
                    });
                }
            });
            $("#order_category_id,#order_subcategory_id").change( function()
            {
                var subcat=$('#order_subcategory_id').val();
                $.ajax({
                    type: "GET",
                    data: {
                        'subcategory_id':subcat,
                    },
                    url: "{{ route('orders.filter') }}",
                    success:function(data) {
                        $('#product-data').html(data);
                        addingList();
                    }
                });
            });
            /////////
            // cancel order
            $('.sendCancelOrder').on('click',function ()
            {
                var comment_id=$(this).attr("data-id");
                var url=$(this).attr('data-commentNotice');
                $('#formModalPost').attr('action',url);
                $('#examplePostModal').addClass('examplePostModal'+comment_id);
                //$('#examplePostModal h3').text('Send Notice ( Comment )');
            });
        });
    </script>

    </body>
</html>
