@extends('layouts.app')
@section('title')
    {{__('users.clients.titles.index')}}
@endsection
@section('head')
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">

                    <div class="py-5">
                        <div class="container">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-6">
                                    <h2 class="mb-4 text-center">{{__('users.clients.titles.search')}}</h2>
                                    <form>
                                        <div class="input-group input-group-lg mb-3">
                                            <input type="text" class="form-control"
                                                   aria-label="Example text with button addon"
                                                   placeholder="{{__('users.clients.placeholder.search')}}" autofocus
                                                   aria-describedby="button-addon1" id="clientSearchInput">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button"
                                                        id="button-addon1">
                                                    <i class="ti-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
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
                                            <td class="text-right">
                                                <div>
                                                    <a href="{{route('orders.create',['client'=>$client->id])}}" class="btn btn-dark">طلب أوردر</a>
                                                    <a href="{{route('clients.edit',['client'=>$client->id])}}" class="btn btn-warning">تعديل العميل</a>
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

        </div>
    </div>
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
    <!-- Datatable -->
    <script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
    <script>

       var  otable = $('#user-list').DataTable({
           "language": {
               "zeroRecords": '<button type="button" id="new-record" class="btn btn-outline-secondary btn-uppercase" data-toggle="modal" data-target="#exampleModal"><i class="ti-plus mr-2"></i>{{__('users.clients.titles.subcreate')}}</button>'
           },
           order:[0,'desc']
       });
        $('#clientSearchInput').keyup(function () {
            otable.search($(this).val()).draw();
        });
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
       }

    </script>

    {{--<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>--}}
@endsection
